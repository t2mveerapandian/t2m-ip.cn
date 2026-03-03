<?php include('includes/header.php'); ?>
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?php include('includes/sidebar.php'); ?>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->			
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<div class="color-panel hidden-phone">
							<div class="color-mode-icons icon-color"></div>
							<div class="color-mode-icons icon-color-close"></div>
							<div class="color-mode">
								<p>THEME COLOR</p>
								<ul class="inline">
									<li class="color-black current color-default" data-style="default"></li>
									<li class="color-blue" data-style="blue"></li>
									<li class="color-brown" data-style="brown"></li>
									<li class="color-purple" data-style="purple"></li>
									<li class="color-white color-light" data-style="light"></li>
								</ul>
								<label class="hidden-phone">
								<input type="checkbox" class="header" checked value="" />
								<span class="color-mode-label">Fixed Header</span>
								</label>							
							</div>
						</div>
						<!-- END BEGIN STYLE CUSTOMIZER -->  
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
							Manage Slider Menu 
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="dashbord.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							
							<li><a href="#">Manage Slider Menu </a></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box light-grey">
							<div class="portlet-title">
								<h4><i class="icon-globe"></i>Manage Slider Menu</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								
								<?php  if(isset($_SESSION['success']))
								{ 
								?>
								<div class="alert alert-success">
									<button class="close" data-dismiss="alert"></button>
									<strong>Success!</strong> <?php echo $_SESSION['success']; ?>
								</div>
								<?php unset($_SESSION['success']); } ?>
								<table class="table table-striped table-bordered table-hover" id="sample">
									<thead>
										<tr>
											<th> Menu</th>											
											<th class="hidden-480">Action</th>
										</tr>
									</thead>
									<tbody>
									<tr class="odd gradeX">
										<td><b>Cellular</b></td>											
										<td>&nbsp;</td>
									</tr>
										<?php
									     $menud = ORM::for_table('sys_slider_menu')->where(array('category'=>'Cellular'))->order_by_asc('id')->find_many();
										 $sn=1;
										 foreach($menud as $md) {  
										 ?>
										  <tr class="odd gradeX">
											<td style="padding-left:60px;"><img src="<?php echo SITE_URL.$md['menu_icon'];?>" width="70px;"></td>											
											<td><a href="edit_slider_menu.php?id=<?php echo $md['id'] ; ?>" > Edit  </a> </td>
										  </tr>
										  <?php $sn++; } ?>
									<tr class="odd gradeX">
										<td><b>Broadcast</b></td>											
										<td>&nbsp;</td>
									</tr>
										<?php
									     $menud = ORM::for_table('sys_slider_menu')->where(array('category'=>'Broadcast'))->order_by_asc('id')->find_many();
										 $sn=1;
										 foreach($menud as $md) {  
										 ?>
										  <tr class="odd gradeX">
											<td style="padding-left:60px;"><img src="<?php echo SITE_URL.$md['menu_icon'];?>" width="70px;"></td>											
											<td><a href="edit_slider_menu.php?id=<?php echo $md['id'] ; ?>" > Edit  </a> </td>
										  </tr>
										  <?php $sn++; } ?>
									<tr class="odd gradeX">
										<td><b>Interface</b></td>											
										<td>&nbsp;</td>
									</tr>
										<?php
									     $menud = ORM::for_table('sys_slider_menu')->where(array('category'=>'Interface'))->order_by_asc('id')->find_many();
										 $sn=1;
										 foreach($menud as $md) {  
										 ?>
										  <tr class="odd gradeX">
											<td style="padding-left:60px;"><img src="<?php echo SITE_URL.$md['menu_icon'];?>" width="70px;"></td>											
											<td><a href="edit_slider_menu.php?id=<?php echo $md['id'] ; ?>" > Edit  </a> </td>
										  </tr>
										  <?php $sn++; } ?>
									<tr class="odd gradeX">
										<td><b>Wireless</b></td>											
										<td>&nbsp;</td>
									</tr>
										<?php
									     $menud = ORM::for_table('sys_slider_menu')->where(array('category'=>'Wireless'))->order_by_asc('id')->find_many();
										 $sn=1;
										 foreach($menud as $md) {  
										 ?>
										  <tr class="odd gradeX">
											<td style="padding-left:60px;"><img src="<?php echo SITE_URL.$md['menu_icon'];?>" width="100px;"></td>											
											<td><a href="edit_slider_menu.php?id=<?php echo $md['id'] ; ?>" > Edit  </a> </td>
										  </tr>
										  <?php $sn++; } ?>
									<tr class="odd gradeX">
										<td><b>Audio SW</b></td>											
										<td>&nbsp;</td>
									</tr>
										<?php
									     $menud = ORM::for_table('sys_slider_menu')->where(array('category'=>'Audio SW'))->order_by_asc('id')->find_many();
										 $sn=1;
										 foreach($menud as $md) {  
										 ?>
										  <tr class="odd gradeX">
											<td style="padding-left:60px;"><img src="<?php echo SITE_URL.$md['menu_icon'];?>" width="120px;"></td>											
											<td><a href="edit_slider_menu.php?id=<?php echo $md['id'] ; ?>" > Edit  </a> </td>
										  </tr>
										  <?php $sn++; } ?>	  
									</tbody>
								</table>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
				</div>
				
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<?php include('includes/footer.php') ;?>