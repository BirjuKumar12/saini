<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saini Refrigeration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Blur effect when sidebar is open on mobile */
        .blurred {
            filter: blur(4px);
            pointer-events: none;
            user-select: none;
        }

        @media (max-width: 767.98px) {
            .sidebar {
                width: 220px;
                min-width: 220px;
                z-index: 1050;
            }

            .sidebar.collapsed {
                margin-left: -220px;
            }

            .content,
            .topbar {
                margin-left: 0 !important;
            }
        }

        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #ddd;
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar.collapsed {
            margin-left: -250px;
        }

        .sidebar .nav-link {
            padding: 12px 20px;
            color: #333;
            font-weight: 500;
        }

        .sidebar .nav-link.active {
            background: #eef3ff;
            color: #0d6efd;
            /* border-radius: 6px; */
            border-right: 4px solid #0d6efd;
        }

        .sidebar .nav-link:hover {
            background: #eef3ff;
            color: #0d6efd;
            /* border-radius: 6px; */
            border-right: 4px solid #0d6efd;
        }

        .sidebar-footer .nav-link:hover {
            background: #f8dfdfff;
            color: #fd0d0dff;
            /* border-radius: 6px; */
            border-right: 4px solid #fd0d0dff;
        }

        /* Main content */
        .content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            padding: 20px;
        }

        .content.full {
            margin-left: 0;
        }

        .topbar.full {
            margin-left: 0;
        }

        .footer-custom {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            padding: 20px;
        }

        .footer-custom.full {
            margin-left: 0;
        }

        /* Top Navbar */
        .topbar {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            background: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.05);
        }

        .chart-box {
            height: 300px;
            background: #eef3ff;
            border-radius: 12px;
        }
    </style>
</head>


<body>
    <!-- Mobile Search Modal -->
    <div class="modal fade" id="mobileSearchModal" tabindex="-1" aria-labelledby="mobileSearchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="mobileSearchModalLabel">Search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <input type="text" class="form-control" placeholder="Search here...">
                </div>
            </div>
        </div>
    </div>

    <?php include("./pages/sidebar.php"); ?>


    <!-- Topbar -->
    <div class="topbar" id="topbar">
        <div class="d-flex align-items-center">
            <button class="btn btn-light me-2" id="toggleBtn"><i class="bi bi-list"></i></button>
            <input type="text" class="form-control d-none d-md-block" placeholder="Search here..." style="width:250px;">
            <button class="btn btn-light d-block d-md-none" id="mobileSearchBtn" type="button"><i class="bi bi-search"></i></button>
        </div>
        <div class="d-flex align-items-center">
            <i class="bi bi-envelope me-3 fs-5"></i>
            <?php if (isset($_SESSION['admin_name'])): ?>
                <span class="me-2 fw-bold text-primary"><?php echo htmlspecialchars($_SESSION['admin_name']); ?></span>
            <?php else: ?>
                <span class="me-2 fw-bold text-primary">Admin</span>
            <?php endif; ?>
            <img src="https://i.pravatar.cc/40" class="rounded-circle" alt="profile">
        </div>
    </div>