<?php include('includes/header.php'); 

if($_SESSION['role']==2)
{
 
   header("location:edit_category.php?id=".$_SESSION['id']);
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
	 
	 $d = ORM::for_table('sys_course_categories')->find_one($did);
    
    
     if($d)
     {
            $d->delete();
            $_SESSION['success'] = 'Category deleted successfully.';
                    
      }

}
}
$d = ORM::for_table('sys_course_categories')->where(array('parent_category'=>0))->order_by_asc('sort_order')->find_many();
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
							Manage Product Categories 
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="dashbord.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							
							<li><a href="#">Manage Categories </a></li>
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
								<h4><i class="icon-globe"></i>Manage Categories</h4>
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
										<a href="add_category.php" ><button id="sample_editable_1_new" class="btn green">
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
										
											<th> Category Title</th>											
											<th class="hidden-480">Action</th>
											
											<th style="width:8px;">Order</th>											
											
										</tr>
									</thead>
									<tbody>
									<?php foreach($d as $category) {  ?>
										<tr class="odd gradeX">
											
											<td><?php echo $category['title'] ; ?></td>											
											<td><a href="edit_category.php?id=<?php echo $category['id'] ; ?>" > Edit  </a> |  <a href="manage_categories.php?action=del&did=<?php echo $category['id'] ; ?>" > Delete  </a> </td>
											 <td><?php echo $category['sort_order'] ; ?></td>
										</tr>
										
										
									<?php
									     $d1 = ORM::for_table('sys_course_categories')->where(array('parent_category'=>$category['id']))->order_by_asc('sort_order')->find_many();
										
										 foreach($d1 as $category1) {  ?>
										 
										  <tr class="odd gradeX">
										
											<td style="padding-left:40px;"><?php echo $category1['title'] ; ?> <?php if(isset($category1->cat_icon) && $category1->cat_icon!=''){ ?> <img src="<?php echo 'images/icons/'.$category1->cat_icon;?>" width="25px;"> <?php }?></td>											
											<td><a href="edit_category.php?id=<?php echo $category1['id'] ; ?>" > Edit  </a> |  <a href="manage_categories.php?action=del&did=<?php echo $category1['id'] ; ?>" > Delete  </a> </td>
											 <td><?php echo $category1['sort_order'] ; ?></td>
										</tr>
										 
										 
										 <?php } ?>
										
									
										
										
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