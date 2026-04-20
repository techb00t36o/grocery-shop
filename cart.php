<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

$page_title = SITE_NAME . ' — Cart';
$page_description = 'Review your cart, update quantities, and proceed to checkout.';

$products = demo_products();
$product_index = [];
foreach ($products as $p) {
    $product_index[(string)$p['id']] = $p;
}

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <section class="section">
    <div class="container">
      <div class="section-head" style="margin-bottom:.6rem">
        <div>
          <h1 class="section-title" style="margin:0">Shopping cart</h1>
          <p class="section-sub">Update quantities instantly—stored on your device for this demo.</p>
        </div>
        <a class="btn btn-outline" href="shop.php">Continue shopping</a>
      </div>

      <div class="cart-layout" data-cart-root>
        <section class="card cart-items" aria-label="Cart items">
          <div class="cart-head">
            <strong>Items</strong>
            <button class="btn btn-outline btn-sm" type="button" data-cart-clear>Clear cart</button>
          </div>

          <div class="cart-table" aria-label="Cart table" data-cart-table>
            <div class="cart-table-row cart-table-head" role="row">
              <div role="columnheader">Product</div>
              <div role="columnheader">Price</div>
              <div role="columnheader">Qty</div>
              <div role="columnheader">Subtotal</div>
              <div role="columnheader">Remove</div>
            </div>
            <div data-cart-rows></div>
          </div>

          <div class="cart-cards" data-cart-cards></div>

          <div class="cart-empty" hidden data-cart-empty>
            <div class="pill sale">Your cart is empty</div>
            <p class="muted">Browse fresh produce and add items to your basket.</p>
            <a class="btn btn-primary" href="shop.php">Shop now</a>
          </div>
        </section>

        <aside class="card cart-summary" aria-label="Order summary" data-cart-summary>
          <h2 class="filters-title" style="margin:0">Summary</h2>

          <div class="summary-lines">
            <div class="line"><span class="muted">Subtotal</span><strong data-sum-subtotal><?= htmlspecialchars(money(0)) ?></strong></div>
            <div class="line"><span class="muted">Delivery</span><strong data-sum-delivery><?= htmlspecialchars(money(0)) ?></strong></div>
            <div class="line"><span class="muted">Discount</span><strong data-sum-discount><?= htmlspecialchars(money(0)) ?></strong></div>
            <div class="line total"><span>Total</span><strong data-sum-total><?= htmlspecialchars(money(0)) ?></strong></div>
          </div>

          <details class="coupon" data-coupon>
            <summary>Have a coupon?</summary>
            <div class="coupon-body">
              <div class="coupon-row">
                <input type="text" placeholder="Enter code" aria-label="Coupon code" data-coupon-code>
                <button class="btn btn-outline btn-sm" type="button" data-apply-coupon>Apply</button>
              </div>
              <p class="muted" style="margin:.4rem 0 0">Demo codes: <strong>FRESH10</strong>, <strong>WELCOME5</strong></p>
            </div>
          </details>

          <div class="summary-actions">
            <a class="btn btn-primary" href="checkout.php">Proceed to checkout</a>
            <a class="btn btn-outline" href="shop.php">Add more items</a>
          </div>

          <p class="muted" style="margin:.6rem 0 0">Tip: On mobile, summary stays reachable while you scroll.</p>
        </aside>
      </div>
    </div>
  </section>
</main>

<script>
  window.__LEAFMART_CURRENCY__ = <?= json_encode(SHOP_CURRENCY_SYMBOL, JSON_UNESCAPED_UNICODE) ?>;
  window.__LEAFMART_PRODUCTS__ = <?= json_encode($product_index, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
