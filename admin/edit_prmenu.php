<?php
ob_start();
include('includes/header.php');

$id = $_REQUEST['id'];
$d = ORM::for_table('sys_prmenu')->find_one($id);


if (isset($_POST['submit'])) {

    $service_title = $_POST['title'];
    // Finding value as per id
    $id = $_POST['id'];
    
     
     if(isset($_POST['slug']) && $_POST['slug'] !="")
	 {
        $slug = generateslug($_POST['slug'],'sys_prmenu','edit');
	 }
	 else
	 {
	      $slug = generateslug($_POST['title'],'sys_prmenu','edit');
	 }   
    
    
    
    $d = ORM::for_table('sys_prmenu')->find_one($id);
    
    
    // updating into db as per record
    $d->title = $_POST['title'];
    $d->parent_category = $_POST['parent_category'];
    $d->status = 1;
	$d->sort_order = $_POST['sort_order'];
    $d->save();
    $_SESSION['success'] = 'Menu Updated Successfully.';
    header('location:manage_prmenu.php');
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
                            <a href="manage_categories.php">Manage Menu</a>
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
                            <form action="edit_prmenu.php" class="form-horizontal" name="add_category" method="post" onsubmit="return manage_validation_service();">

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
                                            <h3 class="block">Provide your account details</h3>
                                            <div class="control-group">
                                                <label class="control-label">Menu Title</label>
                                                <div class="controls">
                                                    <input type="hidden" value="<?php echo $d->id; ?>" name="id">
                                                    <input type="text"  class="span6 m-wrap" name="title" id="title" value="<?php echo $d->title; ?>" />
                                                    <span class="help-inline" id="category_title_error" style="display: none;">Provide Menu name</span>
                                                </div>
                                            </div>
    											<?php

    											$listCat = ORM::for_table('sys_prmenu')->where(array('parent_category'=>0))->find_array();

    										?>
    										
											
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
