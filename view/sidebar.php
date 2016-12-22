<div id="categories">
	<h2>CATEGORIES</h2>
		<ul>
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
</div>