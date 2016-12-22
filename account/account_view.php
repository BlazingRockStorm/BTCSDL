<html>
	<head>
		<title>Account view</title>
		<link href="\BTLCSDLver13\image\logo.jpg" rel="icon" type="image/jpg">
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
	</head>
	<body>
		<div id="container">
			<?php 	header('Content-Type: text/html;charset=UTF-8'); 
					include 'view/header.php';?>
			<div id="pagebody">	
			<div id="customerview">
			<h2>My Account</h2>
				<p><?php echo $customer_name . ' (' . $email . ')'; ?></p>
				
				<form action="." method="post">
				<input type="hidden" name="action" value="view_account_edit">
				<input type="submit" value="Edit Account">
				</form>
				
				<h2>Địa chỉ</h2>
				<p>
				<?php echo htmlspecialchars($address['city']); ?>, <?php 
				echo htmlspecialchars($address['district']); ?>,
				<?php 
				echo htmlspecialchars($address['street']); ?>
				<br>
				<?php echo htmlspecialchars($address['phone']); ?>
				</p>
				
				<form action="." method="post">
				<input type="hidden" name="action" value="view_address_edit">
				<input type="hidden" name="address_type" value="billing">
				<input type="submit" value="Edit Address">
				</form>

				<?php if (count($orders) > 0 ) : ?>
				<h2>Đơn hàng của bạn</h2>
				
				<ul>
				<?php foreach($orders as $order) :
				$order_id = $order['orderid'];
				$order_date = strtotime($order['orderdate']);
				$order_date = date('M j, Y', $order_date);
				$url = $app_path . 'account' .
				'?action=view_order&order_id=' . $order_id;
				?>
				
				<li>
				Order # <a href="<?php echo $url; ?>">
				<?php echo $order_id; ?></a> placed on
				<?php echo $order_date; ?>
				</li>
				<?php endforeach; ?>
				</ul>
				
				<?php endif; ?>
			</div>
			</div>
		<?php include 'view/footer.php';?>
	</div>
	</body>
</html>
