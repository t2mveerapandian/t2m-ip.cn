<?php
ob_start();
 include('includes/header.php'); 

if(isset($_POST['submit']))
{	
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$title = $_POST['title'];
	$slugd = $_POST['slug'];
	$slug = generateslug($slugd,'sys_events','add');
	$link_url = $_POST['link_url'];
	$description = $_POST['description'];
	$sort_order = $_POST['sort_order'];
	$is_featured = $_POST['is_featured'];
	if($is_featured==''){ $is_featured=0; }

    $d = ORM::for_table('sys_events')->create();
	if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
			{
				$extension = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' ,'jpg');
				
				if(in_array($extension, $allowed_extension))
				{
					$banner = "event_".time().".".$extension;
					$d->banner   = $banner;
					 move_uploaded_file($_FILES['banner']['tmp_name'], "images/events/".$banner);
				}
				else
				{
					$d->banner ='';
				}
			}
	$d->start_date = $start_date;
	$d->end_date = $end_date;	
    $d->title = $title;
	$d->slug = $slug;
	$d->link_url = $link_url;	
	$d->description = $description;
    $d->sort_order = $sort_order;
	$d->is_featured = $is_featured;
    $d->save();
    $_SESSION['success'] = 'Event Added Successfully.';
    header('location:manage_events.php');
    exit;
			
	 		
}				
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
                  <h3 class="page-title">
                     Add Event                     
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashbord.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_categories.php">Manage Event</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Add Event</a></li>
                  </ul>
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
                  <div class="portlet box blue" id="form_wizard_1">
                     <div class="portlet-title">
                        <h4>
                           <i class="icon-reorder"></i> Add Event 
                        </h4>
                        <div class="tools hidden-phone">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <form action="add_events.php" class="form-horizontal" name="frm_add_events" method="post" enctype="multipart/form-data">
						    <div class="form-wizard">
                              <?php  if(isset($_SESSION['message_err']))
								{ 
								?>
								<div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<strong>Error!</strong> <?php echo $_SESSION['message_err']; ?>
								</div>
								
								<?php unset($_SESSION['message_err']); } ?>
								<div class="tab-content">
									<div class="tab-pane active" id="tab1">
									
									<div class="control-group">
										   <label class="control-label">Start Date</label>
										   <div class="controls">
											  <input type="date"  class="span6 m-wrap" name="start_date" required/>											  
											  
										   </div>
										</div>
										<div class="control-group">
										   <label class="control-label">End Date</label>
										   <div class="controls">
											  <input type="date"  class="span6 m-wrap" name="end_date" required/>											  
											  
										   </div>
										</div>
										
										<div class="control-group">
										   <label class="control-label">Event Title</label>
										   <div class="controls">
											  <input type="text"  class="span6 m-wrap" name="title" id="title" required/>											  
											 
										   </div>
										</div>

										<div class="control-group">
										   <label class="control-label">Display Url</label>
										   <div class="controls">
											  <input type="text" class="span6 m-wrap" name="slug" id="event_slug" value="" required/>
											  <span class="help-block" id="event_slug_error"></span>	
										   </div>
										</div>	
								
										<div class="control-group">
										   <label class="control-label">Banner/Logo</label>
										   <div class="controls">
											<input type="file" class="span6 m-wrap" name="banner" id="banner" required/>
										    </div>
										</div>
										
										<div class="control-group">
										   <label class="control-label">Event page URL</label>
										   <div class="controls">
											  <input type="text" class="span6 m-wrap" name="link_url" value=""/>
										   </div>
										</div>
									
										<div class="control-group">
										   <label class="control-label">Event Description</label>
										   <div class="controls">
											  <textarea  class="span6 m-wrap ckeditor" name="description" id="description"/></textarea>										  
										   </div>
										</div>
										
										<div class="control-group">
										   <label class="control-label">Sort Order</label>
										   <div class="controls">
											  <input type="text"  class="large  m-wrap" name="sort_order" id="sort_order" value="" required/>											  
										   </div>
										</div>
									
									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Featured</label>
												<div class="controls">
													<input type="checkbox" class="large  m-wrap"  name="is_featured" value="1">
												</div>
											</div>
                                       </div>
									</div>
										
										<div class="form-actions clearfix">   
											<button type="submit" name="submit" class="btn blue"><i class="icon-ok"></i> Submit</button>
										</div>
									</div>                        
								</div>						
							</div>
						</form>
					</div>
				</div>
            <!-- END PAGE CONTENT-->         
				</div>
         <!-- END PAGE CONTAINER-->
			</div>
      <!-- END PAGE -->  
		</div>
   <!-- END CONTAINER -->
	</div>   
</div>
 
   <?php include('includes/footer.php') ;?>