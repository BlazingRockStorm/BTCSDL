<?php
function get_products_by_category($category_id) {
    global $db;
    $query = "
        SELECT *
        FROM products p
           INNER JOIN categories c
           ON p.categoryid = c.categoryid
        WHERE p.categoryid = :category_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}


function delete_product_by_name($productname){
	global $db;
	$query = "DELETE FROM products WHERE productname = :productname";
	try{
		$statement = $db->prepare($query);
		$statement->bindValue(':productname', $productname);
		$statement->execute();
		$statement->closeCursor();
	}catch (PDOException $e) {
		$error_message = $e->getMessage();
		display_db_error($error_message);
	}
}
function get_all_products(){
	global $db;
	$query = "SELECT * FROM products ORDER BY productid ASC";
	try{
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}catch (PDOException $e) {
		$error_message = $e->getMessage();
		display_db_error($error_message);
	}
}

function get_product($product_id) {
    global $db;
    $query = "
        SELECT *
        FROM products p
           INNER JOIN categories c
           ON p.categoryid = c.categoryid
       WHERE productid = :product_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_product_order_count($product_id) {
    global $db;
    $query = "
        SELECT COUNT(*) AS orderCount
        FROM orderitems
        WHERE productid = :product_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $product = $statement->fetch();
        $order_count = $product['orderCount'];
        $statement->closeCursor();
        return $order_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_product($category_id, $name, $description,
        $price, $discount_percent,$country,$branch,$emlink) {
    global $db;
    $query = "INSERT INTO products
                 (categoryid, productname, description, price,
                  discountpercent, dateadded,country,branch,emlink)
              VALUES
                 (:category_id, :name, :description, :price,
                  :discount_percent, NOW(),:country,:branch,:emlink)";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':discount_percent', $discount_percent);
        $statement->bindValue(':country', $country);
        $statement->bindValue(':branch', $branch);
        $statement->bindValue(':emlink', $emlink);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product id that was automatically generated
        $product_id = $db->lastInsertid('products_productid_seq');
        return $product_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_product($product_id, $name, $description,
                        $price, $discount, $category_id,$country,$branch,$emlink) {
    global $db;
    $query = "
        UPDATE Products
        SET productName = :name,
            description = :description,
            Price = :price,
            discountPercent = :discount,
            country = :country,
            branch = :branch,
            emlink = :emlink,
            categoryid = :category_id
        WHERE productid = :product_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':discount', $discount);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':country', $country);
        $statement->bindValue(':branch', $branch);
        $statement->bindValue(':emlink', $emlink);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_product($product_id) {
    global $db;
    $query = "DELETE FROM products WHERE productid = :product_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>