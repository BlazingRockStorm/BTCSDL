<html>
	<head>
		<title>Admin</title>
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
	</head>
	<body>
		<div id="container">
		<?php 	header('Content-Type: text/html;charset=UTF-8'); 
					include '../view/header.php';?>
			<div id="pagebody">
			<div id="customerview">
				<h2>Trang quản lý cửa hàng</h2>
				
				<form name="" action="" method="get" enctype="multipart/form-data" >
				<select name="choice">
				<option disabled value=""> Chọn chức năng </option>
					<optgroup label="Quản lý sản phẩm">
						<option value="view_pro"> Danh sách sản phẩm </option>
						<option value="add_pro"> Thêm sản phẩm </option>
						<option value="del_pro"> Xóa sản phẩm </option>
					</optgroup>
					<optgroup label="Quản lý đơn hàng">
						<option value="manage_order"> Danh sách đơn hàng </option>
					</optgroup>
					<optgroup label="Quản lý khách hàng">
						<option value="manage_customer"> Khách hàng </option>
					</optgroup>
				</select>
				
				<input type="submit" value="OK" />
				</form>
			<div id="vieworder">
				<form name="" action="" method="get" enctype="multipart/form-data">
					<fieldset style="text-align: left"> 
						<legend style="font-weight: bold">Các đơn hàng</legend>
						<table>
							<tr>
								<td>Order ID </td>
								<td>Tên khách hàng </td>
								<td>Các mặt hàng </td>				
								<td>Địa chỉ giao hàng </td>
								<td>Số tiền </td>
								<td></td>
							</tr>
							<?php 	
								$orders = get_all_order();
								foreach($orders as $order):
								
							?>
							<tr>
								<td><?php echo $order['orderid']; ?></td>
								<?php $customer = get_customer($order['customerid']) ;?>
								<td><?php echo $customer['name'];?></td>
								<td><?php 
									$order_items = get_order_items($order['orderid']);
									foreach($order_items as $order_item):
									$product = get_product($order_item['productid']);
								?>
								<?php echo $product['productname'];?>-Số lượng:<?php echo $order_item['quantity'];?><br/>
								<?php endforeach; ?></td>
								<?php 
									$address = get_address($customer['customerid']);
								?>
								<td><?php echo $address['street'].', '.$address['district'].', '.$address['city'];?></td>
								<td><?php echo $order['price'];?></td>
								
							</tr>
							<?php endforeach; ?>
						</table>
					</fieldset>		
				</form>
			</div>
		</div>
		<?php include '../view/footer.php';?>
	</div>
	</div>
	</body>
</html>