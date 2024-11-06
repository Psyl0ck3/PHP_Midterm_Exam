<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="categorystyle.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;1,200&display=swap" rel="stylesheet">
</head>
<body>
	<a href="index.php">
		<img src="blackglowmuse.png" alt="Logo" href="index.php" style="height: 95px; width: auto; margin-left: 3%;">
	</a>
	<div class="container my-4 fill-up-area align-items-center">
		<a href="viewproducts.php?category_id=<?php echo $_GET['category_id']; ?>" class="viewproducts">
		View The Products</a>
		<h2>Edit the products!</h2>
		<?php $getProductsByID = getProductsByID($pdo, $_GET['products_id']); ?>
		<form action="core/handleForms.php?products_id=<?php echo $_GET['products_id']; ?>
		&category_id=<?php echo $_GET['category_id']; ?>" method="POST">
			<label for="firstName">Product Name</label>
			<p> 
				<input type="text" name="product_name" 
				value="<?php echo $getProductsByID['product_name']; ?>">
			</p>
			<label for="firstName">Price</label> 
			<p>
				<input type="text" name="price" 
				value="<?php echo $getProductsByID['price']; ?>">
			</p>
			<label for="firstName">Stock</label>
			<p> 
				<input type="text" name="stock" 
				value="<?php echo $getProductsByID['stock']; ?>">
			</p>
			<input type="submit" name="editproducts_btn" class="btn">
		</form>
	</div>
</body>
</html>