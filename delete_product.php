<?php
session_start();
require_once('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM product_list WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$product_id]);

    header('Location: admin_index.php');
    exit();
} else {
    echo "Invalid request.";
}
?>
