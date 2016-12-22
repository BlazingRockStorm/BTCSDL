<?php
function get_categories() {
    global $db;
    $query = "SELECT *,
                (SELECT COUNT(*)
                 FROM products
                 WHERE Products.categoryid = Categories.categoryid)
                 AS productCount
              FROM categories
              ORDER BY categoryid";
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function get_categoryid($categoryname) {
    global $db;
    $query = "
        SELECT *
        FROM categories
        WHERE categoryname = :categoryname";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryname', $categoryname);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function get_category($category_id) {
    global $db;
    $query = "
        SELECT *
        FROM categories
        WHERE categoryid = :category_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_category($name) {
    global $db;
    $query = "INSERT INTO categories
                 (categoryname)
              VALUES
                 (:name)";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product id that was automatically generated
        $category_id = $db->lastInsertid('categories_categoryid_seq');
        return $category_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_category($category_id, $name) {
    global $db;
    $query = "
        UPDATE categories
        SET categoryname = :name
        WHERE categoryid = :category_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_category($category_id) {
    global $db;
    $query = "DELETE FROM categories WHERE categoryid = :category_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>