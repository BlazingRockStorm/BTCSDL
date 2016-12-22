<?php
require_once('../util/main.php');
require_once('util/secure_conn.php');

require_once('model/customer_db.php');
require_once('model/address_db.php');
require_once('model/order_db.php');
require_once('model/product_db.php');

require_once('model/fields.php');
require_once('model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_login';
        if (isset($_SESSION['user'])) {
            $action = 'view_account';
        }
    }
}

// Set up all possible fields to validate
$validate = new Validate();
$fields = $validate->getFields();

// for the Registration page and other pages
$fields->addField('email');
$fields->addField('password_1');
$fields->addField('password_2');
$fields->addField('name');


$fields->addField('city');
$fields->addField('district');
$fields->addField('street');
$fields->addField('zipcode');
$fields->addField('phone');


// for the Login page
$fields->addField('password');

// for the Edit Address page


switch ($action) {
    case 'view_register':
        // Clear user data
        $email = '';
        $name = '';
        $city = '';
		$district = '';
        $street = '';
        $zipcode = '';
        $phone = '';
        include 'register.php';
        break;
    case 'register':
        // Store user data in local variables
        $email = filter_input(INPUT_POST, 'email');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');
        $name = filter_input(INPUT_POST, 'name');
        //$city = filter_input(INPUT_POST, 'city');
		//$district = filter_input(INPUT_POST, 'district');
        //$street = filter_input(INPUT_POST, 'street');
        //$zipcode = filter_input(INPUT_POST, 'zipcode');
        //$phone = filter_input(INPUT_POST, 'phone');    
        $city = ' ';
		$district = ' ';
        $street = ' ';
        $zipcode = ' ';
        $phone = ' ';
        // Validate user data       
        $validate->email('email', $email);
        $validate->text('password_1', $password_1, true, 6, 30);
        $validate->text('password_2', $password_2, true, 6, 30);        
        $validate->text('name', $name);       
        //$validate->text('city', $city);   
		//$validate->text('district', $district);  		
        //$validate->text('street', $street);        
        //$validate->text('zipcode', $zipcode);        
        //$validate->text('phone', $phone, false);        
        
        
        

        // If validation errors, redisplay Register page and exit controller
        if ($fields->hasErrors()) {
            include 'account/register.php';
            break;
        }

        // If passwords don't match, redisplay Register page and exit controller
        if ($password_1 !== $password_2) {
            $password_message = 'Passwords do not match.';
            include 'account/register.php';
            break;
        }

        // Validate the data for the customer
        if (is_valid_customer_email($email)) {
            display_error('The e-mail address ' . $email . ' is already in use.');
        }
        
        

        $customer_id = add_customer($email, $name, $password_1);
        //$address_id = add_address($customer_id,$city, $district,$street ,$zipcode, $phone);
		//$customer_id = add_customer($email, $name, $password_1,$address_id);
        

        

        // Store user data in session
        $_SESSION['user'] = get_customer($customer_id);
        
        // Redirect to the Checkout application if necessary
		if (isset($_SESSION['checkout'])) {
            unset($_SESSION['checkout']);
            redirect('../checkout');
        } else {
            redirect('.');
        }        
        
        break;
    case 'view_login':
        // Clear login data
        $email = '';
        $password = '';
        $password_message = '';
        
        include './login.php';
        break;
    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        //echo '                        '.$email.'   '.$password;
		//$email = $_POST('email');
		//$password = $_POST('password');
        // Validate user data
        $validate->email('email', $email);
        $validate->text('password', $password, true, 6, 30);        

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'account/login.php';
            break;
        }
		//echo '                        '.$email.$password;
		
        $email_user = 'vankhanhbk14@gmail.com';
		$password_1_user = 'admiral1996';
		//if($email == $email_user && $password == $password_1_user)echo 'Good job';
        // Check email and password in database
		if($email == 'admin@guitarshop.com' && $password = 'admiral1996'){
			$_SESSION['user'] = get_customer_by_email($email);
			//$_SESSION['user']['email']
			//include 'admin/admin.php';
		}else if (is_valid_customer_login($email, $password)) {
            $_SESSION['user'] = get_customer_by_email($email);
        } else {
            $password_message = 'Login failed. Invalid email or password.';
			//echo '                        '.$email.$password;
            include 'account/login.php';
            break;
        }
		
        // If necessary, redirect to the Checkout app
        // Redirect to the Checkout application
        if (isset($_SESSION['checkout'])) {
            unset($_SESSION['checkout']);
            redirect('../checkout');
        } else {
            redirect('.');
        }        
        break;
    case 'view_account':
        $customer_name = $_SESSION['user']['name'];
                         
        $email = $_SESSION['user']['emailaddress'];        
		//echo $_SESSION['user']['customerid'];
        $address = get_address($_SESSION['user']['customerid']);
        //echo '123';

        $orders = get_orders_by_customer_id($_SESSION['user']['customerid']);
        if (!isset($orders)) {
            $orders = array();
        }        
        include 'account_view.php';
        break;
    case 'view_order':
        $order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
        $order = get_order($order_id);
        $order_date = strtotime($order['orderdate']);
        $order_date = date('M j, Y', $order_date);
        $order_items = get_order_items($order_id);

        $address = get_address($order['customerid']);
        
        
        include 'account_view_order.php';
        break;
    case 'view_account_edit':
        $email = $_SESSION['user']['emailaddress'];
        $name = $_SESSION['user']['name'];
        
        $address_id = get_address($_SESSION['user']['customerid']);
        

        $password_message = '';        

        include 'account_edit.php';
        break;
    case 'update_account':
        // Get the customer data
        $customer_id = $_SESSION['user']['customerid'];
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $name = filter_input(INPUT_POST, 'name');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');
        $password_message = '';

        // Get the old data for the customer
        $old_customer = get_customer($customer_id);

        // Validate user data
        $validate->email('email', $email);
        $validate->text('password_1', $password_1, false, 6, 30);
        $validate->text('password_2', $password_2, false, 6, 30);        
        $validate->text('name', $name);
        
        
        // Check email change and display message if necessary
        if ($email != $old_customer['emailaddress']) {
            display_error('You can\'t change the email address for an account.');
        }

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'account/account_edit.php';
            break;
        }
        
        // Only validate the passwords if they are NOT empty
        if (!empty($password_1) && !empty($password_2)) {            
            if ($password_1 !== $password_2) {
                $password_message = 'Passwords do not match.';
                include 'account/account_edit.php';
                break;
            }
        }

        // Update the customer data
        update_customer($customer_id, $email, $name,
                      $password_1, $password_2);

        // Set the new customer data in the session
        $_SESSION['user'] = get_customer($customer_id);

        redirect('.');
        break;
    case 'view_address_edit':
        // Set up variables for address type
        $address_type = filter_input(INPUT_POST, 'address_type');
        if ($address_type == 'billing') {
            $address_id = get_address($_SESSION['user']['customerid']);
            $heading = 'Update Address';
        }

        // Get the data for the address
        $address = get_address($_SESSION['user']['customerid']);
        
        $city = $address['city'];
		$district = $address['district'];
        $street = $address['street'];
        $zipcode = $address['zipcode'];
        $phone = $address['phone'];

        // Display the data on the page
        include 'address_edit.php';
        break;
    case 'update_address':
        $customer_id = $_SESSION['user']['customerid'];
		$address = get_address($_SESSION['user']['customerid']);
        // Set up variables for address type
        //$address_type = filter_input(INPUT_POST, 'address_type');
        //if ($address_type == 'billing') {
        $address_id = $address['addressid'];
        $heading = 'Update Address';
        //} 

        // Get the post data
        
        $city = filter_input(INPUT_POST, 'city');
		$district = filter_input(INPUT_POST, 'district');
        $street = filter_input(INPUT_POST, 'street');
        $zipcode = filter_input(INPUT_POST, 'zipcode');
        $phone = filter_input(INPUT_POST, 'phone');

        // Validate the data
               
        $validate->text('city', $city);   
		$validate->text('district', $district); 		
        $validate->text('street', $street);        
        $validate->text('zipcode', $zipcode);        
        $validate->text('phone', $phone, false);        

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'account/address_edit.php';
            break;
        }
        
        // If the old address has orders, disable it
        // Otherwise, delete it
        //disable_or_delete_address($address_id);

        // Add the new address
		if($address_id == NULL){
			$address_id = add_address($customer_id,$city, $district,$street ,$zipcode, $phone);
		}else {
			$address_id = update_address($address_id,$city, $district,$street ,$zipcode, $phone,$customer_id);
		}

        

        // Set the user data in the session
        $_SESSION['user'] = get_customer($customer_id);

        redirect('.');
        break;
    case 'logout':
        unset($_SESSION['user']);
        redirect('..');
        break;
    default:
        display_error("Unknown account action: " . $action);
        break;
}
?>