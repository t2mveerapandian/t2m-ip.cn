<?php
ob_start();
 include('includes/header.php'); 

if(isset($_POST['submit']))
{	
    
	$description = $_POST['description'];

    $d = ORM::for_table('homepagetext')->create();
	$d->description = $description;
    $d->status = 1;
    $d->save();
    $_SESSION['success'] = 'Text Added Successfully.';
    header('location:manage_homepageText.php');
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
                     Add Text                     
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashbord.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_homepageText.php">Manage Text</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Add Text</a></li>
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
                           <i class="icon-reorder"></i> Add Text 
                        </h4>
                        <div class="tools hidden-phone">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <form action="add_homepageText.php" class="form-horizontal" name="add_homepageText" method="post" onsubmit="return manage_validation_service();">
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
										   <label class="control-label"> Description</label>
										   <div class="controls">
											  <textarea  class="span6 m-wrap ckeditor" name="description" id="description"/>	</textarea>										  
											  <span class="help-inline" id="event_description_error" style="display: none;">Provide Description</span>
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

   
   
    var categorye_title = jQuery("#description").val();    
    
    
    if(service_title==""){
        jQuery('#event_description_error').show();
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