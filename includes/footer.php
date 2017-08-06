	</div><!-- /.container -->


	<!-- Footer -->
	<footer class="text-center" id="footer">
		&copy; Copyright 2017 Anita
	</footer>

	<script src="js/jquery-1.12.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		$(window).scroll( function() {
			var vscroll = $(this).scrollTop();
			//console.log(vscroll);
			$('#logotext').css({
				"transform" : "translate(0px, "+vscroll/2+"px)"

			});
		});

		function detailsmodal(id) {
			var data = {"id" : id};
			// send data to detailsmodal.php
			jQuery.ajax({
				url		: './includes/detailsmodal.php',
				method	: "post",
				data	: data,
				success	: function(data){
					jQuery('body').append(data);
					jQuery('#details-modal').modal('toggle');
				},
				error	: function(){
					alert("Something went wrong!");
				}
			});
		}

		function add_to_cart(){
			jQuery('#modal_errors').html("");
			var quantity = jQuery('#quantity').val();
			var error = '';
			var data = jQuery('#add_product_form').serialize();
			if (quantity == '' || quantity == 0){
				error += '<p class="text-danger text-center">Quantity cannot be 0 </p>';
				jQuery('#modal_errors').html(error);
				return;
			}else{
				jQuery.ajax({
					url : './admin/parsers/add_cart.php',
					method : 'post',
					data : data,
					success : function(result){
						console.log(result);
						location.reload();
					},
					error : function(result){
						console.log(result);
						alert("Something went wrong");
					}
				})
			}

		}
	</script>
</body>
</html>
