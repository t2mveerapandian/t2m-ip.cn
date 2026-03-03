<?php include('includes/header.php'); 
if( $_SESSION['login_type'] == 'hotel')
{
   header('location:dashboard-hotel.php');
   exit;
}
$id = $_REQUEST['id'];
$d = ORM::for_table('sys_hotels')->where('id',$id)->find_one();

if(isset($_POST['submit']))
{
    /* echo "<pre>";
     print_r($_POST);
     echo "<pre>";
     die('code die here');*/
    $id = $_POST['id'];
     $hotel_name = ($_POST['hotel_name']);
	 $slogan =  addslashes($_POST['slogan']);
	 $address = addslashes($_POST['address']);
	 $city = addslashes($_POST['city']);
	 $state = $_POST['state'];
	 $zipcode = addslashes($_POST['zipcode']);
	 $description = addslashes($_POST['description']);
	 
	 
	 
	 $username = $_POST['username'];
	 $password = $_POST['password'];
	 $contact_name = addslashes($_POST['contact_name']);
	 $email = $_POST['email'];
	 $phone = $_POST['phone'];
	 
	 
	 $amenities = $_POST['amenities'];
	 
	 if(!empty($amenities))
	 {
		 if(is_array($amenities))
		 {
		     $amenitiesStr = implode(',',$amenities);
		 }
		 else
		 {
		   $amenitiesStr = $amenities ;
		 }
	 }
     
    $d = ORM::for_table('sys_hotels')->find_one($id);
    
	 if($password !='')
    {
      $d->password = md5($password);
    }    

			
			$d->hotel_name = $hotel_name;
			$d->slogan = $slogan;
			$d->description = $description;			 	
			$d->address = $address;
			$d->city = $city;
			$d->state = $state;
			$d->zipcode = $zipcode;			
			//$d->status  = 'Active';
			//$d->creationdate = time();	
			$d->contact_person = $contact_name;
			$d->amenities = $amenitiesStr;			
			$d->username = $username;
			//$d->password = md5($password);
			$d->email = $email;
			$d->phone = $phone;		
								
			$d->save();
			$_SESSION['success'] = 'Hotel Updated Successfully.';
			header('location:manage_hotels.php');
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
                     EDIT Hotel
                    
                  </h3>
                  <ul class="breadcrumb">
                     <li>
                        <i class="icon-home"></i>
                        <a href="dashbord.php">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="manage_hotels.php">Manage Hotels</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Edit Hotel</a></li>
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
                                 <h4><i class="icon-reorder"></i>Edit Hotel - <?php echo $d->hotel_name; ?></h4>
                                 <div class="tools">
                                    &nbsp;
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
                                <form action="edit_hotel.php" class="form-horizontal" name="add_hotel" method="post" onsubmit="return manage_validation_hotel();">
                                   <input type="hidden"  name="id" value="<?php echo $id ;?>" />
                                    <h3 class="form-section">Hotel Detail</h3>
                                    <div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
                                       <label class="control-label">Hotel Name</label>
                                       <div class="controls">
                                          <input type="text" class="large m-wrap" readonly="readonly" name="hotel_name" id="hotel_name" value="<?php echo $d->hotel_name; ?>"/>
                                          <span class="help-block" id="hotel_name_error" style="display: none;">Provide Hotel Name.</span>
                                       </div>
                                    </div>
                                       </div>
                                       <!--/span-->
                                       <div class="span6 ">
                                          <div class="control-group">
                                       <label class="control-label">Slogan</label>
                                       <div class="controls">
                                          <input type="text" class="large m-wrap" name="slogan" id="slogan" value="<?php echo $d->slogan; ?>" />
                                          <span class="help-inline" id="slogan_error" style="display: none;">Provide your slogan</span>
                                       </div>
                                    </div>
                                       </div>
                                       <!--/span-->
                                    </div>
                                    <!--/row-->   
                                    <div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
									   <label class="control-label">Address</label>
                                       <div class="controls">
                                          <input type="text" class="large m-wrap" name="address" id="address" value="<?php echo $d->address; ?>" />
                                           <span class="help-inline" id="address_error" style="display: none;">Provide Hotel Addrees</span>
                                       </div>
                                    </div>
                                       </div>
                                       <!--/span-->
                                       <div class="span6 ">
                                          <div class="control-group">
                                       <label class="control-label">City/Town</label>
                                       <div class="controls">
                                          <input type="text" class="large m-wrap" name="city" id="city" value="<?php echo $d->city; ?>"/>
                                          <span class="help-inline" id="city_error" style="display: none;">Provide your city or town</span>
                                       </div>
                                    </div>
                                       </div>

                                       <!--/span-->
                                    </div>
                                    <!--/row-->        
                                    <div class="row-fluid">
                                       <div class="span6 ">
                                           <div class="control-group">
                                       <label class="control-label">Zipcode</label>
                                       <div class="controls">
                                          <input type="text" class="large m-wrap" name="zipcode" id="zipcode" value="<?php echo $d->zipcode; ?>"/>
                                          <span class="help-inline" id="zipcode_error" style="display: none;">Provide your zipcode.</span>
                                       </div>
                                    </div>  
                                       </div>
                                       <!--/span-->  
                                       <div class="span6 ">
                                           <div class="control-group">
                                       <label class="control-label">State</label>
                                       <div class="controls">
                                          <select class="large m-wrap" tabindex="1" name="state" id="state">
											<option value="">------------Select State------------</option>
											<option <?php if(stripslashes($d->state) == 'Andaman and Nicobar Islands' ) { echo 'selected="selected"' ; }  ?> value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                            <option value="Andhra Pradesh" <?php if(stripslashes($d->state) == 'Andhra Pradesh' ) { echo 'selected="selected"';  } ?>>Andhra Pradesh</option>
                                            <option value="Arunachal Pradesh" <?php if(stripslashes($d->state) == 'Arunachal Pradesh' ) { echo 'selected="selected"' ; }  ?>>Arunachal Pradesh</option>
                                            <option value="Assam" <?php if(stripslashes($d->state) == 'Assam' ) { echo 'selected="selected"'; }  ?>>Assam</option>
                                            <option value="Bihar" <?php if(stripslashes($d->state) == 'Bihar' ) { echo 'selected="selected"' ;}  ?>>Bihar</option>
                                            <option value="Chandigarh" <?php if(stripslashes($d->state) == 'Chandigarh' ) { echo 'selected="selected"' ;}  ?>>Chandigarh</option>
                                            <option value="Chhattisgarh" <?php if(stripslashes($d->state) == 'Chhattisgarh' ) { echo 'selected="selected"' ; }  ?>>Chhattisgarh</option>
                                            <option value="Dadra and Nagar Haveli" <?php if(stripslashes($d->state) == 'Dadra and Nagar Haveli' ) { echo 'selected="selected"'; }  ?>>Dadra and Nagar Haveli</option>
                                            <option value="Daman and Diu" <?php if(stripslashes($d->state) == 'Daman and Diu' ) { echo 'selected="selected"'; } ?>>Daman and Diu</option>
                                            <option value="Delhi" <?php if(stripslashes($d->state) == 'Delhi' ) { echo 'selected="selected"' ;} ?>>Delhi</option>
                                            <option value="Goa" <?php if(stripslashes($d->state) == 'Goa' ) { echo 'selected="selected"'; }  ?>>Goa</option>
                                            <option value="Gujarat" <?php if(stripslashes($d->state) == 'Gujarat' ) { echo 'selected="selected"' ;} ?>>Gujarat</option>
                                            <option value="Haryana" <?php if(stripslashes($d->state) == 'Haryana' ) { echo 'selected="selected"' ;}  ?>>Haryana</option>
                                            <option value="Himachal Pradesh" <?php if(stripslashes($d->state) == 'Himachal Pradesh' ) { echo 'selected="selected"' ;} ?>>Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir" <?php if(stripslashes($d->state) == 'Jammu and Kashmir' ) { echo 'selected="selected"'; }  ?>>Jammu and Kashmir</option>
                                            <option value="Jharkhand" <?php if(stripslashes($d->state) == 'Jharkhand' ) { echo 'selected="selected"' ;}  ?>>Jharkhand</option>
                                            <option value="Karnataka" <?php if(stripslashes($d->state) == 'Karnataka' ) { echo 'selected="selected"' ; }  ?>>Karnataka</option>
                                            <option value="Kerala" <?php if(stripslashes($d->state) == 'Kerala' ) { echo 'selected="selected"' ;}  ?>>Kerala</option>
                                            <option value="Lakshadweep" <?php if(stripslashes($d->state) == 'Lakshadweep' ) { echo 'selected="selected"' ;}  ?>>Lakshadweep</option>
                                            <option value="Madhya Pradesh" <?php if(stripslashes($d->state) == 'Madhya Pradesh' ) { echo 'selected="selected"' ; }  ?>>Madhya Pradesh</option>
                                            <option value="Maharashtra" <?php if(stripslashes($d->state) == 'Maharashtra' ) { echo 'selected="selected"' ;}  ?>>Maharashtra</option>
                                            <option value="Manipur" <?php if(stripslashes($d->state) == 'Manipur' ) { echo 'selected="selected"'; }  ?>>Manipur</option>
                                            <option value="Meghalaya" <?php if(stripslashes($d->state) == 'Meghalaya' ) { echo 'selected="selected"'; }  ?>>Meghalaya</option>
                                            <option value="Mizoram" <?php if(stripslashes($d->state) == 'Mizoram' ) { echo 'selected="selected"'; }  ?>>Mizoram</option>
                                            <option value="Nagaland" <?php if(stripslashes($d->state) == 'Nagaland' ) { echo 'selected="selected"' ;}  ?>>Nagaland</option>
                                            <option value="Orissa" <?php if(stripslashes($d->state) == 'Orissa' ) { echo 'selected="selected"' ;}  ?>>Orissa</option>
                                            <option value="Pondicherry" <?php if(stripslashes($d->state) == 'Pondicherry' ) { echo 'selected="selected"'; }  ?>>Pondicherry</option>
                                            <option value="Punjab" <?php if(stripslashes($d->state) == 'Punjab' ) { echo 'selected="selected"' ;}  ?>>Punjab</option>
                                            <option value="Rajasthan" <?php if(stripslashes($d->state) == 'Andaman and Nicobar Islands' ) { echo 'selected="selected"'  ; } ?>>Rajasthan</option>
                                            <option value="Sikkim" <?php if(stripslashes($d->state) == 'Sikkim' ) { echo 'selected="selected"' ;}  ?>>Sikkim</option>
                                            <option value="Tamil Nadu" <?php if(stripslashes($d->state) == 'Tamil Nadu' ) { echo 'selected="selected"' ; }  ?>>Tamil Nadu</option>
                                            <option value="Tripura" <?php if(stripslashes($d->state) == 'Tripura' ) { echo 'selected="selected"'  ;} ?>>Tripura</option>
                                            <option value="Uttaranchal" <?php if(stripslashes($d->state) == 'Uttaranchal' ) { echo 'selected="selected"' ; }  ?>>Uttaranchal</option>
                                            <option value="Uttar Pradesh" <?php if(stripslashes($d->state) == 'Uttar Pradesh' ) { echo 'selected="selected"'; }  ?>>Uttar Pradesh</option>
                                            <option value="West Bengal" <?php if(stripslashes($d->state) == 'West Bengal' ) { echo 'selected="selected"' ; } ?>>West Bengal</option>
                                          </select>
                                          <span class="help-inline" id="state_error" style="display: none;">Provide your State</span>
                                       </div>
                                    </div>
                                       </div>
                                       <!--/span-->
									  
                                    </div>
                                    <!--/row-->   
									
									
									<div class="row-fluid">
                                       <div class="span12 ">
                                          <div class="control-group">
									   <label class="control-label">About Hotel</label>
                                       <div class="controls">
                                         <textarea class="large m-wrap" name="description" rows="3" id="description"><?php echo $d->description; ?></textarea>
                                         <br>
                                         <span class="help-inline" id="description_error" style="display: none;">Tell us about hotel</span>
                                         
                                       </div>
                                    </div>
                                       </div>
                                      
                                    </div>
									
									 <h3 class="form-section">Hotel Amenities</h3>
									 
									 
									 <div class="row-fluid">
                                       
                                     <div class="control-group">
                                       <label class="control-label">Amenities</label>
                                       <div class="controls">
									   
									   <?php $amenities =  ORM::for_table('sys_amenities')->find_many();
									         
                                             $cheked_amenities = $d->amenities;
                                            $cheked_amenities_arry = explode(",",$cheked_amenities);
									    foreach($amenities as $amn) {  ?>
                                          <label class="checkbox">
                                          <input type="checkbox" name="amenities[]" id="amenities<?php echo $amn->id ; ?> " value="<?php echo $amn->slug ; ?>" <?php if(in_array($amn->slug, $cheked_amenities_arry) ) { echo 'checked="checked"' ;}  ?>  />
                                          <?php echo $amn->amenity_value  ; ?>
                                          </label>
										  <?php } ?>
                                           <br>
                                           <span class="help-inline" id="amenities_error" style="display: none;">Select at least one.</span>
                                           
                                       </div>
                                    </div>
                                    </div>
									 
									                            
                                    <h3 class="form-section">Hotel Admin(Manager) Information</h3>
                                    
                                    <div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
                                       <label class="control-label">Username</label>
                                       <div class="controls">
                                          <input type="text" class="large m-wrap" readonly="readonly" name="username" id="username" value="<?php echo $d->username; ?>"  />
                                          <span class="help-inline" id="username_error" style="display: none;">Provide your username</span>
                                       </div>
                                    </div>
                                       </div>
                                       <!--/span-->
                                       <div class="span6 ">
                                          <div class="control-group">
                                       <label class="control-label">Name</label>
                                       <div class="controls">
                                          <input type="text" class="large m-wrap"  name="contact_name" id="contact_name" value="<?php echo $d->contact_person; ?>"/>
                                          <span class="help-inline" id="contact_name_error" style="display: none;">Provide Manager Name</span>
                                       </div>
                                    </div>
                                       </div>
                                       <!--/span-->
                                    </div>
                                    <!--/row-->
                                       <div class="row-fluid">
                                       <div class="span6 ">
                                          <div class="control-group">
                                       <label class="control-label">Email</label>
                                       <div class="controls">
                                          <input type="email" class="large m-wrap" readonly="readonly" name="email" id="email" value="<?php echo $d->email; ?>" />
                                          <span class="help-inline" id="email_error" style="display: none;">Provide your email.</span>
                                       </div>
                                    </div>
                                       </div>
                                       <!--/span-->
                                       <div class="span6 ">
                                           <div class="control-group">
                                       <label class="control-label">Phone</label>
                                       <div class="controls">
                                          <input type="text" class="large m-wrap" name="phone"  id ="phone" value="<?php echo $d->phone; ?>" />
                                          <span class="help-inline" id="phone_error" style="display: none;">Provide your phone number</span>
                                       </div>
                                    </div>
                                       </div>
                                       <!--/span-->
                                    </div>
                                    <!--/row--> 
                                    
                                    <!--/row-->           
                                    <div class="row-fluid">
                                       <div class="span6 ">        
                                          <div class="control-group">
                                       <label class="control-label">Password</label>
                                       <div class="controls">
                                          <input type="password" class="large m-wrap" name="password" id="password" />
                                          <span class="help-inline" id="password_error">Provide your Password if you want to change otherwise leave it blank</span>
                                       </div>
                                    </div>
                                       </div>
                                        <!--/span-->
                                        <!--<div class="span6 ">
                                        <div class="control-group">
                                        <label class="control-label">Confirm Password</label>
                                        <div class="controls">
                                        <input type="password" class="large m-wrap" name="cpassword" id="cpassword"  />
                                        <span class="help-inline" id="cpassword_error" style="display: none;">Confirm password does not match</span>
                                        </div>
                                        </div>
                                        </div>-->
                                        <!--/span-->
                                    </div>
                                    <!--/row--> 
								 
									
									
									
									
                                    <div class="form-actions">
                                       <button type="submit" name="submit" class="btn blue"><i class="icon-ok"></i> Save</button>
                                       <a href="manage_hotels.php" ><button type="button" class="btn">Cancel</button></a>
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
   
 <script type="text/javascript">
function manage_validation_hotel(){
    
   // fico_userid, fico_password, fico_userid_error, fico_ssn, fico_ssn_error
   
   
   
    
   // jQuery.noConflict();    
    var hotel_name = jQuery("#hotel_name").val();
    var slogan = jQuery("#slogan").val();
    var address = jQuery("#address").val();
    var city = jQuery("#city").val();
    var zipcode = jQuery("#zipcode").val();
     var state = jQuery("#state").val();
     var description = jQuery("#description").val();
    var amenities = jQuery("input[type='checkbox'][name='amenities[]']:checked").length;
     
    // alert (amenities);
    
    var username = jQuery("#username").val();
    var contact_name = jQuery("#contact_name").val();
   // var password = jQuery("#password").val();
  //  var cpassword = jQuery("#cpassword").val();
    
    
    var email = jQuery("#email").val();
    var phone = jQuery("#phone").val();
   
   
   
    var flg=0;
    
    
    
    
    if(hotel_name==""){
        jQuery('#hotel_name_error').show();
        flg=1;
    }
    else{
        jQuery('#hotel_name_error').hide();
    }
    
     if(slogan==""){
        jQuery('#slogan_error').show();
        flg=1;
    }
    else{
        jQuery('#slogan_error').hide();
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
    
      if(zipcode==""){
        jQuery('#zipcode_error').show();
        flg=1;
    }
    else{
        jQuery('#zipcode_error').hide();
    }
    
    if(state==""){
        jQuery('#state_error').show();
        flg=1;
    }
    else{
        jQuery('#state_error').hide();
    }
    
   
    
    if(description==""){
        jQuery('#description_error').show();
        flg=1;
    }
    else{
        jQuery('#description_error').hide();
    }
    
     
    
    if(amenities==""){
        jQuery('#amenities_error').show();
        flg=1;
    }
    else{
        jQuery('#amenities_error').hide();
    }
    
    
    if(username==""){
        jQuery('#username_error').show();
        flg=1;
    }
    else{
        jQuery('#username_error').hide();
    }
    
     /*if(password==""){
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
    }*/
    
    if(contact_name==""){
        jQuery('#contact_name_error').show();
        flg=1;
    }
    else{
        jQuery('#contact_name_error').hide();
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
    
   
    
    
        
    if(flg==1){
        return false;    
    }else{
        return true;    
    }
    
}

</script>  
   <?php include('includes/footer.php') ;?>