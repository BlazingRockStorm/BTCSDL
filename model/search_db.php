<?php 

function get_product_from_key($key) {
    global $db;
    $query = "
        SELECT *
        FROM products 
           WHERE (LOWER(productname) LIKE '%:key%') OR productname = ''";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':key', $key);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>