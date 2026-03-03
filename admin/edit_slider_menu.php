<?php
ob_start();
include('includes/header.php');

$id = $_REQUEST['id'];
$d = ORM::for_table('sys_slider_menu')->find_one($id);


if (isset($_POST['submit'])) {

    $menu_link = $_POST['menu_link'];
	$mid = $_POST['mid'];
    
    $d = ORM::for_table('sys_slider_menu')->find_one($mid);
    
    // updating into db as per record
    $d->menu_link = $_POST['menu_link'];
    $d->save();
    $_SESSION['success'] = 'Link has been updated Successfully.';
    header('location:manage_slider_menu.php');
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
                        Edit Slider Menu

                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="dashbord.php">Home</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li>
                            <a href="manage_slider_menu.php">Manage Slider Menu</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li><a href="#">Edit Slider Menu</a></li>
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
                                <i class="icon-reorder"></i> Update Menu Link
                            </h4>
                            <div class="tools hidden-phone">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="edit_slider_menu.php" class="form-horizontal" name="add_category" method="post" onsubmit="return manage_validation_service();">

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
                                          <div class="control-group">
											<label class="control-label"><img src="<?php echo SITE_URL.$d->menu_icon;?>"></label>
											<div class="controls">
											<input type="text"  class="span6 m-wrap" name="menu_link" value="<?php echo $d->menu_link; ?>" />
											 </div>
										</div>
                                            <div class="form-actions clearfix">
												<input type="hidden" name="mid" value="<?php echo $id;?>">
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
<?php include('includes/footer.php'); ?>
