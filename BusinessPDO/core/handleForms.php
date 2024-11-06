<?php
require_once 'dbConfig.php'; 
require_once 'models.php';
//one 
if (isset($_POST['insertcategory_btn'])) {

	$query = insertCategory($pdo, $_POST['category_name'], $_POST['Description']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}


if (isset($_POST['editcategory_btn'])) {
	$query = updateCategory($pdo, $_POST['category_name'], $_POST['description'], 
    $_POST['category_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}


if (isset($_POST['deletecategory_btn'])) {
	$query = deleteCategory($pdo, $_GET['category_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}



//many

if (isset($_POST['insertproducts_btn'])) {
	$query = insertProducts($pdo, 
	$_POST['product_name'], 
	$_POST['price'],
	$_POST['stock'], 
	 $_GET['category_id']);

	if ($query) {
		header("Location: ../viewproducts.php?category_id=" .$_GET['category_id']);
	}
	else {
		echo "Insertion failed";
	}
}

if (isset($_POST['insertNewproducts_btn'])) {
	$query = insertProducts($pdo, 
	$_POST['product_name'], 
	$_POST['price'],
	$_POST['stock'], 
	 $_GET['category_id']);

	if ($query) {
		header("Location: ../viewproducts.php?category_id=" .$_GET['category_id']);
	}
	else {
		echo "Insertion failed";
	}
}


if (isset($_POST['editproducts_btn'])) {
	$query = updateProducts($pdo, $_POST['product_name'], $_POST['price'], $_POST['stock'],$_GET['products_id']);

	if ($query) {
		header("Location: ../viewproducts.php?category_id=" .$_GET['category_id']);
	}
	else {
		echo "Update failed";
	}

}

if (isset($_POST['deleteProductBtn'])) {
	$query = deleteProducts($pdo, $_GET['products_id']);

	if ($query) {
		header("Location: ../viewproducts.php?category_id=" .$_GET['category_id']);
	}
	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $position = $_POST['position'];

	if (!empty($username) && !empty($password)) {

		$insertQuery = insertNewUser($pdo, $username, $password, $first_name, $last_name, $age, $position);

        if ($insertQuery) {
			header("Location: ../login.php");
		} else {
			header("Location: ../register.php");
		}
    }

	else {
		$_SESSION['message'] = "Empty input fields.";
		header("Location: ../login.php");
	}
}

if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../index.php");
			 exit();
		}
		else {
			header("Location: ../login.php");
			exit();
		}
	}
	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../login.php");
	}
 
}

if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}

?>