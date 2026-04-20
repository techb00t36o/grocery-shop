<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/components/product-card.php';

$page_title = SITE_NAME . ' — Shop';
$page_description = 'Shop fresh fruits & vegetables. Filter by category, tag, availability, and price.';

$all = demo_products();

// Query params (shareable).
$q = strtolower((string)(get_qs('q', '') ?? ''));
$categories = get_qs_array('category'); // Fruits, Vegetables
$tags = get_qs_array('tag'); // Organic, Seasonal
$availability = get_qs('availability', ''); // in_stock | on_sale
$sort = get_qs('sort', 'relevance') ?? 'relevance';
$min = (float)(get_qs('min', '') ?? 0);
$max = (float)(get_qs('max', '') ?? 0);

$filtered = array_values(array_filter($all, function ($p) use ($q, $categories, $tags, $availability, $min, $max) {
    $name = strtolower((string)$p['name']);
    $cat = (string)$p['category'];
    $ptags = (array)($p['tags'] ?? []);
    $price = (float)$p['price'];
    $stock = (int)$p['stock'];
    $on_sale = !empty($p['on_sale']);

    if ($q !== '' && strpos($name, $q) === false) return false;
    if ($categories && !in_array($cat, $categories, true)) return false;
    if ($tags) {
        foreach ($tags as $t) {
            if (!in_array($t, $ptags, true)) return false;
        }
    }
    if ($availability === 'in_stock' && $stock <= 0) return false;
    if ($availability === 'on_sale' && !$on_sale) return false;
    if ($min > 0 && $price < $min) return false;
    if ($max > 0 && $price > $max) return false;
    return true;
}));

// Sorting
usort($filtered, function ($a, $b) use ($sort, $q) {
    $pa = (float)$a['price']; $pb = (float)$b['price'];
    $ra = (float)$a['rating']; $rb = (float)$b['rating'];
    if ($sort === 'price_asc') return $pa <=> $pb;
    if ($sort === 'price_desc') return $pb <=> $pa;
    if ($sort === 'rating_desc') return $rb <=> $ra;
    // relevance: naive "query match position" then rating
    if ($q !== '') {
        $na = strtolower((string)$a['name']); $nb = strtolower((string)$b['name']);
        $ia = strpos($na, $q); $ib = strpos($nb, $q);
        $ia = $ia === false ? 9999 : $ia;
        $ib = $ib === false ? 9999 : $ib;
        if ($ia !== $ib) return $ia <=> $ib;
    }
    return $rb <=> $ra;
});

$total = count($filtered);

// Server pagination (desktop/tablet); mobile gets "Load more" via JS (progressive).
$per_page = 12;
$page = max(1, (int)(get_qs('page', '1') ?? '1'));
$pages = (int)max(1, ceil($total / $per_page));
$page = min($page, $pages);
$offset = ($page - 1) * $per_page;
$page_items = array_slice($filtered, $offset, $per_page);

