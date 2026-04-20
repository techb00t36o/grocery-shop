/* global window, document */
(() => {
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

  const storage = {
    get(key, fallback) {
      try {
        const v = window.localStorage.getItem(key);
        return v ? JSON.parse(v) : fallback;
      } catch {
        return fallback;
      }
    },
    set(key, value) {
      try {
        window.localStorage.setItem(key, JSON.stringify(value));
      } catch {
        // ignore
      }
    },
  };

  const CART_KEY = "leafmart_cart_v1";
  const WISHLIST_KEY = "leafmart_wishlist_v1";
  const USER_KEY = "leafmart_user_v1";

  const getUser = () => storage.get(USER_KEY, null);
  const setUser = (u) => storage.set(USER_KEY, u);

  function countItems(map) {
    if (!map || typeof map !== "object") return 0;
    return Object.values(map).reduce((sum, qty) => sum + (Number(qty) || 0), 0);
  }

  function setBadge(el, n) {
    if (!el) return;
    const val = Math.max(0, Number(n) || 0);
    el.textContent = String(val);
    el.classList.toggle("is-hidden", val === 0);
  }

  function bounceBadge(el) {
    if (!el) return;
    el.classList.remove("is-bounce");
    // reflow
    void el.offsetWidth;
    el.classList.add("is-bounce");
  }

  function refreshHeaderBadges({ bounceCart = false, bounceWishlist = false } = {}) {
    const cart = storage.get(CART_KEY, {});
    const wishlist = storage.get(WISHLIST_KEY, {});
    const cartCount = countItems(cart);
    const wishCount = countItems(wishlist);

    const cartEl = $("[data-cart-count]");
    const wishEl = $("[data-wishlist-count]");
    setBadge(cartEl, cartCount);
    setBadge(wishEl, wishCount);
    if (bounceCart) bounceBadge(cartEl);
    if (bounceWishlist) bounceBadge(wishEl);
  }

  function toast({ title, message, type = "success", ms = 2600 } = {}) {
    const region = $("[data-toasts]");
    if (!region) return;
    const el = document.createElement("div");
    el.className = "toast";
    el.innerHTML = `
      <span class="toast-dot ${type === "error" ? "is-error" : ""}" aria-hidden="true"></span>
      <div>
        <div class="toast-title"></div>
        <div class="toast-msg"></div>
      </div>
    `;
    $(".toast-title", el).textContent = title || (type === "error" ? "Oops" : "Done");
    $(".toast-msg", el).textContent = message || "";
    region.appendChild(el);
    requestAnimationFrame(() => el.classList.add("is-in"));
    window.setTimeout(() => {
      el.classList.remove("is-in");
      window.setTimeout(() => el.remove(), 220);
    }, ms);
  }

  function lockBody(lock) {
    document.documentElement.style.overflow = lock ? "hidden" : "";
  }

  function setupMobileMenu() {
    const menu = $("[data-mobile-menu]");
    const backdrop = $("[data-backdrop]");
    const openBtn = $("[data-menu-open]");
    const closeBtn = $("[data-menu-close]");
    if (!menu || !backdrop || !openBtn || !closeBtn) return;

    const open = () => {
      menu.hidden = false;
      backdrop.hidden = false;
      requestAnimationFrame(() => menu.classList.add("is-open"));
      openBtn.setAttribute("aria-expanded", "true");
      lockBody(true);
    };
    const close = () => {
      menu.classList.remove("is-open");
      openBtn.setAttribute("aria-expanded", "false");
      lockBody(false);
      window.setTimeout(() => {
        menu.hidden = true;
        backdrop.hidden = true;
      }, 280);
    };

    openBtn.addEventListener("click", open);
    closeBtn.addEventListener("click", close);
    backdrop.addEventListener("click", close);
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && !menu.hidden) close();
    });
  }

  function setupFooterAccordions() {
    const root = $("[data-footer-accordions]");
    if (!root) return;
    const isDesktop = () => window.matchMedia("(min-width: 768px)").matches;
    const cols = $$(".footer-col", root);
    const buttons = $$("[data-accordion-btn]", root);

    const sync = () => {
      if (isDesktop()) {
        cols.forEach((c) => c.setAttribute("data-open", "true"));
        buttons.forEach((b) => b.setAttribute("aria-expanded", "true"));
        return;
      }
      cols.forEach((c, i) => c.setAttribute("data-open", i === 0 ? "true" : "false"));
      buttons.forEach((b, i) => b.setAttribute("aria-expanded", i === 0 ? "true" : "false"));
    };

    buttons.forEach((btn) => {
      btn.addEventListener("click", () => {
        if (isDesktop()) return;
        const col = btn.closest(".footer-col");
        if (!col) return;
        const open = col.getAttribute("data-open") === "true";
        col.setAttribute("data-open", open ? "false" : "true");
        btn.setAttribute("aria-expanded", open ? "false" : "true");
      });
    });

    sync();
    window.addEventListener("resize", sync);
  }

  function setupBackToTop() {
    const btn = $("[data-back-to-top]");
    if (!btn) return;
    const onScroll = () => {
      const show = window.scrollY > 600;
      btn.hidden = !show;
    };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
    btn.addEventListener("click", () => window.scrollTo({ top: 0, behavior: "smooth" }));
  }

  function setupSearchAutocomplete() {
    const wrap = $("[data-search]");
    if (!wrap) return;
    const input = $("[data-search-input]", wrap);
    const box = $("[data-search-suggest]", wrap);
    if (!input || !box) return;

    const base = [
      "apples",
      "bananas",
      "strawberries",
      "mangoes",
      "oranges",
      "grapes",
      "watermelon",
      "papaya",
      "tomatoes",
      "carrots",
      "cucumbers",
      "spinach",
      "onions",
      "broccoli",
      "bell peppers",
      "potatoes",
    ];

    const close = () => {
      box.hidden = true;
      box.innerHTML = "";
    };
    const open = (items) => {
      box.innerHTML = "";
      items.slice(0, 6).forEach((t) => {
        const b = document.createElement("button");
        b.type = "button";
        b.innerHTML = `<span>${t}</span><small>Search</small>`;
        b.addEventListener("click", () => {
          input.value = t;
          wrap.submit();
        });
        box.appendChild(b);
      });
      box.hidden = items.length === 0;
    };

    input.addEventListener("input", () => {
      const q = input.value.trim().toLowerCase();
      if (q.length < 2) return close();
      const items = base.filter((x) => x.includes(q));
      open(items);
    });
    input.addEventListener("blur", () => window.setTimeout(close, 120));
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") close();
    });
  }

  function setupShopUI() {
    const filterDrawer = document.querySelector("[data-filter-drawer]");
    const filterBackdrop = document.querySelector("[data-filter-backdrop]");
    const openBtn = document.querySelector("[data-filter-open]");
    const closeBtn = document.querySelector("[data-filter-close]");
    const sortSel = document.querySelector("[data-sort]");

    const syncFilterCount = () => {
      const pill = document.querySelector("[data-filter-count]");
      if (!pill) return;
      const url = new URL(window.location.href);
      let count = 0;
      const q = (url.searchParams.get("q") || "").trim();
      if (q) count += 1;
      count += url.searchParams.getAll("category[]").length;
      count += url.searchParams.getAll("tag[]").length;
      const avail = url.searchParams.get("availability") || "";
      if (avail) count += 1;
      const min = url.searchParams.get("min") || "";
      const max = url.searchParams.get("max") || "";
      if (min) count += 1;
      if (max) count += 1;
      pill.textContent = String(count);
      pill.hidden = count === 0;
    };

    syncFilterCount();

    if (filterDrawer && filterBackdrop && openBtn && closeBtn) {
      const lockBody = (lock) => (document.documentElement.style.overflow = lock ? "hidden" : "");
      const open = () => {
        filterDrawer.hidden = false;
        filterBackdrop.hidden = false;
        requestAnimationFrame(() => filterDrawer.classList.add("is-open"));
        openBtn.setAttribute("aria-expanded", "true");
        lockBody(true);
      };
      const close = () => {
        filterDrawer.classList.remove("is-open");
        openBtn.setAttribute("aria-expanded", "false");
        lockBody(false);
        window.setTimeout(() => {
          filterDrawer.hidden = true;
          filterBackdrop.hidden = true;
        }, 280);
      };
      openBtn.addEventListener("click", open);
      closeBtn.addEventListener("click", close);
      filterBackdrop.addEventListener("click", close);
      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && !filterDrawer.hidden) close();
      });
    }

    if (sortSel) {
      sortSel.addEventListener("change", () => {
        const url = new URL(window.location.href);
        url.searchParams.set("sort", sortSel.value);
        url.searchParams.delete("page");
        window.location.href = url.toString();
      });
    }

    // Product card actions
    document.addEventListener("click", (e) => {
      const btn = e.target.closest?.("[data-add-to-cart], [data-wishlist-toggle]");
      if (!btn) return;
      const card = btn.closest?.("[data-product-card]");
      const id = card?.getAttribute?.("data-product-id");
      if (!id) return;

      if (btn.matches("[data-add-to-cart]")) {
        window.LeafMart?.addToCart(id, 1);
      } else if (btn.matches("[data-wishlist-toggle]")) {
        const on = window.LeafMart?.toggleWishlist(id);
        if (on) btn.classList.add("is-on");
        else btn.classList.remove("is-on");
      }
    });

    // Product detail add to cart form
    document.addEventListener("submit", (e) => {
      const form = e.target;
      if (!form.matches("[data-add-to-cart-form]")) return;
      e.preventDefault();
      const id = form.querySelector("input[name='product_id']")?.value;
      const qty = form.querySelector("input[name='qty']")?.value || 1;
      if (id) {
        window.LeafMart?.addToCart(id, qty);
      }
    });

    // Progressive "Load more" (client-side reveal) for mobile.
    const grid = document.querySelector("[data-product-grid]");
    const loadWrap = document.querySelector("[data-load-more-wrap]");
    const loadBtn = document.querySelector("[data-load-more]");
    if (grid && loadWrap && loadBtn) {
      const cards = Array.from(grid.children);
      const per = Number(loadBtn.getAttribute("data-per-page")) || 12;
      let shown = cards.length; // server already paginated

      // If server paginated, we can't reveal more without fetching; hide button on desktop.
      // For now keep the button on small screens as a hint (pagination still works).
      const isDesktop = () => window.matchMedia("(min-width: 1024px)").matches;
      const sync = () => {
        loadWrap.hidden = isDesktop();
      };
      sync();
      window.addEventListener("resize", sync);

      loadBtn.addEventListener("click", () => {
        // Navigate to next page for now (fast + simple).
        const url = new URL(window.location.href);
        const page = Number(url.searchParams.get("page") || "1");
        url.searchParams.set("page", String(page + 1));
        window.location.href = url.toString();
      });
    }
  }

  function setupNewsletter() {
    const forms = $$("[data-newsletter]");
    forms.forEach((f) => {
      f.addEventListener("submit", (e) => {
        e.preventDefault();
        const email = $("input[type='email']", f)?.value?.trim();
        if (!email) {
          toast({ type: "error", title: "Email required", message: "Please enter your email to subscribe." });
          return;
        }
        toast({ title: "Subscribed", message: "Thanks! You’ll get fresh offers soon." });
        f.reset();
      });
    });
  }

  function setupContactForm() {
    const form = document.querySelector("[data-contact-form]");
    if (!form) return;
    form.addEventListener("submit", (e) => {
      const name = form.querySelector("input[name='name']")?.value?.trim();
      const email = form.querySelector("input[name='email']")?.value?.trim();
      const message = form.querySelector("textarea[name='message']")?.value?.trim();
      if (!name || !email || !message) {
        e.preventDefault();
        toast({ type: "error", title: "Missing info", message: "Please fill in name, email, and message." });
      }
    });
  }

  function fmtMoney(n) {
    const sym = window.__LEAFMART_CURRENCY__ || "৳";
    const num = Number(n) || 0;
    const s = num.toFixed(2).replace(/\.00$/, "").replace(/(\.\d)0$/, "$1");
    return `${sym} ${s}`;
  }

  function setupCartPage() {
    const root = document.querySelector("[data-cart-root]");
    if (!root) return;

    const products = window.__LEAFMART_PRODUCTS__ || {};
    const rowsWrap = root.querySelector("[data-cart-rows]");
    const cardsWrap = root.querySelector("[data-cart-cards]");
    const empty = root.querySelector("[data-cart-empty]");
    const clearBtn = root.querySelector("[data-cart-clear]");

    const elSub = root.querySelector("[data-sum-subtotal]");
    const elDel = root.querySelector("[data-sum-delivery]");
    const elDis = root.querySelector("[data-sum-discount]");
    const elTot = root.querySelector("[data-sum-total]");

    const codeEl = root.querySelector("[data-coupon-code]");
    const applyBtn = root.querySelector("[data-apply-coupon]");
    let coupon = storage.get("leafmart_coupon_v1", "");

    if (codeEl) codeEl.value = coupon || "";

    const deliveryFor = (subtotal) => {
      if (subtotal <= 0) return 0;
      return subtotal >= 500 ? 0 : 40;
    };

    const discountFor = (subtotal) => {
      const c = (coupon || "").trim().toUpperCase();
      if (!c) return 0;
      if (c === "FRESH10") return Math.round(subtotal * 0.10);
      if (c === "WELCOME5") return 5;
      return 0;
    };

    function render() {
      const cart = window.LeafMart?.getCart?.() || {};
      const ids = Object.keys(cart).filter((id) => Number(cart[id]) > 0);

      if (rowsWrap) rowsWrap.innerHTML = "";
      if (cardsWrap) cardsWrap.innerHTML = "";

      if (ids.length === 0) {
        empty && (empty.hidden = false);
        root.querySelector("[data-cart-table]")?.classList.add("is-empty");
        if (elSub) elSub.textContent = fmtMoney(0);
        if (elDel) elDel.textContent = fmtMoney(0);
        if (elDis) elDis.textContent = fmtMoney(0);
        if (elTot) elTot.textContent = fmtMoney(0);
        refreshHeaderBadges();
        return;
      }

      empty && (empty.hidden = true);
      root.querySelector("[data-cart-table]")?.classList.remove("is-empty");

      let subtotal = 0;
      ids.forEach((id) => {
        const p = products[id];
        if (!p) return;
        const qty = Math.max(1, Number(cart[id]) || 1);
        const price = Number(p.price) || 0;
        const line = price * qty;
        subtotal += line;

        // Table row (desktop)
        if (rowsWrap) {
          const row = document.createElement("div");
          row.className = "cart-table-row";
          row.setAttribute("role", "row");
          row.innerHTML = `
            <div class="ct-prod" role="cell">
              <div class="ct-name">${p.name}</div>
              <div class="muted">${p.unit || ""}</div>
            </div>
            <div role="cell"><strong>${fmtMoney(price)}</strong></div>
            <div role="cell">
              <div class="qty" data-qty>
                <button class="icon-btn qty-btn" type="button" aria-label="Decrease quantity" data-qty-dec>−</button>
                <input class="qty-in" type="number" inputmode="numeric" min="1" value="${qty}" aria-label="Quantity" data-qty-input>
                <button class="icon-btn qty-btn" type="button" aria-label="Increase quantity" data-qty-inc>+</button>
              </div>
            </div>
            <div role="cell"><strong>${fmtMoney(line)}</strong></div>
            <div role="cell">
              <button class="icon-btn" type="button" aria-label="Remove item" data-remove>✕</button>
            </div>
          `;
          row.dataset.productId = id;
          rowsWrap.appendChild(row);
        }

        // Card (mobile)
        if (cardsWrap) {
          const card = document.createElement("div");
          card.className = "cart-card";
          card.dataset.productId = id;
          card.innerHTML = `
            <div class="cart-card-top">
              <div>
                <div class="cart-card-name">${p.name}</div>
                <div class="muted">${p.unit || ""}</div>
                <div class="cart-card-price">${fmtMoney(price)} <span class="muted">each</span></div>
              </div>
              <button class="icon-btn" type="button" aria-label="Remove item" data-remove>✕</button>
            </div>
            <div class="cart-card-bottom">
              <div class="qty" data-qty>
                <button class="icon-btn qty-btn" type="button" aria-label="Decrease quantity" data-qty-dec>−</button>
                <input class="qty-in" type="number" inputmode="numeric" min="1" value="${qty}" aria-label="Quantity" data-qty-input>
                <button class="icon-btn qty-btn" type="button" aria-label="Increase quantity" data-qty-inc>+</button>
              </div>
              <div class="cart-card-sub"><strong>${fmtMoney(line)}</strong></div>
            </div>
          `;
          cardsWrap.appendChild(card);
        }
      });

      const delivery = deliveryFor(subtotal);
      const discount = discountFor(subtotal);
      const total = Math.max(0, subtotal + delivery - discount);

      if (elSub) elSub.textContent = fmtMoney(subtotal);
      if (elDel) elDel.textContent = fmtMoney(delivery);
      if (elDis) elDis.textContent = `-${fmtMoney(discount)}`;
      if (elTot) elTot.textContent = fmtMoney(total);

      refreshHeaderBadges();
    }

    function setQty(id, qty) {
      const cart = window.LeafMart?.getCart?.() || {};
      const q = Math.max(1, Math.min(99, Number(qty) || 1));
      cart[id] = q;
      window.LeafMart?.setCart?.(cart);
      render();
    }

    function removeItem(id) {
      const cart = window.LeafMart?.getCart?.() || {};
      delete cart[id];
      window.LeafMart?.setCart?.(cart);
      toast({ title: "Removed", message: "Item removed from cart." });
      render();
    }

    root.addEventListener("click", (e) => {
      const row = e.target.closest?.("[data-product-id]");
      const id = row?.dataset?.productId;
      if (!id) return;

      if (e.target.closest?.("[data-remove]")) {
        removeItem(id);
        return;
      }
      if (e.target.closest?.("[data-qty-dec]")) {
        const cart = window.LeafMart?.getCart?.() || {};
        setQty(id, (Number(cart[id]) || 1) - 1);
        return;
      }
      if (e.target.closest?.("[data-qty-inc]")) {
        const cart = window.LeafMart?.getCart?.() || {};
        setQty(id, (Number(cart[id]) || 1) + 1);
      }
    });

    root.addEventListener("input", (e) => {
      const input = e.target.closest?.("[data-qty-input]");
      if (!input) return;
      const row = input.closest?.("[data-product-id]");
      const id = row?.dataset?.productId;
      if (!id) return;
      const v = Number(input.value) || 1;
      setQty(id, v);
    });

    clearBtn?.addEventListener("click", () => {
      window.LeafMart?.setCart?.({});
      toast({ title: "Cleared", message: "Cart cleared." });
      render();
    });

    applyBtn?.addEventListener("click", () => {
      const code = (codeEl?.value || "").trim().toUpperCase();
      coupon = code;
      storage.set("leafmart_coupon_v1", code);
      if (code === "FRESH10" || code === "WELCOME5" || code === "") {
        toast({ title: "Coupon applied", message: code ? `Applied ${code}.` : "Coupon removed." });
      } else {
        toast({ type: "error", title: "Invalid coupon", message: "Try FRESH10 or WELCOME5." });
      }
      render();
    });

    render();
  }

  function setupAuthModalGlobal() {
    const modal = document.querySelector("[data-auth-modal]");
    const backdrop = document.querySelector("[data-auth-backdrop]");
    const closeBtn = document.querySelector("[data-auth-close]");
    const tabBtns = Array.from(document.querySelectorAll("[data-auth-tab]"));
    const forms = {
      login: document.querySelector("[data-auth-form='login']"),
      register: document.querySelector("[data-auth-form='register']"),
    };
    if (!modal || !backdrop || !closeBtn || (!forms.login && !forms.register)) return;

    const open = (tab = "login") => {
      if (tab === "register") setAuthTab("register");
      else setAuthTab("login");
      modal.hidden = false;
      backdrop.hidden = false;
      modal.classList.add("is-open");
      lockBody(true);
    };
    const close = () => {
      modal.classList.remove("is-open");
      lockBody(false);
      window.setTimeout(() => {
        modal.hidden = true;
        backdrop.hidden = true;
      }, 200);
    };

    const setAuthTab = (t) => {
      tabBtns.forEach((b) => {
        const on = b.getAttribute("data-auth-tab") === t;
        b.setAttribute("aria-selected", on ? "true" : "false");
      });
      if (forms.login) forms.login.hidden = t !== "login";
      if (forms.register) forms.register.hidden = t !== "register";
    };

    tabBtns.forEach((b) => b.addEventListener("click", () => setAuthTab(b.getAttribute("data-auth-tab"))));

    closeBtn.addEventListener("click", close);
    backdrop.addEventListener("click", close);
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && !modal.hidden) close();
    });

    // Any button can open auth
    document.addEventListener("click", (e) => {
      const trigger = e.target.closest?.("[data-auth-open]");
      if (trigger) {
        e.preventDefault();
        open("login");
      }

      const accountLink = e.target.closest?.("[data-account-link]");
      if (accountLink && !getUser()) {
        e.preventDefault();
        open("login");
      }
    });

    forms.login?.addEventListener("submit", (e) => {
      e.preventDefault();
      const email = forms.login.querySelector("input[name='email']")?.value?.trim();
      const pass = forms.login.querySelector("input[name='password']")?.value || "";
      if (!email || pass.length < 6) {
        toast({ type: "error", title: "Check details", message: "Enter a valid email and password (6+ chars)." });
        return;
      }
      setUser({ email, name: email.split("@")[0], createdAt: Date.now() });
      toast({ title: "Welcome back", message: "Logged in (demo)." });
      close();
      window.dispatchEvent(new CustomEvent("leafmart:auth", { detail: { user: getUser() } }));
    });

    forms.register?.addEventListener("submit", (e) => {
      e.preventDefault();
      const name = forms.register.querySelector("input[name='name']")?.value?.trim();
      const phone = forms.register.querySelector("input[name='phone']")?.value?.trim();
      const email = forms.register.querySelector("input[name='email']")?.value?.trim();
      const pass = forms.register.querySelector("input[name='password']")?.value || "";
      const confirmPass = forms.register.querySelector("input[name='confirm_password']")?.value || "";
      if (!name || !email || pass.length < 6) {
        toast({ type: "error", title: "Check details", message: "Name, valid email, and 6+ char password required." });
        return;
      }
      if (pass !== confirmPass) {
        toast({ type: "error", title: "Passwords don't match", message: "Please make sure both passwords are identical." });
        return;
      }
      setUser({ email, name, phone, createdAt: Date.now() });
      toast({ title: "Account created", message: "Signed up (demo)." });
      close();
      window.dispatchEvent(new CustomEvent("leafmart:auth", { detail: { user: getUser() } }));
    });

    document.querySelector("[data-auth-forgot]")?.addEventListener("click", () => {
      toast({ title: "Password reset", message: "Demo: integrate with email OTP/reset flow." });
    });

    setAuthTab("login");
  }

  function setupAccountPage() {
    const root = document.querySelector("[data-account-root]");
    if (!root) return;

    const logoutBtn = root.querySelector("[data-logout]");
    const welcome = root.querySelector("[data-account-welcome]");

    const syncUI = () => {
      const u = getUser();
      if (u) {
        if (welcome) {
          welcome.innerHTML = `
            <div class="pill sale">Signed in</div>
            <p class="muted" style="margin:.5rem 0 0">Hi <strong>${u.name || "friend"}</strong>. Manage wishlist and profile.</p>
            <div class="cta-actions" style="margin-top:.75rem">
              <a class="btn btn-primary" href="#wishlist">Wishlist</a>
              <a class="btn btn-outline" href="cart.php">Cart</a>
            </div>
          `;
        }
        if (logoutBtn) logoutBtn.hidden = false;
      } else {
        if (welcome) {
          // keep original content (server rendered)
        }
        if (logoutBtn) logoutBtn.hidden = true;
      }
      renderWishlist();
      loadProfile();
    };

    logoutBtn?.addEventListener("click", () => {
      setUser(null);
      toast({ title: "Logged out", message: "You’ve been signed out (demo)." });
      // soft reload to restore welcome section
      window.location.reload();
    });

    // Tabs (hash-based)
    const links = Array.from(root.querySelectorAll("[data-tab-link]"));
    const panels = Array.from(root.querySelectorAll("[data-panel]"));
    const showPanel = (hash) => {
      const id = (hash || "#dashboard").replace("#", "");
      panels.forEach((p) => (p.hidden = p.id !== id));
      links.forEach((a) => a.classList.toggle("is-active", a.getAttribute("href") === `#${id}`));
    };
    links.forEach((a) => a.addEventListener("click", () => showPanel(a.getAttribute("href"))));
    window.addEventListener("hashchange", () => showPanel(window.location.hash));
    showPanel(window.location.hash);

    // Wishlist rendering
    const grid = root.querySelector("[data-wishlist-grid]");
    const empty = root.querySelector("[data-wishlist-empty]");

    function renderWishlist() {
      if (!grid) return;
      const products = window.__LEAFMART_PRODUCTS__ || {};
      const wish = storage.get(WISHLIST_KEY, {});
      const ids = Object.keys(wish);
      grid.innerHTML = "";
      if (ids.length === 0) {
        empty && (empty.hidden = false);
        return;
      }
      empty && (empty.hidden = true);
      ids.forEach((id) => {
        const p = products[id] || { name: id, unit: "", price: 0 };
        const el = document.createElement("div");
        el.className = "wish-card";
        el.dataset.productId = id;
        el.innerHTML = `
          <div>
            <div class="wish-name">${p.name}</div>
            <div class="muted">${p.unit || ""}</div>
            <div class="wish-price">${fmtMoney(p.price || 0)}</div>
          </div>
          <div class="wish-actions">
            <button class="btn btn-primary btn-sm" type="button" data-wish-add>Add to cart</button>
            <button class="btn btn-outline btn-sm" type="button" data-wish-remove>Remove</button>
          </div>
        `;
        grid.appendChild(el);
      });
    }

    root.addEventListener("click", (e) => {
      const card = e.target.closest?.("[data-product-id]");
      const id = card?.dataset?.productId;
      if (!id) return;
      if (e.target.closest?.("[data-wish-add]")) {
        window.LeafMart?.addToCart?.(id, 1);
        toast({ title: "Added to cart", message: "Moved from wishlist." });
      }
      if (e.target.closest?.("[data-wish-remove]")) {
        const wish = storage.get(WISHLIST_KEY, {});
        delete wish[id];
        storage.set(WISHLIST_KEY, wish);
        refreshHeaderBadges({ bounceWishlist: true });
        renderWishlist();
      }
    });

    // Profile local save
    const profileForm = root.querySelector("[data-profile-form]");
    const PROFILE_KEY = "leafmart_profile_v1";
    const loadProfile = () => {
      if (!profileForm) return;
      const p = storage.get(PROFILE_KEY, {});
      ["full_name", "phone", "email"].forEach((k) => {
        const input = profileForm.querySelector(`[name='${k}']`);
        if (input && p[k]) input.value = p[k];
      });
    };
    profileForm?.addEventListener("submit", (e) => {
      e.preventDefault();
      const data = {};
      ["full_name", "phone", "email"].forEach((k) => {
        data[k] = profileForm.querySelector(`[name='${k}']`)?.value?.trim() || "";
      });
      storage.set(PROFILE_KEY, data);
      toast({ title: "Saved", message: "Profile saved (demo)." });
    });

    // Provide products index for wishlist rendering if not already set.
    if (!window.__LEAFMART_PRODUCTS__) {
      // account.php does not include the product index; keep fallback minimal.
      window.__LEAFMART_PRODUCTS__ = {};
    }

    window.addEventListener("leafmart:auth", syncUI);
    syncUI();
  }

  // Public event hooks for upcoming pages (shop/product detail).
  window.LeafMart = {
    addToCart(productId, qty = 1) {
      const cart = storage.get(CART_KEY, {});
      cart[productId] = (Number(cart[productId]) || 0) + (Number(qty) || 1);
      storage.set(CART_KEY, cart);
      refreshHeaderBadges({ bounceCart: true });
      toast({ title: "Added to cart", message: "Item added. Open cart to checkout." });
    },
    toggleWishlist(productId) {
      const wish = storage.get(WISHLIST_KEY, {});
      if (wish[productId]) delete wish[productId];
      else wish[productId] = 1;
      storage.set(WISHLIST_KEY, wish);
      refreshHeaderBadges({ bounceWishlist: true });
      toast({ title: "Wishlist updated", message: wish[productId] ? "Saved for later." : "Removed from wishlist." });
      return Boolean(wish[productId]);
    },
    getCart() {
      return storage.get(CART_KEY, {});
    },
    setCart(cart) {
      storage.set(CART_KEY, cart || {});
      refreshHeaderBadges();
    },
  };

  function setupCheckoutPage() {
    const root = document.querySelector("[data-checkout-root]");
    if (!root) return;

    const form = document.querySelector("[data-checkout-form]");
    const itemsWrap = document.querySelector("[data-checkout-items]");
    const products = window.__LEAFMART_PRODUCTS__ || {};
    
    // Payment method UI logic
    const pmLabels = Array.from(root.querySelectorAll("[data-pm-label]"));
    const pmDetails = Array.from(root.querySelectorAll("[data-pm-details]"));
    
    pmLabels.forEach(lbl => {
      const inp = lbl.querySelector("[data-pm-input]");
      if (!inp) return;
      inp.addEventListener("change", () => {
        pmLabels.forEach(l => l.classList.remove("is-active"));
        lbl.classList.add("is-active");
        const val = inp.value;
        pmDetails.forEach(d => {
          d.hidden = d.getAttribute("data-pm-details") !== val;
        });
      });
    });

    const elSub = root.querySelector("[data-sum-subtotal]");
    const elDel = root.querySelector("[data-sum-delivery]");
    const elDis = root.querySelector("[data-sum-discount]");
    const elTot = root.querySelector("[data-sum-total]");

    const coupon = storage.get("leafmart_coupon_v1", "");

    const deliveryFor = (subtotal) => {
      if (subtotal <= 0) return 0;
      return subtotal >= 500 ? 0 : 40;
    };

    const discountFor = (subtotal) => {
      const c = (coupon || "").trim().toUpperCase();
      if (!c) return 0;
      if (c === "FRESH10") return Math.round(subtotal * 0.10);
      if (c === "WELCOME5") return 5;
      return 0;
    };

    function renderSummary() {
      const cart = window.LeafMart?.getCart?.() || {};
      const ids = Object.keys(cart).filter((id) => Number(cart[id]) > 0);

      if (itemsWrap) itemsWrap.innerHTML = "";

      let subtotal = 0;
      ids.forEach((id) => {
        const p = products[id];
        if (!p) return;
        const qty = Math.max(1, Number(cart[id]) || 1);
        const price = Number(p.price) || 0;
        const line = price * qty;
        subtotal += line;

        if (itemsWrap) {
          const item = document.createElement("div");
          item.className = "co-item";
          item.innerHTML = `
            <div>
              <div class="co-item-name">${p.name}</div>
              <div class="co-item-qty">${qty} × ${fmtMoney(price)}</div>
            </div>
            <strong>${fmtMoney(line)}</strong>
          `;
          itemsWrap.appendChild(item);
        }
      });

      const delivery = deliveryFor(subtotal);
      const discount = discountFor(subtotal);
      const total = Math.max(0, subtotal + delivery - discount);

      if (elSub) elSub.textContent = fmtMoney(subtotal);
      if (elDel) elDel.textContent = fmtMoney(delivery);
      if (elDis) elDis.textContent = `-${fmtMoney(discount)}`;
      if (elTot) elTot.textContent = fmtMoney(total);
    }

    renderSummary();

    if (form) {
      form.addEventListener("submit", (e) => {
        e.preventDefault();
        const cart = window.LeafMart?.getCart?.() || {};
        const ids = Object.keys(cart).filter((id) => Number(cart[id]) > 0);
        if (ids.length === 0) {
          toast({ type: "error", title: "Cart empty", message: "Your cart is empty." });
          return;
        }
        
        window.LeafMart?.setCart({});
        storage.set("leafmart_coupon_v1", "");
        toast({ title: "Order Placed!", message: "Redirecting to shop..." });
        
        setTimeout(() => {
          window.location.href = "shop.php";
        }, 2000);
      });
    }
  }

  function init() {
    refreshHeaderBadges();
    setupMobileMenu();
    setupFooterAccordions();
    setupBackToTop();
    setupSearchAutocomplete();
    setupShopUI();
    setupNewsletter();
    setupContactForm();
    setupCartPage();
    setupAuthModalGlobal();
    setupAccountPage();
    setupCheckoutPage();
  }

  if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", init);
  else init();
})();

