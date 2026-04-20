<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

$page_title = SITE_NAME . ' — Privacy Policy';
$page_description = 'How we collect, use, and protect your information.';

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <section class="page-hero">
    <div class="container">
      <div class="card page-hero-card">
        <div class="page-hero-grid">
          <div>
            <div class="hero-kicker">
              <span aria-hidden="true">🔒</span>
              Privacy Policy
            </div>
            <h1 class="page-title">Your privacy, respected.</h1>
            <p class="page-lead">
              This is a demo-friendly policy template. Replace with your legal text before production.
            </p>
            <div class="hero-actions">
              <a class="btn btn-outline" href="terms.php">Terms</a>
              <a class="btn btn-primary" href="contact.php">Questions?</a>
            </div>
          </div>
          <div class="page-hero-media" aria-label="Leaf imagery">
            <img
              src="https://images.unsplash.com/photo-1462536943532-57a629f6cc60?auto=format&fit=crop&w=1400&q=70"
              width="1400"
              height="900"
              loading="lazy"
              alt="Green leaves with soft light">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <article class="card legal">
        <h2 class="section-title" style="margin:0 0 .6rem">1. Information we collect</h2>
        <p class="muted" style="margin:0 0 1rem">
          When you shop or contact us, we may collect your name, phone number, email, delivery address, and order details.
        </p>

        <h2 class="section-title" style="margin:0 0 .6rem">2. How we use information</h2>
        <ul class="clean-list">
          <li><strong>Order fulfillment</strong> (delivery, updates, and support)</li>
          <li><strong>Service improvement</strong> (quality feedback and operational metrics)</li>
          <li><strong>Security</strong> (fraud prevention and account protection)</li>
        </ul>

        <h2 class="section-title" style="margin:0 0 .6rem">3. Cookies & local storage</h2>
        <p class="muted" style="margin:0 0 1rem">
          This frontend demo uses <strong>localStorage</strong> to store your cart and wishlist on your device.
          In production, you may also use cookies/sessions for authentication.
        </p>

        <h2 class="section-title" style="margin:0 0 .6rem">4. Sharing</h2>
        <p class="muted" style="margin:0 0 1rem">
          We only share data with delivery partners or payment providers as needed to complete your order,
          and only under appropriate safeguards.
        </p>

        <h2 class="section-title" style="margin:0 0 .6rem">5. Contact</h2>
        <p class="muted" style="margin:0">
          For questions, contact us via <a href="contact.php">Contact</a>.
        </p>
      </article>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

