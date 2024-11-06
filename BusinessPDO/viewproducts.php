<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="viewstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;1,200&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <a href="index.php">
            <img src="blackglowmuse.png" alt="Logo" href="index.php" style="height: 95px; width: auto; margin-left: 3%;">
        </a>
            
        <div class="container my-4 fill-up-area">
            <?php 
            // Fetching category information
            $getAllInfoByCategoryID = getAllInfoByCategoryID($pdo, $_GET['category_id']); 
            ?>
            <div class="row">
                <div class="col-6 justify-content-center align-items-center">
                    <h3>Category ID: <?php echo $getAllInfoByCategoryID['category_id']; ?></h3>
                    <h3>Category Name: <?php echo $getAllInfoByCategoryID['category_name']; ?></h3>
                    <h5>Description: <?php echo $getAllInfoByCategoryID['Description']; ?></h5>
                </div>
                <div class="col-6 justify-content-center align-items-center add-area">
                <h1>Add New Product</h1>
                    <form action="core/handleForms.php?category_id=<?php echo $_GET['category_id']; ?>" method="POST">
                        <label for="product_name">Product Name</label> 
                        <p>
                            <input type="text" name="product_name">
                        </p>
                        <label for="price">Price</label> 
                        <p>
                            <input type="text" name="price">
                        </p>
                        <label for="stock">Stock</label> 
                        <p>
                            <input type="text" name="stock">
                        </p>
                        <input type="submit" name="insertproducts_btn" value="Add Product">
                    </form>
                </div>
            </div>
        </div>

        <?php
        // Check if products_id is set and retrieve the product for editing
        if (isset($_GET['products_id'])) {
            $getProductsByID = getProductsByID($pdo, $_GET['products_id']);
            
            if ($getProductsByID) { // Ensure product was found
                ?>
                <h1>Edit Product</h1>
                <form action="core/handleForms.php?products_id=<?php echo $_GET['products_id']; ?>&category_id=<?php echo $_GET['category_id']; ?>" method="POST">
                    <p>
                        <label for="product_name">Product Name</label> 
                        <input type="text" name="product_name" value="<?php echo $getProductsByID['product_name']; ?>">
                    </p>
                    <p>
                        <label for="price">Price</label> 
                        <input type="text" name="price" value="<?php echo $getProductsByID['price']; ?>">
                    </p>
                    <p>
                        <label for="stock">Stock</label> 
                        <input type="text" name="stock" value="<?php echo $getProductsByID['stock']; ?>">
                    </p>
                    <input type="submit" name="editproducts_btn" value="Edit Product">
                </form>
                <?php
            } else {
                echo "<p>Product not found.</p>";
            }
        } else {
            echo "<p>Please select a product to edit.</p>";
        }
        ?>

        <table style="width:100%; margin-top: 50px; border: 1px solid;">
        <tr style="border: 1px solid;">
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category ID</th>
            <th>Added by</th>
            <th>Last Updated</th>
            <th>Created by</th>
            <th>Updated by</th>
            <th>Options</th>    
        </tr>
        <?php 
        // Fetching products for the category
        $getProductsByCategory = getProductsByCategory($pdo, $_GET['category_id']); 
        foreach ($getProductsByCategory as $row) { 
        ?>
        <tr>
            <td><?php echo $row['products_id']; ?></td>    
            <td><?php echo $row['product_name']; ?></td>                
            <td><?php echo $row['price']; ?></td>      
            <td><?php echo $row['stock']; ?></td>
            <td><?php echo $row['category_id']; ?></td>
            <td><?php echo $row['added_by']; ?></td>
            <td><?php echo $row['last_updated']; ?></td>
            <td><?php echo $row['created_by']; ?></td>
            <td><?php echo $row['updated_by']; ?></td>
            <td>
                <a href="editproducts.php?products_id=<?php echo $row['products_id']; ?>&category_id=<?php echo $_GET['category_id']; ?>">Edit</a>
                <a href="deleteproducts.php?products_id=<?php echo $row['products_id']; ?>&category_id=<?php echo $_GET['category_id']; ?>">Delete</a>
            </td>      
        </tr>
        <?php } ?>
        </table>
    </div>
    
</body>
</html>
