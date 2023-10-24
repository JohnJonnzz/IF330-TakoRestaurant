<?php
session_start();
require_once('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'];
    $product_name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = '';

    switch ($category_id) {
        case 1:
            $category = 'Sushi';
            break;
        case 2:
            $category = 'Rice';
            break;
        case 3:
            $category = 'Noodles';
            break;
        case 4:
            $category = 'Drinks';
            break;
        default:
            $category = 'Unknown';
    }

    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];

        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $allowed_extensions = array('jpg', 'jpeg', 'png');

        if (in_array($image_extension, $allowed_extensions)) {
            $target_directory = 'Images/';

            $unique_image_name = uniqid('product_') . '.' . $image_extension;

            $target_path = $target_directory . $unique_image_name;

            if (move_uploaded_file($image_tmp_name, $target_path)) {
                $sql = "UPDATE product_list
                        SET category_id = ?, category = ?, name = ?, description = ?, price = ?, img_path = ?
                        WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$category_id, $category, $product_name, $description, $price, $target_path, $_POST['product_id']]);

                header('Location: admin_index.php');
                exit();
            } else {
                echo "Failed to upload the image.";
            }
        } else {
            echo "Please upload a valid image (JPG, JPEG, or PNG).";
        }
    } else {
        echo "Image not provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
