<?php
include "session.php";
include 'pages/header.php';
include "config/db.php";

// Redirect if admin not logged in
if (!isset($_SESSION['admin_name'])) {
	header("location:login.php");
	exit;
}

// ======================== ADD SLIDER ========================
if (isset($_POST['add_slider'])) {
	$heading = $_POST['slider_heading'];
	$description = $_POST['slider_description'];

	if (isset($_FILES['slider_image']) && $_FILES['slider_image']['error'] == 0) {
		$fileName = time() . '_' . $_FILES['slider_image']['name'];
		$fileTmp = $_FILES['slider_image']['tmp_name'];
		$filePath = 'uploads/sliders/' . $fileName;

		if (!is_dir('uploads/sliders')) mkdir('uploads/sliders', 0777, true);

		if (move_uploaded_file($fileTmp, $filePath)) {
			$sql = "INSERT INTO sliders (heading, description, image, created_at) VALUES (?, ?, ?, NOW())";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("sss", $heading, $description, $fileName);
			$stmt->execute();
			echo "<script>
                alert('Slider added successfully');
                window.location.href = 'sliders.php';
            </script>";
		}
	}
}

// ======================== DELETE SLIDER ========================
if (isset($_POST['delete_slider'])) {
	$slider_id = $_POST['slider_id'];

	$stmtImg = $conn->prepare("SELECT image FROM sliders WHERE id=?");
	$stmtImg->bind_param("i", $slider_id);
	$stmtImg->execute();
	$stmtImg->bind_result($imgName);
	$stmtImg->fetch();
	$stmtImg->close();

	$stmt = $conn->prepare("DELETE FROM sliders WHERE id=?");
	$stmt->bind_param("i", $slider_id);
	$stmt->execute();

	if (file_exists('uploads/sliders/' . $imgName)) unlink('uploads/sliders/' . $imgName);

	echo "<script>
        alert('Slider deleted successfully');
        window.location.href='sliders.php';
    </script>";
}

// ======================== UPDATE SLIDER ========================
if (isset($_POST['update_slider'])) {
	$slider_id = $_POST['slider_id'];
	$heading = $_POST['slider_heading'];
	$description = $_POST['slider_description'];

	// Check if a new image is uploaded
	if (isset($_FILES['slider_image']) && $_FILES['slider_image']['error'] == 0) {
		$stmtImg = $conn->prepare("SELECT image FROM sliders WHERE id=?");
		$stmtImg->bind_param("i", $slider_id);
		$stmtImg->execute();
		$stmtImg->bind_result($oldImage);
		$stmtImg->fetch();
		$stmtImg->close();

		$fileName = time() . '_' . $_FILES['slider_image']['name'];
		$fileTmp = $_FILES['slider_image']['tmp_name'];
		$filePath = 'uploads/sliders/' . $fileName;

		if (!is_dir('uploads/sliders')) mkdir('uploads/sliders/', 0777, true);

		if (move_uploaded_file($fileTmp, $filePath)) {
			if (file_exists('uploads/sliders/' . $oldImage)) unlink('uploads/sliders/' . $oldImage);

			$sql = "UPDATE sliders SET heading=?, description=?, image=? WHERE id=?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("sssi", $heading, $description, $fileName, $slider_id);
			$stmt->execute();
		}
	} else {
		$sql = "UPDATE sliders SET heading=?, description=? WHERE id=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssi", $heading, $description, $slider_id);
		$stmt->execute();
	}

	echo "<script>
        alert('Slider updated successfully');
        window.location.href='sliders.php';
    </script>";
}
?>

<div class="content" id="content">

	<div class="d-flex justify-content-between align-items-center my-4">
		<h4 class="fw-bold mb-0">Sliders</h4>
		<button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addSliderModal">
			<i class="bi bi-plus-circle me-2"></i> Add Slider
		</button>
	</div>

	<!-- Add Slider Modal -->
	<div class="modal fade" id="addSliderModal" tabindex="-1" aria-labelledby="addSliderModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Slider</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form method="post" enctype="multipart/form-data">
						<div class="mb-3">
							<label>Heading</label>
							<input type="text" name="slider_heading" class="form-control" required>
						</div>
						<div class="mb-3">
							<label>Description</label>
							<textarea name="slider_description" class="form-control" rows="3"></textarea>
						</div>
						<div class="mb-3">
							<label>Image</label>
							<input type="file" name="slider_image" class="form-control" required>
						</div>
						<button type="submit" name="add_slider" class="btn btn-primary w-100">Add Slider</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Update Slider Modal -->
	<div class="modal fade" id="updateSliderModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update Slider</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form method="post" enctype="multipart/form-data" id="updateSliderForm">
						<input type="hidden" name="slider_id" id="update_slider_id">
						<div class="mb-3">
							<label>Heading</label>
							<input type="text" name="slider_heading" id="update_slider_heading" class="form-control" required>
						</div>
						<div class="mb-3">
							<label>Description</label>
							<textarea name="slider_description" id="update_slider_description" class="form-control" rows="3"></textarea>
						</div>
						<div class="mb-3">
							<label>Image (optional)</label>
							<input type="file" name="slider_image" class="form-control">
						</div>
						<button type="submit" name="update_slider" class="btn btn-success w-100">Update Slider</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Sliders Table -->
	<div class="card mt-4">
		<div class="card-body">
			<table id="slidersTable" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Heading</th>
						<th>Description</th>
						<th>Image</th>
						<th>Created At</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT * FROM sliders ORDER BY created_at DESC";
					$result = $conn->query($sql);
					$i = 1;
					while ($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $i++ . '</td>';
						echo '<td>' . htmlspecialchars($row['heading']) . '</td>';
						echo '<td>' . htmlspecialchars($row['description']) . '</td>';
						echo '<td><img src="uploads/sliders/' . $row['image'] . '" width="100"></td>';
						echo '<td>' . $row['created_at'] . '</td>';
						echo '<td>
            <button class="btn btn-info btn-sm editBtn" 
                data-id="' . $row['id'] . '" 
                data-heading="' . htmlspecialchars($row['heading']) . '" 
                data-description="' . htmlspecialchars($row['description']) . '">
                <i class="bi bi-pencil-square"></i>
            </button>
            <form method="post" style="display:inline;">
                <input type="hidden" name="slider_id" value="' . $row['id'] . '">
                <button type="submit" name="delete_slider" 
                    onclick="return confirm(\'Are you sure you want to delete this slider?\')" 
                    class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
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
			$('#slidersTable').DataTable();

			// Open update modal and fill data
			$('.editBtn').on('click', function() {
				var id = $(this).data('id');
				var heading = $(this).data('heading');
				var description = $(this).data('description');

				$('#update_slider_id').val(id);
				$('#update_slider_heading').val(heading);
				$('#update_slider_description').val(description);
				$('#updateSliderModal').modal('show');
			});
		});
	</script>

</div>

<?php include 'pages/footer.php'; ?>