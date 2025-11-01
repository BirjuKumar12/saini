<?php
include 'include/config/db.php'; // Database connection

// Get product ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product
$product_query = mysqli_query($conn, "SELECT * FROM product WHERE id = $id");
if (!$product_query || mysqli_num_rows($product_query) == 0) {
    die("<h2 style='text-align:center;margin-top:50px;'>Product not found!</h2>");
}
$product = mysqli_fetch_assoc($product_query);

// Fetch images
$images_query = mysqli_query($conn, "SELECT image FROM product_images WHERE product_id = $id");
$images = [];
while ($img = mysqli_fetch_assoc($images_query)) {
    $images[] = "admin/uploads/products/" . $img['image'];
}
if (empty($images)) {
    $images[] = "img/no-image.png";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - Saini Refrigeration</title>
</head>

<style>
    /* ======= PRODUCT DETAIL CSS ======= */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 30px;
        font-family: 'Lato', sans-serif;
    }

    .pd-pagination {
        color: #787a80;
        margin: 25px 0;
        font-size: 14px;
    }

    .pd-pagination a {
        text-decoration: none;
        color: #17696a;
    }

    .pd-pagination a:hover {
        text-decoration: underline;
    }

    .pd-container {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        margin-top: 40px;
        justify-content: start;
    }

    .pd-img-card {
        width: 40%;
        min-width: 300px;
    }

    .pd-img-card img {
        width: 100%;
        border-radius: 6px;
        height: 520px;
        object-fit: cover;
        transition: 0.3s;
    }

    .pd-small-card {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 15px;
    }

    .pd-small-card img {
        width: 104px;
        height: 104px;
        border-radius: 4px;
        cursor: pointer;
        object-fit: cover;
        border: 2px solid transparent;
    }

    .pd-small-card img.active {
        border: 2px solid #17696a;
    }

    .pd-info {
        width: 55%;
        min-width: 300px;
    }

    .pd-info h3 {
        font-size: 32px;
        font-weight: 600;
        line-height: 130%;
    }

    .pd-info h5 {
        font-size: 24px;
        font-weight: 500;
        color: #ff4242;
        margin: 6px 0;
    }

    .pd-info del {
        color: #a9a9a9;
        font-size: 18px;
    }

    .pd-info p {
        color: #424551;
        margin: 15px 0;
        width: 90%;
        line-height: 1.6;
    }

    .pd-quantity input {
        width: 51px;
        height: 33px;
        margin-bottom: 15px;
        padding: 6px;
        text-align: center;
    }

    .pd-btn {
        background: #17696a;
        border-radius: 4px;
        padding: 10px 37px;
        border: none;
        color: white;
        font-weight: 600;
        cursor: pointer;
    }

    .pd-btn:hover {
        background: #ff4242;
        transition: ease-in 0.4s;
    }

    .pd-delivery {
        display: flex;
        flex-direction: column;
        margin-top: 25px;
    }

    .pd-delivery div {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        font-size: 13px;
        color: #787a80;
        border-bottom: 1px solid #eee;
    }

    @media screen and (max-width:768px) {
        .pd-container {
            flex-direction: column;
            align-items: center;
        }

        .pd-img-card,
        .pd-info {
            width: 100%;
        }

        .pd-info p,
        .pd-delivery div {
            width: 100%;
        }
    }
</style>

<body>
    <?php 
    include "include/header.php";
    ?>
    <div class="pd-pagination">
        <p><a href="index.php">Home</a> > <a href="products.php">Products</a> > <?= htmlspecialchars($product['name']) ?></p>
    </div>

    <section class="pd-container">
        <!-- Left Side Images -->
        <div class="pd-img-card">
            <img src="<?= $images[0] ?>" id="pd-featured-image" alt="Product Image">
            <div class="pd-small-card">
                <?php foreach ($images as $i => $img): ?>
                    <img src="<?= $img ?>" class="pd-thumb <?= $i === 0 ? 'active' : '' ?>" alt="Thumbnail">
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Product Info -->
        <div class="pd-info">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <h5>₹<?= number_format($product['price'], 2) ?> <del>₹<?= number_format($product['price'] + 500, 2) ?></del></h5>
            <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>

            <div class="pd-quantity">
                <input type="number" id="pd-qty" value="1" min="1">
                <button class="pd-btn" id="pd-add-to-cart"
                    data-id="<?= $product['id'] ?>"
                    data-name="<?= htmlspecialchars($product['name']) ?>"
                    data-price="<?= $product['price'] ?>"
                    data-image="<?= $images[0] ?>">
                    <i class="fa fa-shopping-cart me-2"></i>Add to Cart
                </button>
            </div>

            <div class="pd-delivery">
                <p>Delivery:</p>
                <p>Free standard shipping on orders over ₹1000, plus free returns.</p>
                <div>
                    <p>TYPE</p>
                    <p>HOW LONG</p>
                    <p>CHARGE</p>
                </div>
                <div>
                    <p>Standard</p>
                    <p>2-5 business days</p>
                    <p>₹50</p>
                </div>
                <div>
                    <p>Express</p>
                    <p>1-2 business days</p>
                    <p>₹150</p>
                </div>
                <div>
                    <p>Pickup in store</p>
                    <p>1 business day</p>
                    <p>Free</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Thumbnail image click
        const thumbs = document.querySelectorAll('.pd-thumb');
        const featured = document.getElementById('pd-featured-image');
        thumbs.forEach(img => {
            img.addEventListener('click', () => {
                thumbs.forEach(i => i.classList.remove('active'));
                img.classList.add('active');
                featured.src = img.src;
            });
        });

        // Add to Cart functionality (simple alert)
        const addCartBtn = document.getElementById('pd-add-to-cart');
        addCartBtn.addEventListener('click', () => {
            const id = addCartBtn.dataset.id;
            const name = addCartBtn.dataset.name;
            const price = addCartBtn.dataset.price;
            const image = addCartBtn.dataset.image;
            const qty = document.getElementById('pd-qty').value;
            alert(`✅ ${qty} x ${name} added to cart!`);
            // You can later replace alert with AJAX to add to cart
        });
    </script>

</body>

</html>