<?php include('includes/header.php'); 

$d = ORM::for_table('sys_appconfig')->where('id',1 )->find_one();

if(isset($_POST['submit']) && isset($_POST['id']) && $_POST['id']!='')
{
     
	$CompanyName = $_POST['CompanyName'];
	$headerText = $_POST['headerText'];
	$id = $_POST['id'];
	$email = $_POST['email'];
	$phone = addslashes($_POST['phone']);
	$timezone = $_POST['timezone'];
	$country  = $_POST['country'];
	$country_code = $_POST['country_code'];
	$address = addslashes($_POST['address']);
	$currency_code = addslashes($_POST['currency_code']);
	$site_url = addslashes($_POST['site_url']);
	$copyright = addslashes($_POST['copyright']);
	$facebook = addslashes($_POST['facebook']);
	$twitter = addslashes($_POST['twitter']);
	$linkedin = addslashes($_POST['linkedin']);
	$weibo = addslashes($_POST['weibo']);
	
	 
	$d = ORM::for_table('sys_appconfig')->find_one($id);
	$d->company_name = $CompanyName;
	$d->header_text = $headerText;
	$d->email = $email;
	$d->phone = $phone;
	$d->address = $address;
	$d->timezone = $timezone;
	$d->country_code = $country_code;	
	$d->site_url = $site_url;		
	$d->copyright = $copyright;	
	$d->currency_code = $currency_code;	
	$d->linkedin = $linkedin;	
	$d->twitter = $twitter;
	$d->facebook = $facebook;
	$d->weibo = $weibo;
		
					
	$d->save();
	$_SESSION['success'] = 'Setting  Updated Successfully.';
	header('location:setting.php');
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
                    General Setting
                    
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashbord.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="setting.php">Setting</a>
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
                        
                        <div class="tools hidden-phone">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <form action="setting.php" class="form-horizontal" name="add_staff" method="post">
						<input type="hidden"  name="id" value="1" />
                           <div class="form-wizard">
                              		<?php  if(isset($_SESSION['success']))
								{ 
								?>
								<div class="alert alert-success">
									<button class="close" data-dismiss="alert"></button>
									<strong>Success!</strong> <?php echo $_SESSION['success']; ?>
								</div>
								<?php unset($_SESSION['success']); } ?>
                              <div class="tab-content">
                                 <div class="tab-pane active" id="tab1">
                                  
									
                                    <div class="control-group">
                                       <label class="control-label">Company Name</label>
                                       <div class="controls">
                                          <input type="text"  class="span6 m-wrap" name="CompanyName" value="<?php echo $d->company_name;?>" />
                                          <span class="help-inline">Provide your Company Name</span>
                                       </div>
                                    </div>
                                   
								    <div class="control-group">
                                       <label class="control-label">Header Text</label>
                                       <div class="controls">
                                          <input type="text"  class="span6 m-wrap" name="headerText" value="<?php echo $d->header_text;?>" />
                                          <span class="help-inline">Provide Header Text</span>
                                       </div>
                                    </div>
                                    
									
                                    <div class="control-group">
                                       <label class="control-label">Email</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="email"  value="<?php echo $d->email ; ?>"  />
                                          <span class="help-inline">Provide your email address</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Phone Number</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap"  name="phone" value="<?php echo $d->phone ; ?>"/>
                                          <span class="help-inline">Provide your phone number</span>
                                       </div>
                                    </div>
                                    
                                    <div class="control-group">
                                       <label class="control-label">Address</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="address" value="<?php echo $d->address ; ?>" />
                                          <span class="help-inline">Provide your street address</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Curreny Code</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="currency_code" value="<?php echo $d->currency_code ; ?>"  />
                                          <span class="help-inline">Provide your currency code</span>
                                       </div>
                                    </div>
									
									 <div class="control-group">
                                       <label class="control-label">Country </label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="country" value="<?php echo $d->country ; ?>"  />
                                          <span class="help-inline">Provide your country</span>
                                       </div>
                                    </div>
									
									<div class="control-group">
                                       <label class="control-label">Country Code</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="country_code" value="<?php echo $d->country_code ; ?>"  />
                                          <span class="help-inline">Provide your Country Code</span>
                                       </div>
                                    </div>
									
									<div class="control-group">
                                       <label class="control-label">Site Url</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="site_url" value="<?php echo $d->site_url ; ?>"  />
                                          <span class="help-inline">Provide your Site Url</span>
                                       </div>
                                    </div>
									
									
									<div class="control-group">
                                       <label class="control-label">Copyright Text</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="copyright" value="<?php echo $d->copyright ; ?>"  />
                                          <span class="help-inline">Provide your Copyright Text</span>
                                       </div>
                                    </div>
									
									<div class="control-group">
                                       <label class="control-label">Time Zone</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="timezone" value="<?php echo $d->timezone ; ?>"  />
                                          <span class="help-inline">Provide your Copyright Text</span>
                                       </div>
                                    </div>
									<div class="control-group">
                                       <label class="control-label">Linkedin</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="linkedin" value="<?php echo $d->linkedin ; ?>"  />
                                          <span class="help-inline">Provide your Linkedin Url</span>
                                       </div>
                                    </div>
									<div class="control-group">
                                       <label class="control-label">Twitter</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="twitter" value="<?php echo $d->twitter ; ?>"  />
                                          <span class="help-inline">Provide your Twitter Url</span>
                                       </div>
                                    </div>
									<div class="control-group">
                                       <label class="control-label">Instagram</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="facebook" value="<?php echo $d->facebook ; ?>"  />
                                          <span class="help-inline">Provide your Instagram Url</span>
                                       </div>
                                    </div>
                                    
                                    <div class="control-group">
                                       <label class="control-label">Weibo Link</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="weibo" value="<?php echo $d->weibo ; ?>"  />
                                          <span class="help-inline">Provide your Instagram Url</span>
                                       </div>
                                    </div>
									
									
									
									
                                    
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
   <?php include('includes/footer.php') ;?>