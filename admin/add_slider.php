<?php
ob_start();
 include('includes/header.php'); 

if(isset($_POST['submit']))
{	
	$category              = $_POST['category'];
	$link_url              = $_POST['link_url'];
	$sort_order         = $_POST['sort_order'];
	
    $d = ORM::for_table('sys_slider')->create();
	$d->category = $category;
	$d->link_url = $link_url;
    if(isset($_FILES['slider_image']['name']) && $_FILES['slider_image']['name']!='')
			{
				$extension = pathinfo($_FILES['slider_image']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' ,'jpg');
				
				if(in_array($extension, $allowed_extension))
				{
					$banner = "slide_".time().".".$extension;
					$d->image   = $banner;
					 move_uploaded_file($_FILES['slider_image']['tmp_name'], "images/sliders/".$banner);
				}
				else
				{
					$d->image ='';
				}
			}
	
    $d->sort_order = $sort_order;
    $d->save();
    $_SESSION['success'] = 'Slider Added Successfully.';
    header('location:manage_slider.php');
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
                     Add Slider                     
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashbord.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_slider.php">Manage Slider</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Add Category</a></li>
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
                           <i class="icon-reorder"></i> Add Slider 
                        </h4>
                        <div class="tools hidden-phone">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <form action="add_slider.php" class="form-horizontal" name="add_slider" method="post" onsubmit="return manage_validation_service();" enctype="multipart/form-data">
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
												<label class="control-label">Display In</label>
												<div class="controls">
													<select class="span6 m-wrap" name="category" required>
													<option value="1">Featured IP</option>
													<option value="2">Target Market</option>		
													</select>
													
												</div>
											</div>
                                      
									
										<div class="control-group">
										   <label class="control-label">Link URL</label>
										   <div class="controls">
											  <input type="text"  class="span6 m-wrap" name="link_url" id="link_url" required/>											  
										   </div>
										</div>										
										
										<div class="control-group">
										   <label class="control-label">Slider Image </label>
										   <div class="controls">											  
												<input type="file" name="slider_image" class="span6 m-wrap" id="slider_image" required>
										   </div>
										</div>
											<div class="control-group">
										   <label class="control-label">Display Order</label>
										   <div class="controls">
											  <input type="text"  class="span6 m-wrap" name="sort_order" id="sort_order" required/>											  
										   </div>
										</div>
										<div class="form-actions clearfix">   
											<button type="submit" name="submit"  class="btn blue"><i class="icon-ok"></i> Submit</button>
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
 <script type="text/javascript">

function manage_validation_service(){

   
   
    var slider_title = jQuery("#title").val();    
    var slider_image = jQuery("#slider_image").val();   
    
    if(slider_title==""){
        jQuery('#slider_title_error').show();
        flg=1;
    }
  
     if(slider_image==""){
        jQuery('#slider_image_error').show();
        flg=1;
    }
        
    if(flg==1){
        return false;    
    }else{
        return true;    
    }
    
}


</script> 
   <?php include('includes/footer.php') ;?>