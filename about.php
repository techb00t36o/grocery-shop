<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

$page_title = SITE_NAME . ' — About';
$page_description = 'Learn about our organic-first sourcing and farm-fresh promise.';

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <section class="page-hero">
    <div class="container">
      <div class="card page-hero-card">
        <div class="page-hero-grid">
          <div>
            <div class="hero-kicker">
              <span aria-hidden="true">🌾</span>
              About <?= htmlspecialchars(SITE_NAME) ?>
            </div>
            <h1 class="page-title">Fresh food, honest sourcing, simple shopping.</h1>
            <p class="page-lead">
              We’re building a friendly grocery experience that feels calm on mobile, fast on slow networks, and joyful
              in your kitchen—starting with fruits and vegetables.
            </p>
            <div class="hero-actions">
              <a class="btn btn-primary" href="shop.php">Shop produce</a>
              <a class="btn btn-outline" href="contact.php">Contact us</a>
            </div>
          </div>
          <div class="page-hero-media" aria-label="Farm imagery">
            <img
              src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1400&q=70"
              srcset="
                https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=700&q=70 700w,
                https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1100&q=70 1100w,
                https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1400&q=70 1400w"
              sizes="(min-width: 768px) 42vw, 92vw"
              width="1400"
              height="900"
              loading="lazy"
              alt="Green plants growing in a garden bed">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-head">
        <div>
          <h2 class="section-title">Our promise</h2>
          <p class="section-sub">The standards we won’t compromise on.</p>
        </div>
      </div>

      <div class="why">
        <article class="card why-item">
          <div class="why-icon" aria-hidden="true">🧺</div>
          <h3>Careful selection</h3>
          <p>We choose produce for taste, freshness, and handling quality—not just size.</p>
        </article>
        <article class="card why-item">
          <div class="why-icon" aria-hidden="true">🧾</div>
          <h3>Clear pricing</h3>
          <p>Simple unit sizes and transparent prices so you know what you’re getting.</p>
        </article>
        <article class="card why-item">
          <div class="why-icon" aria-hidden="true">🍃</div>
          <h3>Organic-first</h3>
          <p>Organic options are prioritized and labeled—easy to filter and find.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="content-grid">
        <article class="card content-card">
          <h2 class="section-title" style="margin:0 0 .4rem">How we source</h2>
          <p class="muted" style="margin:0 0 1rem">
            For this frontend demo we use sample products, but the structure is ready for real sourcing metadata.
          </p>
          <ul class="clean-list">
            <li><strong>Local partners</strong> where possible for speed and freshness.</li>
            <li><strong>Seasonal rotation</strong> so your cart stays exciting.</li>
            <li><strong>Cold-chain awareness</strong> for delicate items.</li>
            <li><strong>Quality feedback</strong> loop based on customer ratings.</li>
          </ul>
          <a class="btn btn-outline" href="shop.php?tag%5B%5D=Seasonal">See seasonal items</a>
        </article>

        <aside class="card content-card tint">
          <h2 class="section-title" style="margin:0 0 .4rem">What matters to us</h2>
          <p class="muted" style="margin:0 0 1rem">A small checklist we use daily.</p>
          <div class="pill" style="margin-bottom:.5rem">Taste first</div>
          <div class="pill" style="margin-bottom:.5rem">Less waste</div>
          <div class="pill" style="margin-bottom:.5rem">Fast delivery</div>
          <div class="pill">Mobile-friendly</div>
        </aside>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="card cta-band">
        <div>
          <h2 class="section-title" style="margin:0">Ready to shop fresh?</h2>
          <p class="muted" style="margin:.25rem 0 0">Start with fruits and veggies—then build your basket.</p>
        </div>
        <div class="cta-actions">
          <a class="btn btn-primary" href="shop.php">Go to shop</a>
          <a class="btn btn-outline" href="contact.php">Ask a question</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

