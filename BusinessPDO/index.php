<?php 
	require_once 'core/dbConfig.php';
	require_once 'core/models.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="indexstyle.css?v=1.2">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;1,200&display=swap" rel="stylesheet">
</head>
<body>
	<!-- Navbar -->
    <!-- Sidebar -->
    <div class="sidebar">
		<img src="blackglowmuse.png" alt="Logo" style="height: 155px; width: auto; margin-left: 3%;">
        <a class="navbar-brand" href="#">Glowmuse Cosmetics Inventory System</a>
		<?php if (isset($_SESSION['message'])) { ?>
		<h2 style="color: red;"><?php echo $_SESSION['message']; ?></h2>
		<?php } unset($_SESSION['message']); ?>

		<?php if (isset($_SESSION['username'])) { ?>
			<h2>Welcome, <?php echo ($_SESSION['username']); ?></h2>
		<?php } else { echo "<h3>No user logged in</h3>";}?>

		<div class="users-list-container">
			<h4 class="users-header">Users List</h4>
			<ul class="users-list">
				<?php $getAllUsers = getAllUsers($pdo); ?>
				<?php foreach ($getAllUsers as $row) { ?>
					<li class="user-item">
						<a href="viewuser.php?user_id=<?php echo $row['user_id']; ?>">
							<?php echo $row['username']; ?>
						</a>
					</li>
				<?php } ?>
			</ul>
			<form action="core/handleForms.php?logoutAUser=1" method="POST">
				<button name="logoutBtn" class="logout-button">Logout</button>
			</form>
		</div>

    </div>
	<div class="main-content">
		<div class="container my-4">
			<div class="row justify-content-center fill-up-area">
				<div class="col-12 text-center">
					<h1 style="font-weight: 1000; font-size: 5vh;">Glowmuse Inc. Cosmetics Inventory System</h1>
				</div>
				<form action="core/handleForms.php" method="POST" class="col-8 d-flex flex-column align-items-center">
					<div class="d-flex gap-3">
						<div class="form-group">
							<label for="category_name" class="form-label">Category Name</label>
							<input type="text" name="category_name" class="form-control" id="category_name" style="width: 250px;">
						</div>
						<div class="form-group">
							<label for="Description" class="form-label">Description</label>
							<input type="text" name="Description" class="form-control" id="Description" style="width: 250px;">
						</div>
					</div>
					<div class="row mt-4 justify-content-center">
						<div class="col-auto">
							<input type="submit" name="insertcategory_btn" class="btn-submit" value="Submit">
						</div>
					</div>
				</form>
			</div>
		</div>


		<div class="container my-4">
			<div class="row">
				<?php $getAllCategory = getAllCategory($pdo); ?>
				<?php foreach ($getAllCategory as $row) { ?>
					<div class="col-md-4 mb-4">
						<div class="category-box">
							<div class="category-title">
								<?php echo $row['category_name']; ?>
							</div>
							<div class="category-content">
								<p>Description: <?php echo $row['Description']; ?></p>
								<div class="editAndDelete">
									<a href="viewproducts.php?category_id=<?php echo $row['category_id']; ?>" class="view">View Products</a>
									<a href="editcategory.php?category_id=<?php echo $row['category_id']; ?>" class="edit">Edit</a>
									<a href="deletecategory.php?category_id=<?php echo $row['category_id']; ?>" class="delete">Delete</a>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

	</div>	

	
</body>
</html>