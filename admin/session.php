<?php
// session.php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_name'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit;
}

// Optional: you can use these session variables on your page
// $admin_id = $_SESSION['admin_id'];
// $admin_name = $_SESSION['admin_name'];
