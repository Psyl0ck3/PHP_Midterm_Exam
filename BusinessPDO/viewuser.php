<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View user</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="login.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;1,200&display=swap" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="view-user">
		<a href="index.php">
			<img src="blackglowmuse.png" alt="Logo" href="index.php" style="height: 95px; width: auto; margin-left: 3%;">
		</a>
            <h2 class="mb-4">User Details</h2>
            <table class="table table-bordered table-striped">
                <tbody>
                    <?php 
                    $getUserByID = getUserByID($pdo, $_GET['user_id']); 
                    ?>
                    <tr>
                        <th>Username</th>
                        <td><?php echo htmlspecialchars($getUserByID['username']); ?></td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td><?php echo htmlspecialchars($getUserByID['first_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><?php echo htmlspecialchars($getUserByID['last_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><?php echo htmlspecialchars($getUserByID['age']); ?></td>
                    </tr>
                    <tr>
                        <th>Position</th>
                        <td><?php echo htmlspecialchars($getUserByID['position']); ?></td>
                    </tr>
                    <tr>
                        <th>Date Joined</th>
                        <td><?php echo htmlspecialchars($getUserByID['date_added']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>