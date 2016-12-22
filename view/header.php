<div id="header">
<div id="gnav"> 
	<div id="web_logo"></div>
	<ul class="menu">
		<?php if(isset($_SESSION['user'])):
				if($_SESSION['user']['emailaddress'] == 'admin@guitarshop.com'):		
		?>
		<?php else: ?>
		<li><a href="<?php echo $app_path; ?>"> Trang chủ</a></li>
		<li><a href="#">Sản phẩm</a>
			<ul class="submenu">
				<?php
					require_once('model/database.php');
					require_once('model/category_db.php');						
					$categories = get_categories();
					foreach($categories as $category) :
					$name = $category['categoryname'];
					$id = $category['categoryid'];
					$url = $app_path . 'catalog?category_id=' . $id;
				?>
				<li><a href="<?php echo $url; ?>">
						<?php echo htmlspecialchars($name); ?>
					</a>
				</li>
				<?php endforeach;?>
		
			</ul>
		</li>
		<?php endif; ?>
		<?php else: ?>
		<li><a href="<?php echo $app_path; ?>"> Trang chủ</a></li>
		<li><a href="#">Sản phẩm</a>
			<ul class="submenu">
				<?php
					require_once('model/database.php');
					require_once('model/category_db.php');						
					$categories = get_categories();
					foreach($categories as $category) :
					$name = $category['categoryname'];
					$id = $category['categoryid'];
					$url = $app_path . 'catalog?category_id=' . $id;
				?>
				<li><a href="<?php echo $url; ?>">
						<?php echo htmlspecialchars($name); ?>
					</a>
				</li>
				<?php endforeach;?>
		
			</ul>
		</li>
		<?php endif;?>
		<?php
			// Check if user is logged in and
			// display appropriate account links
			$account_url = $app_path . 'account';
			$logout_url = $account_url . '?action=logout';
			if (isset($_SESSION['user'])):
			
				if($_SESSION['user']['emailaddress'] == 'admin@guitarshop.com'):
			?>
					<li><a href="<?php echo $account_url; ?>">My Account Admin</a></li>
					<li><a href="<?php echo $logout_url; ?>">Đăng xuất</a>
					<li><a href="<?php echo $app_path.'admin'; ?>">Manager</a></li>
			<?php else: ?>
					<li><a href="<?php echo $account_url; ?>">My Account</a></li>
					<li><a href="<?php echo $logout_url; ?>">Đăng xuất</a>
					<li><a href="<?php echo $app_path.'cart'; ?>">Xem giỏ hàng</a></li>
					<?php endif;?>
			
	<?php else: ?>
				<li><a href="<?php echo $account_url; ?>">Đăng nhập</a></li>
				<li><a href="<?php echo $app_path.'cart'; ?>">Xem giỏ hàng</a></li>
			<?php endif;?>	
			
			<li id="search"><a>
			<form action="<?php echo $app_path.'search'; ?>">
			
			<input type="submit" value="">
			</form>
		</a>
		</li>
	</ul>
</div>

</div>