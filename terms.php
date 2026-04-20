<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

$page_title = SITE_NAME . ' — Terms & Conditions';
$page_description = 'Website terms for shopping, delivery, and usage.';

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <section class="page-hero">
    <div class="container">
      <div class="card page-hero-card">
        <div class="page-hero-grid">
          <div>
            <div class="hero-kicker">
              <span aria-hidden="true">📄</span>
              Terms & Conditions
            </div>
            <h1 class="page-title">Simple terms for a simple shop.</h1>
            <p class="page-lead">
              This is a demo template. Replace with your official terms before production.
            </p>
            <div class="hero-actions">
              <a class="btn btn-outline" href="privacy.php">Privacy</a>
              <a class="btn btn-primary" href="shop.php">Start shopping</a>
            </div>
          </div>
          <div class="page-hero-media" aria-label="Paper texture image">
            <img
              src="https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=1400&q=70"
              width="1400"
              height="900"
              loading="lazy"
              alt="Notebook and pen on a desk">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <article class="card legal">
        <h2 class="section-title" style="margin:0 0 .6rem">1. Using the site</h2>
        <p class="muted" style="margin:0 0 1rem">
          By using this site, you agree to these terms. If you do not agree, please do not use the site.
        </p>

        <h2 class="section-title" style="margin:0 0 .6rem">2. Orders & pricing</h2>
        <p class="muted" style="margin:0 0 1rem">
          Prices and availability may change. For the demo, products are placeholder items without a live inventory system.
        </p>

        <h2 class="section-title" style="margin:0 0 .6rem">3. Delivery</h2>
        <p class="muted" style="margin:0 0 1rem">
          Delivery time slots are provided at checkout. Missed deliveries may require rescheduling and may incur additional fees.
        </p>

        <h2 class="section-title" style="margin:0 0 .6rem">4. Returns & refunds</h2>
        <p class="muted" style="margin:0 0 1rem">
          If items arrive damaged, contact us within 24 hours. Resolution may include replacement or refund.
        </p>

        <h2 class="section-title" style="margin:0 0 .6rem">5. Contact</h2>
        <p class="muted" style="margin:0">
          For support, visit <a href="contact.php">Contact</a> or see <a href="faq.php">FAQ</a>.
        </p>
      </article>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

