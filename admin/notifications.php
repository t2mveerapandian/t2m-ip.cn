<?php include('includes/header.php'); 


if(isset($_REQUEST['action'])){
if($_REQUEST['action']=='del')
{   
   /*  echo "<pre>";
     print_r($_REQUEST);
     echo "<pre>";
     die('code die');*/
    
     $did = $_REQUEST['did'];
    
     $d = ORM::for_table('sys_notification')->find_one($did);
     if($d)
     {
            $d->delete();
            $_SESSION['success'] = 'Notification deleted successfully.';
                    
      }

}
}
$noti = ORM::for_table('sys_notification')->where('status',0)->orderByDesc('date_updated')->find_many();
//echo "<pre>"; print_r($noti); die;
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
							Manage Notifications 
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="dashbord.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							
							<li><a href="#">Manage Notifications </a></li>
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
								<h4><i class="icon-globe"></i>Manage Notifications</h4>
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
								
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Notification</th>
											<th class="hidden-480">Time</th>											
											<th ></th>
										</tr>
									</thead>
									<tbody>
									<?php $i= 1 ;foreach($noti as $notification) {
									if($notification->action == 0){
										$ref_text = "added new rooms";
									}else{
										$ref_text = "updated their rooms";
									}
									$hotel = ORM::for_table('sys_hotels')->where('id',$notification['hotel_id'])->find_one();
									$time_diff = time() - $notification['date_updated'];
									if($time_diff < 60){
										$time = "Just now";
									}elseif((60 <= $time_diff) && ($time_diff < 3600)){
										$time = floor($time_diff/60)." mins ago";
									}elseif((3600 <= $time_diff) && ($time_diff <= 86400)){
										$time = floor($time_diff/(60*60))." hrs ago";	
									}else{
										$time = floor($time_diff/(60*60*24))." days ago";	
									}
									
									
									?>
										<tr class="odd gradeX">
											
											<td><?php echo $hotel->hotel_name." ".$ref_text; ?></td>
											<td class="hidden-480"><?php echo $time;?></td>
											
											<td >
											<a href="add_room.php?id=<?php echo $notification['hotel_id'];?>"> View </a>| <a href="notifications.php?action=del&did=<?php echo $notification['id'] ; ?>" > Delete  </a> </td>
										</tr>
									<?php $i++ ; } ?>	
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