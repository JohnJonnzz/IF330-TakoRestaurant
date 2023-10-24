<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
            <form action="login_process.php" class="sign-in-form" method="POST">
                <h2 class="title">Log In</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input name="username" type="text" placeholder="Username" />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input name="password" type="password" placeholder="Password" />
                    <?php                             
                        $capcode = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
                        $capcode = substr(str_shuffle($capcode), 0, 6);
                        $_SESSION['captcha'] = $capcode;
                        echo '<div class="unselectable" style="align: center;">' . $capcode . '</div>';
                    ?>
                </div>
                <br />
                <input size="25" type="text" class="input-field" name="captcha" placeholder="Enter Captcha"  autocomplete="off" required>
                <button type="submit" class="btn">Login</button>
                <a href="index.php" class="btn2">HOME</a>
            </form>
            <form action="register_process.php" class="sign-up-form" method="POST">
                <h2 class="title">Register</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input name="Fname"type="text" placeholder="First Name" />
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input name="Lname"type="text" placeholder="Last Name" />
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input name="username"type="text" placeholder="Username (lowercases)" />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input name="password"type="password" placeholder="Password" />
                </div>
                <div class="input-field">
                    <i class="fas fa-calender"></i>
                    <input name="tglLahir"type="date" placeholder="Tanggal Lahir" />
                </div>
                <div class="input-field">
                    <i class="fas fa-venus-mars"></i>
                    <input name="kelamin"type="text" placeholder="Gender (F/M)" />
                </div>
                <input type="submit" class="btn" value="Sign up" />
                <a href="index.php" class="btn2">HOME</a>
            </form>
        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h1>Welcome Back!</h1>
                <p>
                Enter your personal details to order our menu
                </p>
                <button class="btn transparent" id="sign-up-btn">
                    Register
                </button>
            </div>
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>Hello, Friend!</h3>
                <p>
                    Register with your personal details to order our menu
                </p>
                <button class="btn transparent" id="sign-in-btn">
                    Sign in
                </button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>