<?php
session_start();
include 'config/db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['password'])) {
  $name = $conn->real_escape_string($_POST['name']);
  $password = $_POST['password'];

  // Query the admin table
  $sql = "SELECT * FROM admin WHERE name='$name' LIMIT 1";
  $result = $conn->query($sql);

  if ($result && $result->num_rows === 1) {
    $admin = $result->fetch_assoc();

    // Password check (plain or hashed)
    if (isset($admin['password']) && ($admin['password'] === $password || password_verify($password, $admin['password']))) {
      // Set session
      $_SESSION['admin_name'] = $admin['name'];

      header('Location: index.php'); // redirect to admin dashboard
      exit;
    } else {
      $error = 'Invalid credentials.';
    }
  } else {
    $error = 'Invalid credentials.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: url('../assests/images/auth2.jpg') center center/cover no-repeat;
      filter: blur(4px) brightness(0.9);
      z-index: 0;
    }

    .login-card {
      position: relative;
      z-index: 1;
      max-width: 400px;
      width: 100%;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background: #fff;
    }

    .login-card h3 {
      font-weight: 600;
    }
  </style>
</head>

<body>
  <div class="login-card m-5">
    <div class="d-flex justify-content-center align-items-center mb-3">
      <img src="../assests/images/logo.png" alt="">
    </div>

    <h3 class="mb-3 text-center text-primary">Admin Login</h3>
    <form method="post" autocomplete="off">
      <div class="mb-3">
        <label for="name" class="form-label">Admin Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Admin Name" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
          <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
            <i class="bi bi-eye-slash"></i>
          </span>
        </div>
      </div>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger py-2"><?php echo $error; ?></div>
      <?php endif; ?>

      <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');

    togglePassword.addEventListener('click', () => {
      // Toggle the type attribute
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);

      // Toggle the eye icon
      togglePassword.innerHTML = type === 'password' ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
    });
  </script>
</body>

</html>