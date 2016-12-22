<?php 
require_once('../util/main.php');
require_once('../util/secure_conn.php');
require_once('util/secure_conn.php');
require_once('model/category_db.php');
require_once('model/customer_db.php');
require_once('model/address_db.php');
require_once('model/order_db.php');
require_once('model/product_db.php');

require_once('model/fields.php');
require_once('model/validate.php');
	
$choice = filter_input(INPUT_POST, 'choice');
if ($choice == NULL) {
    $choice = filter_input(INPUT_GET, 'choice');
    if ($choice == NULL) {        
        $choice = 'view_list_function';
    }
}



$validate = new Validate();
$fields = $validate->getFields();

// for the Registration page and other pages
$fields->addField('category_id');
$fields->addField('category');
$fields->addField('name');
$fields->addField('del_name');
$fields->addField('description');
$fields->addField('price');
$fields->addField('discount_percent');
$fields->addField('country');
$fields->addField('branch');
$fields->addField('emlink');

switch($choice){
	case 'view_list_function':
		include './admin.php';
		break;
	case 'view_pro':
		
		include 'viewproduct.php';
		break;
	case 'add_pro':
		$category = '';
		$name = '';
		$description = '';
		$price = '';
		$discount_percent = '';
		$country = '';
		$branch = '';
		include 'addproduct.php';
		break;
	case 'add_product':
		$category = filter_input(INPUT_POST, 'category');
		echo $category;
		echo '12';
		$name = filter_input(INPUT_POST, 'name');
		$description = filter_input(INPUT_POST, 'description');
		$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
		$discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_FLOAT);
		$country = filter_input(INPUT_POST, 'country');
		$branch = filter_input(INPUT_POST, 'branch');
		$emlink = filter_input(INPUT_POST, 'emlink');;
        // Validate inputs
        if (empty($name) || empty($description) ||
            $price === false || $discount_percent === false) {
            $error = 'Invalid product data.
                      Check all fields and try again.';
            
        } else {
			$category = get_categoryid($category);
			echo $category['categoryid'];
            //$categories = get_categories();
            $product_id = add_product($category['categoryid'], $name,
                    $description, $price, $discount_percent,$country,$branch,$emlink);
            //$product = get_product($product_id);
		}
		redirect('.');
		break;
	case 'del_pro':
		$name = '';
		include 'delproduct.php';
		break;
	case 'del_product':
		$name = filter_input(INPUT_POST, 'del_name');
		$validate->text('del_name', $name);   
		//echo $name;
		delete_product_by_name($name);
		//echo '1'.$name;
		redirect('.');
		break;
	case 'manage_order':
		include 'manage_order.php';
		break;
	case 'manage_customer':
		include 'manage_customer.php';
		break;
	case 'delete_customer':
		$customerid = filter_input(INPUT_GET, 'customer_id',FILTER_VALIDATE_INT);
		//echo $customerid;
		$orders = get_orders_by_customerid($customerid);
		foreach($orders as $order){
			delete_orderitem($order['orderid']);
		}
		delete_customer($customerid);
		redirect('./');
		break;
	default:
		break;
	
}


	
?>