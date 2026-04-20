<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

$page_title = SITE_NAME . ' — FAQ';
$page_description = 'Frequently asked questions about delivery, freshness, returns, and payments.';

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <section class="page-hero">
    <div class="container">
      <div class="card page-hero-card">
        <div class="page-hero-grid">
          <div>
            <div class="hero-kicker">
              <span aria-hidden="true">❓</span>
              FAQ
            </div>
            <h1 class="page-title">Quick answers, zero stress.</h1>
            <p class="page-lead">
              Find delivery info, payment options, and return policy details. Built to be easy to read on small screens.
            </p>
            <div class="hero-actions">
              <a class="btn btn-primary" href="shop.php">Shop now</a>
              <a class="btn btn-outline" href="contact.php">Contact support</a>
            </div>
          </div>
          <div class="page-hero-media" aria-label="Fresh produce image">
            <img
              src="https://images.unsplash.com/photo-1543168256-418811576931?auto=format&fit=crop&w=1400&q=70"
              width="1400"
              height="900"
              loading="lazy"
              alt="Fresh vegetables in a basket">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="faq-grid">
        <nav class="card faq-nav" aria-label="FAQ sections">
          <a class="chip" href="#delivery">Delivery</a>
          <a class="chip" href="#payments">Payments</a>
          <a class="chip" href="#returns">Returns</a>
          <a class="chip" href="#products">Products</a>
        </nav>

        <div class="card faq-card">
          <h2 class="section-title" id="delivery" style="margin:0 0 .4rem">Delivery</h2>
          <div class="faq" data-faq>
            <details class="faq-item" open>
              <summary>When do you deliver?</summary>
              <div class="faq-body">
                We offer flexible time slots: <strong>Morning (8–12)</strong>, <strong>Afternoon (12–4)</strong>, and <strong>Evening (4–8)</strong>.
                Checkout will show available slots for the next 7 days.
              </div>
            </details>
            <details class="faq-item">
              <summary>Do you deliver everywhere?</summary>
              <div class="faq-body">
                Coverage depends on area. For the frontend demo, delivery is assumed available. In a real integration,
                we’ll calculate fees and availability based on your address.
              </div>
            </details>
            <details class="faq-item">
              <summary>How do you keep produce fresh?</summary>
              <div class="faq-body">
                We pack carefully, separate delicate items, and keep delivery times short to reduce heat exposure.
              </div>
            </details>
          </div>

          <hr class="soft-hr">

          <h2 class="section-title" id="payments" style="margin:0 0 .4rem">Payments</h2>
          <div class="faq" data-faq>
            <details class="faq-item" open>
              <summary>What payment methods do you accept?</summary>
              <div class="faq-body">
                Cash on Delivery (COD), Cards, and Mobile Banking (bKash/Nagad). The checkout page will show the options.
              </div>
            </details>
            <details class="faq-item">
              <summary>Is online payment secure?</summary>
              <div class="faq-body">
                Yes—when integrated with a real payment gateway, card details are handled by PCI-compliant providers.
              </div>
            </details>
          </div>

          <hr class="soft-hr">

          <h2 class="section-title" id="returns" style="margin:0 0 .4rem">Returns</h2>
          <div class="faq" data-faq>
            <details class="faq-item">
              <summary>What if something arrives damaged?</summary>
              <div class="faq-body">
                Contact us within 24 hours with a photo. We’ll replace or refund based on the issue.
              </div>
            </details>
            <details class="faq-item">
              <summary>Can I cancel an order?</summary>
              <div class="faq-body">
                You can cancel before packing begins. In the demo, this is a placeholder for backend logic.
              </div>
            </details>
          </div>

          <hr class="soft-hr">

          <h2 class="section-title" id="products" style="margin:0 0 .4rem">Products</h2>
          <div class="faq" data-faq>
            <details class="faq-item">
              <summary>Are items organic?</summary>
              <div class="faq-body">
                Organic items are clearly labeled and filterable in the shop. Not all items are organic.
              </div>
            </details>
            <details class="faq-item">
              <summary>Do you show nutrition info?</summary>
              <div class="faq-body">
                Product detail pages can include optional nutrition panels. For the demo, it’s a planned feature.
              </div>
            </details>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

