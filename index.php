<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Saini Refrigeration</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;600;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .service-item {
            overflow: hidden;
            transition: transform 0.3s ease;
            background: #fff;
            height: 350px;
            /* fixed card height */
            display: flex;
            flex-direction: column;
        }

        .service-item:hover {
            transform: scale(1.03);
        }

        .service-item img {
            width: 100%;
            height: 200px;
            /* fixed image height */
            object-fit: cover;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .service-item:hover img {
            transform: scale(1.05);
        }

        .service-item .bg-light {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-item h5 {
            color: #333;
            font-weight: 600;
            text-align: center;
        }

        .service-item:hover h5 {
            color: orange;
        }
    </style>


</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <?php include "include/header.php"; ?>

    <!-- Carousel Start -->
    <?php include "include/carousel.php"; ?>
    <!-- Carousel End -->

    <!-- About Start -->
    <?php include "include/about.php"; ?>
    <!-- About End -->

    <!-- Facts Start -->
    <?php include "include/facts.php"; ?>
    <!-- Facts End -->


    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-5">We Provide Professional Heating & Cooling Services</h1>
            </div>

            <div class="row g-4 justify-content-center">
                <?php
                include "include/config/db.php";

                $sql = "SELECT * FROM ourservices ORDER BY created_at DESC";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $service_id = $row['id'];
                    $service_name = htmlspecialchars($row['name']);
                    $imagePath = 'admin/uploads/services/' . $row['image'];
                ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a href="servicess.php" class="text-decoration-none text-dark">
                            <div class="service-item border rounded shadow-sm text-center h-100">
                                <?php if (file_exists($imagePath) && !empty($row['image'])): ?>
                                    <img class="img-fluid" src="<?= $imagePath ?>" alt="<?= $service_name ?>">
                                <?php else: ?>
                                    <img class="img-fluid" src="img/default-service.png" alt="No Image">
                                <?php endif; ?>

                                <div class="bg-light p-3">
                                    <h5 class="mb-0"><?= $service_name ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>



    <!-- Features Start -->
    <?php include "include/features.php"; ?>
    <!-- Features End -->

    <!-- Service Start -->
    <?php include "include/service.php"; ?>
    <!-- Service End -->


    <!-- Quote Start -->
    <?php include "include/quote.php"; ?>
    <!-- Quote End -->

    <!-- Team Start -->
    <?php include "include/team.php"; ?>
    <!-- Team End -->

    <!-- Testimonial Start -->
    <?php include "include/testo.php"; ?>
    <!-- Testimonial End -->

    <!-- Footer Start -->
    <?php include "include/footer.php"; ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/parallax/parallax.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Initialize WOW.js -->
    <script>
        new WOW().init();
    </script>
</body>

</html>