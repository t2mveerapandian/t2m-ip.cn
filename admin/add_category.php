<?php
ob_start();
 include_once('../common/config.php'); 

if(isset($_POST['submit']))
{	
	$title = addslashes($_POST['title']);
	$sort_order = addslashes($_POST['sort_order']);
	
	if(isset($_POST['parent_category']) && !empty($_POST['parent_category'])){
		$parent_category = $_POST['parent_category'];
	}else{
		$parent_category = 0;
	}
	
	

	$slug = generateslug($_POST['title'],'sys_course_categories','add');
    $d = ORM::for_table('sys_course_categories')->create();
    $d->title = $title; 
    $d->slug = $slug; 
	$d->parent_category = $parent_category;
	if(isset($_FILES['cat_icon']['name']) && $_FILES['cat_icon']['name']!='')
			{
				$extension = pathinfo($_FILES['cat_icon']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' ,'jpg');
				
				if(in_array($extension, $allowed_extension))
				{
					$cat_icon = $_FILES['cat_icon']['name'];
					$d->cat_icon   = $cat_icon;
					 move_uploaded_file($_FILES['cat_icon']['tmp_name'], "images/icons/".$cat_icon);
				}
				else
				{
					$d->cat_icon   ='';
				}
			}
    $d->status = 1;
    $d->sort_order = $sort_order; 
    $d->save();
    $_SESSION['success'] = 'Category Added Successfully.';
    header('location:manage_categories.php');
    exit;
			
	 		
}	

 include('includes/header.php'); 
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
                     Add Category                     
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashbord.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_categories.php">Manage Category</a>
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
                           <i class="icon-reorder"></i> Add Category 
                        </h4>
                        <div class="tools hidden-phone">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <form action="add_category.php" class="form-horizontal" name="add_category" method="post" onsubmit="return manage_validation_service();" enctype="multipart/form-data">
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
										   <label class="control-label">Category Title</label>
										   <div class="controls">
											  <input type="text"  class="span6 m-wrap" name="title" id="title" required/>											  
											  <span class="help-inline" id="category_title_error" style="display: none;">Provide Category name</span>
										   </div>
										</div>
										
										
										<?php 										
											$listCat = ORM::for_table('sys_course_categories')->where(array('parent_category'=>0))->find_array();
										?>
										<div class="control-group">
										   <label class="control-label">Parent Category</label>
										   <div class="controls">											  
												<select id="parent-category" class="span6 m-wrap" name="parent_category">
													<option value="" selected>Choose Parent Category</option>
													<?php
													foreach($listCat as $cat):
													?>
														<option value="<?php echo $cat['id']; ?>"><?php echo $cat['title']; ?></option>
													<?php
													endforeach;
													?>
												</select>
										   </div>
										</div>
										<div class="control-group">
										   <label class="control-label">Category Icon</label>
										   <div class="controls">
											  <input type="file" class="mediam m-wrap" name="cat_icon" id="cat_icon"/>											  
											</div>
										</div>
										
											<div class="control-group">
										   <label class="control-label">Sort Order</label>
										   <div class="controls">
											  <input type="text"  class="span6 m-wrap" name="sort_order" id="sort_order"/>											  
											  <span class="help-inline" id="sorder_error" style="display: none;">Provide Sort Order</span>
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

   
   
    var categorye_title = jQuery("#title").val();    
    
    
    if(service_title==""){
        jQuery('#category_title_error').show();
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