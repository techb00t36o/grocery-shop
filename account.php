<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

$page_title = SITE_NAME . ' — Account';
$page_description = 'Login, view orders, manage addresses, and wishlist.';

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
          <h1 class="section-title" style="margin:0">Account</h1>
          <p class="section-sub">Demo authentication stored locally (no backend yet).</p>
        </div>
      </div>

      <div class="account-layout" data-account-root>
        <aside class="card account-nav" aria-label="Account navigation">
          <div class="account-welcome" data-account-welcome>
            <div class="pill sale">Guest</div>
            <p class="muted" style="margin:.5rem 0 0">Login to view your dashboard and save details.</p>
            <div class="cta-actions" style="margin-top:.75rem">
              <button class="btn btn-primary" type="button" data-auth-open>Login / Register</button>
              <a class="btn btn-outline" href="shop.php">Shop</a>
            </div>
          </div>

          <nav class="account-links" aria-label="Account sections">
            <a class="nav-link" href="#dashboard" data-tab-link>Dashboard</a>
            <a class="nav-link" href="#orders" data-tab-link>Orders</a>
            <a class="nav-link" href="#addresses" data-tab-link>Addresses</a>
            <a class="nav-link" href="#wishlist" data-tab-link>Wishlist</a>
            <a class="nav-link" href="#profile" data-tab-link>Profile</a>
          </nav>

          <button class="btn btn-outline" type="button" hidden data-logout>Logout</button>
        </aside>

        <section class="account-main" aria-label="Account content">
          <div class="card account-panel" id="dashboard" data-panel>
            <h2 class="section-title" style="margin:0 0 .4rem">Dashboard</h2>
            <p class="muted" style="margin:0">
              Welcome back. This demo page shows how account sections could be organized before backend integration.
            </p>
          </div>

          <div class="card account-panel" id="orders" data-panel hidden>
            <h2 class="section-title" style="margin:0 0 .4rem">Order history</h2>
            <p class="muted" style="margin:0 0 1rem">No orders yet. Once backend is added, recent orders will appear here.</p>
            <div class="pill">Tip: try adding items to cart and checking out.</div>
            <div style="margin-top:.9rem">
              <a class="btn btn-primary" href="shop.php">Start shopping</a>
            </div>
          </div>

          <div class="card account-panel" id="addresses" data-panel hidden>
            <h2 class="section-title" style="margin:0 0 .4rem">Saved addresses</h2>
            <p class="muted" style="margin:0 0 1rem">For now, addresses are entered during checkout (Step 1).</p>
            <a class="btn btn-outline" href="checkout.php">Go to checkout</a>
          </div>

          <div class="card account-panel" id="wishlist" data-panel hidden>
            <div class="account-panel-head">
              <div>
                <h2 class="section-title" style="margin:0 0 .2rem">Wishlist</h2>
                <p class="section-sub">Saved items from the shop.</p>
              </div>
              <a class="btn btn-outline btn-sm" href="shop.php">Browse</a>
            </div>

            <div class="wish-grid" data-wishlist-grid></div>

            <div class="cart-empty" hidden data-wishlist-empty>
              <div class="pill sale">No saved items</div>
              <p class="muted">Tap the heart on a product to save it here.</p>
              <a class="btn btn-primary" href="shop.php">Shop now</a>
            </div>
          </div>

          <div class="card account-panel" id="profile" data-panel hidden>
            <h2 class="section-title" style="margin:0 0 .4rem">Profile</h2>
            <p class="muted" style="margin:0 0 1rem">Demo profile settings (stored locally).</p>
            <form class="form" data-profile-form>
              <div class="form-row">
                <label class="field">
                  <span class="label">Full name</span>
                  <input name="full_name" type="text" autocomplete="name" placeholder="Your name">
                </label>
                <label class="field">
                  <span class="label">Phone</span>
                  <input name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="+880…">
                </label>
              </div>
              <label class="field">
                <span class="label">Email</span>
                <input name="email" type="email" autocomplete="email" placeholder="you@example.com">
              </label>
              <div class="form-actions">
                <button class="btn btn-primary" type="submit">Save</button>
                <button class="btn btn-outline" type="reset">Reset</button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </section>

</main>

<script>
  window.__LEAFMART_CURRENCY__ = <?= json_encode(SHOP_CURRENCY_SYMBOL, JSON_UNESCAPED_UNICODE) ?>;
  window.__LEAFMART_PRODUCTS__ = <?= json_encode($product_index, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
