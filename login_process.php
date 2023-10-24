<?php
session_start();
require_once('db_connect.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM `user_info`
        WHERE username = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$username]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    echo "User not found.";
} else {
    if ($username === "admin") {
        if (password_verify($password, $row['password'])) {
            header('location: admin_index.php');
        } else {
            echo "<script>alert('Password is incorrect for admin.'); window.location.href = 'login.php';</script>";
        }
    } else {
        if (password_verify($password, $row['password'])) {
            if (isset($_SESSION['captcha']) && isset($_POST['captcha'])) {
                $userCaptcha = $_POST['captcha'];
                $generatedCaptcha = $_SESSION['captcha'];

                if (strtolower($userCaptcha) === strtolower($generatedCaptcha)) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    header('location: index.php');
                } else {
                    echo "<script>alert('CAPTCHA is incorrect.'); window.location.href = 'login.php';</script>";
                }
            } else {
                echo "<script>alert('CAPTCHA verification failed.'); window.location.href = 'login.php';</script>";
            }
        } else {
            echo "<script>alert('Password is incorrect.'); window.location.href = 'login.php';</script>";
        }
    }
}
