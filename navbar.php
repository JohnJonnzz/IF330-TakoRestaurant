<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    if (!isset($_SESSION['alert'])) {
        echo '<script>alert("Welcome, ' . $username . '!");</script>';
        $_SESSION['alert'] = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>

    <title>Tako Restaurant</title>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">HOME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">MENU</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">CART</a>
        </li>
        <li class="nav-item">
          <?php
          if (isset($_SESSION['username'])) {
            echo '<a class="nav-link" href="logout.php">LOGOUT</a>';
          } else {
            echo '<a class="nav-link" href="login.php">LOGIN</a>';
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

