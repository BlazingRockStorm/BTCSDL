<html>
	<head>
		<title>Admin</title>
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
	</head>
	<body>
		<div id="container">
			<?php 	header('Content-Type: text/html;charset=UTF-8'); 
					include 'view/header.php';?>
		<div id="pagebody">
		<div id="manage" style="height:500px">
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
			<?php
				if(isset($_GET['choice'])){
					switch($_GET['choice']){
						case "view_pro" : require("manage/viewproduct.php") ; break;
						case "add_pro" : require("manage/addproduct.php") ; break;
						case "del_pro" : require("manage/delproduct.php") ; break;
						case "manage_order" : require("manage/manage_order.php") ; break;
						case "manage_customer" : require("manage/manage_customer.php") ; break;
					}
				}
			?>
		</div>
		</div>
		<?php include 'footer.php';?>
	</div>
	</body>
</html>