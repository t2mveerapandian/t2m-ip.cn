<?php
ob_start();
 include('includes/header.php'); 

if(isset($_POST['submit']))
{	
	$country = $_POST['country'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$whatsapp = $_POST['whatsapp'];
	$wechat = $_POST['wechat'];
	$skype = $_POST['skype'];
	$sort_order = $_POST['sort_order'];
	
    $d = ORM::for_table('sys_offices')->create();
	$d->country = $country;
	$d->email = $email;
	$d->contact = $contact;	
    $d->whatsapp = $whatsapp;
	$d->wechat = $wechat;
	$d->skype = $skype;	
    $d->sort_order = $sort_order;
    $d->save();
    $_SESSION['success'] = 'Office Added Successfully.';
    header('location:manage_offices.php');
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
                     Add Office                     
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashbord.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_offices.php">Manage Offices</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Add Office</a></li>
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
                           <i class="icon-reorder"></i> Add Office 
                        </h4>
                        <div class="tools hidden-phone">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <form action="add_office.php" class="form-horizontal" name="frm_add_events" method="post" enctype="multipart/form-data">
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
										   <label class="control-label">Location(Country)</label>
										   <div class="controls">
											  <input type="text"  class="span6 m-wrap" name="country" required/>											  
											  
										   </div>
										</div>
										<div class="control-group">
										   <label class="control-label">Email address</label>
										   <div class="controls">
											  <input type="email"  class="span6 m-wrap" name="email" required/>											  
											  
										   </div>
										</div>
										<div class="control-group">
										   <label class="control-label">Contact No</label>
										   <div class="controls">
											  <input type="text"  class="span6 m-wrap" name="contact"/>											  
											 
										   </div>
										</div>
										
										<div class="control-group">
										   <label class="control-label">WhatsApp</label>
										   <div class="controls">
											  <input type="text"  class="span6 m-wrap" name="whatsapp"/>											  
											 
										   </div>
										</div>

										
										<div class="control-group">
										   <label class="control-label">WeChat</label>
										   <div class="controls">
											  <input type="text" class="span6 m-wrap" name="wechat" value=""/>
										   </div>
										</div>
									
										<div class="control-group">
										   <label class="control-label">Skype</label>
										   <div class="controls">
											  <input type="text" class="span6 m-wrap" name="skype" value=""/>
										   </div>
										</div>
										
										<div class="control-group">
										   <label class="control-label">Sort Order</label>
										   <div class="controls">
											  <input type="text"  class="large  m-wrap" name="sort_order" id="sort_order" value="" required/>											  
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