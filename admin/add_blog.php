<?php include('includes/header.php');
if(isset($_GET['id']) && $_GET['id']!='')
{
	$check = ORM::for_table('sys_blog')->find_one($_GET['id']);
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
                     Add News
                    
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_blogs.php">Manage News</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Add News</a></li>
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
                                 <h4><i class="icon-reorder"></i>Add News</h4>
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
                                <form action="functions/middleware.php?module=blog&action=<?php if(isset($data->id) && $data->id!='') echo "edit_blog&id=".$data->id; else echo "add_blog";?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <h3 class="form-section">News Detail</h3>
									<div class="row-fluid">
                                       <div class="span10">
											<div class="control-group">
											   <label class="control-label">Select Date</label>
											   <div class="controls">
												  <input type="<?php if(isset($data->created_date) && $data->created_date!=''){ echo 'text'; }else{ echo 'date';}?>" class="large m-wrap" name="created_date" value="<?php if(isset($data->created_date) && $data->created_date!='') echo date('d-m-Y', $data['created_date']);?>" required/>
											   </div>
											</div>
                                       </div>
                                    </div>
									
                                    <div class="row-fluid">
                                       <div class="span10">
											<div class="control-group">
											   <label class="control-label">Title</label>
											   <div class="controls">
												  <input type="text" class="large m-wrap" name="blog_title" id="blog_title" value="<?php if(isset($data->blog_title) && $data->blog_title!='') echo $data->blog_title;?>" required/>
												  <span class="help-block" id="blog_name_error" style="display: none;">Provide news Title.</span>
											   </div>
											</div>
                                       </div>
                                    </div>
									
									 <div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
											   <label class="control-label">Display Url</label>
											   <div class="controls">
												  <input type="text" class="large m-wrap" name="blog_slug" id="blog_slug" value="<?php if(isset($data->slug) && $data->slug!='') echo $data->slug;?>" required/>
												  <span class="help-block" id="blog_slug_error"></span>	
											   </div>
											</div>
                                       </div>
                                    </div>
                                   
                                   	<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Category</label>
												<div class="controls">
													<select class="large m-wrap" name="sys_category" required>
													<option value="">Select Category</option>
													<?php 
													$sysCat = ORM::for_table('category_news')->find_many();
													foreach($sysCat as $cats) {
													?>
													<option value="<?php  echo $cats->id; ?>" <?php if(isset($data['blog_cat_id']) && $cats->id==$data['blog_cat_id']) echo 'selected';?>><?php  echo $cats->title; ?></option>   
													    <?php } ?>
													</select>
													<br>
													<span class="help-inline" id="description_error" style="display: none;">Tell us about page</span>
												</div>
											</div>
                                       </div>
									</div>
                                    
									<div class="row-fluid">
                                       <div class="span11">
											<div class="control-group">
												<label class="control-label">Description</label>
												<div class="controls">
													<textarea class="large m-wrap ckeditor" name="description" rows="4" id="description"><?php if(isset($data->blog_description) && $data->blog_description!='') echo $data->blog_description;?></textarea>
													<br>
													<span class="help-inline" id="description_error" style="display: none;">Tell us about page</span>
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
												<label class="control-label">Meta keywords</label>
												<div class="controls">
													<input type="text" class="large  m-wrap"  name="meta_keyword" rows="4" id="meta_keyword" value="<?php if(isset($data->meta_keyword) && $data->meta_keyword!='') echo $data->meta_keyword;?>" >
												
													
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