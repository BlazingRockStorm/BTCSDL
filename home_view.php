<html>
	<head>
		<title>My Guitar Shop</title>
		<link href="\BTLCSDLver13\image\logo.jpg" rel="icon" type="image/jpg">
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
		<link href="<?php echo $app_path.'loginstyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
		<link href="https://fonts.googleapis.com/css?family=Pacifico|Pinyon+Script" rel="stylesheet"> 
	</head>
	<body>
		<div id="container">	
			<?php 	header('Content-Type: text/html;charset=UTF-8'); 
					include 'view/header.php';?>
			
			<div id="pagebody">											
				<div id="tit"><h1>The sound of your soul</h1> 							
				</div>		
				<!--<form class="form-3">
					<p class="clearfix">
						<label for="login">Tên</label>
						<input type="text" name="login" id="login" placeholder="Tên đăng nhập">
					</p>
					<p class="clearfix">
						<label for="password">Mật khẩu</label>
						<input type="password" name="password" id="password" placeholder="Mật khẩu">
					</p>
					<p class="clearfix">
						<input type="checkbox" name="remember" id="remember">
						<label for="remember">Ghi nhớ đăng nhập</label>
					</p>
					<p class="clearfix">
						<input type="submit" name="submit" value="Đăng nhập">
					</p>
				</form>
				-->
				<div id="featured_products">
					<h2>FEATURED PRODUCTS</h2>
					<h3><br/>We have a great selection of musical instruments
					including guitars, basses, and drums. And we're 
					constantly adding more to give you the best 
					selection possible!</h3>
					<table cellspacing="20px">
					<?php foreach ($products as $product) :
						// Get product data
						$list_price = $product['price'];
						$discount_percent = $product['discountpercent'];
						$description = $product['description'];
        
						// Calculate unit price
						$discount_amount = round($list_price * ($discount_percent / 100.0), 2);
						$unit_price = $list_price - $discount_amount;

						// Get first paragraph of description
						$description_with_tags = add_tags($description);
						$i = strpos($description_with_tags, "</p>");
						$first_paragraph = substr($description_with_tags, 3, $i-3);        
					?>
						<tr>
							<td align="center">
								<img src="image/<?php echo htmlspecialchars($product['productid']); ?>.jpg" width="150" >
							</td>
							<td width="400">
								<p>
									<a href="<?php echo $app_path.'catalog?product_id'?>=<?php echo $product['productid']; ?>">
										<?php echo htmlspecialchars($product['productname']); ?>
									</a><img src="image/new.png" height="20px">
								</p>
								<p>
									Giá <?php echo number_format($unit_price, 2); ?> Đ
								</p>
								<p>
									<?php echo $first_paragraph; ?>
								</p>
							</td>
							<td>
								<form action="<?php echo $app_path . 'cart' ?>" method="get" 
									id="add_to_cart_form">
									<input type="hidden" name="action" value="add" />
									<input type="hidden" name="product_id"
											value="<?php echo $product['productid']; ?>" />
											&nbsp;
									<input type="hidden" name="quantity" value="1" />
									<input id="buybutton" type="submit" value="Thêm vào giỏ" /><!--onclick="alert('Đã thêm vào giỏ')" />-->
								</form>
							</td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
			<?php include 'view/footer.php';?>
		</div>
	</body>
</html>
