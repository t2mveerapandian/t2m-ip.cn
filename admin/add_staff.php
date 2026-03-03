<?php include('includes/header.php'); 

if($_SESSION['role'] == 2 )
{
   header('location:dashbord.php');
   exit;
}
if(isset($_POST['submit']))
{
     
	 $username = $_POST['username'];
	 $password = $_POST['password'];
	 $fullname = addslashes($_POST['fullname']);
	 $email = $_POST['email'];
	 $phone = $_POST['phone'];
	 $gender = $_POST['gender'];
	 $address = addslashes($_POST['address']);
	 $city = addslashes($_POST['city']);
	 $state = $_POST['state'];
	
	 
     $dusername = ORM::for_table('sys_users')->where('username',$username)->find_one();
	  
	 $demail = ORM::for_table('sys_users')->where('email',$email)->find_one();
     if($dusername)
	 {
            $_SESSION['message_err'] = "username already exist.";
     }
	 else  if($demail)
	 {
            $_SESSION['message_err'] = "email already exist.";
     }	 
	 else
	 {
	 
			$d = ORM::for_table('sys_users')->create();
			$d->username = $username;
			$d->password = md5($password);
			$d->fullname = $fullname;
			$d->email = $email;
			$d->phone = $phone;
			$d->address = $address;
			$d->city = $city;
			$d->state = $state;
			$d->role = 2;
			$d->gender = $gender;
			$d->status = 'Active';
			$d->creationdate = time();					
			$d->save();
			$_SESSION['success'] = 'Staff Added Successfully.';
			header('location:manage_staff.php');
			exit;
			
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
                     Add Staff Member
                    
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashbord.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_staff.php">Manage Staff</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Add Staff</a></li>
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
                           <i class="icon-reorder"></i> Add New Staff Member
                        </h4>
                        <div class="tools hidden-phone">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
					 
					 
					
					 
                     <div class="portlet-body form">
                        <form action="add_staff.php" class="form-horizontal" name="add_staff" method="post" onsubmit="return manage_validation_user();">
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
                                    <h3 class="block">Provide your account details</h3>
									
                                    <div class="control-group">
                                       <label class="control-label">Username</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="username" id="username" />
                                          <span class="help-inline" id="username_error" style="display: none;">Provide your username</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Password</label>
                                       <div class="controls">
                                          <input type="password" class="span6 m-wrap" name="password"  id="password"/>
                                          <span class="help-inline" id="password_error" style="display: none;">Provide your Password</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Confirm Password</label>
                                       <div class="controls">
                                          <input type="password" class="span6 m-wrap" name="cpassword"  id="cpassword" />
                                          <span class="help-inline" id="cpassword_error" style="display: none;">Confirm password does not Match</span>
                                       </div>
                                    </div>
									<div class="control-group">
                                       <label class="control-label">Fullname</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap"  name="fullname" id="fullname" />
                                          <span class="help-inline" id="fullname_error" style="display: none;">Provide your fullname</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Email</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="email" id="email" />
                                          <span class="help-inline" id="email_error" style="display: none;">Provide your email address</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Phone Number</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap"  name="phone" id="phone"/>
                                          <span class="help-inline" id="phone_error" style="display: none;">Provide your phone number</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Gender</label>
                                       <div class="controls">
                                          <label class="radio">
                                          <input type="radio" name="gender" id="optionsRadios1" value="Male" checked />
                                          Male
                                          </label>
                                          
                                          <label class="radio">
                                          <input type="radio" name="gender" id="optionsRadios2" value="Female" />
                                          Female
                                          </label>  
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Address</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="address" id="address" />
                                          <span class="help-inline" id="address_error" style="display: none;">Provide your street address</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">City/Town</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" name="city" id="city"/>
                                          <span class="help-inline" id="city_error" style="display: none;">Provide your city or town</span>
                                       </div>
                                    </div>
									
									 <div class="control-group">
                                       <label class="control-label">State</label>
                                       <div class="controls">
                                          <select class="large m-wrap" tabindex="1" name="state" id="state" >
											<option value="">------------Select State------------</option>
											<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
											<option value="Andhra Pradesh">Andhra Pradesh</option>
											<option value="Arunachal Pradesh">Arunachal Pradesh</option>
											<option value="Assam">Assam</option>
											<option value="Bihar">Bihar</option>
											<option value="Chandigarh">Chandigarh</option>
											<option value="Chhattisgarh">Chhattisgarh</option>
											<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
											<option value="Daman and Diu">Daman and Diu</option>
											<option value="Delhi">Delhi</option>
											<option value="Goa">Goa</option>
											<option value="Gujarat">Gujarat</option>
											<option value="Haryana">Haryana</option>
											<option value="Himachal Pradesh">Himachal Pradesh</option>
											<option value="Jammu and Kashmir">Jammu and Kashmir</option>
											<option value="Jharkhand">Jharkhand</option>
											<option value="Karnataka">Karnataka</option>
											<option value="Kerala">Kerala</option>
											<option value="Lakshadweep">Lakshadweep</option>
											<option value="Madhya Pradesh">Madhya Pradesh</option>
											<option value="Maharashtra">Maharashtra</option>
											<option value="Manipur">Manipur</option>
											<option value="Meghalaya">Meghalaya</option>
											<option value="Mizoram">Mizoram</option>
											<option value="Nagaland">Nagaland</option>
											<option value="Orissa">Orissa</option>
											<option value="Pondicherry">Pondicherry</option>
											<option value="Punjab">Punjab</option>
											<option value="Rajasthan">Rajasthan</option>
											<option value="Sikkim">Sikkim</option>
											<option value="Tamil Nadu">Tamil Nadu</option>
											<option value="Tripura">Tripura</option>
											<option value="Uttaranchal">Uttaranchal</option>
											<option value="Uttar Pradesh">Uttar Pradesh</option>
											<option value="West Bengal">West Bengal</option>
                                          </select>
                                          <span class="help-inline" id="state_error" style="display: none;">Provide your State</span>
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
<script type="text/javascript">
function manage_validation_user(){
    
   // fico_userid, fico_password, fico_userid_error, fico_ssn, fico_ssn_error
   
    
  //  jQuery.noConflict();    
    var username = jQuery("#username").val();
    var password = jQuery("#password").val();
    var cpassword = jQuery("#cpassword").val();
    var fullname = jQuery("#fullname").val();
    
    var email = jQuery("#email").val();
    var phone = jQuery("#phone").val();
    var address = jQuery("#address").val();
    var city = jQuery("#city").val();
    var state = jQuery("#state").val();
    
    var flg=0;
    
    if(username==""){
        jQuery('#username_error').show();
        flg=1;
    }
    else{
        jQuery('#username_error').hide();
    }
    
     if(password==""){
        jQuery('#password_error').show();
        flg=1;
    }
    else{
        jQuery('#password_error').hide();
    }
    
    if(password!=cpassword){
        jQuery('#cpassword_error').show();
        flg=1;
    }
    else{
        jQuery('#cpassword_error').hide();
    }
    
    if(fullname==""){
        jQuery('#fullname_error').show();
        flg=1;
    }
    else{
        jQuery('#fullname_error').hide();
    }
    
    
    var isValidemail = false;
    var regexemail =  /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    isValidemail = regexemail.test(email);
    if(isValidemail == false || email==""){
        jQuery('#email_error').show();
        flg=1;
    }else{
        jQuery('#email_error').hide();        
    }
    
    
    var isValidphone = false;
    var regexphone = /^[0-9-+]+$/;
    isValidphone = regexphone.test(phone);
    if(isValidphone == false){
        jQuery('#phone_error').show();
        flg=1;
    }else{
        jQuery('#phone_error').hide();        
    }
    
   
    if(address==""){
        jQuery('#address_error').show();
        flg=1;
    }
    else{
        jQuery('#address_error').hide();
    }
    
    if(city==""){
        jQuery('#city_error').show();
        flg=1;
    }
    else{
        jQuery('#city_error').hide();
    }
    
    
    if(state==""){
        jQuery('#state_error').show();
        flg=1;
    }
    else{
        jQuery('#state_error').hide();
    }
    
        
    if(flg==1){
        return false;    
    }else{
        return true;    
    }
    
}

</script>   
   <?php include('includes/footer.php') ;?>