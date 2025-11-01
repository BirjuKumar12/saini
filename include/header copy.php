<!-- Topbar Start -->
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
<!-- Topbar End -->

<!-- Navbar Start -->
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
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu bg-light border-0 m-0">
                    <a href="feature.html" class="dropdown-item">Features</a>
                    <a href="quote.html" class="dropdown-item">Free Quote</a>
                    <a href="team.html" class="dropdown-item">Our Team</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404 Page</a>
                </div>
            </div>
            <a href="contact.php" class="nav-item nav-link">Contact Us</a>
        </div>

        <!-- ✅ Cart and Quote Buttons -->
        <div class="h-100 d-lg-inline-flex align-items-center d-none">
            <button class="btn btn-square rounded-circle bg-primary text-white me-2" data-bs-toggle="modal" data-bs-target="#cartModal">
                <i class="bi bi-cart"></i>
            </button>
            <button class="btn btn-square rounded-circle bg-primary text-white me-2" data-bs-toggle="modal" data-bs-target="#quoteModal">
                <i class="bi bi-chat-quote"></i>
            </button>
        </div>
    </div>
</nav>
<!-- Navbar End -->

<!-- 🛒 Cart Modal Start -->
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

<!-- 🛒 Cart Modal End -->

<!-- 🛒 Cart Modal End -->


<!-- 📝 Quick Quote Modal Start -->
<div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <!-- Modal Header -->
            <div class="modal-header p-3" style="background: linear-gradient(135deg, #ff6600, #e65c00); border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h5 class="modal-title text-white fw-bold" id="quoteModalLabel">
                    <i class="bi bi-chat-quote me-2"></i>Get a Quick Quote
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
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

            <!-- Modal Footer -->
            <div class="modal-footer bg-light border-0 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary rounded-3 px-4" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-orange rounded-3 px-4" form="quoteForm">Submit Quote</button>
            </div>
        </div>
    </div>
</div>
<!-- 📝 Quick Quote Modal End -->



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

    /* Modal backdrop */
    .modal-backdrop.show {
        opacity: 0.5;
        transition: opacity 0.3s ease;
    }

    /* Cart modal styling */
    .cart-item {
        transition: all 0.3s ease;
    }

    .cart-item:hover {
        background-color: #e9ecef;
    }

    .qty-input {
        text-align: center;
        border-radius: 5px;
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .btn-primary {
        background-color: #0057b8;
        border-color: #0057b8;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #004099;
        border-color: #004099;
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
        /* light orange background */
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

    #quoteModal .btn-outline-secondary {
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    #quoteModal .btn-outline-secondary:hover {
        background-color: #ffe6cc;
    }



    /* Responsive adjustments */
    @media (max-width: 576px) {

        /* Keep slide-in cart modal full width */
        .modal-dialog-right {
            max-width: 100%;
        }

        /* Ensure navbar logo stays left */
        .navbar-brand {
            margin-left: 0 !important;
            margin-right: auto !important;
        }

        /* Navbar collapse menu still below logo */
        .navbar-collapse {
            text-align: left;
        }

        .navbar-nav {
            width: 100%;
            align-items: flex-start;
        }
    }
</style>

<!-- ✅ JavaScript for Cart Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartItemsContainer = document.getElementById('cartItems');
        const emptyCartMessage = document.getElementById('emptyCartMessage');
        const cartTotalElement = document.getElementById('cartTotal');

        // Function to update cart total
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
        }

        // Event delegation for quantity buttons and remove buttons
        cartItemsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('increase-qty')) {
                const input = e.target.previousElementSibling;
                input.value = parseInt(input.value) + 1;
                updateCartTotal();
            } else if (e.target.classList.contains('decrease-qty')) {
                const input = e.target.nextElementSibling;
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                    updateCartTotal();
                }
            } else if (e.target.classList.contains('remove-item') || e.target.parentElement.classList.contains('remove-item')) {
                e.target.closest('.cart-item').remove();
                updateCartTotal();
            }
        });

        // Update total on input change
        cartItemsContainer.addEventListener('input', function(e) {
            if (e.target.classList.contains('qty-input') && e.target.value < 1) {
                e.target.value = 1;
            }
            updateCartTotal();
        });

        // Quote form submission (basic example)
        const quoteForm = document.getElementById('quoteForm');
        quoteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Quote submitted successfully!'); // Replace with actual submission logic
            bootstrap.Modal.getInstance(document.getElementById('quoteModal')).hide();
            quoteForm.reset();
        });

        // Initial total calculation
        updateCartTotal();
    });
</script>