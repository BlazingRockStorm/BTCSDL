<?php
function is_valid_customer_email($email) {
    global $db;
    $query = "
        SELECT customerid FROM customers
        WHERE emailaddress = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function is_valid_customer_login($email, $password) {
    global $db;
    $password = sha1($email . $password);
    $query = "
        SELECT * FROM customers
        WHERE emailaddress = :email AND password = :password";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}
function get_all_customer() {
    global $db;
    $query = "SELECT * FROM customers ORDER BY customerid";
    $statement = $db->prepare($query);
    $statement->execute();
    $customer = $statement->fetchAll();
    $statement->closeCursor();
    return $customer;
}
function get_customer($customer_id) {
    global $db;
    $query = "SELECT * FROM customers WHERE customerid = :customer_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

function get_customer_by_email($email) {
    global $db;
    $query = "SELECT * FROM customers WHERE emailaddress = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}


function add_customer($email, $name, 
                      $password_1) {
    global $db;
    $password = sha1($email . $password_1);
    $query = "
        INSERT INTO customers (name, password, emailaddress)
        VALUES (:name, :password, :email)";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $customer_id = $db->lastInsertid('customers_customerid_seq');
    $statement->closeCursor();
    return $customer_id;
}

function update_customer($customer_id, $email, $name,
                      $password_1, $password_2) {
    global $db;
    if (!empty($password_1) && !empty($password_2)) {
        $password = sha1($email . $password_1);
    }
    $query = "
        UPDATE customers
        SET emailaddress = :email,
            name = :name,
            password = :password
        WHERE customerid = :customer_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $statement->closeCursor();
}

function get_address($customer_id) {					  
	global $db;
	$query = "SELECT * FROM addresses WHERE customerid = :customerid";
	$statement = $db->prepare($query);
	$statement->bindValue(':customerid',$customer_id);
	$statement->execute();
	$address = $statement->fetch();
	$statement->closeCursor();
	return 	$address;				  
}

function delete_customer($customerid) {					  
	global $db;
	$query = "DELETE FROM orders WHERE customerid = :customerid";
	$statement = $db->prepare($query);
	$statement->bindValue(':customerid',$customerid);
	$statement->execute();
	$query = "DELETE FROM addresses WHERE customerid = :customerid";
	$statement = $db->prepare($query);
	$statement->bindValue(':customerid',$customerid);
	$statement->execute();
	$query = "DELETE FROM customers WHERE customerid = :customerid";
	$statement = $db->prepare($query);
	$statement->bindValue(':customerid',$customerid);
	$statement->execute();
	$statement->closeCursor();		  
}														  
?>