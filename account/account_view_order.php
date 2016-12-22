<?php
require_once '../util/main.php';
require_once 'util/validation.php';
require_once 'model/order_db.php';
require_once 'model/cart.php';
require_once 'model/product_db.php';
require_once 'model/customer_db.php';
require_once 'model/address_db.php';
?>
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
			<div id="cartview">
				<h1>Đơn hàng của bạn</h1>
				<p>Mã đơn hàng: <?php echo $order_id; ?></p>
				<p>Ngày đặt hàng: <?php echo $order_date; ?></p>
			<table>
				<tr class="table_header">
					<th>Hình ảnh</th>
					<th>Sản phẩm</th>
					<th>Giá niêm yết</th>
					<th>Tiết kiệm</th>
					<th>Giá mua</th>
					<th>Số lượng</th>
					<th>Thành tiền</th>
				</tr>
				<?php
					$order = get_order($order_id);
					$order_items = get_order_items($order_id);
					$subtotal = 0;
					foreach ($order_items as $item) :
					$product_id = $item['productid'];
					$product = get_product($product_id);
					$item_name = $product['productname'];
					$list_price = $product['price'];
					$savings = $list_price*$product['discountpercent']/100;
					$your_cost = $list_price - $savings;
					$quantity = $item['quantity'];
					$line_total = $your_cost * $quantity;
					$subtotal += $line_total;
				?>
				<tr align="center">
					<?php
					$image_filename = $product_id . '.jpg';
					$image_path = $app_path . 'image/' . $image_filename;
					$image_alt = 'Image filename: ' . $image_filename;?>
					<td><img src="<?php echo $image_path; ?>"  alt="<?php echo $image_alt; ?>"  width="70px"/></td>
					<td><?php echo htmlspecialchars($item_name); ?></td>
					<td><?php echo number_format($list_price,0,',','.')."(VND)";?></td>
					<td><?php echo number_format($savings,0,',','.')."(VND)";?></td>
					<td><?php echo number_format($your_cost,0,',','.')."(VND)";?></td>
					<td><?php echo $quantity; ?></td>
					<td><?php echo number_format($line_total,0,',','.')."(VND)";?></td>
				</tr>
					<?php endforeach; ?>
					<tr id="cart_footer"> 
						<td colspan="6"><b>Tổng cộng</b></td>						
						<td><?php echo number_format(cart_subtotal(),0,',','.')."(VND)";?></td>
					</tr>					
			</table>
		</div>
		</div>
		<?php include 'view/footer.php';?>
		
	</div>
	</body>
</html>
