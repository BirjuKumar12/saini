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
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;600;800&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom CSS for Service Hover -->
    <style>
        .service-item {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .service-item:hover {
            transform: scale(1.03);
        }

        /* Overlay Buttons in top-right corner */
        .service-item .overlay-top-right {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 2;
        }

        .service-item:hover .overlay-top-right {
            opacity: 1;
        }

        .overlay-top-right button {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .service-icon img {
            width: 30px;
        }
    </style>
</head>

<body>
    <!-- header -->
    <?php include "include/header.php"; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-4">Services</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="about.php">about</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Services Start -->
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
                    $service_desc = htmlspecialchars($row['description']);
                    $imagePath = 'admin/uploads/services/' . $row['image'];
                ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp">
                        <div class="service-item border rounded shadow-sm">
                            <?php if (file_exists($imagePath) && !empty($row['image'])): ?>
                                <img class="img-fluid" src="<?= $imagePath ?>" alt="<?= $service_name ?>">
                            <?php else: ?>
                                <img class="img-fluid" src="img/default-service.png" alt="No Image">
                            <?php endif; ?>
                            <div class="d-flex align-items-center bg-light p-2">
                                <div class="service-icon flex-shrink-0 bg-primary rounded-circle p-2">
                                    <img class="img-fluid" src="img/icon/icon-01-light.png" alt="">
                                </div>
                                <a class="h5 mx-3 mb-0" href="#"><?= $service_name ?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>



                <!-- Service Item 2 -->
                <!-- <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-item border rounded shadow-sm">
                        <img class="img-fluid" src="img/service-2.jpg" alt="">
                     
                        <div class="d-flex align-items-center bg-light p-2">
                            <div class="service-icon flex-shrink-0 bg-primary rounded-circle p-2">
                                <img class="img-fluid" src="img/icon/icon-02-light.png" alt="">
                            </div>
                            <a class="h5 mx-3 mb-0" href="#">Cooling Services</a>
                        </div>
                    </div>
                </div> -->

                <!-- Service Item 3 -->
                <!-- <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item border rounded shadow-sm">
                        <img class="img-fluid" src="img/service-3.jpg" alt="">
                      
                        <div class="d-flex align-items-center bg-light p-2">
                            <div class="service-icon flex-shrink-0 bg-primary rounded-circle p-2">
                                <img class="img-fluid" src="img/icon/icon-03-light.png" alt="">
                            </div>
                            <a class="h5 mx-3 mb-0" href="#">Heating Services</a>
                        </div>
                    </div>
                </div> -->

                <!-- Service Item 4 -->
                <!-- <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="service-item border rounded shadow-sm">
                        <img class="img-fluid" src="img/service-4.jpg" alt="">
                   
                      
                        <div class="d-flex align-items-center bg-light p-2">
                            <div class="service-icon flex-shrink-0 bg-primary rounded-circle p-2">
                                <img class="img-fluid" src="img/icon/icon-04-light.png" alt="">
                            </div>
                            <a class="h5 mx-3 mb-0" href="#">Maintenance Services</a>
                        </div>
                    </div>
                </div> -->

                <!-- You can continue adding more service items the same way, commenting out buttons -->

            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- Footer -->
    <?php include "include/footer.php"; ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/parallax/parallax.min.js"></script>

    <!-- Template JS -->
    <script src="js/main.js"></script>

</body>

</html>