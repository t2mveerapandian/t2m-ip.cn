<?php
ob_start();
include('includes/header.php');

$d = ORM::for_table('sys_catalogue')->find_one('1');

if (isset($_POST['submit'])) {

    // updating into db as per record
    if(isset($_FILES['banner']['name']) && $_FILES['banner']['name']!='')
			{
				$extension = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('pdf', 'PDF', 'xlsx', 'csv');
				
				if(in_array($extension, $allowed_extension))
				{
					$d = ORM::for_table('sys_catalogue')->find_one('1');
					$banner = "catalogue_".time().".".$extension;
					$d->catalogue   = $banner;
					 move_uploaded_file($_FILES['banner']['tmp_name'], "images/catalogue/".$banner);
					 $d->save();
					 $_SESSION['success'] = 'Catalogue has been updated Successfully.';
				}
				else
				{
					$_SESSION['success'] = 'Sorry! Something is wrong.';
				}
			}

    header('location:catalogue.php');
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
                        Upload Catalogue

                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="dashbord.php">Home</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        <li>
                            <a href="manage_slider_menu.php">Update Catalogue</a>
                            <span class="icon-angle-right"></span>
                        </li>
                        
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
                                <i class="icon-reorder"></i> Upload Catalogue
                            </h4>
                            <div class="tools hidden-phone">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="catalogue.php" class="form-horizontal" name="add_category" method="post" enctype="multipart/form-data">

                                <div class="form-wizard">
                                    <?php
                                    if (isset($_SESSION['success'])) {
                                        ?>
                                        <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert"></button>
                                            <?php echo $_SESSION['success']; ?>
                                        </div>
                                        <?php
                                        unset($_SESSION['success']);
                                    }
                                    ?>
                                    <div class="tab-content" >
                                        <div class="tab-pane active" id="tab1">
											
											<div class="control-group">
											   <label class="control-label">Catalogue (.pdf, .xlsx)</label>
											   <div class="controls">
												  <input type="file" class="mediam m-wrap" name="banner"/><br>
												  <?php if($d->catalogue!=''){ ?>
												  <a href="<?php echo SITE_URL.'admin/images/catalogue/'.$d->catalogue;?>" target="_blank"><img src="assets/img/pdf-icon.png"></a>
												  <?php }?>
												</div>
											</div>
											
                                            <div class="form-actions clearfix">
												<button type="submit" name="submit" class="btn blue"><i class="icon-ok"></i> Upload</button>
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
