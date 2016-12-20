<html>
	<head>
		
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
	</head>
	<body>
		<div id="layout">
			<?php 	header('Content-Type: text/html;charset=UTF-8'); 
					include 'view/header.php';?>

    <h1>Your Order</h1>
    <p>Order Number: <?php echo $order_id; ?></p>
    <p>Order Date: <?php echo $order_date; ?></p>
    <h2>Shipping</h2>
    <p>Ship Date:
        <?php
            if ($order['shipdate'] === NULL) {
                echo 'Not shipped yet';
            } else {
                $ship_date = strtotime($order['shipdate']);
                echo date('M j, Y', $ship_date);
            }
        ?>
    </p>
    <p>
        <?php echo htmlspecialchars($shipping_address['city']); ?>, 
		<?php 
              echo htmlspecialchars($shipping_address['district']); ?><?php 
              echo htmlspecialchars($shipping_address['street']); ?>
        <?php echo htmlspecialchars($shipping_address['zipcode']); ?><br>
        <?php echo htmlspecialchars($shipping_address['phone']); ?>
    </p>
    <h2>Billing</h2>
    <p>Card Number: ...<?php echo substr($order['cardnumber'], -4); ?></p>
    <p>
        <?php echo htmlspecialchars($billing_address['city']); ?>, 
		<?php 
              echo htmlspecialchars($billing_address['district']); ?><?php 
              echo htmlspecialchars($billing_address['street']); ?>
        <?php echo htmlspecialchars($billing_address['zipcode']); ?><br>
        <?php echo htmlspecialchars($billing_address['phone']); ?>
    </p>
    <h2>Order Items</h2>
    <table id="cart">
        <tr id="cart_header">
            <th class="left">Item</th>
            <th class="right">List Price</th>
            <th class="right">Savings</th>
            <th class="right">Your Cost</th>
            <th class="right">Quantity</th>
            <th class="right">Line Total</th>
        </tr>
        <?php
        $subtotal = 0;
        foreach ($order_items as $item) :
            $product_id = $item['productid'];
            $product = get_product($product_id);
            $item_name = $product['productname'];
            $list_price = $item['price'];
            $savings = $item['discountamount'];
            $your_cost = $list_price - $savings;
            $quantity = $item['quantity'];
            $line_total = $your_cost * $quantity;
            $subtotal += $line_total;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($item_name); ?></td>
                <td class="right">
                    <?php echo sprintf('%.2f (VND)', $list_price); ?>
                </td>
                <td class="right">
                    <?php echo sprintf('%.2f (VND)', $savings); ?>
                </td>
                <td class="right">
                    <?php echo sprintf('%.2f (VND)', $your_cost); ?>
                </td>
                <td class="right">
                    <?php echo $quantity; ?>
                </td>
                <td class="right">
                    <?php echo sprintf('%.2f (VND)', $line_total); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr id="cart_footer">
            <td colspan="5" class="right">Subtotal:</td>
            <td class="right">
                <?php echo sprintf('%.2f (VND)', $subtotal); ?>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="right">
                <?php echo htmlspecialchars($shipping_address['street']); ?> Tax:
            </td>
            
        </tr>
        <tr>
            <td colspan="5" class="right">Shipping:</td>
            
        </tr>
            <tr>
            <td colspan="5" class="right">Total:</td>
            <td class="right">
                <?php
                    $total = $subtotal  
                             ;
                    echo sprintf('%.2f (VND)', $total);
                ?>
            </td>
        </tr>
</table>
	<?php include 'view/footer.php';?>
	</div>
	</body>
</html>
