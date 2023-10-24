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
    </head>
    <body>
        <header class="header" id="header">
            <nav class="nav container">
                <a href="#" class="nav__logo">
                    <img src="Images/Logo.png" alt="Logo Image" >
                    Tako Restaurant.
                </a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="index.php" class="nav__link active-link">Home</a>
                        </li>

                        <li class="nav__item">
                            <a href="#popular" class="nav__link">Menu</a>
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
            <section class="home section" id="home">
                <div class="home__container container grid">
                    <img src="Images/ikkousha-ramen.png" alt="home image" class="home__img">

                    <div class="home__data">
                        <h1 class="home__title">
                            The Finest Japanese Cuisine

                            <div>
                                <img src="Images/Logo.png" alt="Home Image" style="height:100px; width:200px;">
                                Tako Restaurant
                            </div>
                        </h1>

                        <p class="home__description">
                            Elevate Your Senses with Japanese Flavors.
                        </p>

                        <a href="#popular" class="button">
                            View Menu <i class="ri-arrow-down-line"></i>
                        </a>
                    </div>
                </div>

                <img src="Images/miso-ramen.png" alt="home image" class="home__ramen-1">
                <img src="Images/sake-bg.png" alt="home image" class="home__ramen-2">
            </section>
            
            <section class="popular section" id="popular">
              <h2 class="section__title">Our Menu</h2>
                <?php
                $sql = "SELECT * FROM product_list";
                $result = $db->query($sql);

                if ($result->rowCount() > 0) {
                    echo '<section class="popular section" id="popular">';
                    echo '<div class="popular__container container grid">';

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                      echo '<article class="popular__card">';
                      echo '<div class="popular__img-container">';
                      echo '<img src="' . $row['img_path'] . '" alt="" class="popular__img">';
                      echo '</div>';
                      echo '<h3 class="popular__name">' . $row['name'] . '</h3>';
                      echo '<span class="popular__description">' . $row['description'] . '</span>';
                      echo '<span class="popular__price">Rp. ' . $row['price'] . '</span>';
                  
                      if (isset($_SESSION['username'])) {
                          echo '<form action="cart.php" method="POST">';
                          echo '<input type="hidden" name="action" value="add_to_cart">';
                          echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                          echo '<input type="hidden" name="product_name" value="' . $row['name'] . '">';
                          echo '<input type="hidden" name="product_price" value="' . $row['price'] . '">';
                          echo '<button type="submit" class="popular__button">';
                          echo '<i class="ri-shopping-cart-line"></i>';
                          echo '</button>';
                          echo '</form>';
                      } else {
                        echo '<a class="popular__button"href="login.php"><i class="ri-shopping-cart-line"></i></a>';
                      }
                      echo '</article>';
                  }
                    echo '</div>';
                    echo '</section>';
                } else {
                    echo '<p>No products available at the moment.</p>';
                }
                ?>
            </section>
        </main>

        <footer class="footer">
            <div class="footer__container container grid">
                <div>
                    <a href="#" class="footer__logo">
                        <img src="Images/Logo.png" alt="logo image" style="height: 50px; width: 100px;">
                        Tako Restaurant.
                    </a>

                    <p class="footer__description">
                    "Elevate Your Senses, Embrace Tradition.<br/>
                    Where Every Bite is a Journey to Japan!"
                    </p>
                </div>
            </div>
        </footer>

        <a href="#" class="scrollup" id="scroll-up">
            <i class="ri-arrow-up-line"></i>
        </a>

        <script src="scrollreveal.min.js"></script>

        <script src="main.js"></script>
    </body>
</html>