<?php
include "session.php";
include 'pages/header.php';

?>
<!-- Main Content -->
<div class="content" id="content">
    <!-- Dashboard Stats -->
    <div class="row my-4">
        <div class="col-md-3 col-12 mb-3">
            <div class="card p-3">
                <h6>Total Page Views</h6>
                <h4>4,42,236 <span class="text-primary small">↑ 59.3%</span></h4>
                <p class="text-muted small">You made an extra 35,000 this year</p>
            </div>
        </div>
        <div class="col-md-3 col-12 mb-3">
            <div class="card p-3">
                <h6>Total Users</h6>
                <h4>78,250 <span class="text-success small">↑ 70.5%</span></h4>
                <p class="text-muted small">You made an extra 8,900 this year</p>
            </div>
        </div>
        <div class="col-md-3 col-12 mb-3">
            <div class="card p-3">
                <h6>Total Order</h6>
                <h4>18,800 <span class="text-warning small">↓ 27.4%</span></h4>
                <p class="text-muted small">You made an extra 1,943 this year</p>
            </div>
        </div>
        <div class="col-md-3 col-12 mb-3">
            <div class="card p-3">
                <h6>Total Sales</h6>
                <h4>$35,078 <span class="text-danger small">↓ 27.4%</span></h4>
                <p class="text-muted small">You made an extra $20,395 this year</p>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <h6>Unique Visitor</h6>
                    <div>
                        <button class="btn btn-sm btn-outline-primary">Month</button>
                        <button class="btn btn-sm btn-primary">Week</button>
                    </div>
                </div>
                <div class="chart-box mt-3"></div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <h6>Income Overview</h6>
                <h4>This Week Statistics</h4>
                <div class="chart-box mt-3"></div>
            </div>
        </div>
    </div>
</div>

<?php include 'pages/footer.php'; ?>