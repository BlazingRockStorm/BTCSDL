<html>
	<head>
		<title>My Guitar Shop</title>
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
	</head>
	<body>
		<div id="container">
			<?php 	header('Content-Type: text/html;charset=UTF-8'); 
					include 'view/header.php';?>
			<div id="pagebody">
				<div id="show_sp">
					<form name="search" action="." method="post" enctype="multipart/form-data">
					<p>Từ khóa: <input name="key" type="text" size="15" maxlength="20" 
								value="<?php echo htmlspecialchars($key); ?>"/><p/>
								<?php echo $fields->getField('key')->getHTML(); ?><br>
					<input id="buybutton" type="submit" value="OK" />
					</form> 
					
					<table cellspacing="20px">
						
							<?php if (count($products1) == 0) : ?>
								<p>There are no products in this page.</p>
							<?php else: ?>
							<?php foreach ($products1 as $product) : 
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
								<img src="../image/<?php echo htmlspecialchars($product['productid']); ?>.jpg" alt="sp1" height="150" width="150" >
							</td>
							<td width="400">
								<p>
									<a href="<?php echo $app_path.'catalog?product_id'?>=<?php echo $product['productid']; ?>">
										<?php echo htmlspecialchars($product['productname']); ?>
									</a>
								</p>
								<p>
									Giá <?php echo number_format($unit_price, 2); ?> Đ
								</p>
								<p>
									<?php echo $first_paragraph; ?>
								</p>
							</td>
						</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</table>
						
				</div>
			</div>
			<?php include 'view/footer.php';?>
		</div>
	</body>
</html>