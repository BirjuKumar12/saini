<div class="container-fluid p-0 mb-5">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2000" data-bs-wrap="true">
        <div class="carousel-inner">
            <?php
            include "database.php";
            $sql = "SELECT * FROM sliders ORDER BY id ASC"; // adjust table/columns if needed
            $result = mysqli_query($conn, $sql);

            $first = true; // to mark the first carousel item as active
            while ($row = mysqli_fetch_assoc($result)) {
                $slider_image = "admin/uploads/sliders/" . $row['image']; // adjust folder path
                $slider_heading = $row['heading'];
                $slider_description = $row['description'];
            ?>
                <div class="carousel-item <?= $first ? 'active' : '' ?>">
                    <img class="w-100" src="<?= $slider_image ?>" alt="<?= htmlspecialchars($slider_heading) ?>">
                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                        <div class="col-lg-7 pt-5 text-center">
                            <h1 class="display-4 text-white mb-4 animate__animated animate__fadeInDown"><?= htmlspecialchars($slider_heading) ?></h1>
                            <p class="fs-5 text-white mb-4 pb-2 mx-sm-5 animate__animated animate__fadeInUp"><?= htmlspecialchars($slider_description) ?></p>
                            <a href="" class="btn btn-primary py-3 px-5 animate__animated animate__fadeInUp animate__delay-1s">Explore More</a>
                        </div>
                    </div>
                </div>
            <?php
                $first = false; // only first item is active
            }
            ?>

            <!-- <div class="carousel-item">
                <img class="w-100" src="img/slider/slider 3.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                    <div class="col-lg-7 pt-5 text-center">
                        <h1 class="display-4 text-white mb-4 animate__animated animate__fadeInDown">Quality Heating & Air Condition Services</h1>
                        <p class="fs-5 text-white mb-4 pb-2 mx-sm-5 animate__animated animate__fadeInUp">Stay warm in winters and cool in summers. Our certified technicians provide top-notch heating and air conditioning services tailored to your needs.</p>
                        <a href="" class="btn btn-primary py-3 px-5 animate__animated animate__fadeInUp animate__delay-1s">Explore More</a>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- JS for Animate.css Reset on Each Slide -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var carouselEl = document.querySelector('#header-carousel');

        // Initialize carousel (auto-slide is handled by data attributes)
        var carousel = new bootstrap.Carousel(carouselEl);

        // Reset Animate.css animations on each slide
        carouselEl.addEventListener('slide.bs.carousel', function(event) {
            var animatedElems = event.relatedTarget.querySelectorAll('.animate__animated');
            animatedElems.forEach(el => {
                el.classList.remove('animate__animated');
                void el.offsetWidth; // trigger reflow
                el.classList.add('animate__animated');
            });
        });
    });
</script>

<style>
    /* Slider Image Fix */
    #header-carousel .carousel-item img {
        width: 100%;
        height: 600px;
        /* adjust as needed */
        object-fit: cover;
        /* fills the container, crops excess */
        object-position: center;
        /* centers the image */
    }

    /* Optional: Responsive height for smaller screens */
    @media (max-width: 1200px) {
        #header-carousel .carousel-item img {
            height: 500px;
        }
    }

    @media (max-width: 768px) {
        #header-carousel .carousel-item img {
            height: 350px;
        }
    }

    @media (max-width: 480px) {
        #header-carousel .carousel-item img {
            height: 250px;
        }

        #header-carousel .carousel-caption h1 {
            font-size: 1.8rem;
        }

        #header-carousel .carousel-caption p {
            font-size: 0.9rem;
        }

        #header-carousel .carousel-caption .btn {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }
    }
</style>