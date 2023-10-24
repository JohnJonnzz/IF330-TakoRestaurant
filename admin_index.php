<?php
include("admin_navbar.php");
?>

<div class="container text-center">
    <h3>MENU TABLE</h3>
    <br />
    <a href="add_product.php"><button class="btn btn-primary">ADD NEW PRODUCTS</button></a>
</div>

<?php
$sql = "SELECT pl.id, 
               pl.name, 
               pl.category_id,
               CASE pl.category_id
                 WHEN 1 THEN 'Sushi'
                 WHEN 2 THEN 'Rice'
                 WHEN 3 THEN 'Noodles'
                 WHEN 4 THEN 'Drinks'
                 ELSE 'Unknown'
               END AS category_name,
               pl.price, 
               pl.description 
        FROM product_list pl";

$stmt = $db->query($sql);

if ($stmt->rowCount() > 0) {
    echo '<table class="table table-striped table-info text-center table-bordered" style="width: 100%; margin-top: 20px">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>';

    $count = 1;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>
                <th scope="row">' . $count . '</th>
                <td>' . $row['name'] . '</td>
                <td>' . $row['category_name'] . '</td>
                <td>' . $row['price'] . '</td>
                <td>' . $row['description'] . '</td>
                <td>
                <a class="btn btn-warning" href="edit_product.php?id=' . $row['id'] . '">EDIT</a>
                    <form method="POST" action="delete_product.php">
                        <input type="hidden" name="product_id" value="' . $row['id'] . '">
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                </td>
            </tr>';

        $count++;
    }

    echo '</tbody></table>';
} else {
    echo '<p>No products found.</p>';
}
?>
