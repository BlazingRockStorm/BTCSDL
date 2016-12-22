<html>
	<head>
		<title>Account edit</title>
		<link href="\BTLCSDLver13\image\logo.jpg" rel="icon" type="image/jpg">
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
	</head>
	<body>
		<div id="container">
			<?php 	header('Content-Type: text/html;charset=UTF-8'); 
					include 'view/header.php';?>
					<div id="pagebody">	
					<div id="customerview">
						<h1>Edit Account</h1>
						<div id="bieu_mau">
							<ul>
							<form action="." method="post">
							<input type="hidden" name="action" value="update_account">
							<li><label>E-Mail:</label>
							<input type="text" name="email" size=30
								value="<?php echo htmlspecialchars($email); ?>">
							<?php echo $fields->getField('email')->getHTML(); ?><br></li>
			
							<li><label>Tên:</label>
							<input type="text" name="name" >
							<?php echo $fields->getField('name')->getHTML(); ?><br></li>

							<li><label>Mật khẩu mới:</label>
							<input type="password" name="password_1">&nbsp;&nbsp;
							<?php echo $fields->getField('password_1')->getHTML(); ?>
							<span class="error"><?php echo $password_message; ?></span><br></li>

							<li><label>Xác nhận lại mật khẩu:</label>
							<input type="password" name="password_2">
							<?php echo $fields->getField('password_2')->getHTML(); ?><br></li>

							<label>&nbsp;</label>
							<input type="submit" value="Update Account"><br>
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
