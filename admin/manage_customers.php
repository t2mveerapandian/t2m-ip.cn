<?php include('includes/header.php'); 


if(isset($_REQUEST['action'])){
if($_REQUEST['action']=='del')
{   
     
     $did = $_REQUEST['did'];
    
     $d = ORM::for_table('sys_customers')->find_one($did);
     if($d)
     {
            $d->delete();
            $_SESSION['success'] = 'Customers deleted successfully.';
                    
      }

}





if($_REQUEST['action']=='active')
{   
     
     $did = $_REQUEST['did'];
    
     $d = ORM::for_table('sys_customers')->find_one($did);	 
     if($d)
     {
            $d->status = 'Active';
			$d->save();
            $_SESSION['success'] = 'Customer Status Activated Successfully.';
                    
      }

}


if($_REQUEST['action']=='inactive')
{   
     
     $did = $_REQUEST['did'];
    
     $d = ORM::for_table('sys_customers')->find_one($did);	 
     if($d)
     {
            $d->status = 'Inactive';
			$d->save();
            $_SESSION['success'] = 'Customer Status Deactivated Successfully.';
                    
      }

}



}

$d = ORM::for_table('sys_customers')->orderByDesc('id')->find_many();
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
							Manage customers 
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="dashbord.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							
							<li><a href="#">Manage customers  </a></li>
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
								<h4><i class="icon-globe"></i>Manage customers </h4>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<!-- <div class="portlet-body">
								<div class="clearfix">
									<div class="btn-group">
										<a href="add_vendor.php" ><button id="sample_editable_1_new" class="btn green">
										Add New <i class="icon-plus"></i>
										</button></a>
									</div>
									
								</div> -->
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
											<th style="width:8px;">S.N</th>
											<th >Name</th>	
                                            <th >Email</th>															
											<th >Phone</th>					
										    <th >Action</th>											
											
											
											<!-- <th ></th> -->
										</tr>
									</thead>
									<tbody>
									<?php  $i= 1 ;foreach($d as $hotel) {  ?>
										<tr class="odd gradeX">
											<td><?php echo $i ; ?></td>
											<td ><?php echo $hotel['firstname']." ".$hotel['lastname']; ?></td>										
											<td ><a href="mailto:<?php echo $hotel['email'] ; ?>"><?php echo $hotel['email_id'] ; ?></a></td>
											<td ><?php echo $hotel['phone_number']; ?></td>
											
											
											<td >
												<?php if($hotel->status=='Active'): ?>
												<span class="label label-success"><a href="manage_customers.php?action=inactive&did=<?php echo $hotel['id'] ; ?>" ><?php echo $hotel['status'] ; ?></a></span>
											<?php endif;?>
											<?php if($hotel->status=='Inactive'): ?>
												<span class="label label-error"> <a href="manage_customers.php?action=active&did=<?php echo $hotel['id'] ; ?>" ><?php echo $hotel['status'] ; ?></a></span>
											<?php endif;?>
											 <!-- <a href="edit_vendor.php?id=<?php echo $hotel['id'] ; ?>" > Edit  </a> | -->
											 <a href="manage_customers.php?action=del&did=<?php echo $hotel['id'] ; ?>" > Remove  </a> </td>
										</tr>
									<?php  $i++ ;} ?>	
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