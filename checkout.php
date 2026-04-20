<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

$page_title = SITE_NAME . ' — Checkout';
$page_description = 'Secure checkout. Enter your shipping and payment details.';

$products = demo_products();
$product_index = [];
foreach ($products as $p) {
    $product_index[(string)$p['id']] = $p;
}

include __DIR__ . '/includes/header.php';
?>

<main id="main" class="checkout-bg">
  <section class="section">
    <div class="container">
      <div class="section-head" style="margin-bottom:1rem">
        <div>
          <h1 class="section-title" style="margin:0">Checkout</h1>
          <p class="section-sub">Almost there! Complete your order securely.</p>
        </div>
        <a class="btn btn-outline" href="cart.php">Back to cart</a>
      </div>

      <div class="checkout-layout" data-checkout-root>
        <div class="checkout-main">
          <form class="checkout-form" data-checkout-form>
            
            <div class="checkout-section card">
              <h2 class="co-section-title">
                <span class="co-step">1</span> Contact Information
              </h2>
              <div class="co-section-body">
                <div class="form-row">
                  <label class="field">
                    <span class="label">Email address</span>
                    <input type="email" name="email" required placeholder="e.g. you@example.com">
                  </label>
                  <label class="field">
                    <span class="label">Phone number</span>
                    <input type="tel" name="phone" required placeholder="e.g. +880 1712-345678">
                  </label>
                </div>
              </div>
            </div>

            <div class="checkout-section card">
              <h2 class="co-section-title">
                <span class="co-step">2</span> Shipping Address
              </h2>
              <div class="co-section-body">
                <div class="field" style="margin-bottom: .9rem">
                  <span class="label">Full Name</span>
                  <input type="text" name="name" required placeholder="Jane Doe">
                </div>
                <div class="field" style="margin-bottom: .9rem">
                  <span class="label">Street Address</span>
                  <input type="text" name="address" required placeholder="123 Leafy Lane, Apt 4B">
                </div>
                <div class="form-row">
                  <label class="field">
                    <span class="label">City</span>
                    <input type="text" name="city" required placeholder="Dhaka">
                  </label>
                  <label class="field">
                    <span class="label">Postal Code</span>
                    <input type="text" name="zip" required placeholder="1212">
                  </label>
                </div>
              </div>
            </div>

            <div class="checkout-section card">
              <h2 class="co-section-title">
                <span class="co-step">3</span> Payment Method
              </h2>
              <div class="co-section-body">
                <div class="payment-methods">
                  <label class="payment-method is-active" data-pm-label>
                    <input type="radio" name="payment" value="card" checked class="sr-only" data-pm-input>
                    <span class="pm-box"></span>
                    <div class="pm-content">
                      <span class="pm-title">Credit / Debit Card</span>
                      <span class="pm-desc">Pay securely with Visa or Mastercard</span>
                    </div>
                  </label>
                  <label class="payment-method" data-pm-label>
                    <input type="radio" name="payment" value="cod" class="sr-only" data-pm-input>
                    <span class="pm-box"></span>
                    <div class="pm-content">
                      <span class="pm-title">Cash on Delivery</span>
                      <span class="pm-desc">Pay when you receive your order</span>
                    </div>
                  </label>
                  <label class="payment-method" data-pm-label>
                    <input type="radio" name="payment" value="bkash" class="sr-only" data-pm-input>
                    <span class="pm-box"></span>
                    <div class="pm-content">
                      <span class="pm-title">bKash</span>
                      <span class="pm-desc">Pay via mobile banking</span>
                    </div>
                  </label>
                </div>

                <div class="pm-details" data-pm-details="card">
                  <div class="field" style="margin-bottom: .9rem">
                    <span class="label">Card Number</span>
                    <input type="text" placeholder="0000 0000 0000 0000" maxlength="19">
                  </div>
                  <div class="form-row">
                    <label class="field">
                      <span class="label">Expiry Date</span>
                      <input type="text" placeholder="MM/YY" maxlength="5">
                    </label>
                    <label class="field">
                      <span class="label">CVC</span>
                      <input type="text" placeholder="123" maxlength="4">
                    </label>
                  </div>
                </div>
                
                <div class="pm-details" hidden data-pm-details="cod">
                  <div class="form-banner" style="margin:0">
                    You will pay the delivery agent in cash upon receiving your items.
                  </div>
                </div>

                <div class="pm-details" hidden data-pm-details="bkash">
                  <div class="form-banner" style="margin:0">
                    You will be redirected to the secure bKash payment gateway to complete your transaction after clicking "Place Order".
                  </div>
                </div>
              </div>
            </div>

            <div class="checkout-actions">
              <button class="btn btn-primary btn-lg" type="submit" style="width:100%; font-size:1.15rem; min-height:56px">
                Place Order
              </button>
              <p class="muted" style="text-align:center; font-size:.9rem; margin-top:.75rem">
                By placing this order, you agree to our Terms & Conditions.
              </p>
            </div>
          </form>
        </div>

        <aside class="checkout-sidebar">
          <div class="card checkout-summary" aria-label="Order summary" data-checkout-summary>
            <h2 class="filters-title" style="margin:0">Order Summary</h2>
            
            <div class="co-items" data-checkout-items>
              <!-- Populated by JS -->
            </div>

            <div class="summary-lines">
              <div class="line"><span class="muted">Subtotal</span><strong data-sum-subtotal><?= htmlspecialchars(money(0)) ?></strong></div>
              <div class="line"><span class="muted">Delivery</span><strong data-sum-delivery><?= htmlspecialchars(money(0)) ?></strong></div>
              <div class="line"><span class="muted">Discount</span><strong data-sum-discount><?= htmlspecialchars(money(0)) ?></strong></div>
              <div class="line total"><span>Total</span><strong data-sum-total><?= htmlspecialchars(money(0)) ?></strong></div>
            </div>
          </div>
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
