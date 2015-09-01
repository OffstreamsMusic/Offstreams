<ul id="navUl">
	<?php
	
		$sql = "SELECT * FROM `navigation`";
		$query = $conn->query($sql) or die($conn->error);
		
		while($row = $query->fetch_assoc()){
			
			$nav['id'][] = $row['nav_id'];
			$nav['name'][] = $row['nav_name']; 
		
		}
		
		for ($i = 0; $i < count($nav['id']); $i++){ ?>
		
			<a class="aWhite" href="<?php echo BASE_URI; ?><?php echo strtolower(rtrim($nav['name'][$i], "s")); ?>">
				<li id="nav<?php echo $nav['id'][$i]; ?>" class="ulNavChild bold">
					<?php echo $nav['name'][$i]; ?>
				</li>
			</a>
			
		<?php } 
		
		?>
</ul>