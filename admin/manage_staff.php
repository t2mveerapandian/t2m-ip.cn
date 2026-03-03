<?php include('includes/header.php'); 

if($_SESSION['role']==2)
{
 
   header("location:edit_staff.php?id=".$_SESSION['id']);
   exit();
}

if(isset($_REQUEST['action'])){
if($_REQUEST['action']=='del')
{   
   /*  echo "<pre>";
     print_r($_REQUEST);
     echo "<pre>";
     die('code die');*/
    
     $did = $_REQUEST['did'];
    
     $d = ORM::for_table('sys_users')->find_one($did);
     if($d)
     {
            $d->delete();
            $_SESSION['success'] = 'Staff deleted successfully.';
                    
      }

}
}
$d = ORM::for_table('sys_users')->where('role',2)->find_many();
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
							Manage Staff 
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="dashbord.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							
							<li><a href="#">Manage Staff </a></li>
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
								<h4><i class="icon-globe"></i>Manage Staff</h4>
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
										<a href="add_staff.php" ><button id="sample_editable_1_new" class="btn green">
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
								
								<table class="table table-striped table-bordered table-hover" id="sample_1">
									<thead>
										<tr>
											<th style="width:8px;">Id</th>
											<th>Username</th>
											<th class="hidden-480">Name</th>
											<th class="hidden-480">Email</th>
											<th class="hidden-480">Phone</th>											
											<th ></th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($d as $staff) {  ?>
										<tr class="odd gradeX">
											<td><?php echo $staff['id'] ; ?></td>
											<td><?php echo $staff['username'] ; ?></td>
											<td class="hidden-480"><?php echo $staff['fullname'] ; ?></td>
											<td class="hidden-480"><a href="mailto:<?php echo $staff['email'] ; ?>"><?php echo $staff['email'] ; ?></a></td>
											<td class="center hidden-480"><?php echo $staff['phone'] ; ?></td>
											<td ><span class="label label-success"><?php echo $staff['status'] ; ?></span>
											 <a href="edit_staff.php?id=<?php echo $staff['id'] ; ?>" > Edit  </a> |  <a href="manage_staff.php?action=del&did=<?php echo $staff['id'] ; ?>" > Delete  </a> </td>
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