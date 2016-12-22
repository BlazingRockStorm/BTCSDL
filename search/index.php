<?php
require_once('../util/main.php');
require_once('model/fields.php');
require_once('model/validate.php');
require_once('model/search_db.php');
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_search';
		if (isset($_SESSION['search'])) {
            $action = 'view_search';
        }
    }
}
$validate = new Validate();
$fields = $validate->getFields();

$fields->addField('key');
$products1 = array();
switch($action){
case 'view_search':
	$key='';
	break;
	case 'search':
$key = filter_input(INPUT_POST, 'key');
		//echo $key;
		$key_new = strtolower($key);
		//echo $key_new;
		//$products1 = get_all_products();
		$products1= get_product_from_key($key_new);
		$_SESSION['search'] = 1;
		$key = '';
		break;
	default:
			break;
}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>My Guitar Shop</title>
		<link href="\BTLCSDLver13\image\logo.jpg" rel="icon" type="image/jpg">
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
		<link rel="stylesheet" href="jquery-ui.css">
		<script src="jquery-1.10.2.js"></script>
		<script src="jquery-ui.js"></script>
		<script>
		$(function() {
			$( "#skills" ).autocomplete({
				source: 'search.php'
			});
		});
		</script>
	</head>
<body>
		<div id="container">
			<?php 	header('Content-Type: text/html;charset=UTF-8'); 
					include 'view/header.php';?>
			<div id="pagebody">
				<div id="show_sp">
		<div class="ui-widget">
		<form name="search" action="." method="post" enctype="multipart/form-data">
					<input type="hidden" name="action" value="search">
					
					<p>
					<label for="skills">Từ khóa: </label>
					<input  id="skills" name="key" type="text" size="30" maxlength="30" 
								value="<?php echo htmlspecialchars($key); ?>"/><p/>
								<?php echo $fields->getField('key')->getHTML(); ?><br>
					<input id="buybutton" type="submit" value="OK" />
		</form> 
		</div>

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
								<img src="../image/<?php echo htmlspecialchars($product['productid']); ?>.jpg" alt="sp1"  width="150" >
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