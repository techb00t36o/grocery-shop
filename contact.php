<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

$page_title = SITE_NAME . ' — Contact';
$page_description = 'Contact LeafMart for support, delivery questions, or partnership inquiries.';

$state = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'message' => '',
];
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $state['name'] = trim((string)($_POST['name'] ?? ''));
    $state['email'] = trim((string)($_POST['email'] ?? ''));
    $state['phone'] = trim((string)($_POST['phone'] ?? ''));
    $state['message'] = trim((string)($_POST['message'] ?? ''));

    if ($state['name'] === '' || $state['email'] === '' || $state['message'] === '') {
        $error = 'Please fill in your name, email, and message.';
    } elseif (!filter_var($state['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Backend integration point:
        // - send email
        // - create support ticket
        // - store inquiry in database
        $success = true;
        $state = ['name' => '', 'email' => '', 'phone' => '', 'message' => ''];
    }
}

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <section class="page-hero">
    <div class="container">
      <div class="card page-hero-card">
        <div class="page-hero-grid">
          <div>
            <div class="hero-kicker">
              <span aria-hidden="true">📮</span>
              Contact us
            </div>
            <h1 class="page-title">We’re here to help.</h1>
            <p class="page-lead">
              Questions about delivery time slots, order changes, or product quality? Send a message—mobile friendly and fast.
            </p>
            <div class="hero-actions">
              <a class="btn btn-outline" href="shop.php">Continue shopping</a>
              <a class="btn btn-primary" href="#contact-form">Message us</a>
            </div>
          </div>
          <div class="page-hero-media" aria-label="Fresh produce image">
            <img
              src="https://images.unsplash.com/photo-1543168256-418811576931?auto=format&fit=crop&w=1400&q=70"
              srcset="
                https://images.unsplash.com/photo-1543168256-418811576931?auto=format&fit=crop&w=700&q=70 700w,
                https://images.unsplash.com/photo-1543168256-418811576931?auto=format&fit=crop&w=1100&q=70 1100w,
                https://images.unsplash.com/photo-1543168256-418811576931?auto=format&fit=crop&w=1400&q=70 1400w"
              sizes="(min-width: 768px) 42vw, 92vw"
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
      <div class="contact-grid">
        <aside class="card contact-cards" aria-label="Contact information">
          <div class="contact-card">
            <div class="why-icon" aria-hidden="true">📞</div>
            <div>
              <div class="contact-label">Phone</div>
              <a class="contact-link" href="tel:+8801000000000">+880 10 0000 0000</a>
              <div class="muted">Daily 8:00–22:00</div>
            </div>
          </div>
          <div class="contact-card">
            <div class="why-icon" aria-hidden="true">✉️</div>
            <div>
              <div class="contact-label">Email</div>
              <a class="contact-link" href="mailto:support@leafmart.test">support@leafmart.test</a>
              <div class="muted">We reply within 24 hours</div>
            </div>
          </div>
          <div class="contact-card">
            <div class="why-icon" aria-hidden="true">📍</div>
            <div>
              <div class="contact-label">Address</div>
              <div class="contact-text">Dhaka, Bangladesh</div>
              <div class="muted">Delivery coverage varies by area</div>
            </div>
          </div>
          <div class="contact-card soft">
            <div>
              <div class="pill sale">Tip</div>
              <p class="muted" style="margin:.4rem 0 0">
                For order help, include your phone number and what you ordered.
              </p>
            </div>
          </div>
        </aside>

        <section class="card contact-form-wrap" aria-label="Contact form">
          <div class="section-head" style="margin-bottom:.25rem">
            <div>
              <h2 class="section-title" id="contact-form" style="margin:0">Send a message</h2>
              <p class="section-sub">Fields marked required are needed to submit.</p>
            </div>
          </div>

          <?php if ($success): ?>
            <div class="form-banner success" role="status">
              Message received. We’ll get back to you soon.
            </div>
          <?php elseif ($error): ?>
            <div class="form-banner error" role="alert">
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>

          <form class="form" method="post" action="#contact-form" data-contact-form>
            <div class="form-row">
              <label class="field">
                <span class="label">Name <span aria-hidden="true">*</span></span>
                <input name="name" type="text" autocomplete="name" required value="<?= htmlspecialchars($state['name']) ?>" placeholder="Your name">
              </label>
              <label class="field">
                <span class="label">Email <span aria-hidden="true">*</span></span>
                <input name="email" type="email" autocomplete="email" required value="<?= htmlspecialchars($state['email']) ?>" placeholder="you@example.com">
              </label>
            </div>

            <div class="form-row">
              <label class="field">
                <span class="label">Phone</span>
                <input name="phone" type="tel" inputmode="tel" autocomplete="tel" value="<?= htmlspecialchars($state['phone']) ?>" placeholder="+880…">
              </label>
              <label class="field">
                <span class="label">Topic</span>
                <select name="topic" aria-label="Topic">
                  <option value="support">Order support</option>
                  <option value="delivery">Delivery schedule</option>
                  <option value="product">Product quality</option>
                  <option value="partner">Partner with us</option>
                </select>
              </label>
            </div>

            <label class="field">
              <span class="label">Message <span aria-hidden="true">*</span></span>
              <textarea name="message" required rows="6" placeholder="How can we help?"><?= htmlspecialchars($state['message']) ?></textarea>
            </label>

            <div class="form-actions">
              <button class="btn btn-primary" type="submit">Send message</button>
              <a class="btn btn-outline" href="faq.php">Check FAQ</a>
            </div>
          </form>
        </section>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="card map-card" aria-label="Map">
        <div class="section-head" style="margin:0 0 .6rem">
          <div>
            <h2 class="section-title" style="margin:0">Find us</h2>
            <p class="section-sub">Map embed placeholder for the demo.</p>
          </div>
        </div>
        <div class="map-embed" role="region" aria-label="Map embed">
          <iframe
            title="Map"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.openstreetmap.org/export/embed.html?bbox=90.3561%2C23.7639%2C90.4261%2C23.8039&amp;layer=mapnik">
          </iframe>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

