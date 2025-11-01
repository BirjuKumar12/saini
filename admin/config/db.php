<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) session_start();

// Base URL for images
$baseUrl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http')
	. '://' . $_SERVER['HTTP_HOST']
	. rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';

// Database connection
$conn = new mysqli('localhost', 'root', '', 'saini');
if ($conn->connect_error) {
	die('Database connection failed: ' . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");
