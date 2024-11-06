<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="login.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;1,200&display=swap" rel="stylesheet">
</head>
<body>
	<?php 
		if (isset($_SESSION['message'])) { ?>
			<h1 style="color: red;"><?php echo $_SESSION['message']; } ?></h1>
	
	<?php 
			unset($_SESSION['message']); 
	?>
	<div class="container">
			<div class="row">
				<div class="register-content container">
				<form action="core/handleForms.php" method="POST">
				<a href="login.php">
					<img src="blackglowmuse.png" alt="Logo" href="login.php" style="height: 95px; width: auto; margin-left: 3%;">
				</a>
				<h2>Register here!</h2>	
				<label for="username">Username</label>
				<p>
					<input type="text" class="inputfields" name="username">
				</p>
				<label for="username">Password</label>
				<p>
					<input type="password" class="inputfields" name="password">
				</p>
				<label for="username">First Name</label>
				<p>
					<input type="text"class="inputfields"  name="first_name">
				</p>
				<label for="username">Last Name</label>
				<p>
					<input type="text" class="inputfields" name="last_name">
				</p>
				<label for="username">Age</label>
				<p>
					<input type="text" class="inputfields" name="age">
				</p>
				<label for="username">position</label>
				<p>
					<input type="text" class="inputfields" name="position">
				</p>
				<input type="submit" class="btn" name="registerUserBtn">
			</form>
				</div>
			</div>
		</div>
</body>
</html>