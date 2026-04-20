<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$page_title = $page_title ?? SITE_NAME;
$page_description = $page_description ?? 'Fresh, organic fruits & vegetables delivered fast.';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="theme-color" content="#4A7C59">
  <title><?= htmlspecialchars($page_title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($page_description) ?>">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Quicksand:wght@500;600;700&family=Caveat:wght@600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/style.css">
  <script defer src="assets/js/main.js"></script>
</head>
<body>
  <a class="skip-link" href="#main">Skip to content</a>

  <header class="site-header" data-header>
    <div class="container header-inner">
      <button class="icon-btn header-burger" type="button" aria-label="Open menu" aria-controls="mobile-menu" aria-expanded="false" data-menu-open>
        <span class="icon icon-burger" aria-hidden="true"></span>
      </button>

      <a class="brand" href="index.php" aria-label="<?= htmlspecialchars(SITE_NAME) ?> home">
        <span class="brand-mark" aria-hidden="true">
          <img class="logo-img" src="assets/images/icons/leafmart-logo.svg" width="40" height="40" alt="">
        </span>
        <span class="brand-text">
          <span class="brand-name"><?= htmlspecialchars(SITE_NAME) ?></span>
          <span class="brand-tag"><?= htmlspecialchars(SITE_TAGLINE) ?></span>
        </span>
      </a>

      <form class="header-search" action="shop.php" method="get" role="search" aria-label="Search products" data-search>
        <label class="sr-only" for="q">Search</label>
        <input id="q" name="q" type="search" inputmode="search" autocomplete="off" placeholder="Search apples, spinach…" value="<?= htmlspecialchars(get_qs('q', '') ?? '') ?>" data-search-input>
        <button class="icon-btn" type="submit" aria-label="Search">
          <span class="icon icon-search" aria-hidden="true"></span>
        </button>
        <div class="search-suggest" role="listbox" aria-label="Search suggestions" hidden data-search-suggest></div>
      </form>

      <nav class="header-actions" aria-label="Quick actions">
        <a class="icon-btn" href="account.php" aria-label="Account" data-account-link>
          <span class="icon icon-user" aria-hidden="true"></span>
        </a>
        <a class="icon-btn badge-wrap" href="account.php#wishlist" aria-label="Wishlist">
          <span class="icon icon-heart" aria-hidden="true"></span>
          <span class="badge" data-wishlist-count aria-label="Wishlist items">0</span>
        </a>
        <a class="icon-btn badge-wrap" href="cart.php" aria-label="Cart">
          <span class="icon icon-cart" aria-hidden="true"></span>
          <span class="badge" data-cart-count aria-label="Cart items">0</span>
        </a>
      </nav>
    </div>

    <div class="container header-nav-desktop" data-desktop-nav>
      <?php include __DIR__ . '/navigation.php'; ?>
    </div>
  </header>

  <div class="backdrop" hidden data-backdrop></div>
  <aside class="mobile-drawer" id="mobile-menu" aria-label="Mobile menu" hidden data-mobile-menu>
    <div class="mobile-drawer-head">
      <span class="drawer-title">Menu</span>
      <button class="icon-btn" type="button" aria-label="Close menu" data-menu-close>
        <span class="icon icon-close" aria-hidden="true"></span>
      </button>
    </div>
    <div class="mobile-drawer-body">
      <form class="mobile-search" action="shop.php" method="get" role="search" aria-label="Search products">
        <label class="sr-only" for="mq">Search</label>
        <input id="mq" name="q" type="search" inputmode="search" autocomplete="off" placeholder="Search produce…" value="<?= htmlspecialchars(get_qs('q', '') ?? '') ?>">
        <button class="btn btn-sm" type="submit">Search</button>
      </form>

      <?php include __DIR__ . '/navigation.php'; ?>

      <div class="mobile-drawer-foot">
        <a class="btn btn-outline" href="account.php">Account</a>
        <a class="btn btn-primary" href="cart.php">View cart</a>
      </div>
    </div>
  </aside>

  <div class="toast-region" aria-live="polite" aria-atomic="true" data-toasts></div>

