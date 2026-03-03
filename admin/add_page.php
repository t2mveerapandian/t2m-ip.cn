<?php include('includes/header.php');
if(isset($_GET['id']) && $_GET['id']!='')
{
	$check = ORM::for_table('sys_cms')->find_one($_GET['id']);
	if(isset($check->id) && $check->id > 0)
	{
		$data = $check;
	}
	else
	{
		$_SESSION['message_err'] = 'Something went wrong.';
	}
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
                     Add Page
                    
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_pages.php">Manage Pages</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Add New Page</a></li>
                  </ul>
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
			   
			   
			   <div class="tab-pane " id="tab_2">
                           <div class="portlet box green">
                              <div class="portlet-title">
                                 <h4><i class="icon-reorder"></i>Add New Page</h4>
                                 <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                    <a href="javascript:;" class="reload"></a>
                                    <a href="javascript:;" class="remove"></a>
                                 </div>
                              </div>
                              <div class="portlet-body form">
							  
                                 <!-- BEGIN FORM-->
								 <?php  if(isset($_SESSION['message_err']))
								{ 
								?>
                              <div class="alert alert-error">
									<button class="close" data-dismiss="alert"></button>
									<strong>Error!</strong> <?php echo $_SESSION['message_err']; ?>
								</div>
								<?php unset($_SESSION['message_err']); } ?>
                                <form action="functions/middleware.php?module=cms&action=<?php if(isset($data->id) && $data->id!='') echo "edit_page&id=".$data->id; else echo "add_page";?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <h3 class="form-section">Page Detail</h3>
                                    <div class="row-fluid">
                                       <div class="span10">
											<div class="control-group">
											   <label class="control-label">Title</label>
											   <div class="controls">
												  <input type="text" class="large m-wrap" name="page_title" id="page_title" value="<?php if(isset($data->cms_title) && $data->cms_title!='') echo $data->cms_title;?>"/>
												  <span class="help-block" id="activity_name_error" style="display: none;">Provide Page Title.</span>
											   </div>
											</div>
                                       </div>
                                    </div>
                                  
                                    
									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Description</label>
												<div class="controls">
													<textarea class="large m-wrap ckeditor" name="description" rows="4" id="description"><?php if(isset($data->cms_description) && $data->cms_description!='') echo $data->cms_description;?></textarea>
													<br>
													<span class="help-inline" id="description_error" style="display: none;">Tell us about page</span>
												</div>
											</div>
                                       </div>
									</div>
									
									<div class="form-actions">
                                       <button type="submit" name="submit" class="btn blue" value="<?php if(isset($data->id) && $data->id!='') echo "edit"; else echo "add";?>"><i class="icon-ok"></i> Save</button>
                                       
                                    </div>
                                 </form>
                                 <!-- END FORM-->                
                              </div>
                           </div>
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