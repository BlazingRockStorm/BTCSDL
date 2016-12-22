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
				<form name="add_product_form" action="." method="post" enctype="multipart/form-data">
					<input type="hidden" name="choice" value="add_product">
					<ul>
						<fieldset style="text-align: left"> 
						
							<legend style="font-weight: bold">Thêm sản phẩm</legend>
							<li>Tên sản phẩm: <input name="name" type="text" size="25" maxlength="40"/>
							<?php echo $fields->getField('name')->getHTML(); ?><p/> </li>
							
							<li>Thể loại: <input name="category" type="text" size="10" maxlength= "20"/>
								<?php echo $fields->getField('category')->getHTML(); ?><p/></li>
								
							<li>Giá tiền: <input name="price" type="text" size="10" maxlength= "10"/>
								<?php echo $fields->getField('price')->getHTML(); ?><p/></li>
								
							<li>Discount: <input name="discount_percent" type="text" size="10" maxlength= "10"/>
								<?php echo $fields->getField('discount_percent')->getHTML(); ?><p/></li>
								
							<li>Nation: <input name="country" type="text" size="10" maxlength= "10"/>
								<?php echo $fields->getField('country')->getHTML(); ?><p/></li>
								
							<li>Branch: <input name="branch" type="text" size="10" maxlength= "10"/>
								<?php echo $fields->getField('branch')->getHTML(); ?><p/></li>
							
							<li>Link video: <input name="emlink" type="text" size="50" maxlength= "10"/>
								<?php echo $fields->getField('emlink')->getHTML(); ?><p/></li>
								
							<li>Miêu tả:<br/><textarea name="description" cols="20" rows="5" ></textarea>
								<?php echo $fields->getField('description')->getHTML(); ?><p/></li>
							<!--
							<li>Ảnh đại diện: <input name="pro_img" type="file"/>
								<?php echo $fields->getField('name')->getHTML(); ?><p/></li>-->
							<li><input type="submit" value="Thêm"/><p/></li>
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