$active_filters = [
    'q' => $q ?: null,
    'category' => $categories ?: null,
    'tag' => $tags ?: null,
    'availability' => $availability ?: null,
    'min' => $min > 0 ? $min : null,
    'max' => $max > 0 ? $max : null,
    'sort' => $sort !== 'relevance' ? $sort : null,
];

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <div class="container shop-top">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span aria-hidden="true">/</span>
      <span>Shop</span>
    </nav>

    <div class="shop-bar">
      <button class="btn btn-outline shop-filter-btn" type="button" data-filter-open aria-controls="filter-drawer" aria-expanded="false">
        Filters
        <span class="pill" data-filter-count aria-label="Active filters count">0</span>
      </button>

      <div class="shop-results">
        <strong><?= htmlspecialchars((string)$total) ?></strong> results
      </div>

      <label class="shop-sort">
        <span class="sr-only">Sort</span>
        <select name="sort" aria-label="Sort products" data-sort>
          <option value="relevance" <?= $sort === 'relevance' ? 'selected' : '' ?>>Sort: Relevance</option>
          <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Price: Low to high</option>
          <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Price: High to low</option>
          <option value="rating_desc" <?= $sort === 'rating_desc' ? 'selected' : '' ?>>Rating</option>
        </select>
      </label>
    </div>
  </div>

  <div class="container shop-layout">
    <aside class="filters card" aria-label="Filters" data-filters-sidebar>
      <form class="filters-form" method="get" action="shop.php" data-filters>
        <div class="filters-head">
          <h2 class="filters-title">Filters</h2>
          <a class="btn btn-outline btn-sm" href="shop.php" data-clear-filters>Clear</a>
        </div>

        <div class="filters-group">
          <label class="filters-label" for="sq">Search</label>
          <input id="sq" type="search" name="q" inputmode="search" autocomplete="off" value="<?= htmlspecialchars($q) ?>" placeholder="e.g. apples, spinach">
        </div>

        <fieldset class="filters-group">
          <legend class="filters-label">Category</legend>
          <?php foreach (['Fruits','Vegetables'] as $c): ?>
            <label class="check">
              <input type="checkbox" name="category[]" value="<?= htmlspecialchars($c) ?>" <?= in_array($c, $categories, true) ? 'checked' : '' ?>>
              <span><?= htmlspecialchars($c) ?></span>
            </label>
          <?php endforeach; ?>
        </fieldset>

        <fieldset class="filters-group">
          <legend class="filters-label">Tags</legend>
          <?php foreach (['Organic','Seasonal'] as $t): ?>
            <label class="check">
              <input type="checkbox" name="tag[]" value="<?= htmlspecialchars($t) ?>" <?= in_array($t, $tags, true) ? 'checked' : '' ?>>
              <span><?= htmlspecialchars($t) ?></span>
            </label>
          <?php endforeach; ?>
        </fieldset>

        <div class="filters-group">
          <div class="filters-label">Price range</div>
          <div class="price-row">
            <label>
              <span class="sr-only">Min price</span>
              <input type="number" name="min" inputmode="numeric" min="0" step="5" placeholder="Min" value="<?= $min > 0 ? htmlspecialchars((string)$min) : '' ?>">
            </label>
            <label>
              <span class="sr-only">Max price</span>
              <input type="number" name="max" inputmode="numeric" min="0" step="5" placeholder="Max" value="<?= $max > 0 ? htmlspecialchars((string)$max) : '' ?>">
            </label>
          </div>
        </div>

        <fieldset class="filters-group">
          <legend class="filters-label">Availability</legend>
          <label class="radio">
            <input type="radio" name="availability" value="" <?= $availability === '' ? 'checked' : '' ?>>
            <span>Any</span>
          </label>
          <label class="radio">
            <input type="radio" name="availability" value="in_stock" <?= $availability === 'in_stock' ? 'checked' : '' ?>>
            <span>In stock</span>
          </label>
          <label class="radio">
            <input type="radio" name="availability" value="on_sale" <?= $availability === 'on_sale' ? 'checked' : '' ?>>
            <span>On sale</span>
          </label>
        </fieldset>

        <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
        <button class="btn btn-primary" type="submit">Apply filters</button>
      </form>
    </aside>

    <section class="shop-main" aria-label="Product results">
      <?php if ($total === 0): ?>
        <div class="card empty">
          <h2 class="section-title" style="margin:0">No matches</h2>
          <p class="muted">Try clearing filters or searching with a simpler keyword.</p>
          <a class="btn btn-primary" href="shop.php">Reset filters</a>
        </div>
      <?php else: ?>
        <div class="product-grid" data-product-grid>
          <?php foreach ($page_items as $p) render_product_card($p); ?>
        </div>

        <nav class="pagination" aria-label="Pagination">
          <?php
            $qs = $active_filters;
            $qs['page'] = null;
            $base_qs = query_string($qs);
            $base = 'shop.php' . ($base_qs ? ('?' . $base_qs . '&') : '?');
          ?>
          <a class="btn btn-outline btn-sm" href="<?= $base ?>page=<?= max(1, $page - 1) ?>" <?= $page <= 1 ? 'aria-disabled="true" tabindex="-1"' : '' ?>>Prev</a>
          <span class="muted">Page <?= $page ?> of <?= $pages ?></span>
          <a class="btn btn-outline btn-sm" href="<?= $base ?>page=<?= min($pages, $page + 1) ?>" <?= $page >= $pages ? 'aria-disabled="true" tabindex="-1"' : '' ?>>Next</a>
        </nav>

        <div class="load-more-wrap" data-load-more-wrap>
          <button class="btn btn-outline" type="button" data-load-more data-per-page="<?= (int)$per_page ?>">
            Load more
          </button>
          <p class="muted">Tip: on desktop you can use the pagination above.</p>
        </div>
      <?php endif; ?>
    </section>
  </div>

  <div class="backdrop" hidden data-filter-backdrop></div>
  <aside class="filter-drawer" id="filter-drawer" aria-label="Filters drawer" hidden data-filter-drawer>
    <div class="mobile-drawer-head">
      <span class="drawer-title">Filters</span>
      <button class="icon-btn" type="button" aria-label="Close filters" data-filter-close>
        <span class="icon icon-close" aria-hidden="true"></span>
      </button>
    </div>
    <div class="mobile-drawer-body">
      <form class="filters-form" method="get" action="shop.php" data-filters-mobile>
        <div class="filters-group">
          <label class="filters-label" for="fq">Search</label>
          <input id="fq" type="search" name="q" inputmode="search" autocomplete="off" value="<?= htmlspecialchars($q) ?>" placeholder="e.g. apples, spinach">
        </div>

        <fieldset class="filters-group">
          <legend class="filters-label">Category</legend>
          <?php foreach (['Fruits','Vegetables'] as $c): ?>
            <label class="check">
              <input type="checkbox" name="category[]" value="<?= htmlspecialchars($c) ?>" <?= in_array($c, $categories, true) ? 'checked' : '' ?>>
              <span><?= htmlspecialchars($c) ?></span>
            </label>
          <?php endforeach; ?>
        </fieldset>

        <fieldset class="filters-group">
          <legend class="filters-label">Tags</legend>
          <?php foreach (['Organic','Seasonal'] as $t): ?>
            <label class="check">
              <input type="checkbox" name="tag[]" value="<?= htmlspecialchars($t) ?>" <?= in_array($t, $tags, true) ? 'checked' : '' ?>>
              <span><?= htmlspecialchars($t) ?></span>
            </label>
          <?php endforeach; ?>
        </fieldset>

        <div class="filters-group">
          <div class="filters-label">Price range</div>
          <div class="price-row">
            <label>
              <span class="sr-only">Min price</span>
              <input type="number" name="min" inputmode="numeric" min="0" step="5" placeholder="Min" value="<?= $min > 0 ? htmlspecialchars((string)$min) : '' ?>">
            </label>
            <label>
              <span class="sr-only">Max price</span>
              <input type="number" name="max" inputmode="numeric" min="0" step="5" placeholder="Max" value="<?= $max > 0 ? htmlspecialchars((string)$max) : '' ?>">
            </label>
          </div>
        </div>

        <fieldset class="filters-group">
          <legend class="filters-label">Availability</legend>
          <label class="radio">
            <input type="radio" name="availability" value="" <?= $availability === '' ? 'checked' : '' ?>>
            <span>Any</span>
          </label>
          <label class="radio">
            <input type="radio" name="availability" value="in_stock" <?= $availability === 'in_stock' ? 'checked' : '' ?>>
            <span>In stock</span>
          </label>
          <label class="radio">
            <input type="radio" name="availability" value="on_sale" <?= $availability === 'on_sale' ? 'checked' : '' ?>>
            <span>On sale</span>
          </label>
        </fieldset>

        <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
        <div class="mobile-drawer-foot">
          <a class="btn btn-outline" href="shop.php">Clear</a>
          <button class="btn btn-primary" type="submit">Show results</button>
        </div>
      </form>
    </div>
  </aside>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

