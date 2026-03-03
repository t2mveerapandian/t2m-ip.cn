<?php
$title = "下载IP品类目录 | T2M-IP";
$meta_description = "Looking for leadership, state of the art, silicon proven, semiconductor IP &amp; Software for your next SoC? T2M, your one stop technology supplier and provider";

include('common/header.php');
?>


<section class=" mbr-section mbr-section-hero mbr-section-full3 " style="background-image: url(images/bg-meeting.jpg); background-size:cover;">
 

  <div class="mbr-table-cell2">

        <div class="container inner-page-container height2" style="background-color: rgba(255,255,255,0.95);">
            <div class="row ">

<div class="col-lg-12 col-md-12 col-sm-12"> <h3>下载IP品类目录</h3> <div class="bor-bt2" style="width:200px;"></div>
<form id="downloadipfrm" method="post" action="">
<div class="row mt-4">


<div class="col-lg-6 col-md-6 col-sm-12 my-3">
<input type="hidden" id="frm" value="downloadip">
<input type="text" class="form-control2 mb-2" id="name" placeholder="Name*">
<input type="text" class="form-control2 mb-2" id="corporate_email" placeholder="Corporate E-mail ID*">
<input type="text" class="form-control2 mbr-section-full3" id="alternate_id" placeholder="Alternate ID">
<input type="text" class="form-control2 mb-2" id="company_url" placeholder="Company URL*" >
<select class="form-control2 mb-2"  id="country">
  <option value="">Country / Region*</option>
  <option value="+91">India</option>
  <option value="+44">UK</option>
  <option value="+49">Germany</option>
</select>
<p id="country_error"></p>
<div style="display:inline-block; width:100%;">
<input type="text" class="form-control2 contact-fld" id="contact" placeholder="Mobile number*" required>
<a class="btn submit-btn" onclick="getotp();" id="loader_msg_otp" style="padding: 5px 30px !important;">提交</a>
</div>

<input type="text" class="form-control2 country-fld" id="otp" placeholder="Enter OTP *" style="padding:8px;" required>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 my-3"> <textarea rows="3" id="message" style="resize: none;" cols="50" class="form-control2" placeholder="Message*" required>
</textarea>
<div class="g-recaptcha g-recaptcha2 schedule-textarea mb-2" style="border:none !important;" data-sitekey="6Lcu79siAAAAALzz13S3Bsvs8568tYRxLmEWGvb-" ></div><br>
<p id="captcha_error" style="float: left;color: red !important;font-size: 12px; width: 100%;"></p>
<div class="checkbox mt-2" style="display: block;
    float: left;width: 100%;">
    <label><input type="checkbox" id="terms"> Yes, I understand your <a href="<?php echo SITE_URL;?>gdpr.php">Terms and Privacy Policy</a><br/>
<p id="policy_error" style="float: left;color: red !important;font-size: 12px; width: 100%;"></p>
</label>
  </div><div class="checkbox">
    <label><input type="checkbox" id="news_updated" value="yes"> Yes, I please keep me updated with exciting <br> new IPs, NEWS and Events from T2M
</label>
  </div>
  <p id="success_msg" style="float: left;width: 100%;"><p>
  <button class="btn submit-btn mt-1" style="padding: 5px 5% !important; color:#fff;" type="button" onclick="submitfrm();" id="loader_msg">下载</button></div>


</div>
</form>

</div>
            </div>
        </div>
    </div> 

    

</section>

<?php
$downloadip_d = ORM::for_table('sys_catalogue')->find_one('1');
$download_ip_link = 'https://t-2-m.com/admin/images/catalogue/'.$downloadip_d->catalogue;
?>

<script>

function getotp(){
var country = $('#country').val();
var contact = $('#contact').val();	
if(country == ''){
	   document.getElementById('country_error').innerHTML = 'Please select country';
	  return false;
	}
	 document.getElementById('country_error').innerHTML ='';

	if(contact == ''){
	  $('#contact').attr('placeholder','Please enter Mobile No');
	  $('#contact').css('border','2px solid red');
	  return false;
	}
	$('#contact').css('border','1px solid #c00000');
	
	if(contact!=''){
	  var check = !isNaN(contact);
	  if(check == false){
		$('#contact').val('');
		$('#contact').attr('placeholder','Please enter valid, Mobile No');
		$('#contact').css('border','2px solid red');
		return false;
	  } 
	}
	$('#contact').css('border','1px solid #c00000');
	
	document.getElementById('loader_msg_otp').innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
	
	
	jQuery.ajax({
		url: "https://t-2-m.com/getotp.php",
		type: "GET",
		crossDomain: true,
		data: {
			action : 'sendotp',
			country_code: country,
			contact: contact,
		},
		cache: false,
		success: function(result) {
			
			if(result==1){
				document.getElementById('loader_msg_otp').innerHTML = 'Submit';
			}
		}
	});	
	
}

