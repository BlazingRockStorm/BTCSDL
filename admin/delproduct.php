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
				<div id="bieu_mau">
					<form name="del_form" action="." method="post" enctype="multipart/form-data">
					<input type="hidden" name="choice" value="del_product">
					<ul>
						<fieldset style="text-align: left"> 
			
						<legend style="font-weight: bold">Xóa sản phẩm</legend>
						<li>Tên sản phẩm: <input name="del_name" type="text" size="25" maxlength="40"/>
						<?php echo $fields->getField('del_name')->getHTML(); ?><p/> </li>
						<li><input type="submit" value="Xóa"/><p/></li>
			
						</fieldset>
					</ul>
					</form>	
				</div>
		
			</div>
			</div>
	<?php include '../view/footer.php';?>
	</div>
	</body>
</html>