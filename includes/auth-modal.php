<?php
declare(strict_types=1);
?>
<div class="backdrop auth-backdrop-blur" hidden data-auth-backdrop></div>
<section class="auth-modal premium-auth" role="dialog" aria-modal="true" aria-label="Login or Register" hidden data-auth-modal>
  <div class="auth-illustration">
    <img src="assets/images/auth-bg.png" alt="Fresh Groceries">
    <div class="auth-illustration-overlay">
      <h3>Welcome to LeafMart</h3>
      <p>Fresh groceries delivered directly to your door.</p>
    </div>
  </div>
  <div class="auth-content">
    <div class="auth-head">
      <strong>Account</strong>
      <button class="icon-btn" type="button" aria-label="Close" data-auth-close>
        <span class="icon icon-close" aria-hidden="true"></span>
      </button>
    </div>

    <div class="auth-tabs" role="tablist" aria-label="Authentication tabs">
      <button class="btn btn-outline btn-sm auth-tab-btn" type="button" role="tab" aria-selected="true" data-auth-tab="login">Login</button>
      <button class="btn btn-outline btn-sm auth-tab-btn" type="button" role="tab" aria-selected="false" data-auth-tab="register">Sign up</button>
    </div>

    <div class="auth-body">
      <form class="form auth-form-anim" data-auth-form="login">
        <label class="field premium-field">
          <span class="label">Email</span>
          <input name="email" type="email" autocomplete="email" required placeholder="you@example.com">
        </label>
        <label class="field premium-field">
          <span class="label">Password</span>
          <input name="password" type="password" autocomplete="current-password" required minlength="6" placeholder="••••••">
        </label>
        <div class="auth-form-actions">
          <label class="check premium-check" style="color:var(--c-text)">
            <input type="checkbox" name="remember" checked>
            <span>Remember me</span>
          </label>
          <button class="btn-text" type="button" data-auth-forgot>Forgot password?</button>
        </div>
        <button class="btn btn-primary premium-btn" type="submit">Login</button>
      </form>

      <form class="form auth-form-anim" data-auth-form="register" hidden>
        <div class="form-row">
          <label class="field premium-field">
            <span class="label">Name</span>
            <input name="name" type="text" autocomplete="name" required placeholder="Your name">
          </label>
          <label class="field premium-field">
            <span class="label">Phone</span>
            <input name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="+880…">
          </label>
        </div>
        <label class="field premium-field">
          <span class="label">Email</span>
          <input name="email" type="email" autocomplete="email" required placeholder="you@example.com">
        </label>
        <div class="form-row">
          <label class="field premium-field">
            <span class="label">Password</span>
            <input name="password" type="password" autocomplete="new-password" required minlength="6" placeholder="At least 6 chars">
          </label>
          <label class="field premium-field">
            <span class="label">Confirm</span>
            <input name="confirm_password" type="password" autocomplete="new-password" required minlength="6" placeholder="Confirm">
          </label>
        </div>
        <label class="check premium-check" style="color:var(--c-text); margin: .5rem 0;">
          <input type="checkbox" required>
          <span>I agree to the <a href="terms.php">terms</a></span>
        </label>
        <button class="btn btn-primary premium-btn" type="submit">Create account</button>
      </form>
    </div>
  </div>
</section>

