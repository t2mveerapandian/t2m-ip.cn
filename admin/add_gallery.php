<?php include('includes/header.php'); 
if(isset($_GET['id']) && $_GET['id']!='')
{
	$id = $_GET['id'];
	$gallery = ORM::for_table('sys_gallery')->where('activity_id', $id)->find_many();
	
	$activity = ORM::for_table('sys_activities')->find_one($id);
}
else
{
	header("location:index.php");
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
                     Add Gallery to <?php echo $activity->activity_name ; ?>
                    
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_activities.php">Manage Gallery</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Gallery</a></li>
                  </ul>
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN GALLERY MANAGER PORTLET-->
                        <div class="portlet box purple">
                            <div class="portlet-title">
                                <h4><i class="icon-reorder"></i>Gallery Manager</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                    <a href="javascript:;" class="reload"></a>
                                    <a href="javascript:;" class="remove"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN GALLERY MANAGER PANEL-->
                                <div class="row-fluid">
                                    <div class="span4">
                                        <h4><?php echo $activity->activity_name ; ?></h4>
                                    </div>
                                    
                                    <?php  if(isset($_SESSION['success']))
                                { 
                                ?> 
                                 <br>
                                 <br>
                              <div class="alert alert-success">
                                    <button class="close" data-dismiss="alert"></button>
                                    <strong>Success!</strong> <?php echo $_SESSION['success']; ?>
                                </div>
                                <?php unset($_SESSION['success']); } ?>
                                    <div class="span8">
                                        <div class="pull-right">
                                           <form action="functions/middleware.php?module=gallery&action=add_gallery" class="form-horizontal" name="add_gallery_image" method="post" onsubmit="return manage_validation_gallery();" enctype="multipart/form-data">
												<input type="hidden" name="activity_id" value="<?php echo $activity->id ; ?>">
                                   
												<div class="row-fluid">
													<!--/span-->
												   <div class="span6 ">
														<div class="control-group">
														   <label class="control-label">Photo</label>
														   <div class="controls">
															  <input type="file" class="mediam m-wrap" name="image" id="image"/>
															 <span class="help-inline" id="image_error" style="display: none;">Provide Gallery Photo.</span>
														   </div>
														</div>
												   </div>
												   <!--/span-->
												</div>


												<div class="clearfix space5"></div>
                                   
												<button type="submit" name="submit" class="btn blue" value="add"><i class="icon-plus"></i> Upload</button>                                       
                                   
											</form>
                                           
                                                                                        
                                        </div>
                                    </div>
                                </div>
                                <!-- END GALLERY MANAGER PANEL-->
                                
                                
                                <hr class="clearfix" />
                                <!-- BEGIN GALLERY MANAGER LISTING-->
                                <div class="row-fluid">
                                  <?php 
                                $i =0;
                                foreach($gallery as $gallery_data) { 
                                    if($i%4==0){echo '</div> <div class="row-fluid">';}
                                    ?>
                                    <div class="span3">
                                        <div class="item">
                                            <a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="images/gallery/<?php echo $gallery_data->image;?>">
                                                <div class="zoom">
                                                    <img src="images/gallery/<?php echo $gallery_data->image;?>" alt="Photo" style="width:280px; height:280px"/>                            
                                                    <div class="zoom-icon"></div>
                                                </div>
                                            </a>
                                            <div class="details">
                                                <a href="#" class="icon"><i class="icon-paper-clip"></i></a>
                                                <a href="#" class="icon"><i class="icon-link"></i></a>
                                                <a href="#" class="icon"><i class="icon-pencil"></i></a>
                                                <a href="functions/middleware.php?module=gallery&action=delete_gallery&id=<?php echo $activity->id;?>&gallery_id=<?php echo $gallery_data->id;?>" class="icon" onclick="return confirm('Do you want to delete?');"><i class="icon-remove"></i></a>        
                                            </div>
                                        </div>
                                    </div>
                                  <?php 
                               
                                $i++;
                                } ?>  
                                    
                         </div>
                                
                                <div class="space10"></div>
                               
                                
                                
                                <!-- END GALLERY MANAGER LISTING-->
                                <!-- BEGIN GALLERY MANAGER PAGINATION-->
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="pagination pull-right">
                                            <ul>
                                                <li><a href="#">«</a></li>
                                                <li><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#">5</a></li>
                                                <li><a href="#">»</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- END GALLERY MANAGER PAGINATION-->
                            </div>
                        </div>
                        <!-- END GALLERY MANAGER PORTLET-->
                    </div>
                </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->
   
   <script type="text/javascript">
function manage_validation_gallery(){
    
   // fico_userid, fico_password, fico_userid_error, fico_ssn, fico_ssn_error
   
 
  //  jQuery.noConflict();    
    var image = jQuery("#image").val();
    
   
    
    var flg=0;
    
    if(image==""){
        jQuery('#image_error').show();
        flg=1;
    }
    else{
        jQuery('#image_error').hide();
    }
    
  
        
    if(flg==1){
        return false;    
    }else{
        return true;    
    }
    
}

</script>
<?php include('includes/footer.php') ;?>