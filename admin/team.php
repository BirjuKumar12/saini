<?php
include "session.php";
?>
<?php include 'pages/header.php'; ?>

<div class="content" id="content">

    <div class="d-flex justify-content-between align-items-center my-4">
        <h4 class="fw-bold mb-0">Team Members</h4>
        <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addTeamModal">
            <i class="bi bi-plus-circle me-2"></i> Add Team Member
        </button>
    </div>

    <?php
    include 'config/db.php';

    // ======================== ADD TEAM MEMBER ========================
    if (isset($_POST['add_team'])) {
        $name = $_POST['team_name'];
        $description = $_POST['team_description'];

        // Handle image upload
        if (isset($_FILES['team_image']) && $_FILES['team_image']['name'] != "") {
            $image_name = time() . '_' . $_FILES['team_image']['name'];
            if (!is_dir('uploads/team')) mkdir('uploads/team', 0777, true);
            move_uploaded_file($_FILES['team_image']['tmp_name'], 'uploads/team/' . $image_name);
        } else {
            $image_name = '';
        }

        $stmt = $conn->prepare("INSERT INTO team_member (name, description, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $description, $image_name);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Team member added successfully');
                    window.location.href='team.php';
                  </script>";
        }
        $stmt->close();
    }

    // ======================== UPDATE TEAM MEMBER ========================
    if (isset($_POST['update_team'])) {
        $id = $_POST['team_id'];
        $name = $_POST['team_name'];
        $description = $_POST['team_description'];

        if (isset($_FILES['team_image']) && $_FILES['team_image']['name'] != "") {
            // Delete old image
            $stmtOld = $conn->prepare("SELECT image FROM team_member WHERE id=?");
            $stmtOld->bind_param("i", $id);
            $stmtOld->execute();
            $stmtOld->bind_result($oldImage);
            $stmtOld->fetch();
            $stmtOld->close();

            if ($oldImage != '' && file_exists('uploads/team/' . $oldImage)) unlink('uploads/team/' . $oldImage);

            $image_name = time() . '_' . $_FILES['team_image']['name'];
            if (!is_dir('uploads/team')) mkdir('uploads/team', 0777, true);
            move_uploaded_file($_FILES['team_image']['tmp_name'], 'uploads/team/' . $image_name);

            $stmt = $conn->prepare("UPDATE team_member SET name=?, description=?, image=? WHERE id=?");
            $stmt->bind_param("sssi", $name, $description, $image_name, $id);
        } else {
            $stmt = $conn->prepare("UPDATE team_member SET name=?, description=? WHERE id=?");
            $stmt->bind_param("ssi", $name, $description, $id);
        }

        if ($stmt->execute()) {
            echo "<script>
                    alert('Team member updated successfully');
                    window.location.href='team.php';
                  </script>";
        }
        $stmt->close();
    }

    // ======================== DELETE TEAM MEMBER ========================
    if (isset($_POST['delete_team'])) {
        $id = $_POST['team_id'];

        // Delete image
        $stmtImg = $conn->prepare("SELECT image FROM team_member WHERE id=?");
        $stmtImg->bind_param("i", $id);
        $stmtImg->execute();
        $stmtImg->bind_result($imgName);
        $stmtImg->fetch();
        $stmtImg->close();

        if ($imgName != '' && file_exists('uploads/team/' . $imgName)) unlink('uploads/team/' . $imgName);

        $stmt = $conn->prepare("DELETE FROM team_member WHERE id=?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Team member deleted successfully');
                    window.location.href='team.php';
                  </script>";
        }
        $stmt->close();
    }
    ?>

    <!-- Add Team Modal -->
    <div class="modal fade" id="addTeamModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Team Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="team_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="team_description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="team_image" class="form-control" required>
                        </div>
                        <button type="submit" name="add_team" class="btn btn-primary w-100">Add Team Member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Team Modal -->
    <div class="modal fade" id="updateTeamModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Team Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="updateTeamForm">
                        <input type="hidden" name="team_id" id="update_team_id">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="team_name" id="update_team_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="team_description" id="update_team_description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image (optional)</label>
                            <input type="file" name="team_image" class="form-control">
                        </div>
                        <button type="submit" name="update_team" class="btn btn-success w-100">Update Team Member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Members Table -->
    <div class="card mt-4">
        <div class="card-body">
            <table id="teamTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM team_member ORDER BY id DESC";
                    $result = $conn->query($sql);
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                        echo '<td><img src="uploads/team/' . $row['image'] . '" width="100"></td>';
                        echo '<td>
                                <button class="btn btn-warning btn-sm editBtn" 
                                        data-id="' . $row['id'] . '" 
                                        data-name="' . htmlspecialchars($row['name']) . '" 
                                        data-description="' . htmlspecialchars($row['description']) . '"><i class="bi bi-pencil-square"></i></button>
                                <form method="post" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this team member?\');">
                                    <input type="hidden" name="team_id" value="' . $row['id'] . '">
                                    <button type="submit" name="delete_team" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                              </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#teamTable').DataTable();

            // Open update modal and fill data
            $('.editBtn').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var description = $(this).data('description');

                $('#update_team_id').val(id);
                $('#update_team_name').val(name);
                $('#update_team_description').val(description);
                $('#updateTeamModal').modal('show');
            });
        });
    </script>

</div> <!-- End of content -->

<?php include 'pages/footer.php'; ?>