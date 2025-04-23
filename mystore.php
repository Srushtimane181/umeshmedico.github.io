<?php
session_start();
if (!isset($_SESSION['admin_session'])) {
    // If there is no active admin session, redirect to the login page.
    header("Location: adminindex.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- FontAwesome for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
      /* Custom sidebar styles */
      .sidebar {
          height: 100vh;
          background-color: #16a085;
          padding-top: 20px;
          position: fixed;
          width: 15%;
          overflow-y: auto;
      }
      .sidebar a {
          padding: 10px 15px;
          text-align: left;
          display: block;
          font-size: 18px;
          color: white;
          text-decoration: none;
      }
      .sidebar a:hover {
          background-color: #218838;
      }
      .main-content {
          margin-left: 15%;
          padding: 20px;
      }
      /* Navbar shadow */
      .navbar {
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }
      /* Responsive adjustments */
      @media (max-width: 768px) {
          .sidebar {
              width: 100%;
              height: auto;
              position: relative;
          }
          .main-content {
              margin-left: 0;
          }
          .sidebar a {
              text-align: center;
              font-size: 16px;
          }
      }
      @media (max-width: 576px) {
          .sidebar a {
              font-size: 14px;
          }
      }
  </style>
</head>
<body>
  <nav class="navbar navbar-light bg-light">
      <div class="container-fluid d-flex justify-content-between align-items-center">
          <a class="navbar-brand"><b>Admin</b></a>
          <span>
              <i class="fas fa-sign-out-alt"></i>
              <a href="adminlogout.php">Logout</a>
              <a href="index.php">Home</a>
          </span>
      </div>
  </nav>
  
  <!-- Sidebar -->
  <div class="sidebar">
      <a href="products.php"><i class="fas fa-box"></i> <span>Products</span></a>
      <a href="users.php"><i class="fas fa-users"></i> <span>Users</span></a>
      <a href="uorder.php"><i class="fas fa-users"></i> <span>Orders</span></a>
  </div>
  
  <!-- Main content -->
  <div class="main-content">
      <h1>Welcome Admin</h1>
      <p>Select an option from the sidebar to manage Products or Users.</p>
  </div>
  
  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
          integrity="sha384-IQsoLXlY6/6ArM2J6Oe5BEVvFZtT5urUz6v/B0ospiPgtvE1jtt7aqS6M6BT6LIp"
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
          integrity="sha384-cVKIPhG+yI2u5iF6tak+p9e+Jp65gM2K4QeYPF/nkkkl5aapLP0o6A5C6b7DL6S2"
          crossorigin="anonymous"></script>
</body>
</html>
