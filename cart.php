<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<?php
session_start();

include('db_connect.php');

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    if (!isset($_SESSION['alert'])) {
        echo '<script>alert("Welcome, ' . $username . '!");</script>';
        $_SESSION['alert'] = true;
    }
}

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['action']) && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    if ($_POST['action'] === 'add_to_cart') {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]++;
        } else {
            $_SESSION['cart'][$product_id] = 1;
        }
    } elseif ($_POST['action'] === 'remove_from_cart') {
        unset($_SESSION['cart'][$product_id]);
    } elseif ($_POST['action'] === 'increase_quantity') {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]++;
        }
    } elseif ($_POST['action'] === 'decrease_quantity') {
        if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id] > 1) {
            $_SESSION['cart'][$product_id]--;
        }
    }
}

$cart_items = array();
$total_price = 0;

foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $sql = "SELECT * FROM product_list WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    $quantity = (int)$quantity;

    $product_total_price = $product['price'] * $quantity;
    $total_price += $product_total_price;

    $product['quantity'] = $quantity;
    $product['total_price'] = $product_total_price;

    $cart_items[] = $product;
}

if (isset($_POST['checkout'])) {
    if (isset($_SESSION['username'])) {
        $_SESSION['cart'] = array();
        $total_price = 0;

        header("Location: order_confirmation.php");
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">

    <title>Tako Restaurant - Kelompok 8</title>
    <style>
        .cart__total {
            text-align: center;
        }
        .cart__checkout {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px; 
        }

        .checkout-button {
            background-color: #007bff; 
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .thank-you__message {
            text-align: center;
            font-size: 24px;
        }


    </style>
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
                            <a href="index.php" class="nav__link active-link">Home</a>
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

    <main class="main">
        <section class="cart section" id="cart">
            <h2 class="section__title">Shopping Cart</h2>
            <div class="cart__container container grid">
            <?php 
            $cart_items = array();
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $sql = "SELECT * FROM product_list WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$product_id]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                $cart_items[] = $product;
            }

            foreach ($cart_items as $product) {
                echo '<article class="popular__card">';
                echo '<div class="popular__img-container" style="height: 200px; width: 150px;">';
                echo '<img src="' . $product['img_path'] . '" alt="" class="popular__img">';
                echo '</div>';
                echo '<h3 class="popular__name">' . $product['name'] . '</h3>';
                echo '<span class="popular__description">' . $product['description'] . '</span>';
                echo '<span class="popular__price">Rp. ' . $product['price'] . '</span>';
                echo '<div class="cart__item-quantity">';
                echo '<form method="post">';
                echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
                echo '<button type="submit" name="action" value="decrease_quantity" class="btn btn-secondary" style="width: 34px; height: 27px;">-</button>';
                echo '<input type="text" name="quantity" value="' . (isset($_SESSION['cart'][$product['id']]) ? (int)$_SESSION['cart'][$product['id']] : 0) . '" style="width: 30px; text-align: center;">';
                echo '<button type="submit" name="action" value="increase_quantity" class="btn btn-secondary" style="width: 34px; height: 27px;">+</button>';
                echo '<button type="submit" name="action" value="remove_from_cart" class="btn btn-danger">Remove</button>';
                echo '</form>';
                echo '</div>';
                echo '</article>';
            }
            ?>
            </div>
            
            <div class="cart__total">
                <?php if (!empty($_SESSION['cart'])): ?>
                <p>Total Price: Rp. <?php echo number_format($total_price, 2); ?></p>
                <?php endif; ?>
            </div>

            <div class="cart__checkout">
                <?php if (!empty($_SESSION['cart'])): ?>
                <form method="post">
                    <button type="submit" name="checkout" class="checkout-button">Proceed to Checkout</button>
                </form>
                <?php else: ?>
                <p>Your cart is empty. Please add items to your cart before proceeding to checkout.</p>
                <?php endif; ?>
            </div>

            <div class="thank-you__message">
                <?php
                if (isset($order_confirmation_message)) {
                    echo '<p>' . $order_confirmation_message . '</p>';
                }
                ?>
            </div>
        </section>
        
    </main>
    <script src="main.js"></script>
</body>
</html>