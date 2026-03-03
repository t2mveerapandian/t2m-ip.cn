<?php include('includes/header.php'); 

if(isset($_REQUEST['action'])){
if($_REQUEST['action']=='del')
{   
   //
    
     $did = $_REQUEST['did'];
    
     $d = ORM::for_table('sys_blog')->find_one($did);
     if($d)
     {
            $d->delete();
            $_SESSION['success'] = 'Blog deleted successfully.';
                    
      }

}
}


$d = ORM::for_table('sys_blog')->order_by_desc('id')->find_many();

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
							Manage News 
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="dashbord.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							
							<li><a href="#">Manage News</a></li>
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
								<h4><i class="icon-globe"></i>Manage News</h4>
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
										<a href="add_blog.php"><button id="sample_editable_1_new" class="btn green">
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
											<th style="width:8px;">S.N</th>
											<th class="hidden-480">Title</th>
											<th class="hidden-480">Category</th>
											<th class="hidden-480">Dated</th>
											<th class="hidden-480" style="width:220px;">Action</th>											
										</tr>
									</thead>
									<tbody>
									<?php  $i= 1; foreach($d as $page) {  ?>
										<tr class="odd gradeX">
											<td><?php echo $i ; ?></td>
											<td class="hidden-480"><?php echo $page['blog_title'] ; ?></td>
											<td class="hidden-480"><?php if($page['blog_cat_id']==2){ echo 'Press Release'; }else{ echo 'Industry News';}?></td>
											<td class="hidden-480"><?php echo date('d/m/Y', $page['created_date']); ?></td>
											<td class="hidden-480">
												<a class="btn green" href="<?php echo SITE_URL.'news/'.$page['slug']; ?>" target="_blank" title="Preview"><i class="icon-eye-open"></i></a>
												<a class="btn yellow" href="functions/middleware.php?module=blog&action=update_status&id=<?php if(isset($page['id']) && $page['id']!='') echo $page['id'];?>&status=<?php if(isset($page['status']) && $page['status']=='1') echo "0"; else echo "1"; ?>"><?php if(isset($page['status']) && $page['status']=='1') echo "Active"; else echo "Inactive"; ?></a>&nbsp;
												<a class="btn blue" href="add_blog.php?id=<?php echo $page['id'] ; ?>" title="Edit"><i class="icon-edit"></i></a>
												&nbsp;
												<a class="btn red" href="manage_blogs.php?action=del&did=<?php echo $page['id'] ; ?>" title="Delete"><i class="icon-trash"></i></a>
											</td>
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