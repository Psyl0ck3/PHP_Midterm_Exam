CREATE TABLE products (
    products_id INT PRIMARY KEY AUTO_INCREMENT, 
    product_name VARCHAR(100),
    category_name VARCHAR(100),
    price INT, 
    stock INT,
    category_id INT
);

CREATE TABLE category (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(100),
    Description VARCHAR(255)
);