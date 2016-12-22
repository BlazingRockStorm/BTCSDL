<?php 

function get_product_from_key($key) {
    global $db;
	//$key = 'or';
	//$key_new = 'or';
    $query = "
        SELECT *
        FROM products 
           WHERE LOWER(productname) LIKE '%$key%'";
    try {
        $statement = $db->prepare($query);
        //$statement->bindValue(':key', $key);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function search_from_skills($key) {
    global $db;
	//$key = 'or';
	//$key_new = 'or';
    $query = "
        SELECT *
        FROM skills 
           WHERE skill LIKE '%$key%'";
    try {
        $statement = $db->prepare($query);
        //$statement->bindValue(':key', $key);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>