
<?php

require_once('../util/main.php');
require_once('util/secure_conn.php');

require_once('model/customer_db.php');
require_once('model/address_db.php');
require_once('model/order_db.php');
require_once('model/product_db.php');

require_once('model/fields.php');
require_once('model/validate.php');
require_once('model/search_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view';
    }
}

$validate = new Validate();
$fields = $validate->getFields();

$fields->addField('key');

$key = filter_input(INPUT_POST, 'key');        
$key ='Or';

$product_ids = array(1,8,9);


$products1 = array();
foreach ($product_ids as $product_id) {
    $product = get_product($product_id);
    $products1[] = $product;  
}    

include './search.php';

?>