<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart · empty state with continue shopping</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome 6 (free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: linear-gradient(145deg, #f0f2f5 0%, #e6eaf0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .cart-container {
            max-width: 880px;
            width: 100%;
            margin: auto;
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 36px;
            padding: 2.2rem 2.2rem 2.5rem;
            box-shadow: 0 30px 60px -20px rgba(0,20,40,0.25), inset 0 1px 2px rgba(255,255,255,0.8);
        }

        h2 {
            font-size: 2.3rem;
            font-weight: 650;
            letter-spacing: -0.02em;
            background: linear-gradient(145deg, #1e2b3c, #2a3f54);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h2 i {
            background: rgba(30,43,60,0.08);
            padding: 12px;
            border-radius: 24px;
            color: #1e2b3c;
        }

        .cart-summary-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            border-bottom: 2px dashed rgba(0,0,0,0.07);
            padding-bottom: 1rem;
        }

        .item-count-badge {
            background: #1f2a3f;
            color: white;
            padding: 0.4rem 1.4rem;
            border-radius: 60px;
            font-size: 0.95rem;
            font-weight: 500;
            box-shadow: 0 6px 12px rgba(0,0,0,0.04);
        }

        #cart-items {
            margin-bottom: 2.2rem;
            border-radius: 28px;
            transition: all 0.2s;
        }

        /* cart item card (when items exist) */
        .cart-item {
            background: white;
            border-radius: 28px;
            padding: 1.4rem 1.8rem;
            margin-bottom: 1rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.02), 0 2px 0 rgba(255,255,255,0.8) inset;
            border: 1px solid rgba(255,255,255,0.7);
            transition: transform 0.15s ease, box-shadow 0.2s;
        }

        .cart-item:hover {
            box-shadow: 0 20px 30px -12px rgba(33,37,44,0.12), 0 0 0 1px rgba(255,255,255,0.9) inset;
            transform: scale(1.002);
        }

        .item-info {
            flex: 2 1 240px;
        }

        .item-info h4 {
            font-size: 1.35rem;
            font-weight: 620;
            color: #152b3c;
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .item-price-detail {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #3a4e64;
            font-size: 1rem;
            flex-wrap: wrap;
        }

        .item-price-detail .price {
            font-weight: 650;
            color: #1a2d3c;
            background: #eef2f6;
            padding: 5px 16px;
            border-radius: 40px;
            font-size: 1.05rem;
        }

        .item-price-detail .subtotal {
            background: #e3e9f0;
            padding: 5px 16px;
            border-radius: 40px;
            font-size: 0.95rem;
            color: #1f2f40;
        }

        .subtotal span {
            font-weight: 700;
        }

        .qty-controls {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #f2f6fb;
            padding: 6px 10px;
            border-radius: 60px;
            margin-top: 10px;
            width: fit-content;
        }

        .qty-controls button {
            background: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-size: 1.1rem;
            color: #1f2a3f;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            cursor: pointer;
            transition: 0.15s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(0,0,0,0.02);
        }

        .qty-controls button:hover:not(:disabled) {
            background: #2c3e50;
            color: white;
            box-shadow: 0 8px 16px rgba(0,20,40,0.15);
        }

        .qty-controls button:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .qty-controls span {
            min-width: 36px;
            text-align: center;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .item-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 12px;
            margin-left: 15px;
        }

        .remove-btn {
            background: transparent;
            border: 1px solid rgba(231, 76, 60, 0.25);
            color: #c0392b;
            padding: 9px 20px;
            border-radius: 40px;
            font-size: 0.92rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.15s;
            cursor: pointer;
        }

        .remove-btn:hover {
            background: #e74c3c;
            border-color: #e74c3c;
            color: white;
            box-shadow: 0 10px 18px rgba(231, 76, 60, 0.2);
        }

        /* ------ EMPTY CARD with CONTINUE SHOPPING button only (clean) ------ */
        .empty-cart-simple {
            text-align: center;
            padding: 3.5rem 1.5rem;
            background: rgba(255,255,255,0.45);
            border-radius: 60px;
            border: 2px dashed rgba(44,62,80,0.2);
            backdrop-filter: blur(4px);
            margin-bottom: 1.2rem;
        }

        .empty-cart-simple i {
            font-size: 4.2rem;
            color: #2c3e50;
            opacity: 0.4;
            margin-bottom: 0.8rem;
        }

        .empty-cart-simple p {
            font-size: 1.5rem;
            font-weight: 450;
            color: #2c4056;
            margin-bottom: 2rem;
        }

        .continue-shopping-btn {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            background: #1f2a3f;
            border: none;
            color: white;
            padding: 1rem 3rem;
            border-radius: 60px;
            font-weight: 600;
            font-size: 1.2rem;
            box-shadow: 0 20px 30px -12px #1f2a3f80;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .continue-shopping-btn:hover {
            background: #0f1a2a;
            transform: scale(1.02);
            box-shadow: 0 28px 36px -14px #0f1a2a;
        }

        /* cart footer */
        .cart-footer {
            margin-top: 2rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1.2rem;
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(8px);
            border-radius: 80px;
            padding: 1.2rem 2rem;
            border: 1px solid rgba(255,255,255,0.9);
        }

        .total {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #0b1a2a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .total small {
            font-size: 1.1rem;
            font-weight: 400;
            color: #4d6579;
        }

        .action-buttons {
            display: flex;
            gap: 14px;
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid #2c3e50;
            color: #2c3e50;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-outline:hover {
            background: #2c3e50;
            color: white;
            border-color: #2c3e50;
        }

        .btn-solid {
            background: #1f2a3f;
            border: none;
            color: white;
            padding: 12px 36px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 16px 28px -12px #1f2a3f;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-solid:hover {
            background: #0f172a;
            transform: scale(1.02);
        }

        @media (max-width: 640px) {
            .cart-container { padding: 1.5rem; }
            .cart-item { flex-direction: column; align-items: flex-start; }
            .item-actions { align-items: flex-start; margin-left: 0; width: 100%; }
            .cart-footer { flex-direction: column; align-items: stretch; border-radius: 50px; }
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h2>
            <i class="fas fa-shopping-bag"></i> My cart
        </h2>

        <div class="cart-summary-line" id="cartSummaryLine">
            <span class="item-count-badge" id="itemCountDisplay">0 items</span>
            <span style="color:#3b556e;"><i class="far fa-heart" style="margin-right: 6px;"></i>secure checkout</span>
        </div>

        <!-- cart items will be injected here -->
        <div id="cart-items"></div>

        <!-- footer always present (total + action buttons) -->
        <div class="cart-footer" id="cartFooter">
            <div class="total" id="cart-total">
                <small>total</small> ₹0.00
            </div>
            <div class="action-buttons">
                <button class="btn-outline" onclick="clearCart()" id="clearCartBtn"><i class="fas fa-trash-alt"></i> Clear</button>
                <button class="btn-solid" id="checkoutBtn"><i class="fas fa-credit-card"></i> Checkout</button>
            </div>
        </div>
    </div>

    <script>
        const BASE_URL = "https://retailadmin.ggconsultancy.services/api";
        const token = localStorage.getItem("token");

        if (!token) {
            window.location.href = "/login";
        }

        /* ========== LOAD CART ========= */
        async function loadCart() {
            try {
                const response = await fetch(`${BASE_URL}/cart`, {
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Accept": "application/json"
                    }
                });

                if (response.status === 401) {
                    localStorage.removeItem("token");
                    window.location.href = "/login";
                    return;
                }

                const data = await response.json();
                console.log("CART DATA:", data);

                if (data.success) {
                    renderCart(data.data.items, data.data.cart_total);
                } else {
                    renderCart([], 0);
                }

            } catch (error) {
                console.error("Cart load error:", error);
                renderCart([], 0);
            }
        }

        /* ========== RENDER with simple empty state & CONTINUE SHOPPING BUTTON ========= */
        function renderCart(items, total) {
            const container = document.getElementById("cart-items");
            const totalEl = document.getElementById("cart-total");
            const itemCountSpan = document.getElementById("itemCountDisplay");

            // update total (always)
            totalEl.innerHTML = `<small>total</small> ₹${formatPrice(total || 0)}`;

            // --- EMPTY CASE: show only continue shopping button ---
            if (!items || items.length === 0) {
                if (itemCountSpan) itemCountSpan.innerText = `0 items`;

                // SIMPLE EMPTY STATE WITH BUTTON (exactly as requested)
                container.innerHTML = `
                    <div class="empty-cart-simple">
                        <i class="fas fa-store"></i>
                        <p>Your cart is empty</p>
                        <!-- Continue shopping button -> redirect to products page -->
                        <a href="/products" class="continue-shopping-btn">
                            <i class="fas fa-arrow-left"></i> Continue Shopping
                        </a>
                    </div>
                `;
                return;
            }

            // --- ITEMS EXIST: render normal cart with items ---
            const totalItems = items.reduce((acc, i) => acc + (i.quantity || 0), 0);
            if (itemCountSpan) itemCountSpan.innerText = `${totalItems} item${totalItems !== 1 ? 's' : ''}`;

            let itemsHtml = '';
            items.forEach(item => {
                const itemId = item.id;            // cart item ID
                const name = item.product_name || 'Product';
                const price = item.price || 0;
                const qty = item.quantity || 1;
                const subtotal = price * qty;

                itemsHtml += `
                    <div class="cart-item" data-item-id="${itemId}">
                        <div class="item-info">
                            <h4>${escapeHtml(name)}</h4>
                            <div class="item-price-detail">
                                <span class="price"><i class="fas fa-rupee-sign"></i> ${formatPrice(price)}</span>
                                <span class="subtotal">subtotal <span><i class="fas fa-rupee-sign"></i> ${formatPrice(subtotal)}</span></span>
                            </div>
                            <div class="qty-controls">
                                <button onclick="updateQty(${itemId}, ${qty - 1})" ${qty <= 1 ? 'disabled' : ''}><i class="fas fa-minus"></i></button>
                                <span>${qty}</span>
                                <button onclick="updateQty(${itemId}, ${qty + 1})"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="item-actions">
                            <button class="remove-btn" onclick="removeItem(${itemId})"><i class="fas fa-trash-can"></i> Remove</button>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = itemsHtml;
            // total already updated above
        }

        // helpers
        function escapeHtml(unsafe) {
            return unsafe.replace(/[&<>"]/g, function(m) {
                if(m === '&') return '&amp;'; if(m === '<') return '&lt;'; if(m === '>') return '&gt;'; if(m === '"') return '&quot;';
                return m;
            });
        }

        function formatPrice(value) {
            return Number(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

        /* ========== API ACTIONS ========= */
        async function updateQty(id, qty) {
            if (qty < 1) return;
            try {
                await fetch(`${BASE_URL}/cart/${id}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": `Bearer ${token}`,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({ quantity: qty })
                });
            } catch (e) { console.warn(e); }
            loadCart();
        }

        async function removeItem(id) {
            try {
                await fetch(`${BASE_URL}/cart/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Accept": "application/json"
                    }
                });
            } catch (e) { console.warn(e); }
            loadCart();
        }

        async function clearCart() {
            if (!confirm('Empty your cart?')) return;
            try {
                await fetch(`${BASE_URL}/cart`, {
                    method: "DELETE",
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Accept": "application/json"
                    }
                });
            } catch (e) { console.warn(e); }
            loadCart();
        }

        // Checkout demo
        document.getElementById('checkoutBtn')?.addEventListener('click', function() {
            alert('Proceed to checkout (demo). In real app, redirect to payment.');
        });

        // Expose globals for inline onclick
        window.updateQty = updateQty;
        window.removeItem = removeItem;
        window.clearCart = clearCart;

        // Load cart on start
        loadCart();
    </script>
    <!-- when cart is 0, "Continue Shopping" button is clearly visible and redirects to /products -->
</body>
</html>