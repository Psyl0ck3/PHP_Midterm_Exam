<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
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
	<div class="container my-4 fill-up-area">
		<h1>Are you sure you want to delete this product?</h1>
		<div class="container">
			<?php $getProductsByID = getProductsByID($pdo, $_GET['products_id']); ?>
			<h2>Product Name: <?php echo $getProductsByID['product_name'] ?></h2>
			<h2>Price: <?php echo $getProductsByID['price'] ?></h2>
			<h2>Stock: <?php echo $getProductsByID['stock'] ?></h2>

			<div class="deleteBtn" style="float: right; margin-right: 10px;">

				<form action="core/handleForms.php?products_id=<?php echo $_GET['products_id']; ?>&category_id=<?php echo $_GET['category_id']; ?>" method="POST">
					<input type="submit" name="deleteProductBtn" value="Delete" class="del_btn">
				</form>			
				
			</div>	

		</div>
	</div>
</body>
</html>