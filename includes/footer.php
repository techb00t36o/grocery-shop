<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
?>
  <footer class="site-footer">
    <div class="container footer-top">
      <div class="footer-brand">
        <div class="footer-logo">
          <span class="brand-mark" aria-hidden="true">
            <img class="logo-img" src="assets/images/icons/leafmart-logo.svg" width="40" height="40" alt="">
          </span>
          <span>
            <div class="footer-name"><?= htmlspecialchars(SITE_NAME) ?></div>
            <div class="footer-tag"><?= htmlspecialchars(SITE_TAGLINE) ?></div>
          </span>
        </div>
        <p class="muted">Farm-fresh fruits & veggies, carefully sourced and delivered with care.</p>
        <div class="footer-social" aria-label="Social links">
          <a class="chip chip-icon" href="#" aria-label="Facebook">
            <img src="assets/images/icons/facebook.svg" width="18" height="18" alt="">
          </a>
          <a class="chip chip-icon" href="#" aria-label="Instagram">
            <img src="assets/images/icons/instagram.svg" width="18" height="18" alt="">
          </a>
          <a class="chip chip-icon" href="#" aria-label="YouTube">
            <img src="assets/images/icons/youtube.svg" width="18" height="18" alt="">
          </a>
        </div>
      </div>

      <div class="footer-cols" data-footer-accordions>
        <section class="footer-col">
          <button class="footer-col-title" type="button" aria-expanded="false" data-accordion-btn>
            Quick links <span class="chev" aria-hidden="true"></span>
          </button>
          <div class="footer-col-body" data-accordion-panel>
            <a href="about.php">About</a>
            <a href="shop.php">Shop</a>
            <a href="contact.php">Contact</a>
            <a href="faq.php">FAQ</a>
          </div>
        </section>

        <section class="footer-col">
          <button class="footer-col-title" type="button" aria-expanded="false" data-accordion-btn>
            Customer service <span class="chev" aria-hidden="true"></span>
          </button>
          <div class="footer-col-body" data-accordion-panel>
            <a href="faq.php#delivery">Delivery info</a>
            <a href="faq.php#returns">Returns</a>
            <a href="privacy.php">Privacy</a>
            <a href="terms.php">Terms</a>
          </div>
        </section>

        <section class="footer-col">
          <button class="footer-col-title" type="button" aria-expanded="false" data-accordion-btn>
            Newsletter <span class="chev" aria-hidden="true"></span>
          </button>
          <div class="footer-col-body" data-accordion-panel>
            <form class="newsletter" action="" method="post" data-newsletter>
              <label class="sr-only" for="newsletter-email">Email</label>
              <input id="newsletter-email" name="newsletter_email" type="email" placeholder="you@example.com" required>
              <button class="btn btn-primary" type="submit">Subscribe</button>
              <p class="muted">Seasonal offers & fresh arrivals. No spam.</p>
            </form>
          </div>
        </section>
      </div>
    </div>

    <div class="container footer-bottom">
      <div class="footer-pay" aria-label="Payment methods">
        <span class="chip chip-logo" aria-label="VISA">
          <img src="assets/images/icons/visa.svg" width="72" height="24" alt="">
        </span>
        <span class="chip chip-logo" aria-label="Mastercard">
          <img src="assets/images/icons/mastercard.svg" width="90" height="24" alt="">
        </span>
        <span class="chip chip-logo" aria-label="bKash">
          <img src="assets/images/icons/bkash.svg" width="78" height="24" alt="">
        </span>
        <span class="chip chip-logo" aria-label="Nagad">
          <img src="assets/images/icons/nagad.svg" width="78" height="24" alt="">
        </span>
        <span class="chip chip-logo" aria-label="Cash on delivery">
          <img src="assets/images/icons/cod.svg" width="78" height="24" alt="">
        </span>
      </div>
      <small class="muted">© <?= date('Y') ?> <?= htmlspecialchars(SITE_NAME) ?>. All rights reserved.</small>
    </div>
  </footer>

  <button class="back-to-top" type="button" aria-label="Back to top" hidden data-back-to-top>
    ↑
  </button>

  <?php include __DIR__ . '/auth-modal.php'; ?>
</body>
</html>

