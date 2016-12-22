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
				<form name="" action="" method="get" enctype="multipart/form-data">
					<fieldset style="text-align: left height:400px"> 
						<legend style="font-weight: bold">Danh sách khách hàng</legend>
					<table>
					
						<tr>
						<td>Customer ID</td>
						<td>Tên khách hàng</td>
						<td>Địa chỉ email</td>
						<td>Số điện thoại </td>
						<td>Thành phố</td>
						<td>Quận</td>
						<td>Đường</td>
						<td>Giá trị đơn hàng gần đây nhất</td>
						<td>Tổng số tiền đã giao dịch</td>
						<td></td>
						</tr>
					<?php 
						$customers = get_all_customer();
						foreach($customers as $customer):
							if($customer['emailaddress'] == 'admin@guitarshop.com')continue;
						$address = get_address($customer['customerid']);
						$orders = get_orders_by_customerid($customer['customerid']);
						$sum = get_sum_order_by_customerid($customer['customerid']);
						$date = get_last_time_order_customerid($customer['customerid']);
					?>
						<tr>
						<td><?php echo $customer['customerid'];?></td>
						<td><?php echo $customer['name'];?></td>
						<td><?php echo $customer['emailaddress'];?></td>
						<td><?php echo $address['phone'];?></td>
						<td><?php echo $address['city'];?></td>
						<td><?php echo $address['district'];?></td>
						<td><?php echo $address['street'];?></td>
						<td><?php echo $date['price'];?></td>
						<td><?php echo $sum['sum'];?></td>
						<form action="." method="post">
						<input type="hidden" name="choice" value="delete_customer">
						<input type="hidden" name="customer_id"
							value="<?php echo $customer['customerid']; ?>">
						<td><input type="submit" value="Xóa khách hàng"/><p/></td>
						</form>
						</tr>
					<?php endforeach; ?>
					</table>
				</fieldset>		
				</form>
	</div>
	</div>
		<?php include '../view/footer.php';?>
	</div>
	</body>
</html>