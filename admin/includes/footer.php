<!-- BEGIN FOOTER -->
	<div class="footer">
		<?php echo $config['copyright']; ?>
		<div class="span pull-right">
			<span class="go-top"><i class="icon-angle-up"></i></span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS -->
	<!-- Load javascripts at bottom, this will reduce page load time -->
	<script src="assets/js/jquery-1.8.3.min.js"></script>	
	<script src="assets/breakpoints/breakpoints.js"></script>	
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/fancybox/source/jquery.fancybox.pack.js"></script>		
	<script src="assets/js/jquery.blockui.js"></script>
	<script src="assets/js/jquery.cookie.js"></script>
	<!-- ie8 fixes -->
	<!--[if lt IE 9]>
	<script src="assets/js/excanvas.js"></script>
	<script src="assets/js/respond.js"></script>
	<![endif]-->	
	<script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
	<script src="assets/js/app.js"></script>		
	<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage("table_managed");
			App.init();
			
			$('#product_title').on('change', function() {
			var prod_name = $("#product_title").val();
			var prod_action = $("#prod_action").val();
			var prod_cat = $("#category").val();
				$.ajax({
					url: "<?php echo SITE_URL.'admin/checkproduct.php'; ?>",
					type: "POST",
					data: {
						prod_name: prod_name,
						prod_cat: prod_cat,
						prod_action: prod_action
					},
					dataType: 'json',
					cache: false,
					success: function(result) {
						if(result==0){
						$("#product_title").val('');	
						$("#product_title_error").html("<p style='color:red;'>Sorry: Product already exists.</p>");	
						}else{
						$("#product_title_error").html('');			
						}
					}
				});
			});
			
			$('#product_slug').on('change', function() {
			var product_slug = $("#product_slug").val();
			var prod_action = $("#prod_action").val();
				$.ajax({
					url: "<?php echo SITE_URL.'admin/checkproduct.php'; ?>",
					type: "POST",
					data: {
						product_slug: product_slug,
						prod_action: prod_action
					},
					dataType: 'json',
					cache: false,
					success: function(result) {
						if(result==0){
						$("#product_slug").val('');	
						$("#product_slug_error").html("<p style='color:red;'>Sorry: Product URL already exists.</p>");	
						}else{
						$("#product_slug_error").html('');			
						}
					}
				});
			});
			
			$('#event_slug').on('change', function() {
			var event_slug = $("#event_slug").val();
				$.ajax({
					url: "<?php echo SITE_URL.'admin/checkevent.php'; ?>",
					type: "POST",
					data: {
						event_slug: event_slug,
					},
					dataType: 'json',
					cache: false,
					success: function(result) {
						 
						if(result==0){
						$("#event_slug").val('');	
						$("#event_slug_error").html("<p style='color:red;'>Sorry: Event URL already exists.</p>");	
						}else{
						$("#event_slug_error").html('');			
						}
					}
				});
			});
		});
	</script>
</body>
<!-- END BODY -->
</html>
