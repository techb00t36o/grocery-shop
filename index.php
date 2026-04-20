<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

$page_title = SITE_NAME . ' — ' . SITE_TAGLINE;
$page_description = 'Fresh fruits & vegetables with an organic, farm-fresh vibe. Shop seasonal offers and get fast delivery.';

// Newsletter form demo (no backend): show a success banner if posted.
$newsletter_success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newsletter_email'])) {
    $email = trim((string)$_POST['newsletter_email']);
    $newsletter_success = $email !== '';
}

$products = demo_products();
$seasonal = array_values(array_filter($products, fn($p) => in_array('Seasonal', $p['tags'], true) || !empty($p['on_sale'])));
$seasonal = array_slice($seasonal, 0, 8);

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <section class="hero">
    <div class="container">
      <div class="hero-card">
        <div class="hero-grid">
          <div>
            <div class="hero-kicker" aria-label="Fresh and organic message">
              <span aria-hidden="true">🥬</span>
              Fresh, organic, and delivered fast
            </div>
            <h1>Farm-fresh groceries with an earthy, feel-good vibe.</h1>
            <p>
              Pick crisp fruits, vibrant vegetables, and seasonal favorites—carefully sourced and packed with care.
              Clean ingredients, clear prices, and a checkout that’s easy on mobile.
            </p>
            <div class="hero-actions">
              <a class="btn btn-primary" href="shop.php">Shop now</a>
              <a class="btn btn-outline" href="shop.php?availability=on_sale">See seasonal offers</a>
              <span class="hero-note">Grown with care. Packed with love.</span>
            </div>
          </div>

          <div class="hero-media" aria-label="Fresh produce image">
            <img
              src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1200&q=70"
              srcset="
                https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=600&q=70 600w,
                https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=900&q=70 900w,
                https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1200&q=70 1200w"
              sizes="(min-width: 768px) 42vw, 92vw"
              width="1200"
              height="800"
              loading="eager"
              alt="A colorful assortment of fresh vegetables on a rustic table">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-head">
        <div>
          <h2 class="section-title">Featured categories</h2>
          <p class="section-sub">Quick picks for fruits, veggies, organic, and seasonal finds.</p>
        </div>
        <a class="btn btn-outline" href="shop.php">Browse all</a>
      </div>

      <div class="grid">
        <article class="card cat-card">
          <div class="cat-illu" aria-hidden="true" style="background-image: url('assets/images/categories/fruits.jpg'); background-size: cover; background-position: center;"></div>
          <div class="cat-badge">Fruits</div>
          <h3>Sweet, crisp & juicy</h3>
          <p>From apples to mangoes—fresh and snack-ready.</p>
          <div class="cat-actions">
            <a class="btn btn-primary" href="shop.php?category%5B%5D=Fruits">Shop fruits</a>
            <a class="btn btn-outline" href="shop.php?q=strawberries">Try strawberries</a>
          </div>
        </article>

        <article class="card cat-card">
          <div class="cat-illu" aria-hidden="true" style="background-image: url('assets/images/categories/vegetables.jpg'); background-size: cover; background-position: center;"></div>
          <div class="cat-badge">Vegetables</div>
          <h3>Green, vibrant & fresh</h3>
          <p>Everyday essentials for salads, curries, and sides.</p>
          <div class="cat-actions">
            <a class="btn btn-primary" href="shop.php?category%5B%5D=Vegetables">Shop veggies</a>
            <a class="btn btn-outline" href="shop.php?q=spinach">Try spinach</a>
          </div>
        </article>

        <article class="card cat-card">
          <div class="cat-illu" aria-hidden="true" style="background-image: url('assets/images/categories/organic.jpg'); background-size: cover; background-position: center;"></div>
          <div class="cat-badge">Organic</div>
          <h3>Clean & consciously sourced</h3>
          <p>Simple ingredients, strong standards, real taste.</p>
          <div class="cat-actions">
            <a class="btn btn-primary" href="shop.php?tag%5B%5D=Organic">Shop organic</a>
            <a class="btn btn-outline" href="shop.php?availability=in_stock">In stock now</a>
          </div>
        </article>

        <article class="card cat-card">
          <div class="cat-illu" aria-hidden="true" style="background-image: url('assets/images/categories/seasonal.jpg'); background-size: cover; background-position: center;"></div>
          <div class="cat-badge">Seasonal</div>
          <h3>Limited-time favorites</h3>
          <p>Catch the season’s best—fresh arrivals every week.</p>
          <div class="cat-actions">
            <a class="btn btn-primary" href="shop.php?tag%5B%5D=Seasonal">Shop seasonal</a>
            <a class="btn btn-outline" href="shop.php?availability=on_sale">View offers</a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-head">
        <div>
          <h2 class="section-title">Seasonal offers</h2>
          <p class="section-sub">Swipe on mobile, scroll on desktop—fresh deals you can taste.</p>
        </div>
      </div>

      <div class="slider" aria-label="Seasonal products">
        <?php foreach ($seasonal as $p): ?>
          <?php
          $sale = !empty($p['on_sale']);
          $pill = $sale ? '<span class="pill sale">On sale</span>' : '<span class="pill">Fresh</span>';
          $img = htmlspecialchars((string)$p['image']);
          $name = htmlspecialchars((string)$p['name']);
          $unit = htmlspecialchars((string)$p['unit']);
          ?>
          <article class="card product-mini">
            <img
              src="<?= $img ?>"
              width="96"
              height="96"
              loading="lazy"
              alt="<?= $name ?>">
            <div>
              <div><?= $pill ?></div>
              <h4><?= $name ?></h4>
              <div class="muted"><?= $unit ?></div>
              <div class="price"><?= htmlspecialchars(money((float)$p['price'])) ?></div>
              <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-top:.25rem">
                <button class="btn btn-primary btn-sm" type="button" onclick="window.LeafMart?.addToCart('<?= htmlspecialchars((string)$p['id']) ?>', 1)">Add to cart</button>
                <a class="btn btn-outline btn-sm" href="shop.php?q=<?= urlencode((string)$p['name']) ?>">View</a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-head">
        <div>
          <h2 class="section-title">Why choose us</h2>
          <p class="section-sub">Quality you can see, freshness you can taste.</p>
        </div>
      </div>

      <div class="why">
        <article class="card why-item">
          <div class="why-icon" aria-hidden="true">🌱</div>
          <h3>Organic-first</h3>
          <p>We prioritize organic options and transparent sourcing—no mystery produce.</p>
        </article>
        <article class="card why-item">
          <div class="why-icon" aria-hidden="true">🚚</div>
          <h3>Fast delivery</h3>
          <p>Mobile-friendly checkout and clear time slots help you get it when you need it.</p>
        </article>
        <article class="card why-item">
          <div class="why-icon" aria-hidden="true">🥗</div>
          <h3>Peak freshness</h3>
          <p>We handle produce gently and pack it smart—less bruising, more crunch.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-head">
        <div>
          <h2 class="section-title">Loved by customers</h2>
          <p class="section-sub">Simple, friendly, and reliable—especially on mobile.</p>
        </div>
      </div>

      <div class="testimonials">
        <article class="card quote">
          <div class="pill">“So fresh”</div>
          <p>“The spinach and tomatoes were super fresh. Checkout was easy on my phone.”</p>
          <div class="who">— Riya</div>
        </article>
        <article class="card quote">
          <div class="pill">“Great value”</div>
          <p>“Seasonal offers are great, and delivery is always on time.”</p>
          <div class="who">— Hasan</div>
        </article>
        <article class="card quote">
          <div class="pill">“Clean UI”</div>
          <p>“No clutter. Filters are easy to use and the cart updates instantly.”</p>
          <div class="who">— Nabila</div>
        </article>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="card newsletter-band">
        <div>
          <h3>Get seasonal deals and fresh arrivals.</h3>
          <p class="muted" style="margin:.25rem 0 0">One email a week, max. Unsubscribe anytime.</p>
        </div>

        <?php if ($newsletter_success): ?>
          <div class="pill sale" role="status">Thanks! You’re subscribed.</div>
        <?php endif; ?>

        <form class="newsletter-row" method="post" action="">
          <label class="sr-only" for="home-news">Email</label>
          <input id="home-news" name="newsletter_email" type="email" required placeholder="you@example.com">
          <button class="btn btn-primary" type="submit">Subscribe</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

