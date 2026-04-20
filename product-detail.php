<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/components/product-card.php';

$id = get_qs('id', '');
$products = demo_products();
$product = null;
foreach ($products as $p) {
    if ((string)$p['id'] === $id) {
        $product = $p;
        break;
    }
}

if (!$product) {
    http_response_code(404);
    $page_title = SITE_NAME . ' — Product Not Found';
    include __DIR__ . '/includes/header.php';
    ?>
    <main id="main" class="container page-hero" style="padding: 4rem 1rem; text-align: center;">
      <div class="card empty" style="max-width: 500px; margin: 0 auto; padding: 3rem 1rem;">
        <h1 class="section-title">Product Not Found</h1>
        <p class="muted" style="margin-bottom: 2rem;">The product you're looking for doesn't exist or has been removed.</p>
        <a class="btn btn-primary" href="shop.php">Back to Shop</a>
      </div>
    </main>
    <?php
    include __DIR__ . '/includes/footer.php';
    exit;
}

$name = (string)$product['name'];
$price = (float)$product['price'];
$stock = (int)$product['stock'];
$unit = (string)$product['unit'];
$rating = (float)$product['rating'];
$desc = (string)$product['description'];
$cat = (string)$product['category'];
$tags = (array)($product['tags'] ?? []);
$on_sale = !empty($product['on_sale']);
$img_src = (string)($product['image'] ?? 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=70');

$page_title = SITE_NAME . ' — ' . $name;
$page_description = $desc;

// Find related products
$related = [];
foreach ($products as $p) {
    if ((string)$p['id'] !== $id && (string)$p['category'] === $cat) {
        $related[] = $p;
        if (count($related) >= 4) break;
    }
}

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <div class="container shop-top">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span aria-hidden="true">/</span>
      <a href="shop.php">Shop</a>
      <span aria-hidden="true">/</span>
      <a href="shop.php?category[]=<?= urlencode($cat) ?>"><?= htmlspecialchars($cat) ?></a>
      <span aria-hidden="true">/</span>
      <span aria-current="page"><?= htmlspecialchars($name) ?></span>
    </nav>
  </div>

  <section class="container section">
    <div class="product-detail-layout card" data-product-card data-product-id="<?= htmlspecialchars($id) ?>">
      <div class="pd-media">
        <div class="pd-gallery">
          <img src="<?= htmlspecialchars($img_src) ?>" alt="<?= htmlspecialchars($name) ?>" loading="eager" width="800" height="600" class="pd-main-img">
          <div class="pd-badges" aria-hidden="true">
            <?php if ($on_sale): ?><span class="pill sale">Sale</span><?php endif; ?>
            <?php if ($stock > 0): ?><span class="pill">In stock</span><?php else: ?><span class="pill">Out</span><?php endif; ?>
          </div>
        </div>
      </div>

      <div class="pd-info">
        <div class="pd-info-header">
          <h1 class="pd-title"><?= htmlspecialchars($name) ?></h1>
          <div class="pd-meta">
            <span class="pd-unit"><?= htmlspecialchars($unit) ?></span>
            <span class="p-rating" aria-label="Rating <?= htmlspecialchars((string)$rating) ?>">
              ★ <?= htmlspecialchars(number_format($rating, 1)) ?>
            </span>
          </div>
        </div>

        <div class="pd-price-wrap">
          <div class="pd-price"><?= htmlspecialchars(money($price)) ?></div>
        </div>

        <div class="pd-desc">
          <p><?= htmlspecialchars($desc) ?></p>
        </div>

        <?php if (!empty($tags)): ?>
          <div class="pd-tags">
            <?php foreach ($tags as $t): ?>
              <span class="pill outline"><?= htmlspecialchars($t) ?></span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <hr class="soft-hr">

        <form class="pd-actions" action="cart.php" method="post" data-add-to-cart-form>
          <input type="hidden" name="product_id" value="<?= htmlspecialchars($id) ?>">
          
          <div class="pd-qty">
            <span class="pd-qty-label">Quantity:</span>
            <div class="qty-selector">
              <button type="button" class="qty-btn" aria-label="Decrease quantity" onclick="this.nextElementSibling.stepDown()">-</button>
              <input type="number" name="qty" value="1" min="1" max="<?= max(1, $stock) ?>" aria-label="Quantity" <?= $stock <= 0 ? 'disabled' : '' ?>>
              <button type="button" class="qty-btn" aria-label="Increase quantity" onclick="this.previousElementSibling.stepUp()">+</button>
            </div>
          </div>

          <div class="pd-buttons">
            <button class="btn btn-primary btn-lg pd-add-btn" type="submit" <?= $stock <= 0 ? 'disabled' : '' ?>>
              <span class="icon icon-cart" aria-hidden="true"></span>
              <?= $stock > 0 ? 'Add to cart' : 'Out of stock' ?>
            </button>
            <button class="icon-btn pd-wish-btn" type="button" aria-label="Add to wishlist" data-wishlist-toggle data-product-id="<?= htmlspecialchars($id) ?>">
              <span class="icon icon-heart" aria-hidden="true"></span>
            </button>
          </div>
        </form>

        <div class="pd-features">
          <div class="pd-feature">
            <div class="pd-feature-icon">🛡️</div>
            <div class="pd-feature-text">
              <strong>Quality Guarantee</strong>
              <span>100% fresh & organic</span>
            </div>
          </div>
          <div class="pd-feature">
            <div class="pd-feature-icon">🚚</div>
            <div class="pd-feature-text">
              <strong>Fast Delivery</strong>
              <span>Same day delivery available</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php if (!empty($related)): ?>
    <section class="container section">
      <div class="section-head">
        <div>
          <h2 class="section-title">You might also like</h2>
          <p class="section-sub">More products from <?= htmlspecialchars($cat) ?></p>
        </div>
      </div>
      <div class="product-grid">
        <?php foreach ($related as $rp) render_product_card($rp); ?>
      </div>
    </section>
  <?php endif; ?>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
