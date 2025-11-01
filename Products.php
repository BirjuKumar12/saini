<?php
include 'include/config/db.php'; // Database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saini Refrigeration</title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* ---------- PRODUCT CARD STYLING ---------- */
        .product-item {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
            transition: all 0.3s ease;
            padding-bottom: 20px;
        }

        .product-item:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transform: translateY(-5px);
        }

        /* Product Image */
        .product-item img {
            width: 100%;
            height: 270px;
            object-fit: contain;
            background-color: #f9f9f9;
            transition: transform 0.3s ease;
            padding: 20px;
        }

        .product-item:hover img {
            transform: scale(1.05);
        }

        /* Product Info */
        .product-info {
            padding: 15px;
        }

        .product-info p.brand-name {
            color: #999;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .product-info h5 {
            font-size: 16px;
            font-weight: 600;
            color: #222;
            margin-bottom: 8px;
            transition: color 0.3s;
        }

        .product-info h5:hover {
            color: #007bff;
        }

        /* Rating Stars */
        .star {
            color: #f8b400;
            font-size: 14px;
            margin-bottom: 8px;
        }

        /* Product Price */
        .product-price {
            font-size: 16px;
            font-weight: 700;
            color: #111;
        }

        .product-price del {
            color: #999;
            font-weight: 400;
            font-size: 14px;
            margin-left: 5px;
        }

        /* Add to Cart Button */
        .add-to-cart-btn {
            margin-top: 12px;
            background: #007bff;
            border: none;
            border-radius: 30px;
            font-size: 14px;
            color: #fff;
            padding: 8px 12px;
            transition: background 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background: #0056b3;
        }

        /* Responsive Fix */
        @media (max-width: 991px) {
            .product-item img {
                height: 240px;
            }
        }

        @media (max-width: 767px) {
            .product-item img {
                height: 220px;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <?php include "include/header.php"; ?>

    <!-- Page Header -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-4">Our Products</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold">Explore Our Latest Products</h2>
                <p class="text-muted">High-quality, reliable, and affordable cooling & home appliances.</p>
            </div>

            <div class="row g-4">
                <?php
                $image_index = 0;
                $sql = "SELECT * FROM product ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_name = htmlspecialchars($row['name']);
                        $product_desc = htmlspecialchars(substr($row['description'], 0, 80));
                        $product_price = number_format($row['price'], 2);

                        // Fetch one image
                        $img_sql = "SELECT image FROM product_images WHERE product_id=" . $row['id'] . " ORDER BY id ASC LIMIT $image_index,1";
                        $img_result = mysqli_query($conn, $img_sql);

                        if (mysqli_num_rows($img_result) > 0) {
                            $img_row = mysqli_fetch_assoc($img_result);
                            $product_image = "admin/uploads/products/" . $img_row['image'];
                        } else {
                            $product_image = "img/no-image.png";
                        }
                ?>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="product-item">
                                <img src="<?= $product_image ?>" alt="<?= $product_name ?>">
                                <div class="product-info">
                                    <p class="brand-name">Saini Refrigeration</p>
                                    <h5><?= $product_name ?></h5>
                                    <div class="star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-alt"></i>
                                    </div>
                                    <div class="product-price">₹<?= $product_price ?> <del>₹<?= number_format($row['price'] + 500, 2) ?></del></div>
                                    <button type="button"
                                        class="btn btn-sm add-to-cart-btn w-100 add-to-cart-btn"
                                        data-id="<?= $row['id'] ?>"
                                        data-name="<?= htmlspecialchars($row['name']) ?>"
                                        data-price="<?= $row['price'] ?>"
                                        data-image="<?= $product_image ?>">
                                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="col-12 text-center"><p>No products available at the moment.</p></div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "include/footer.php"; ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>

    <!-- Custom JS -->
    <script src="js/main.js"></script>
</body>

</html>