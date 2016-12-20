<div id="header">
<div id="gnav"> 
	<div id="web_logo"></div>
	<ul class="menu">
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
		<?php
			// Check if user is logged in and
			// display appropriate account links
			$account_url = $app_path . 'account';
			$logout_url = $account_url . '?action=logout';
			if (isset($_SESSION['user'])) :
			?>
			<li><a href="<?php echo $account_url; ?>">My Account</a></li>
				
            <li><a href="<?php echo $logout_url; ?>">Đăng xuất</a>
            <?php else: ?>
			<li><a href="<?php echo $account_url; ?>">Đăng nhập</a></li>
			<?php endif; ?>
			<li><a href="<?php echo $app_path.'cart'; ?>">Xem giỏ hàng</a></li>
		<li id="search">
			<form action="<?php echo $app_path.'search'; ?>">
			<input type="text" placeholder="Tên sản phẩm">
			<input type="submit" value="">
			</form>
		</a>
		</li>
	</ul>
	<!--
	<ul>
		<li><a href="<?php echo $app_path; ?>"><img src="<?php echo $app_path.'image/home.png';?>" height="50"/>HOME
		</a></li>
		<?php
            // Check if user is logged in and
            // display appropriate account links
            $account_url = $app_path . 'account';
            $logout_url = $account_url . '?action=logout';
            if (isset($_SESSION['user'])) :
            ?>
                
				<li><a href="<?php echo $account_url; ?>"><img src="<?php echo $app_path.'image/logout.png';?>" height="50"/>My Account</a></li>
				
                <li><a href="<?php echo $logout_url; ?>"><img src="<?php echo $app_path.'image/logout.png';?>" height="50"/>Logout</a>
            <?php else: ?>
                <li><a href="<?php echo $account_url; ?>"><img src="<?php echo $app_path.'image/login.png';?>" height="50"/>LOGIN</a></li>
            <?php endif; ?>
		
		<li><a href="<?php echo $app_path.'cart'; ?>"><img src="<?php echo $app_path.'image/viewcarticon.png';?>" height="50"/> VIEW CART
		</a></li>
		<li><a href="<?php echo $app_path.'search'; ?>"><img src="<?php echo $app_path.'image/search.png';?>" height="50"/>SEARCH
		</a></li>
	</ul>
	-->
</div>

</div>