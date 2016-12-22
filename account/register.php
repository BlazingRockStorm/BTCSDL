<html>
	<head>
		<title>Đăng ký thành viên</title>
		<link href="\BTLCSDLver13\image\logo.jpg" rel="icon" type="image/jpg">
		<link href="<?php echo $app_path.'homestyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
		<link href="<?php echo $app_path.'loginstyle.css';?>" rel="stylesheet" type="text/css" media="screen,print">
	</head>
	<body>
	<div id="container">
		<?php 	header('Content-Type: text/html;charset=UTF-8'); 
				include 'view/header.php';?>
		<?php 
			if (!isset($password_message)) { $password_message = ''; } 
		?>
		
		<div id="pagebody">
			<div id="register">
			<form class="form-3" name="register" action="." method="post" id="register_form" enctype="multipart/form-data">
				<input type="hidden" name="action" value="register">
		
				<ul>
					<p class="clearfix">
						<label>Họ và tên</label><input type="text" name="name" size="30">
						<?php echo $fields->getField('name')->getHTML(); ?>
					</p>
					
					<p class="clearfix"><label>Mật khẩu:</label>
						<input type="password" name="password_1" size="30">
						<?php echo $fields->getField('password_1')->getHTML(); ?>
						<span class="error"><?php echo htmlspecialchars($password_message); ?></span>
					</p>
					
					<p class="clearfix"><label>Xác nhận lại mật khẩu: </label>
						<input type="password" name="password_2" size="30">
						<?php echo $fields->getField('password_2')->getHTML(); ?>
					</p>
					
					<p class="clearfix"><label>Địa chỉ email:</label>
						<input type="text" name="email"
						value="<?php echo htmlspecialchars($email); ?>" size="30">
						<?php echo $fields->getField('email')->getHTML(); ?>
					</p>
					<!--
					<p class="clearfix"><label>Số điện thoại</label>
						<input type="text" name="phone"
						value="<?php echo htmlspecialchars($phone); ?>" size="30">
						<?php echo $fields->getField('phone')->getHTML(); ?>
					</p>
					
					<p class="clearfix"><label>Thành phố</label>
						<input type="text" name="city"
						value="<?php echo htmlspecialchars($city); ?>" size="30">
						<?php echo $fields->getField('city')->getHTML(); ?>
					</p>
					
					<p class="clearfix"><label>Quận</label><input type="text" name="district"
						value="<?php echo htmlspecialchars($district); ?>" size="30">
						<?php echo $fields->getField('district')->getHTML(); ?>
					</p>
					
					<p class="clearfix"><label>Đường, số nhà</label><input type="text" name="street"
						value="<?php echo htmlspecialchars($street); ?>" size="30">
						<?php echo $fields->getField('street')->getHTML(); ?>
					</p>
					
					<p class="clearfix"><label>Zipcode</label><input type="text" name="zipcode"
						value="<?php echo htmlspecialchars($zipcode); ?>" size="30">
						<?php echo $fields->getField('zipcode')->getHTML(); ?>
					</p>
					-->
					<p><input type="submit" name="submit" value="Đăng ký"></p>
				
				</ul>
								
			</form>
			
			</div>
		</div>
		<?php include 'view/footer.php';?>
		
	</div>
	</body>
</html>