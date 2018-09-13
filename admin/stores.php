<?php
	require_once '../core/init.php';
	if(!is_logged_in()){
		 login_error_redirect();
	}
	include 'includes/head.php';
	include 'includes/navigation.php';
	$results = $db->query("SELECT * FROM store ORDER BY store");
	$errors = array();

	// Edit store
	if(isset($_GET['edit']) && !empty($_GET['edit'])) {
		$edit_id = (int)$_GET['edit'];
		$edit_id = sanitize($edit_id);
		$edit_result = $db->query("SELECT * FROM store WHERE id = '{$edit_id}'");
		$estore = mysqli_fetch_assoc($edit_result);
	}

	// Delete store
	if(isset($_GET['delete']) && !empty($_GET['delete'])) {
		$delete_id = (int)$_GET['delete'];
		$delete_id = sanitize($delete_id);
		$db->query("DELETE FROM store WHERE id = '{$delete_id}'");
		header("Location: stores.php");
	}

	if(isset($_POST['add_submit'])) {
		$store = sanitize($_POST['store']);
		// Check if store is blank
		if($store == '') {
			$errors[] .= 'You must enter a store!';
		}
		// Check if store exist in database
		$sql = "SELECT * FROM store WHERE store = '{$store}'";
		if(isset($_GET['edit'])) {
			$sql = "SELECT * FROM store WHERE store = '{$store}' AND id != '{$edit_id}'";
		}
		$result = $db->query($sql);
		$count = mysqli_num_rows($result);
		if($count > 0) {
			$errors[] .= $store.' already exist. Please choose another store name.';
		}
		// Display errors
		if(!empty($errors)) {
			echo display_errors($errors);
		} else {
			// Add store to database
			$sql = "INSERT INTO store (store) VALUES ('{$store}')";
			if(isset($_GET['edit'])) {
				$sql = "UPDATE store SET store = '{$store}' WHERE id = '{$edit_id}'";
			}
			$db->query($sql);
			header('Location: stores.php');
		}
	}
?>
<h2 class="text-center">Stores</h2>
<hr>

<div class="text-center">
	<form class="form-inline" action="stores.php<?php echo ((isset($_GET['edit']))?'?edit='.$edit_id : ''); ?>" method="post">
		<div class="form-group">
			<label for="store"><?php echo ((isset($_GET['edit']))?'Edit' : 'Add A'); ?> store:</label>
			<?php
				$store_value = '';
				if(isset($_GET['edit'])) {
					$store_value = $estore['store'];
				} else {
					if(isset($_POST['store'])) {
						$store_value = sanitize($_POST['store']);
					}
				}
			?>
			<input class="form-control" type="text" name="store" id="store" value="<?php echo $store_value; ?>">
			<?php if(isset($_GET['edit'])) : ?>
				<a class="btn btn-default" href="stores.php">Cancel</a>
			<?php endif; ?>
			<input class="btn btn-success" type="submit" name="add_submit" value="<?php echo ((isset($_GET['edit']))?'Edit' : 'Add'); ?> store">
		</div>
	</form>
</div>
<hr>

<table class="table table-bordered table-striped table-auto table-condensed">
	<thead>
		<th></th>
		<th>Store</th>
		<th></th>
	</thead>
	<tbody>
		<?php while($store = mysqli_fetch_assoc($results)) : ?>
		<tr>
			<td><a class="btn btn-xs btn-default" href="stores.php?edit=<?php echo $store['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td><?php echo $store['store']; ?></td>
			<td><a class="btn btn-xs btn-default" href="stores.php?delete=<?php echo $store['id']; ?>"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
		</tr>
		<?php endwhile; ?>
	</tbody>
</table>

<?php
	include 'includes/footer.php';
