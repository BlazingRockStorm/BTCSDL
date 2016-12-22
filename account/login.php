<html>
	<head>
		<title>Log In</title>
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
				<!--<div id="tit"><h1>The sound of your soul</h1> 	-->
				
					<form name = "login_form" action="." method="post" id="login_form" class="form-3" enctype="multipart/form-data">
						<input type="hidden" name="action" value="login">
						<p class="clearfix">
						<label for="login">Email</label>
						<input type="text" name="email" id="login" value="<?php echo htmlspecialchars($email); ?>" size="30" placeholder="Email đăng nhập">
						<?php echo $fields->getField('email')->getHTML(); ?><br>
						</p>
	
						<p class="clearfix">
						<label for="password">Mật khẩu</label>
						<input type="password" name="password" id="password" placeholder="Mật khẩu" size="30">
						<?php echo $fields->getField('password')->getHTML(); ?><br>
						</p>

						<p class="clearfix">
						<input type="checkbox" name="remember" id="remember">
						<label for="remember">Ghi nhớ đăng nhập</label>
						</p>

						<p class="clearfix">
						<input type="submit" name="submit" value="Đăng nhập">
						</p>

						<?php if (!empty($password_message)) : ?>         
						<span class="error"><?php echo htmlspecialchars($password_message); ?></span><br>
						<?php endif; ?>
						</p>
					</form> 
				
				<h3 class="maMoi">
					<form action="." method="post">
					Lần đầu tới đây?
						<input type="hidden" name="action" value="view_register">
						<input type="submit" value="Đăng ký" id="AtCbutton">
					thành viên ngay để nhận ưu đãi!
					</form>
				</h3>
			</div>	
			<?php include 'view/footer.php';?>
		</div>
	</body>
</html>