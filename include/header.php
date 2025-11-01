<!-- ✅ Topbar Start -->
<div class="container-fluid bg-dark text-white-50 py-2 px-0 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="fa fa-phone-alt me-2"></small>
                <small>7891346525</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="far fa-envelope-open me-2"></small>
                <small>keshavkumarsaini286@gmail.com</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <ol class="breadcrumb justify-content-end mb-0">
                <li class="breadcrumb-item"><a class="text-white-50 small" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white-50 small" href="#">Terms</a></li>
                <li class="breadcrumb-item"><a class="text-white-50 small" href="#">Privacy</a></li>
                <li class="breadcrumb-item"><a class="text-white-50 small" href="#">Support</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- ✅ Topbar End -->

<!-- ✅ Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
    <a href="index.php" class="navbar-brand d-flex align-items-center" style="margin-left:60px;">
        <h1 class="m-0" style="margin-right:120px;">
            <img class="img-fluid me-3" src="img/logo/logo.png" alt="Saini Refrigeration Logo" style="width:150px; height:auto;">
        </h1>
    </a>

    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto bg-light pe-4 py-3 py-lg-0">
            <a href="index.php" class="nav-item nav-link active">Home</a>
            <a href="about.php" class="nav-item nav-link">About Us</a>
            <a href="servicess.php" class="nav-item nav-link">Our Services</a>
            <a href="Products.php" class="nav-item nav-link">Products</a>
            <a href="contact.php" class="nav-item nav-link">Contact Us</a>
        </div>

        <!-- ✅ Cart and Quote Buttons (Responsive) -->
        <div class="h-100 d-inline-flex align-items-center ms-lg-3 mt-3 mt-lg-0">
            <button class="btn btn-square rounded-circle bg-primary text-white me-2 position-relative" data-bs-toggle="modal" data-bs-target="#cartModal">
                <i class="bi bi-cart"></i>
                <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </button>

            <button class="btn btn-square rounded-circle bg-primary text-white me-2" data-bs-toggle="modal" data-bs-target="#quoteModal">
                <i class="bi bi-chat-quote"></i>
            </button>
        </div>
    </div>
</nav>
<!-- ✅ Navbar End -->

<!-- ✅ Cart Modal Start -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-right">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-cart me-2"></i>Your Cart</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="cartItems">
                    <div id="emptyCartMessage" class="text-center py-3 text-muted" style="display: block;">
                        Your cart is empty.
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-3">
                    <h6 class="fw-bold mb-0">Total:</h6>
                    <h5 class="fw-bold text-success mb-0" id="cartTotal">₹0</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Continue Shopping</button>
                <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>
<!-- ✅ Cart Modal End -->

