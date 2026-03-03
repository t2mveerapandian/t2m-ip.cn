<?php include('includes/header.php'); 

if(isset($_REQUEST['action'])){
if($_REQUEST['action']=='del')
{   
   /*  echo "<pre>";
     print_r($_REQUEST);
     echo "<pre>";
     die('code die');*/
    
     $did = $_REQUEST['did'];
	 
	 $d = ORM::for_table('sys_events')->find_one($did);
    
    
     if($d)
     {
            $d->delete();
            $_SESSION['success'] = 'Event deleted successfully.';
                    
      }

}
}
$d = ORM::for_table('sys_events')->order_by_desc('id')->find_many();
?>
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
							Manage Events 
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="dashbord.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							
							<li><a href="#">Manage Events </a></li>
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
								<h4><i class="icon-globe"></i>Manage Events</h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="clearfix">
									<div class="btn-group">
										<a href="add_events.php" ><button id="sample_editable_1_new" class="btn green">
										Add New <i class="icon-plus"></i>
										</button></a>
									</div>
									
								</div>
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
											<th style="width:8px;">Id</th>
											<th> Event Title</th>
											<th> Start Date</th>
											<th> End Date</th>
											<th> Featured</th>
											<th class="hidden-480">Action</th>
											
										</tr>
									</thead>
									<tbody>
									<?php foreach($d as $category) {  ?>
										<tr class="odd gradeX">
											<td><?php echo $category['id'] ; ?></td>
											<td><?php echo $category['title'] ; ?></td>
											<td><?php echo date('d/m/Y', strtotime($category['start_date'])); ?></td>
											<td><?php echo date('d/m/Y', strtotime($category['end_date'])); ?></td>
											<td><?php if($category['is_featured']==1){ echo 'yes'; }else{ echo 'No'; } ?></td>											
										<td><a href="edit_events.php?id=<?php echo $category['id'] ; ?>" > Edit  </a> |  <a href="manage_events.php?action=del&did=<?php echo $category['id'] ; ?>" > Delete  </a> </td>
										</td>	 
										</tr>
									<?php } ?>	
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