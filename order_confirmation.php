<?php
session_start();

$order_confirmation_message = "Thank you for your order! Your order has been placed.";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .order-confirmation {
            text-align: center;
        }
    </style>
    <title>Order Confirmation - Tako Restaurant</title>
</head>
<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.php" class="nav__logo">
                <img src="Images/Logo.png" alt="Logo Image" >
                Tako Restaurant.
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="index.php" class "nav__link active-link">Home</a>
                    </li>

                    <li class="nav__item">
                        <a href="index.php" class="nav__link">Menu</a>
                    </li>

                    <li class="nav__item">
                        <a href="cart.php" class="nav__link">Cart</a>
                    </li>

                    <li class="nav__item">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<a class="nav__link" href="logout.php">LOGOUT</a>';
                    } else {
                        echo '<a class="nav__link" href="login.php">LOGIN</a>';
                    }
                    ?>
                    </li>
                </ul>
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>

                <img src="Images/tonkotsu-ramen.png" alt="nav image" class="nav__img-1">
                <img src="Images/salmon sushi.png" alt="nav image" class="nav__img-2">
            </div>

            <div class="nav__buttons">
                <i class="ri-moon-line change-theme" id="theme-button"></i>

                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
        </nav>
    </header>

    <h1>Order Confirmation</h1>
    <div class="order-confirmation">
        <p><?php echo $order_confirmation_message; ?></p>
    </div>
    <script src="main.js"></script>
</body>
</html>
