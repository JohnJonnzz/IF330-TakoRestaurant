<?php
include("admin_navbar.php");
require_once('db_connect.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM product_list WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo '<div class="container text-center">
                <h3>Edit Product</h3>
              </div>
              <div class="container">
                <form action="update_product.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="' . $product['id'] . '">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="name" value="' . $product['name'] . '" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="1" ' . ($product['category_id'] == 1 ? 'selected' : '') . '>Sushi</option>
                            <option value="2" ' . ($product['category_id'] == 2 ? 'selected' : '') . '>Rice</option>
                            <option value="3" ' . ($product['category_id'] == 3 ? 'selected' : '') . '>Noodles</option>
                            <option value="4" ' . ($product['category_id'] == 4 ? 'selected' : '') . '>Drinks</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="' . $product['price'] . '" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>' . $product['description'] . '</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
              </div>';
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid request.";
}
?>