function checkotp(){
var country = $('#country').val();
var contact = $('#contact').val();
var otp = $('#otp').val();	

	jQuery.ajax({
		url: "https://t2m-ip.cn/getotp.php",
		type: "GET",
		crossDomain: true,
		data: {
			action : 'chkkotp',
			country_code: country,
			contact: contact,
			otp: otp,
		},
		cache: false,
		success: function(result) {
			
			if(result==0){
				  document.getElementById('otp').value = '';	
				  $('#otp').attr('placeholder','Invalid OTP');
				  $('#otp').css('border','2px solid red');
				  return false;
			}else{
				$('#otp').css('border','1px solid #c00000 ');
			}
		}
	});
	
}		

function submitfrm(){
	
	var frm = $('#frm').val();
	var name = $('#name').val();
	var corporate_email = $('#corporate_email').val();
	var alternate_id = $('#alternate_id').val();
	var company_url = $('#company_url').val();
	var country = $('#country').val();
	var contact = $('#contact').val();
	var otp = $('#otp').val();
	var message = $('#message').val();
	
	if($("#news_updated").prop('checked') == true){
		var news_updated = 'Yes';
	}else{
		var news_updated = 'No';
	}		
	
	var recaptcha_response = $('#g-recaptcha-response').val();
	
	if(name == ''){
	  $('#name').attr('placeholder','Please enter name');
	  $('#name').css('border','2px solid red');
	  return false;
	}
	$('#name').css('border','1px solid #c00000 ');

	if(corporate_email == ''){
	  $('#corporate_email').attr('placeholder','Please enter email');
	  $('#corporate_email').css('border','2px solid red');
	  return false;
	}
	$('#corporate_email').css('border','1px solid #c00000');

	if(corporate_email !=''){
	  var intRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  var check = intRegex.test(corporate_email);
	  if(check == false){
		$('#corporate_email').val('');
		$('#corporate_email').attr('placeholder','Please enter valid email');
		$('#corporate_email').css('border','2px solid red');
		return false;
	  } 
	}
	$('#corporate_email').css('border','1px solid #c00000');
	
	if(company_url == ''){
	  $('#company_url').attr('placeholder','Please enter company url');
	  $('#company_url').css('border','2px solid red');
	  return false;
	}
	$('#company_url').css('border','1px solid #c00000 ');

	if(country == ''){
	   document.getElementById('country_error').innerHTML = 'Please select country';
	  return false;
	}
	 document.getElementById('country_error').innerHTML ='';

	if(contact == ''){
	  $('#contact').attr('placeholder','Please enter Mobile No');
	  $('#contact').css('border','2px solid red');
	  return false;
	}
	$('#contact').css('border','1px solid #c00000');
	
	if(contact!=''){
	  var check = !isNaN(contact);
	  if(check == false){
		$('#contact').val('');
		$('#contact').attr('placeholder','Please enter valid, Mobile No');
		$('#contact').css('border','2px solid red');
		return false;
	  } 
	}
	$('#contact').css('border','1px solid #c00000');
	
	checkotp();
	
	if(otp == ''){
	  $('#otp').attr('placeholder','Please enter OTP');
	  $('#otp').css('border','2px solid red');
	  return false;
	}
	$('#otp').css('border','1px solid #c00000 ');
	
	
	if(recaptcha_response == ''){
	  document.getElementById('captcha_error').innerHTML = 'Please verify captcha';
	  return false;
	}
	document.getElementById('captcha_error').innerHTML = '';
	
	if(!$("#terms").is(":checked")){
	  document.getElementById('policy_error').innerHTML = 'Please accept Terms and Privacy Policy';
	  return false;
	}
	document.getElementById('policy_error').innerHTML = '';
	
	document.getElementById('loader_msg').innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
	 
	jQuery.ajax({
		url: "https://t2m-ip.cn/sendemail.php",
		type: "GET",
		crossDomain: true,
		dataType: 'jsonp',
		data: {
			frm : frm,
			name: name,
			corporate_email: corporate_email,
			alternate_id: alternate_id,
			company_url: company_url,
			country: country,
			contact: contact,
			message: message,
			news_updated: news_updated,
		},
		cache: false,
		success: function(result) {}
	});
	
	setTimeout(function(){
		$('#downloadipfrm').trigger("reset");
		document.getElementById('success_msg').innerHTML = '<span style="color:green !important;">Thank you to Download IP Catalogue.</span>';
		document.getElementById('loader_msg').innerHTML = 'Submit';
		window.location.href = '<?php echo $download_ip_link;?>';

	}, 5000);

}
</script>


<?php include('common/footer.php') ;?>

<script>
function myFunction(x) {
  x.classList.toggle("change");
}
</script>

<script src="js/wow.min.js"></script>
<script>
    wow = new WOW(
                      {
                      boxClass:     'wow',      // default
                      animateClass: 'animated', // default
                      offset:       0,          // default
                      mobile:       true,       // default
                      live:         true        // default
                    }
                    )
                    wow.init();
</script>


<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}
</script>





<script src="tether/tether.min.js"></script>
 <script src="jarallax/jarallax.js"></script>
   <script src="smooth-scroll/smooth-scroll.js"></script>
    <script src="js/script.js"></script>
</body>



</html>
