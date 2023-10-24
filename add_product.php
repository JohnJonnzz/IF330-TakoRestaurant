<?php include("admin_navbar.php"); ?>

<div class="container text-center">
    <h3>Add New Product</h3>
</div>

<div class="container">
    <form action="add_process.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
          <select class="form-select" id="category_id" name="category_id" required>
            <option value="1">Sushi</option>
            <option value="2">Rice</option>
            <option value="3">Noodles</option>
            <option value="4">Drinks</option>
          </select>
        </div>


        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png" required>
        </div>


        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
