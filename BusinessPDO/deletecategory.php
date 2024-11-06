<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="categorystyle.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;1,200&display=swap" rel="stylesheet">
<body>
	<a href="index.php">
		<img src="blackglowmuse.png" alt="Logo" href="index.php" style="height: 95px; width: auto; margin-left: 3%;">
	</a>
	<div class="container my-4 fill-up-area">
		<h2>Are you sure you want to delete this make up category?</h2>
		<?php $getCategorybyID = getCategorybyID($pdo, $_GET['category_id']); ?>
		<div class="container">
			<h5>Category Name: <?php echo $getCategorybyID['category_name']; ?></h5>
			<h5>Description: <?php echo $getCategorybyID['Description']; ?></h5>

			<div class="deleteBtn" style="float: right; margin-right: 10px;">
				<form action="core/handleForms.php?category_id=<?php echo $_GET['category_id']; ?>" method="POST">
					<input type="submit" name="deletecategory_btn" value="Delete" class="del_btn">
				</form>			
			</div>	

		</div>
	</div>
</body>
</html>