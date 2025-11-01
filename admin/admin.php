<?php
require "config/db.php"; // your database connection

// Admin credentials
$name = 'admin';               // Admin name
$password = 'admin@123';       // Plain text password

// Hash the password using bcrypt
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insert query
$insert = "INSERT INTO admin (name, password) VALUES ('$name', '$hashedPassword')";

// Execute the query
if (mysqli_query($conn, $insert)) {
    echo "Admin inserted successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
