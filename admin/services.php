<?php
include "session.php";
include 'pages/header.php';
include "config/db.php";

// Redirect if admin not logged in
if (!isset($_SESSION['admin_name'])) {
    header("location:login.php");
    exit;
}

// ======================== ADD SERVICE ========================
if (isset($_POST['add_service'])) {
    $name = $_POST['service_name'];
    $description = $_POST['service_description'];

    if (isset($_FILES['service_image']) && $_FILES['service_image']['error'] == 0) {
        $fileName = time() . '_' . $_FILES['service_image']['name'];
        $fileTmp = $_FILES['service_image']['tmp_name'];
        $uploadDir = 'uploads/services/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmp, $filePath)) {
            $stmt = $conn->prepare("INSERT INTO ourservices (name, description, image, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $name, $description, $fileName);
            $stmt->execute();
            echo "<script>alert('Service added successfully');window.location.href='services.php';</script>";
        }
    }
}

// ======================== DELETE SERVICE ========================
if (isset($_POST['delete_service'])) {
    $service_id = $_POST['service_id'];

    $stmtImg = $conn->prepare("SELECT image FROM ourservices WHERE id=?");
    $stmtImg->bind_param("i", $service_id);
    $stmtImg->execute();
    $stmtImg->bind_result($imgName);
    $stmtImg->fetch();
    $stmtImg->close();

    $stmt = $conn->prepare("DELETE FROM ourservices WHERE id=?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();

    if (file_exists('uploads/services/' . $imgName)) unlink('uploads/services/' . $imgName);

    echo "<script>alert('Service deleted successfully');window.location.href='services.php';</script>";
}

// ======================== UPDATE SERVICE ========================
if (isset($_POST['update_service'])) {
    $service_id = $_POST['service_id'];
    $name = $_POST['service_name'];
    $description = $_POST['service_description'];

    if (isset($_FILES['service_image']) && $_FILES['service_image']['error'] == 0) {
        // Remove old image
        $stmtImg = $conn->prepare("SELECT image FROM ourservices WHERE id=?");
        $stmtImg->bind_param("i", $service_id);
        $stmtImg->execute();
        $stmtImg->bind_result($oldImage);
        $stmtImg->fetch();
        $stmtImg->close();

        $fileName = time() . '_' . $_FILES['service_image']['name'];
        $fileTmp = $_FILES['service_image']['tmp_name'];
        $uploadDir = 'uploads/services/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmp, $filePath)) {
            if (file_exists($uploadDir . $oldImage)) unlink($uploadDir . $oldImage);

            $stmt = $conn->prepare("UPDATE ourservices SET name=?, description=?, image=? WHERE id=?");
            $stmt->bind_param("sssi", $name, $description, $fileName, $service_id);
            $stmt->execute();
        }
    } else {
        $stmt = $conn->prepare("UPDATE ourservices SET name=?, description=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $description, $service_id);
        $stmt->execute();
    }

    echo "<script>alert('Service updated successfully');window.location.href='services.php';</script>";
}
?>

<div class="content" id="content">

    <div class="d-flex justify-content-between align-items-center my-4">
        <h4 class="fw-bold mb-0">Our Services</h4>
        <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="bi bi-plus-circle me-2"></i> Add Service
        </button>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Service Name</label>
                            <input type="text" name="service_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="service_description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="service_image" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_service" class="btn btn-primary w-100">Add Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Service Modal -->
    <div class="modal fade" id="updateServiceModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" enctype="multipart/form-data" id="updateServiceForm">
                    <div class="modal-body">
                        <input type="hidden" name="service_id" id="update_service_id">
                        <div class="mb-3">
                            <label>Service Name</label>
                            <input type="text" name="service_name" id="update_service_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="service_description" id="update_service_description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image (Optional)</label>
                            <input type="file" name="service_image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update_service" class="btn btn-success w-100">Update Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Services Table -->
    <div class="card mt-4">
        <div class="card-body">
            <table id="servicesTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM ourservices ORDER BY created_at DESC";
                    $result = $conn->query($sql);
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                        echo '<td><img src="uploads/services/' . $row['image'] . '" width="100"></td>';
                        echo '<td>' . $row['created_at'] . '</td>';
                        echo '<td>
                                <button class="btn btn-warning btn-sm editBtn" 
                                    data-id="' . $row['id'] . '" 
                                    data-name="' . htmlspecialchars($row['name']) . '" 
                                    data-description="' . htmlspecialchars($row['description']) . '"><i class="bi bi-pencil-square"></i></button>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="service_id" value="' . $row['id'] . '">
                                    <button type="submit" name="delete_service" 
                                        onclick="return confirm(\'Are you sure?\')" 
                                        class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                              </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- DataTables CSS/JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#servicesTable').DataTable();

            // Open update modal and fill data
            $('.editBtn').on('click', function() {
                $('#update_service_id').val($(this).data('id'));
                $('#update_service_name').val($(this).data('name'));
                $('#update_service_description').val($(this).data('description'));
                $('#updateServiceModal').modal('show');
            });
        });
    </script>

</div>

<?php include 'pages/footer.php'; ?>