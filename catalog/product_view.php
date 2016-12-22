<html>
	<head>
		<title>My Guitar Shop</title>
		<link href="\BTLCSDLver13\image\logo.jpg" rel="icon" type="image/jpg">
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
	</head>
	<body>
		<div id="container">
			<?php 	header('Content-Type: text/html;charset=UTF-8'); 
					include 'view/header.php';?>
			<div id="pagebody">
				<div id="show_sp">
					<table cellspacing="20px">
						<?php include 'view/product.php';?>
					</table>
				</div>
			<?php include 'view/footer.php';?>
			</div>
		</div>
	</body>
</html>