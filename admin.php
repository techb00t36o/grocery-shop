<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

$page_title = SITE_NAME . ' — Admin Dashboard';
$page_description = 'Manage products, orders, and view site statistics.';

$products = demo_products();

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <section class="section">
    <div class="container">
      <div class="section-head" style="margin-bottom:.6rem">
        <div>
          <h1 class="section-title" style="margin:0">Admin Dashboard</h1>
          <p class="section-sub">Store management interface (Demo Mode).</p>
        </div>
      </div>

      <div class="account-layout" data-account-root>
        <!-- Sidebar Navigation -->
        <aside class="card account-nav" aria-label="Admin navigation">
          <div class="account-welcome">
            <div class="pill sale">Admin</div>
            <p class="muted" style="margin:.5rem 0 0">Logged in as Administrator.</p>
          </div>

          <nav class="account-links" aria-label="Admin sections">
            <a class="nav-link" href="#dashboard" data-tab-link>Dashboard</a>
            <a class="nav-link" href="#products" data-tab-link>Products</a>
            <a class="nav-link" href="#orders" data-tab-link>Orders</a>
            <a class="nav-link" href="#settings" data-tab-link>Settings</a>
          </nav>
        </aside>

        <!-- Main Content Area -->
        <section class="account-main" aria-label="Admin content">
          
          <!-- Dashboard Panel -->
          <div class="card account-panel" id="dashboard" data-panel>
            <h2 class="section-title" style="margin:0 0 1rem">Overview</h2>
            
            <div class="stat-grid">
              <div class="stat-card">
                <span class="stat-title">Total Revenue</span>
                <span class="stat-value"><?= money(24500) ?></span>
                <span class="stat-trend positive">+15% this month</span>
              </div>
              <div class="stat-card">
                <span class="stat-title">Active Orders</span>
                <span class="stat-value">12</span>
                <span class="stat-trend">4 pending fulfillment</span>
              </div>
              <div class="stat-card">
                <span class="stat-title">Total Customers</span>
                <span class="stat-value">840</span>
                <span class="stat-trend positive">+32 new</span>
              </div>
              <div class="stat-card">
                <span class="stat-title">Low Stock Items</span>
                <span class="stat-value">3</span>
                <span class="stat-trend negative">Requires attention</span>
              </div>
            </div>

            <div style="margin-top:2rem">
              <h3 style="margin-bottom:1rem;">Recent Activity</h3>
              <p class="muted">No recent activity to show in demo mode.</p>
            </div>
          </div>

          <!-- Products Panel -->
          <div class="card account-panel" id="products" data-panel hidden>
            <div class="account-panel-head">
              <div>
                <h2 class="section-title" style="margin:0 0 .2rem">Products</h2>
                <p class="section-sub">Manage your catalog.</p>
              </div>
              <button class="btn btn-primary btn-sm">Add Product</button>
            </div>

            <div class="table-responsive">
              <table class="admin-table">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach (array_slice($products, 0, 10) as $product): ?>
                  <tr>
                    <td><img src="<?= htmlspecialchars($product['image']) ?>" alt="" width="40" height="40" style="border-radius:6px; object-fit:cover;"></td>
                    <td><strong><?= htmlspecialchars($product['name']) ?></strong><br><small class="muted"><?= htmlspecialchars($product['category']) ?></small></td>
                    <td><?= money($product['price']) ?></td>
                    <td><?= $product['stock'] ?></td>
                    <td>
                      <?php if ($product['stock'] > 20): ?>
                        <span class="pill">In Stock</span>
                      <?php else: ?>
                        <span class="pill sale">Low Stock</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <button class="btn btn-outline btn-sm">Edit</button>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div style="margin-top:1rem; text-align:center;">
              <p class="muted"><small>Showing 10 of <?= count($products) ?> products</small></p>
            </div>
          </div>

          <!-- Orders Panel -->
          <div class="card account-panel" id="orders" data-panel hidden>
            <h2 class="section-title" style="margin:0 0 1rem">Recent Orders</h2>
            
            <div class="table-responsive">
              <table class="admin-table">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#ORD-8902</td>
                    <td>Jane Doe</td>
                    <td>Today, 10:45 AM</td>
                    <td><?= money(1450) ?></td>
                    <td><span class="pill sale">Pending</span></td>
                    <td><button class="btn btn-outline btn-sm">View</button></td>
                  </tr>
                  <tr>
                    <td>#ORD-8901</td>
                    <td>John Smith</td>
                    <td>Yesterday</td>
                    <td><?= money(820) ?></td>
                    <td><span class="pill">Shipped</span></td>
                    <td><button class="btn btn-outline btn-sm">View</button></td>
                  </tr>
                  <tr>
                    <td>#ORD-8900</td>
                    <td>Alice Johnson</td>
                    <td>Oct 12, 2023</td>
                    <td><?= money(2100) ?></td>
                    <td><span class="pill">Delivered</span></td>
                    <td><button class="btn btn-outline btn-sm">View</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Settings Panel -->
          <div class="card account-panel" id="settings" data-panel hidden>
            <h2 class="section-title" style="margin:0 0 .4rem">Store Settings</h2>
            <p class="muted" style="margin:0 0 1.5rem">Update global configurations for the shop.</p>
            
            <form class="form">
              <div class="form-row">
                <label class="field">
                  <span class="label">Store Name</span>
                  <input name="store_name" type="text" value="<?= htmlspecialchars(SITE_NAME) ?>">
                </label>
                <label class="field">
                  <span class="label">Currency Symbol</span>
                  <input name="currency" type="text" value="<?= htmlspecialchars(SHOP_CURRENCY_SYMBOL) ?>">
                </label>
              </div>
              <label class="field">
                <span class="label">Store Tagline</span>
                <input name="tagline" type="text" value="<?= htmlspecialchars(SITE_TAGLINE) ?>">
              </label>
              <div class="form-actions">
                <button class="btn btn-primary" type="button">Save Changes</button>
              </div>
            </form>
          </div>

        </section>
      </div>
    </div>
  </section>
</main>

<script>
  // Expose configuration variables for potential client-side functionality
  window.__LEAFMART_CURRENCY__ = <?= json_encode(SHOP_CURRENCY_SYMBOL, JSON_UNESCAPED_UNICODE) ?>;
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
