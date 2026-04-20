<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/config.php';

/**
 * @param array<string, mixed> $product
 */
function render_product_card(array $product): void {
    $id = (string)($product['id'] ?? '');
    $name = (string)($product['name'] ?? '');
    $unit = (string)($product['unit'] ?? '');
    $price = (float)($product['price'] ?? 0);
    $stock = (int)($product['stock'] ?? 0);
    $rating = (float)($product['rating'] ?? 0);
    $on_sale = !empty($product['on_sale']);

    $img_alt = $name . ' ' . $unit;
    $img_src = (string)($product['image'] ?? 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=70');
    ?>
    <article class="p-card card" data-product-card data-product-id="<?= htmlspecialchars($id) ?>">
      <a class="p-media" href="product-detail.php?id=<?= urlencode($id) ?>" aria-label="View <?= htmlspecialchars($name) ?>">
        <img
          src="<?= htmlspecialchars($img_src) ?>"
          width="800"
          height="600"
          loading="lazy"
          alt="<?= htmlspecialchars($img_alt) ?>">
        <span class="p-badges" aria-hidden="true">
          <?php if ($on_sale): ?><span class="pill sale">Sale</span><?php endif; ?>
          <?php if ($stock > 0): ?><span class="pill">In stock</span><?php else: ?><span class="pill">Out</span><?php endif; ?>
        </span>
      </a>

      <div class="p-body">
        <div class="p-top">
          <h3 class="p-title">
            <a href="product-detail.php?id=<?= urlencode($id) ?>"><?= htmlspecialchars($name) ?></a>
          </h3>
          <button class="icon-btn p-wish" type="button" aria-label="Toggle wishlist" data-wishlist-toggle>
            <span class="icon icon-heart" aria-hidden="true"></span>
          </button>
        </div>
        <div class="p-meta">
          <span class="muted"><?= htmlspecialchars($unit) ?></span>
          <span class="p-rating" aria-label="Rating <?= htmlspecialchars((string)$rating) ?>">★ <?= htmlspecialchars(number_format($rating, 1)) ?></span>
        </div>
        <div class="p-bottom">
          <div class="p-price"><?= htmlspecialchars(money($price)) ?></div>
          <button class="btn btn-primary btn-sm p-add" type="button" <?= $stock <= 0 ? 'disabled' : '' ?> data-add-to-cart>
            Add to cart
          </button>
        </div>
      </div>
    </article>
    <?php
}

