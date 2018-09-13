</div><!-- .container-fluid -->

<!-- Footer -->
<footer class="text-center" id="footer">
	&copy; Copyright 2017 Anita
</footer>

<script>

	function get_child_options(selected) {
		if(typeof selected === 'undefined'){
			var selected = '';
		}
		var parentID = jQuery('#parent').val();
		console.log(parentID);
		jQuery.ajax({

			url: './parsers/child_categories.php',
			type: 'post',
			data: {parentID : parentID, selected : selected},
			success: function(data) {
				jQuery('#child').html(data);
			},
			error: function() {
				alert("Something went wrong with the child options!");
			},
		});
	}
	jQuery('select[name="parent"]').change(function(){
		get_child_options();
	});
</script>

</body>
</html>
