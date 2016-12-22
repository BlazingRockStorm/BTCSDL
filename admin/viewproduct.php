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
		<div id="viewpro">
			<form name="" action="" method="get" enctype="multipart/form-data">
			<fieldset style="text-align: left"> 
			<legend style="font-weight: bold">Danh sách sản phẩm</legend>
			<table>
				<tr>
				<td>Product ID</td>
				<td>Ngày thêm</td>
				<td>Tên sản phẩm </td>
				<td>Thể loại </td>				
				<td>Giá tiền </td>
				<td>Discount</td>
				<td>Country</td>
				<td>Branch</td>
				</tr>
				<?php 
					$list_product = get_all_products();
					if (count($list_product) == 0) : ?>
						<p>There are no products in this shop</p>
				<?php else: 
						foreach ($list_product as $product) : 
				
				?>
				
				<tr>
					<td><?php echo $product['productid'];?></td>
					<td><?php echo $product['dateadded'];?></td>
					<td><?php echo $product['productname'];?></td>
					<td><?php 	$category = get_category($product['categoryid']);
								echo $category['categoryname'];?></td>				
					<td><?php echo $product['price'];?></td>
					<td><?php echo $product['discountpercent'].'%';?></td>
					<td><?php echo $product['country'];?></td>
					<td><?php echo $product['branch'];?></td>
					</tr>
				<?php endforeach; ?>
				<?php endif; ?>
			</table>
			</fieldset>		
			</form>
		</div>
		</div>
	
	</div>
	<?php include '../view/footer.php';?>
	</div>
	</body>
</html>