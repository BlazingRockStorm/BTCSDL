<?php
function add_address($customerid, $city, $district,$street ,$zip_code, $phone) {
    global $db;
    $query = "
        INSERT INTO addresses ( 
                               city, district, street,zipcode, phone,customerid)
        VALUES ( 
                :city, :district, :street,:zip_code, :phone,:customerid)";
    $statement = $db->prepare($query);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':district', $district);
	$statement->bindValue(':street', $street);
    $statement->bindValue(':zip_code', $zip_code);
    $statement->bindValue(':phone', $phone);
	$statement->bindValue(':customerid', $customerid);
    $statement->execute();
    $address_id = $db->lastInsertId('addresses_addressid_seq');
    $statement->closeCursor();
    return $address_id;
}

/*function get_address($address_id) {
    global $db;
    $query = "SELECT * FROM addresses WHERE addressid = :address_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':address_id', $address_id);
    $statement->execute();
    $address = $statement->fetch();
    $statement->closeCursor();
    return $address;
}*/

function update_address ($address_id, 
                         $city, $district,$street, $zip_code, $phone,$customerid) {
    global $db;
    $query = "
        UPDATE addresses
        SET 
            city = :city,
			district = :district,
            street = :street,
            zipcode = :zip_code,
            phone = :phone,
			customerid = :customerid
        WHERE addressid = :address_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':address_id', $address_id);
    $statement->bindValue(':city', $city);
	$statement->bindValue(':district', $district);
    $statement->bindValue(':street', $street);
    $statement->bindValue(':zip_code', $zip_code);
    $statement->bindValue(':phone', $phone);
	$statement->bindValue(':customerid', $customerid);
    $statement->execute();
    $statement->closeCursor();
}

function disable_or_delete_address($address_id) {
    global $db;
    if (is_used_address_id($address_id)) {
        $query = "UPDATE addresses SET disabled = 1 WHERE addressid = :address_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":address_id", $address_id);
        $statement->execute();
        $statement->closeCursor();
    } else {
        $query = "DELETE FROM addresses WHERE addressid = :address_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":address_id", $address_id);
        $statement->execute();
        $statement->closeCursor();
    }
}

function is_used_address_id($address_id) {
    global $db;

    // Check if the address is used as a billing address
    $query1 = "SELECT COUNT(*) FROM orders WHERE billingAddressid = :value";
    $statement1 = $db->prepare($query1);
    $statement1->bindValue(':value', $address_id);
    $statement1->execute();
    $result1 = $statement1->fetch();
    $billing_count = $result1[0];
    $statement1->closeCursor();
    if ($billing_count > 0) { return true; }

    // Check if the address is used as a shipping address
    $query2 = "SELECT COUNT(*) FROM orders WHERE shipAddressid = :value";
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':value', $address_id);
    $statement2->execute();
    $result2 = $statement2->fetch();
    $ship_count = $result2[0];
    $statement2->closeCursor();
    if ($ship_count > 0) { return true; }

    return false;
}

?>