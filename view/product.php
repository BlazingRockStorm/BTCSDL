<!--<div style="float: left">
    <img src="\BTLCSDLver4-2\image\ad.jpg">
</div>-->
<?php
    // Parse data
    $category_id = $product['categoryid'];
    $product_id = $product['productid'];
    $product_name = $product['productname'];
    $description = $product['description'];
    $list_price = $product['price'];
    $discount_percent = $product['discountpercent'];
	$emlink = $product['emlink'];
	$country = $product['country'];
	$branch = $product['branch'];
    // Add HMTL tags to the description
    $description_with_tags = add_tags($description);

    // Calculate discounts
    $discount_amount = round($list_price * ($discount_percent / 100), 2);
    $unit_price = $list_price - $discount_amount;

    // Format discounts
    $discount_percent_f = number_format($discount_percent, 0);
    $discount_amount_f = number_format($discount_amount, 2);
    $unit_price_f = number_format($unit_price, 2);

    // Get image URL and alternate text
    $image_filename = $product_id . '.jpg';
    $image_path = $app_path . 'image/' . $image_filename;
    $image_alt = 'Image filename: ' . $image_filename;
?>

<h1><?php echo htmlspecialchars($product_name); ?></h1>

<div id="left_column"><a class="caption" href="#" data-title="Vulture" data-description="lalala">
    <img src="<?php echo $image_path; ?>"
            alt="<?php echo $image_alt; ?>"  width="500px"/>
			</a>
</div>

<div id="right_column">
    <h2>Mô tả</h2>
    <?php echo $description_with_tags; ?>
    <p><b>Giá gốc:</b>
        <?php echo  $list_price . ' Đồng'; ?></p>
    <p><b>Giảm giá:</b>
        <?php echo $discount_percent_f . '%'; ?></p>
    <p><b>Giá cuối cùng:</b>
        <?php echo $unit_price_f .' Đồng'; ?>
        (Bạn tiết kiệm được
        <?php echo $discount_amount_f . ' Đồng'; ?>)</p>
    <form action="<?php echo $app_path . 'cart' ?>" method="get" 
          id="add_to_cart_form">
        <input type="hidden" name="action" value="add" />
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
        <b>Số lượng:</b>&nbsp;
        <input type="text" name="quantity" value="1" size="2" />
        <input type="submit" value="Add to Cart" class="fa fa-car" id="AtCbutton" />
    </form>
	<br></br>
	<p><b>Quốc gia:</b>
    <?php echo $country; ?></p>
	<p><b>Nhãn hiệu:</b>
    <?php echo $branch; ?></p>
    <p><b>Video sản phẩm</b>
        <iframe src="<?php echo $emlink;?>" allowfullscreen="allowfullscreen" style="width: 400px; height: 300px"></iframe><!--Thay bằng các link đọc từ CSDL--></p>
</div>