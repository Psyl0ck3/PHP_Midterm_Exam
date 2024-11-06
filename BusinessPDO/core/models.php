<?php 
    require_once 'dbConfig.php';

    function insertCategory ($pdo, $category_name, $description) {

        $sql = "INSERT INTO Category (category_name, description) VALUES (?,?)";

        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$category_name, $description]);

        if ($executeQuery) {
            return true;
        }
    }

    function updateCategory ($pdo, $category_name, $Description, $category_id) {

        $sql = "UPDATE Category
				SET category_name = ?,
					description = ?
				WHERE category_id = ?
			";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$category_name, $Description, $category_id]);

        if ($executeQuery) {
            return true;
        }
    }

    function deleteCategory($pdo, $category_id) {
        $deleteCategoryproduct = "DELETE FROM Products WHERE category_id = ?";
        $deleteStmt = $pdo->prepare($deleteCategoryproduct);
        $executeDeleteQuery = $deleteStmt->execute([$category_id]);
    
        if ($executeDeleteQuery) {
            $sql = "DELETE FROM Category WHERE category_id = ?";
            $stmt = $pdo->prepare($sql);
            $executeQuery = $stmt->execute([$category_id]);
    
            if ($executeQuery) {
                return true;
            }
    
        }
        
    }

    function getAllCategory($pdo) {
        $sql = "SELECT * FROM Category";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute();
    
        if ($executeQuery) {
            return $stmt->fetchAll();
        }
    }
    
    function getCategorybyID($pdo, $category_id) {
        $sql = "SELECT * FROM Category WHERE category_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$category_id]);
    
        if ($executeQuery) {
            return $stmt->fetch();
        }
    }

    function getProductsByCategory($pdo, $category_id) {
	
        $sql = "SELECT 
                    products.products_id AS products_id,
                    products.product_name AS product_name,
                    products.price AS price,
                    products.stock AS stock,
                    products.added_by AS added_by,
                    products.last_updated AS last_updated,
                    products.created_by AS created_by,
                    products.updated_by AS updated_by,
                    products.category_id AS category_id
                FROM products
                JOIN category ON products.category_id = category.category_id
                WHERE products.category_id = ? 
                GROUP BY products.products_id;
                ";
    
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$category_id]);
        if ($executeQuery) {
            return $stmt->fetchAll();
        }
    }

    //Products Table CRUD
    function insertProducts($pdo,$product_name, $price, $stock, $category_id) {
    session_start();
    $added_by = $_SESSION['username'];
    $created_by = $added_by;
	$sql = "INSERT INTO Products (product_name, price, stock, category_id, added_by, created_by) VALUES(?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$product_name, $price, $stock, $category_id, $added_by, $created_by]);

        if ($executeQuery) {
            return true;
        }
    }
    function getProductsByID($pdo, $products_id) {
        $sql = "SELECT 
                    products.products_id AS products_id,
                    products.product_name AS product_name,
                    products.price AS price,
                    products.stock AS stock
                FROM products
                JOIN category ON products.category_id = category.category_id
                WHERE products.products_id = ? 
                GROUP BY products.products_id";
        
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$products_id]);
        if ($executeQuery) {
            return $stmt->fetch();
        }
    }
    

    function updateProducts($pdo, $product_name, $price, $stock, $products_id) {
        $updated_by = $_SESSION['username']; 
        $sql = "UPDATE products
                SET product_name = ?,
                    price = ?,
                    stock = ?,
                    updated_by = ?,
                    last_updated = NOW()
                WHERE products_id = ?
                ";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$product_name, $price, $stock, $updated_by, $products_id]);
    
        if ($executeQuery) {
            return true;
        }
    }

    function deleteProducts($pdo, $products_id) {
        $sql = "DELETE FROM products WHERE products_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$products_id]);
        if ($executeQuery) {
            return true;
        }
    }

    function getAllInfoByCategoryID($pdo, $category_id) {
        $sql = "SELECT category_id, category_name, Description FROM Category WHERE category_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$category_id]);
    
        if ($executeQuery) {
            return $stmt->fetch();  // Fetch a single row with the category information
        }
        return null;  // Return null if the query fails
    }
    
//INSERTING NEW USER function 
    function insertNewUser($pdo, $username, $password, $first_name, $last_name, $age, $position) {

        $checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
        $checkUserSqlStmt = $pdo->prepare($checkUserSql);
        $checkUserSqlStmt->execute([$username]);
    
        if ($checkUserSqlStmt->rowCount() == 0) {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $sql = "INSERT INTO user_passwords (username,password, date_added, first_Name, last_name, age, position) VALUES(?,?,NOW(),?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $executeQuery = $stmt->execute([$username, $hashedPassword, $first_name, $last_name, $age, $position]);
    
            if ($executeQuery) {
                $_SESSION['message'] = "User successfully registered";
                return true;
            }else {
                $_SESSION['message'] = "An error occured from the query";
            }
        }
        else {
            $_SESSION['message'] = "User already exists";
        }
    }
    function loginUser($pdo, $username, $password) {
        $sql = "SELECT * FROM user_passwords WHERE username=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]); 
    
        if ($stmt->rowCount() == 1) {
            $userInfoRow = $stmt->fetch(); 
            $passwordFromDB = $userInfoRow['password'];

            // Debug: Print the hashed password from DB and input password for verification
            echo "Password from DB: " . $passwordFromDB . "<br>";
            echo "Input password: " . $password . "<br>";
            
            if (password_verify($password, $passwordFromDB)) {
                $_SESSION['username'] = $userInfoRow['username'];
                $_SESSION['message'] = "Login successful!";
                return true;
            }else {
                $_SESSION['message'] = "Wrong password.";
            }
        } else {
                $_SESSION['message'] = "User not found";
            }return false;

    } 
//GET ALL USERS function 
    function getAllUsers($pdo) {
        $sql = "SELECT * FROM user_passwords";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute();
    
        if ($executeQuery) {
            return $stmt->fetchAll();
        }
    
    }
//GET ALL USER BY ID function 
    function getUserByID($pdo, $user_id) {
        $sql = "SELECT * FROM user_passwords WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$user_id]);
        if ($executeQuery) {
            return $stmt->fetch();
        }
    }
    
    

?>
