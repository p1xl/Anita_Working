<?php
	require_once '../core/init.php';
	$id = $_POST['id'];
	$id = (int)$id;
	$result = $db->query("SELECT * FROM products WHERE id = '$id'");
	$product = mysqli_fetch_assoc($result);
	$store_id = $product['store'];
	$store_query = $db->query("SELECT store FROM store WHERE id = '$store_id'");
	$store = mysqli_fetch_assoc($store_query);
?>

<!-- Details Modal -->
<?php ob_start(); ?>
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" onclick="closeModal()" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-center" id="myModalLabel"><?=$product['title']; ?></h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<span id="modal_errors" class="bg-danger"></span>
						<div class="col-sm-6">
							<div class="center-block">
								<img class="details img-responsive" src="images/products/<?=$product['image']; ?>" alt="<?= $product['title']; ?>">
							</div>
						</div>

						<div class="col-sm-6">
							<h4>Details</h4>
							<p><?= nl2br($product['description']); ?></p>
							<hr>
							<p>Price: $<?= $product['price']; ?></p>
                            <p>Delivery Price: $<?=$product['deliveryprice']; ?></p>
							<p>Store: <?= $store['store']; ?></p>

							<hr>

							<form action="add_cart.php" method="post" id="add_product_form">
								<input type="hidden" name="product_id" value="<?=$id; ?>"
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label for="quantity">Quantity:</label>
											<input class="form-control" id="quantity" type="number" name="quantity">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" onclick="closeModal()">Close</button>
				<button onclick="add_to_cart();return false" class="btn btn-warning"><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
			</div>
		</div>
	</div>
</div>
<script>

	function closeModal() {
		jQuery('#details-modal').modal('hide');
		setTimeout(function(){
			jQuery('#details-modal').remove();
			jQuery('.modal-backdrop').remove();
		},500);
	}
</script>
<?php echo ob_get_clean();
