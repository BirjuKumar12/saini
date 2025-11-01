<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6 mb-5">Meet Our Professional Team Members</h1>
        </div>
        <div class="row g-4">
            <?php
            include "include/config/db.php";

            $sql = "SELECT * FROM team_member";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $team_name = htmlspecialchars($row['name']);
                $team_description = htmlspecialchars($row['description']);
                $team_image = !empty($row['image']) && file_exists('admin/uploads/team/' . $row['image'])
                    ? 'admin/uploads/team/' . $row['image']
                    : 'img/default-team.png'; // fallback image
            ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="team-img position-relative overflow-hidden">
                            <img class="img-fluid" src="<?= $team_image ?>" alt="<?= $team_name ?>">
                            <div class="team-social">
                                <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5><?= $team_name ?></h5>
                            <span class="text-primary"><?= $team_description ?></span>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

                        
             <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                 <div class="team-item">
                     <div class="team-img position-relative overflow-hidden">
                         <img class="img-fluid" src="img/team-2.jpg" alt="">
                         <div class="team-social">
                             <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-facebook-f"></i></a>
                             <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-twitter"></i></a>
                             <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-instagram"></i></a>
                         </div>
                     </div>
                     <div class="bg-light text-center p-4">
                         <h5>Full Name</h5>
                         <span class="text-primary">Designation</span>
                     </div>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                 <div class="team-item">
                     <div class="team-img position-relative overflow-hidden">
                         <img class="img-fluid" src="img/team-3.jpg" alt="">
                         <div class="team-social">
                             <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-facebook-f"></i></a>
                             <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-twitter"></i></a>
                             <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-instagram"></i></a>
                         </div>
                     </div>
                     <div class="bg-light text-center p-4">
                         <h5>Full Name</h5>
                         <span class="text-primary">Designation</span>
                     </div>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                 <div class="team-item">
                     <div class="team-img position-relative overflow-hidden">
                         <img class="img-fluid" src="img/team-4.jpg" alt="">
                         <div class="team-social">
                             <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-facebook-f"></i></a>
                             <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-twitter"></i></a>
                             <a class="btn btn-square btn-primary rounded-circle m-1" href=""><i class="fab fa-instagram"></i></a>
                         </div>
                     </div>
                     <div class="bg-light text-center p-4">
                         <h5>Full Name</h5>
                         <span class="text-primary">Designation</span>
                     </div>
                 </div>
             </div> 
        </div>
    </div>
</div>