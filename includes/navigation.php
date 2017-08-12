<?php
	$sql = "SELECT * FROM categories WHERE parent = 0";
	$pquery = $db->query($sql);
?>
<!-- Navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">
						<img src="images/header/logo.png" width="auto" height="50" alt="">
				</a>
		</div>

			<ul class="nav navbar-nav">
				<?php while($parent = mysqli_fetch_assoc($pquery)) : ?>
				<?php
					$parent_id = $parent['id'];
					$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
					$cquery = $db->query($sql2);
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $parent['category']; ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php while($child = mysqli_fetch_assoc($cquery)) : ?>
						<li><a href="category.php?cat=<?=$child['id'];?>"><?php echo $child['category']; ?></a></li>
						<?php endwhile; ?>
					</ul>
				</li>
				<?php endwhile; ?>
				<li> <a href="cart.php"> <span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
			</ul>
		</div>
</nav>
