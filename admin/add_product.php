<?php include('includes/header.php');
error_reporting(E_ALL);
if(isset($_GET['id']) && $_GET['id']!='')
{
	$check = ORM::for_table('sys_products')->find_one($_GET['id']);
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
                     Add Product

                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_products.php">Manage Products</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Add New Product</a></li>
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
                                 <h4><i class="icon-reorder"></i>Add New Product</h4>
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
                                <form action="functions/middleware.php?module=course&action=<?php if(isset($data->id) && $data->id!='') echo "edit_course&id=".$data->id; else echo "add_course";?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <h3 class="form-section">Product Detail</h3>
									
									<input type="hidden" name="category" value="0">
                                    <div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
											   <label class="control-label">Title</label>
											   <div class="controls">
												  <input type="text" class="large m-wrap" name="title" id="product_title" value="<?php if(isset($data->title) && $data->title!='') echo $data->title;?>" required/>
												  <span class="help-block" id="product_title_error"></span>
											   </div>
											</div>
                                       </div>
                                    </div>
									
                                    
                                    <div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
											   <label class="control-label">Display Url</label>
											   <div class="controls">
												  <input type="text" class="large m-wrap" name="slug" id="product_slug" value="<?php if(isset($data->slug) && $data->slug!='') echo $data->slug;?>" required/>
												  <span class="help-block" id="product_slug_error"></span>	
											   </div>
											</div>
                                       </div>
                                    </div>
									
								
									
									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Overview</label>
												<div class="controls">
													<textarea class="large m-wrap ckeditor" name="overview" rows="4" id="overview"><?php if(isset($data->overview) && $data->overview!='') echo $data->overview;?></textarea>
													<br>
													<span class="help-inline" id="course_overview_error" style="display: none;">enter overview</span>
												</div>
											</div>
                                       </div>
									</div>

									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Features</label>
												<div class="controls">
													<textarea class="large m-wrap ckeditor" name="features" rows="4" id="features"><?php if(isset($data->features) && $data->features!='') echo $data->features;?></textarea>
													<br>
													<span class="help-inline" id="course_content_error" style="display: none;">enter overview</span>
												</div>
											</div>
                                       </div>
									</div>
									
									 
									 	
									 
									<div class="row-fluid">
									<!--/span-->
									<div class="span6 ">
										<div class="control-group">
										   <label class="control-label">Logo 1</label>
										   <div class="controls">
											<?php if(isset($data->logo_1) && $data->logo_1!=''){ ?> <img src="<?php echo 'images/logo/'.$data->logo_1;?>" width="100px;"> <?php }?>
											  <input type="file" class="mediam m-wrap" name="logo_1" id="logo_1"/>
										    </div>
										</div>
									</div>
									<!--/span-->
									</div>
									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Link URL</label>
												<div class="controls">
												<input type="text" class="large m-wrap"	 name="logo_1_url" value="<?php if(isset($data->logo_1_url) && $data->logo_1_url!='') echo $data->logo_1_url;?>">
												</div>
											</div>
                                       </div>
									</div>
									
									<div class="row-fluid">
									<!--/span-->
									<div class="span6 ">
										<div class="control-group">
										   <label class="control-label">Logo 2</label>
										   <div class="controls">
										   <?php if(isset($data->logo_2) && $data->logo_2!=''){ ?> <img src="<?php echo 'images/logo/'.$data->logo_2;?>" width="100px;"> <?php }?>
											  <input type="file" class="mediam m-wrap" name="logo_2" id="logo_2"/>
										   </div>
										</div>
									</div>
									<!--/span-->
									</div>
									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Link URL</label>
												<div class="controls">
												<input type="text" class="large m-wrap"	 name="logo_2_url" value="<?php if(isset($data->logo_2_url) && $data->logo_2_url!='') echo $data->logo_2_url;?>">
												</div>
											</div>
                                       </div>
									</div>
									
									<div class="row-fluid">
									<!--/span-->
									<div class="span6 ">
										<div class="control-group">
										   <label class="control-label">Logo 3</label>
										   <div class="controls">
										   <?php if(isset($data->logo_3) && $data->logo_3!=''){ ?> <img src="<?php echo 'images/logo/'.$data->logo_3;?>" width="100px;"> <?php }?>
											  <input type="file" class="mediam m-wrap" name="logo_3" id="logo_3"/>
										   </div>
										</div>
									</div>
									<!--/span-->
									</div>
									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Link URL</label>
												<div class="controls">
												<input type="text" class="large m-wrap"	 name="logo_3_url" value="<?php if(isset($data->logo_3_url) && $data->logo_3_url!='') echo $data->logo_3_url;?>">
												</div>
											</div>
                                       </div>
									</div>


									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Meta Title</label>
												<div class="controls">
												<input type="text" class="large m-wrap"	 name="meta_title" id="meta_title" value="<?php if(isset($data->meta_title) && $data->meta_title!='') echo $data->meta_title;?>" >
												</div>
											</div>
                                       </div>
									</div>
									
									
									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Meta Description</label>
												<div class="controls">
													<textarea class="large m-wrap" name="meta_description" rows="4" id="meta_description" ><?php if(isset($data->meta_description) && $data->meta_description!='') echo $data->meta_description;?> </textarea>
												
													
												</div>
											</div>
                                       </div>
									</div>
									
									
									
									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Meta keywords</label>
												<div class="controls">
													<input type="text" class="large  m-wrap"  name="meta_keyword" rows="4" id="meta_keyword" value="<?php if(isset($data->meta_keyword) && $data->meta_keyword!='') echo $data->meta_keyword;?>" >
												
													
												</div>
											</div>
                                       </div>
									</div>
									
									<div class="control-group">
										   <label class="control-label">Sort Order</label>
										   <div class="controls">
											  <input type="text"  class="large  m-wrap" name="sort_order" id="sort_order" value="<?php if(isset($data->sort_order) && $data->sort_order!='') echo $data->sort_order;?>"/>											  
											  <span class="help-inline" id="sorder_error" style="display: none;">Provide Sort Order</span>
										   </div>
										</div>
									
									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Latest</label>
												<div class="controls">
													<input type="checkbox" class="large  m-wrap"  name="is_latest" <?php if(isset($data->is_latest) && $data->is_latest=='1') echo 'checked';?> >
												
													
												</div>
											</div>
                                       </div>
									</div>
									
									

									<div class="form-actions">
										<input type="hidden" id="prod_action" value="<?php if(isset($_GET['id']) && $_GET['id']!=''){ echo $_GET['id']; }else{ echo 'add';} ?>">
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
