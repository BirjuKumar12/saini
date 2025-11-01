<?php
include "session.php";
include 'pages/header.php';
include 'config/db.php'; // DB connection
?>

<div class="content" id="content">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h4 class="fw-bold mb-0">Products</h4>
        <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="bi bi-plus-circle me-2"></i> Add Product
        </button>
    </div>
    <?php
    // -------------------- ADD PRODUCT --------------------
    if (isset($_POST['add_product'])) {
        $name = $_POST['product_name'];
        $description = $_POST['product_description'];
        $price = $_POST['product_price'];

        $stmt = $conn->prepare("INSERT INTO product (name, description, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $name, $description, $price);
        $stmt->execute();
        $product_id = $stmt->insert_id;
        $stmt->close();

        // Multiple images
        if (isset($_FILES['product_images'])) {
            foreach ($_FILES['product_images']['name'] as $key => $img_name) {
                if ($img_name != "") {
                    $image_name = time() . '_' . $img_name;
                    move_uploaded_file($_FILES['product_images']['tmp_name'][$key], 'uploads/products/' . $image_name);

                    $stmt_img = $conn->prepare("INSERT INTO product_images (product_id, image) VALUES (?, ?)");
                    $stmt_img->bind_param("is", $product_id, $image_name);
                    $stmt_img->execute();
                    $stmt_img->close();
                }
            }
        }

        echo "<script>alert('✅ Product added successfully'); window.location.href='products.php';</script>";
    }

    // -------------------- UPDATE PRODUCT --------------------
    if (isset($_POST['update_product'])) {
        $id = $_POST['product_id'];
        $name = $_POST['product_name'];
        $description = $_POST['product_description'];
        $price = $_POST['product_price'];

        $stmt = $conn->prepare("UPDATE product SET name=?, description=?, price=? WHERE id=?");
        $stmt->bind_param("ssdi", $name, $description, $price, $id);
        $stmt->execute();
        $stmt->close();

        // Upload new images
        if (isset($_FILES['product_images'])) {
            foreach ($_FILES['product_images']['name'] as $key => $img_name) {
                if ($img_name != "") {
                    $image_name = time() . '_' . $img_name;
                    move_uploaded_file($_FILES['product_images']['tmp_name'][$key], 'uploads/products/' . $image_name);

                    $stmt_img = $conn->prepare("INSERT INTO product_images (product_id, image) VALUES (?, ?)");
                    $stmt_img->bind_param("is", $id, $image_name);
                    $stmt_img->execute();
                    $stmt_img->close();
                }
            }
        }

        echo "<script>alert('✅ Product updated successfully'); window.location.href='products.php';</script>";
    }

    // -------------------- DELETE PRODUCT --------------------
    if (isset($_POST['delete_product'])) {
        $id = $_POST['product_id'];

        // Delete images
        $img_result = $conn->query("SELECT * FROM product_images WHERE product_id=$id");
        while ($img = $img_result->fetch_assoc()) {
            if (file_exists('uploads/products/' . $img['image'])) {
                unlink('uploads/products/' . $img['image']);
            }
        }
        $conn->query("DELETE FROM product_images WHERE product_id=$id");

        // Delete product
        $stmt = $conn->prepare("DELETE FROM product WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        echo "<script>alert('🗑️ Product deleted successfully'); window.location.href='products.php';</script>";
    }

    // -------------------- DELETE SINGLE IMAGE --------------------
    if (isset($_GET['delete_image'])) {
        $img_id = $_GET['delete_image'];
        $img_result = $conn->query("SELECT * FROM product_images WHERE id=$img_id")->fetch_assoc();
        if ($img_result && file_exists('uploads/products/' . $img_result['image'])) {
            unlink('uploads/products/' . $img_result['image']);
        }
        $conn->query("DELETE FROM product_images WHERE id=$img_id");
        echo "<script>window.location.href='products.php';</script>";
    }
    ?>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="product_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="product_description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Price (₹)</label>
                            <input type="number" step="0.01" name="product_price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Images</label>
                            <input type="file" name="product_images[]" class="form-control" multiple required>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-primary w-100">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Product Modal -->
    <div class="modal fade" id="updateProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="updateProductForm">
                        <input type="hidden" name="product_id" id="update_product_id">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="product_name" id="update_product_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="product_description" id="update_product_description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Price (₹)</label>
                            <input type="number" step="0.01" name="product_price" id="update_product_price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Add New Images</label>
                            <input type="file" name="product_images[]" class="form-control" multiple>
                        </div>
                        <div class="mb-3" id="existing_images">
                            <!-- Existing images will be displayed here via AJAX -->
                        </div>
                        <button type="submit" name="update_product" class="btn btn-success w-100">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card mt-4">
        <div class="card-body">
            <table id="productsTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price (₹)</th>
                        <th>Images</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM product ORDER BY id DESC";
                    $result = $conn->query($sql);
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                        echo '<td style="max-width:250px;">' . htmlspecialchars(substr($row['description'], 0, 100)) . '...</td>';
                        echo '<td>₹' . number_format($row['price'], 2) . '</td>';

                        // Fetch images
                        $img_result = $conn->query("SELECT * FROM product_images WHERE product_id=" . $row['id']);
                        echo '<td>';
                        while ($img = $img_result->fetch_assoc()) {
                            echo '<img src="uploads/products/' . $img['image'] . '" width="80" class="rounded me-1 mb-1">';
                        }
                        echo '</td>';

                        echo '<td>
        <button class="btn btn-warning btn-sm editBtn" 
            data-id="' . $row['id'] . '" 
            data-name="' . htmlspecialchars($row['name']) . '" 
            data-description="' . htmlspecialchars($row['description']) . '" 
            data-price="' . $row['price'] . '">
            <i class="bi bi-pencil-square"></i>
        </button>
        <form method="post" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this product?\');">
            <input type="hidden" name="product_id" value="' . $row['id'] . '">
            <button type="submit" name="delete_product" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
        </form>
    </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable();

            // Open Update Modal
            $('.editBtn').on('click', function() {
                let id = $(this).data('id');
                $('#update_product_id').val(id);
                $('#update_product_name').val($(this).data('name'));
                $('#update_product_description').val($(this).data('description'));
                $('#update_product_price').val($(this).data('price'));

                // Fetch existing images via AJAX
                $.ajax({
                    url: 'fetch_product_images.php',
                    type: 'GET',
                    data: {
                        product_id: id
                    },
                    success: function(data) {
                        $('#existing_images').html(data);
                    }
                });

                $('#updateProductModal').modal('show');
            });
        });
    </script>

</div>
<?php include 'pages/footer.php'; ?>
