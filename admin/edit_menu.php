<?php
ob_start();
include('includes/header.php');

$id = $_REQUEST['id'];
$d = ORM::for_table('sys_menu')->find_one($id);


if (isset($_POST['submit'])) {

    $cat_id = $_POST['cat_id'];
	$prod_id = $_POST['prod_id'];
	$sort_order = trim($_POST['sort_order']);
    
    $d = ORM::for_table('sys_menu')->find_one($id);
    
    // updating into db as per record
    $d->cat_id = $_POST['cat_id'];
    $d->prod_id = $_POST['prod_id'];
	$d->sort_order = $_POST['sort_order'];
    $d->save();
    $_SESSION['success'] = 'Menu Updated Successfully.';
    header('location:manage_menu.php');
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
                        Edit Menu

                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="dashbord.php">Home</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li>
                            <a href="manage_menu.php">Manage Menu</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li><a href="#">Edit Menu</a></li>
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
                                <i class="icon-reorder"></i> Update Menu List
                            </h4>
                            <div class="tools hidden-phone">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="edit_menu.php" class="form-horizontal" name="add_category" method="post" onsubmit="return manage_validation_service();">

                                <div class="form-wizard">
                                    <?php
                                    if (isset($_SESSION['message_err'])) {
                                        ?>
                                        <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert"></button>
                                            <strong>Error!</strong> <?php echo $_SESSION['message_err']; ?>
                                        </div>
                                        <?php
                                        unset($_SESSION['message_err']);
                                    }
                                    ?>
                                    <div class="tab-content" >
                                        <div class="tab-pane active" id="tab1">
                                            <?php 										
											$listCat = ORM::for_table('sys_course_categories')->where(array('parent_category'=>0))->order_by_asc('sort_order')->find_array();
										?>
										<div class="control-group">
										   <label class="control-label">Choose Categories</label>
										   <div class="controls">											  
												<select id="cat_id" class="span6 m-wrap" name="cat_id" required>
													<option value="" selected>Choose Categories</option>
													<?php
													foreach($listCat as $cat):
													?>
														<option value="<?php echo $cat['id']; ?>"><?php echo $cat['title']; ?></option>
														
														
														<?php   $d1 = ORM::for_table('sys_course_categories')->where(array('parent_category'=>$cat['id']))->order_by_asc('sort_order')->find_many();
													    
													   	 foreach($d1 as $category1) {
													   	 
													   	 ?> 
													    	 <option value="<?php echo $category1['id']; ?>" <?php if($d->cat_id==$category1['id']){ echo 'selected';}?>>  &nbsp; &nbsp; &nbsp;<?php echo $category1['title']; ?></option>
												  
														
													<?php
													   	 } 
													
												
													endforeach;
													?>
												</select>
										   </div>
										</div>
										
										<?php 										
											$listProd = ORM::for_table('sys_products')->where(array('status'=>1))->order_by_asc('title')->find_array();
										?>
										<div class="control-group">
										   <label class="control-label">Select Product</label>
										   <div class="controls">											  
												<select id="prod_id" class="span6 m-wrap" name="prod_id" required>
													<option value="" selected>Choose Parent Menu</option>
													<?php
													foreach($listProd as $prod):
													?>
														<option value="<?php echo $prod['id']; ?>" <?php if($d->prod_id==$prod['id']){ echo 'selected';}?>><?php echo $prod['title']; ?></option>
													<?php
													endforeach;
													?>
												</select>
										   </div>
										</div>
									
										
										  <div class="control-group">
											<label class="control-label">Order</label>
											<div class="controls">
											<input type="text"  class="span6 m-wrap" name="sort_order" id="sort_order" value="<?php echo $d->sort_order; ?>" />
											 </div>
										</div>
                                            <div class="form-actions clearfix">
                                                <button type="submit" name="submit" class="btn blue"><i class="icon-ok"></i> Submit</button>
                                            </div>
                                        </div>
                                        </form>
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
    </div>
</div>

<script type="text/javascript">

    function manage_validation_service() {
        var categorye_title = jQuery("#title").val();
        if (service_title == "") {
            jQuery('#category_title_error').show();
            flg = 1;
        }
        if (flg == 1) {
            return false;
        } else {
            return true;
        }

    }

</script>
<?php include('includes/footer.php'); ?>