<!-- ✅ Quote Modal Start -->
<div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header p-3" style="background: linear-gradient(135deg, #ff6600, #e65c00); border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h5 class="modal-title text-white fw-bold" id="quoteModalLabel">
                    <i class="bi bi-chat-quote me-2"></i>Get a Quick Quote
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4 bg-light">
                <form id="quoteForm">
                    <div class="mb-3">
                        <label for="quoteName" class="form-label fw-semibold">Full Name</label>
                        <input type="text" class="form-control rounded-3 shadow-sm" id="quoteName" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="quoteEmail" class="form-label fw-semibold">Email Address</label>
                        <input type="email" class="form-control rounded-3 shadow-sm" id="quoteEmail" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="quoteService" class="form-label fw-semibold">Service Required</label>
                        <select class="form-select rounded-3 shadow-sm" id="quoteService" required>
                            <option value="" disabled selected>Select a service</option>
                            <option value="refrigerator">Refrigerator Repair</option>
                            <option value="ac">AC Maintenance</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quoteMessage" class="form-label fw-semibold">Message</label>
                        <textarea class="form-control rounded-3 shadow-sm" id="quoteMessage" rows="4" placeholder="Describe your requirements"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer bg-light border-0 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary rounded-3 px-4" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-orange rounded-3 px-4" form="quoteForm">Submit Quote</button>
            </div>
        </div>
    </div>
</div>
<!-- ✅ Quote Modal End -->


<!-- ✅ Custom CSS -->
<style>
    /* Right-side slide-in modal */
    .modal-dialog-right {
        position: fixed;
        top: 0;
        right: 0;
        margin: 0;
        width: 100%;
        max-width: 450px;
        height: 100%;
        transform: translateX(100%);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
    }

    .modal.fade.show .modal-dialog-right {
        transform: translateX(0);
        pointer-events: auto;
    }

    .modal-dialog-right .modal-content {
        height: 100%;
        border: none;
        border-radius: 0;
        overflow-y: auto;
        background-color: #f8f9fa;
        box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
    }

    .cart-item:hover {
        background-color: #e9ecef;
    }

    .qty-input {
        text-align: center;
        border-radius: 5px;
    }

    .btn-square {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Orange Themed Quote Modal */
    #quoteModal .modal-content {
        border-radius: 1rem;
        overflow: hidden;
    }

    #quoteModal .modal-body {
        background-color: #fdf5f0;
    }

    #quoteModal .form-control,
    #quoteModal .form-select,
    #quoteModal textarea {
        border: 1px solid #e0a060;
        transition: all 0.3s ease;
        padding: 0.6rem 0.75rem;
    }

    #quoteModal .form-control:focus,
    #quoteModal .form-select:focus,
    #quoteModal textarea:focus {
        border-color: #ff6600;
        box-shadow: 0 0 5px rgba(255, 102, 0, 0.4);
        outline: none;
    }

    .btn-orange {
        background-color: #ff6600;
        border-color: #ff6600;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-orange:hover {
        background-color: #e65c00;
        border-color: #e65c00;
    }

    /* ✅ Responsive Adjustments */
    @media (max-width: 576px) {
        .modal-dialog-right {
            max-width: 100%;
        }

        .navbar-brand {
            margin-left: 0 !important;
        }

        .navbar-nav {
            width: 100%;
        }

        #quoteModal .modal-dialog {
            margin: 1rem;
            width: auto;
        }
    }

    @media (max-width: 991px) {
        .navbar .btn-square {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .navbar .badge {
            font-size: 10px;
            padding: 3px 5px;
        }

        .navbar .h-100.d-inline-flex {
            margin-top: 10px;
            justify-content: flex-start;
            width: 100%;
        }
    }
</style>

<!-- ✅ JavaScript for Cart -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartItemsContainer = document.getElementById('cartItems');
        const emptyCartMessage = document.getElementById('emptyCartMessage');
        const cartTotalElement = document.getElementById('cartTotal');
        const cartCountElement = document.getElementById('cartCount');

        function updateCartTotal() {
            let total = 0;
            const items = cartItemsContainer.querySelectorAll('.cart-item');
            items.forEach(item => {
                const price = parseFloat(item.getAttribute('data-price'));
                const qty = parseInt(item.querySelector('.qty-input').value);
                total += price * qty;
                item.querySelector('.item-total').textContent = `₹${(price * qty).toLocaleString('en-IN')}`;
            });
            cartTotalElement.textContent = `₹${total.toLocaleString('en-IN')}`;
            emptyCartMessage.style.display = items.length === 0 ? 'block' : 'none';
            cartCountElement.textContent = items.length;
        }

        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = parseFloat(this.dataset.price);
                const image = this.dataset.image;

                let existingItem = cartItemsContainer.querySelector(`.cart-item[data-id='${id}']`);
                if (existingItem) {
                    const qtyInput = existingItem.querySelector('.qty-input');
                    qtyInput.value = parseInt(qtyInput.value) + 1;
                } else {
                    const cartItem = document.createElement('div');
                    cartItem.classList.add('cart-item', 'd-flex', 'align-items-center', 'p-2', 'shadow-sm', 'rounded', 'mb-3');
                    cartItem.setAttribute('data-id', id);
                    cartItem.setAttribute('data-price', price);
                    cartItem.innerHTML = `
                        <img src="${image}" alt="${name}" class="me-3 rounded" style="width:70px; height:70px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-semibold">${name}</h6>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <button class="btn btn-outline-primary btn-sm decrease-qty">-</button>
                                <input type="number" class="form-control form-control-sm qty-input" value="1" min="1" style="width:55px; text-align:center;">
                                <button class="btn btn-outline-primary btn-sm increase-qty">+</button>
                            </div>
                        </div>
                        <div class="text-end d-flex flex-column align-items-end">
                            <span class="item-total fw-bold text-primary">₹${price.toLocaleString('en-IN')}</span>
                            <button class="btn btn-sm btn-danger remove-item mt-2 rounded-circle" style="width:30px; height:30px;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>`;
                    cartItemsContainer.appendChild(cartItem);
                }

                updateCartTotal();
                alert(`${name} added to cart successfully!`);
                const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
                cartModal.show();
            });
        });

        cartItemsContainer.addEventListener('click', function(e) {
            const cartItem = e.target.closest('.cart-item');
            if (!cartItem) return;

            if (e.target.classList.contains('increase-qty')) {
                const input = cartItem.querySelector('.qty-input');
                input.value = parseInt(input.value) + 1;
                updateCartTotal();
            } else if (e.target.classList.contains('decrease-qty')) {
                const input = cartItem.querySelector('.qty-input');
                if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
                updateCartTotal();
            } else if (e.target.classList.contains('remove-item') || e.target.parentElement.classList.contains('remove-item')) {
                const name = cartItem.querySelector('h6').innerText;
                cartItem.remove();
                updateCartTotal();
                alert(`${name} removed from cart successfully!`);
            }
        });

        cartItemsContainer.addEventListener('input', function(e) {
            if (e.target.classList.contains('qty-input') && e.target.value < 1) e.target.value = 1;
            updateCartTotal();
        });

        updateCartTotal();
    });
</script>