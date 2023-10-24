<?php
require_once('db_connect.php');

$Fname = $_POST['Fname'];
$Lname = $_POST['Lname'];
$username = $_POST['username'];
$kelamin = $_POST['kelamin'];
$tglLahir = $_POST['tglLahir'];
$password = $_POST['password'];

if ($Fname === null || $Lname === null || $username === null || $kelamin === null || $tglLahir === null || $password === null) {
    echo '<script>alert("All fields are required. Please fill in all the fields.");</script>';
    echo '<script>window.location = "login.php";</script>';
} else {
    $en_pass = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO user_info (nama_depan, nama_belakang, username, kelamin, tgl_lahir, password) VALUES (?, ?, ?, ?, ?, ?)";
    $result = $db->prepare($sql);
    $result->execute([$Fname, $Lname, $username, $kelamin, $tglLahir, $en_pass]);

    header('Location: login.php');
}
?>
