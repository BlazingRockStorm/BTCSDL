<html>
	<head>
		<title>Address edit</title>
		<link href="\BTLCSDLver13\image\logo.jpg" rel="icon" type="image/jpg">
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
	</head>
	<body>
		<div id="container">
			<?php 	header('Content-Type: text/html;charset=UTF-8'); 
					include 'view/header.php';?>
		<div id="pagebody">
		<div id="customerview">
		<h1><?php echo $heading; ?></h1>
			<div id="bieu_mau">
			<ul>
				<form action="." method="post">
				<input type="hidden" name="action" value="update_address">
				<input type="hidden" name="address_type" value="<?php echo $address_type ?>">
				
				<li><label>City:</label>
				<input type="text" name="city" 
					value="<?php echo htmlspecialchars($city); ?>">
					<?php echo $fields->getField('city')->getHTML(); ?><br></li>
		
				<li><label>District:</label>
				<input type="text" name="district" 
					value="<?php echo htmlspecialchars($district); ?>">
					<?php echo $fields->getField('district')->getHTML(); ?><br></li>
        
				<li><label>Street</label>
				<input type="text" name="street" 
					value="<?php echo htmlspecialchars($street); ?>">
					<?php echo $fields->getField('street')->getHTML(); ?><br></li>
        
				<li><label>Zip Code:</label>
				<input type="text" name="zipcode" 
					value="<?php echo htmlspecialchars($zipcode); ?>">
					<?php echo $fields->getField('zipcode')->getHTML(); ?><br></li>
        
				<li><label>Phone:</label>
				<input type="text" name="phone" 
					value="<?php echo htmlspecialchars($phone); ?>">
					<?php echo $fields->getField('phone')->getHTML(); ?><br></li>
        
				<label>&nbsp;</label>
				<input type="submit" 
					value="<?php echo htmlspecialchars($heading); ?>"><br>
				</form>
				<form action="." method="post">
					<label>&nbsp;</label>
					<input type="submit" value="Cancel">
				</form>
				</ul>
			</div>
		</div>
		</div>
		<?php include 'view/footer.php';?>
	</div>
	</body>
</html>
