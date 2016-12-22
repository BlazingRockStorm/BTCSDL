<html>

	<head>
		<title>View cart</title>
		<link href="\BTLCSDLver13\image\logo.jpg" rel="icon" type="image/jpg">
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
		<link href="<?php echo $app_path.'loginstyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">	
	</head>
	<body>
		<div id="container">
			<?php 	header('Content-Type: text/html;charset=UTF-8'); 
				include 'view/header.php';?>
			<div id="pagebody">
			<div id="cartview">
				<h2>Giỏ hàng của bạn</h2>
				<?php if (cart_product_count() == 0) : ?>
				<h3><b>Giỏ hàng của bạn còn trống.</h3>
				<a href="<?php echo $url; ?>">Bắt đầu mua sắm</a>
				<?php else:?>
					<!--<p>To remove an item from your cart, change its quantity to 0.</p> -->
					<form action="." method="post">
					<input type="hidden" name="action" value="update">
						<table>
							<tr class="table_header">
								<th>Hình ảnh</th>
								<th>Sản phẩm</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Thành tiền</th>
							</tr>
							<?php foreach ($cart as $product_id => $item) : ?>
							<tr align="center">
								<?php
								$image_filename = $product_id . '.jpg';
								$image_path = $app_path . 'image/' . $image_filename;
								$image_alt = 'Image filename: ' . $image_filename;?>
								<td><img src="<?php echo $image_path; ?>"  alt="<?php echo $image_alt; ?>"  width="70px"/></td>
								<td><?php echo htmlspecialchars($item['name']); ?></td>
								<td><?php echo sprintf('%.2f (VND)' , $item['unit_price']); ?></td>
								<td><input type="text" size="3" class="right"
								   name="items[<?php echo $product_id; ?>]"
								   value="<?php echo $item['quantity']; ?>">
								</td>
								<td><?php echo sprintf('%.2f (VND)', $item['line_price']); ?></td>
							</tr>
							<?php endforeach; ?>
							<tr id="cart_footer"> 
								<td colspan="4"><b>Tổng cộng</b></td>
								<td style="text-align:center"> <?php echo sprintf('%.2f (VND)', cart_subtotal()); ?></td>
							</tr>
							<tr>
								<td colspan="4">
									<a id="continueshop" href="<?php echo $url; ?>">Tiếp tục mua sắm</a>
								</td>
								<td>
									<input id="updatebutton" type="submit" name="submit" value="Cập nhật giỏ hàng">
								</td>
							</tr>
							
						</table>
					</form>
				<?php endif; ?>
			</div>
			<?php
					if (isset($_SESSION['user'])) :
					?>
			<div id="customerview">
				<h2>Thông tin của bạn</h2>
				<table>
					<tr class="table_header">
						<th>Họ và tên</th>
						<th>Thành phố</th>
						<th>Quận</th>
						<th>Đường</th>
						<th>Số điện thoại liên hệ</th>
						<th>Email</th>
					</tr>
					
					<tr>
						<td><?php echo $_SESSION['user']['name'];?></td>
						<?php $address = get_address($_SESSION['user']['customerid']);?>
						<td><?php echo $address['city'];?></td>
						<td><?php echo $address['district'];?></td>
						<td><?php echo $address['street'];?></td>
						<td><?php echo $address['phone'];?></td>
						<td><?php echo $_SESSION['user']['emailaddress'];?></td>
					</tr>			
				</table>
				<?php
				$account_edit_url = $account_url . '?action=view_account_edit';
				$address_edit_url = $account_url . '?action=update_address';
				
				?>
				
				<a href="<?php echo $account_edit_url;?>">Chỉnh sửa thông tin cá nhân</a><br/>
				<a href="<?php echo $address_edit_url;?>">Chỉnh sửa địa chỉ</a>
				
				<p>
				<form name="checkout" action="." method="get" enctype="multipart/form-data">
							<input type="hidden" name="action" value="add_order">
							<input id="buybutton" type="submit" value="Xác nhận mua hàng" />
				</form>
				</p>
				
			</div>
			<?php endif; ?>
			</div>
			<?php include 'view/footer.php';?>
		</div>
	</body>
</html>