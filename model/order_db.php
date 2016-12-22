<?php

// This function calculates a shipping charge of $5 per item
// but it only charges shipping for the first 5 items
function shipping_cost() {
    $item_count = cart_item_count();
    $item_shipping = 5;   // $5 per item
    if ($item_count > 5) {
        $shipping_cost = $item_shipping * 5;
    } else {
        $shipping_cost = $item_shipping * $item_count;
    }
    return $shipping_cost;
}

// This function calcualtes the sales tax,
// but only for orders in California (CA)
/*function tax_amount($subtotal) {
    $shipping_address = get_address($_SESSION['user']['shipAddressid']);
    $state = $shipping_address['state'];
    $state = strtoupper($state);
    switch ($state) {
        case 'CA': $tax_rate = 0.09; break;
        default: $tax_rate = 0; break;
    }
    return round($subtotal * $tax_rate, 2);
}*/

function card_name($card_type) {
    switch($card_type){
        case 1: 
           return 'MasterCard';
        case 2: 
            return 'Visa';
        case 3: 
            return 'Discover';
        case 4:
            return 'American Express';
        default:
            return 'Unknown Card Type';
    }
}

function add_order($price) {
    global $db;
    $customer_id = $_SESSION['user']['customerid'];
    //$billing_id = $_SESSION['user']['billingAddressid'];
    //$shipping_id = $_SESSION['user']['shipAddressid'];
    $shipping_cost = shipping_cost();
    //$tax = tax_amount(cart_subtotal());
    //$order_date = date("Y-m-d H:i:s");

    $query = "
         INSERT INTO orders (customerid, orderdate, price)
         VALUES (:customer_id, NOW(), :price)";
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $order_id = $db->lastInsertid('orders_orderid_seq');
    $statement->closeCursor();
    return $order_id;
}

function add_order_item($order_id, $product_id,
                         $quantity) {
    global $db;
    $query = "
        INSERT INTO orderitems (orderid, productid, quantity)
        VALUES (:order_id, :product_id, :quantity)";
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $statement->closeCursor();
}

function get_all_order() {
    global $db;
    $query = "SELECT * FROM orders ";
    $statement = $db->prepare($query);
    $statement->execute();
    $order = $statement->fetchAll();
    $statement->closeCursor();
    return $order;
}

function get_orders_by_customerid($customerid) {
    global $db;
    $query = "SELECT * FROM orders WHERE customerid = :customerid";
    $statement = $db->prepare($query);
    $statement->bindValue(':customerid', $customerid);
    $statement->execute();
    $order = $statement->fetchAll();
    $statement->closeCursor();
    return $order;
}

function get_last_time_order_customerid($customerid) {
    global $db;
    $query = "SELECT price FROM orders WHERE customerid = :customerid AND (orderdate >= ALL(SELECT orderdate FROM orders WHERE customerid = :customerid))";
    $statement = $db->prepare($query);
    $statement->bindValue(':customerid', $customerid);
    $statement->execute();
    $date = $statement->fetch();
    $statement->closeCursor();
    return $date;
}

function get_sum_order_by_customerid($customerid) {
    global $db;
    $query = "SELECT SUM(price) FROM orders WHERE customerid = :customerid";
    $statement = $db->prepare($query);
    $statement->bindValue(':customerid', $customerid);
    $statement->execute();
	$sum = $statement->fetch();
    $statement->closeCursor();
    return $sum;
}

function get_order($order_id) {
    global $db;
    $query = "SELECT * FROM orders WHERE orderid = :order_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $order = $statement->fetch();
    $statement->closeCursor();
    return $order;
}

function get_order_items($order_id) {
    global $db;
    $query = "SELECT * FROM orderitems WHERE orderid = :order_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $order_items = $statement->fetchAll();
    $statement->closeCursor();
    return $order_items;
}

function get_orders_by_customer_id($customer_id) {
    global $db;
    $query = "SELECT * FROM orders WHERE customerid = :customer_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $order = $statement->fetchAll();
    $statement->closeCursor();
    return $order;
}

function get_unfilled_orders() {
    global $db;
    $query = "SELECT * FROM orders
              INNER JOIN customers
              ON customers.customerid = orders.customerid
              WHERE shipDate IS NULL ORDER BY orderDate";
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}

function get_filled_orders() {
    global $db;
    $query =
        "SELECT * FROM orders
         INNER JOIN customers
         ON customers.customerid = orders.customerid
         WHERE shipDate IS NOT NULL ORDER BY orderDate";
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}

function set_ship_date($order_id) {
    global $db;
    $ship_date = date("Y-m-d H:i:s");
    $query = "
         UPDATE orders
         SET shipDate = :ship_date
         WHERE orderid = :order_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':ship_date', $ship_date);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_order($order_id) {
    global $db;
    $query = "DELETE FROM orders WHERE orderid = :order_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_orderitem($orderid) {
    global $db;
    $query = "DELETE FROM orderitems WHERE orderid = :orderid";
    $statement = $db->prepare($query);
    $statement->bindValue(':orderid', $orderid);
    $statement->execute();
    $statement->closeCursor();
}
?>