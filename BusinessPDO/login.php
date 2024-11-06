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
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="login-content col-12">
				<img src="blackglowmuse.png" alt="">
				<?php if (isset($_SESSION['message'])) { ?>
				<p style="color: white; background-color: #471823;"><?php echo $_SESSION['message']; ?></p>
				<?php } unset($_SESSION['message']); ?>
				<h2>Login</h2>
				<form action="core/handleForms.php" method="POST">
					<label for="username">Username</label>
					<p>
						<input type="text" class="inputfields" name="username">
					</p>
					<label for="username">Password</label>
					<p>
						<input type="password" class="inputfields" name="password">
					</p>
					<input type="submit" class="btn" name="loginUserBtn">
				</form>
				<p>Don't have an account? You may register <a href="register.php">here</a></p>
			</div>
		</div>
	</div>
</body>
</html>