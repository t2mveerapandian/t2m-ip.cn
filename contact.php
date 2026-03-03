<?php
$title = "联系我们 | T2M-IP";
$meta_description = "Looking for leadership, state of the art, silicon proven, semiconductor IP &amp; Software for your next SoC? T2M, your one stop technology supplier and provider";

include('common/header.php');
?>

<section class="mbr-section mbr-section-hero mbr-section-full3 "  style="background-image: url(images/contact-bg.png); background-size:cover;">

 

  <div class="mbr-table-cell2">

  <div class="container inner-page-container height2" style="background-color: rgba(255,255,255,0.95);">
            <div class="row">

<div class="col-lg-12 col-md-12 col-sm-12"> <h3>联系我们 </h3> <div class="bor-bt" style="width:104px;"></div>
 <form name="contactfrm" id="contactfrm" action="" method="POST">
<div class="row">

<div class="col-lg-6 col-md-6 col-sm-12 mt-3">

<input type="hidden" name="frm" id="frm" value="contact">
<input type="text" class="form-control2" name="name" id="name" placeholder="Name*">
<input type="text" class="form-control2" name="corporate_email" id="corporate_email" placeholder="Corporate E-mail ID*" >
<input type="text" class="form-control2" name="company_url" id="company_url" placeholder="Company URL*" >
<input type="text" class="form-control2" name="country" id="country" placeholder="Country / Region*" >
<input type="text" class="form-control2" name="contact" id="contact" placeholder="Contact number*" >
 <textarea style="resize: none;"  class="form-control2" name="message" id="message" placeholder="Message*" ></textarea>
<input type="text" class="form-control2" name="ip_schedule" id="ip_schedule" placeholder="IP Decision Schedule"></div>



<div class="col-lg-6 col-md-6 col-sm-12 mt-3">
<input type="text" class="form-control2" name="tape_out_schedule" id="tape_out_schedule" placeholder="Tape Out Schedule">
<input type="text" class="form-control2" name="process_node" id="process_node" placeholder="Fab. /  Process Node">
<input type="text" class="form-control2" name="ip_product" id="ip_product" placeholder="IP product ">
<div class="g-recaptcha" data-sitekey="6Lcu79siAAAAALzz13S3Bsvs8568tYRxLmEWGvb-"></div><br/>
<span id="captcha_error"></span>
<div class="checkbox mt-3">
    <label><input type="checkbox" id="terms"> Yes, I understand your <a href="<?php echo SITE_URL;?>gdpr.php" target="_blank">Terms and Privacy Policy</a>
</label><br/>
<span id="policy_error"></span>
  </div><div class="checkbox">
    <label><input type="checkbox" name="news_updated" id="news_updated" value=""> Yes, I please keep me updated with exciting <br> new IPs, NEWS and Events from T2M
</label>
  </div>
  <p id="success_msg"><p>
  <button type="button" onclick="submitfrm();" id="loader_msg"  class="btn submit-btn mt-3" style="padding: 5px 5% !important; color:#fff;"> 提交</button>
  
  </div>


</div>
</form>

</div>
            </div>
        </div>
    </div> 

    

</section>





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

function submitfrm(){
	
	var frm = $('#frm').val();
	var name = $('#name').val();
	var corporate_email = $('#corporate_email').val();
	var company_url = $('#company_url').val();
	var country = $('#country').val();
	var contact = $('#contact').val();
	var message = $('#message').val();
	var ip_schedule = $('#ip_schedule').val();
	var tape_out_schedule = $('#tape_out_schedule').val();
	var process_node = $('#process_node').val();
	var ip_product = $('#ip_product').val();
	
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
	  $('#country').attr('placeholder','Please enter country');
	  $('#country').css('border','2px solid red');
	  return false;
	}
	$('#country').css('border','1px solid #c00000 ');

	if(contact == ''){
	  $('#contact').attr('placeholder','Please enter Contact No');
	  $('#contact').css('border','2px solid red');
	  return false;
	}
	$('#contact').css('border','1px solid #c00000');
	
	if(contact!=''){
	  var check = !isNaN(contact);
	  if(check == false){
		$('#contact').val('');
		$('#contact').attr('placeholder','Please enter valid, Contact No');
		$('#contact').css('border','2px solid red');
		return false;
	  } 
	}
	$('#contact').css('border','1px solid #c00000');
	
	if(message == ''){
	  $('#message').attr('placeholder','Please enter message');
	  $('#message').css('border','2px solid red');
	  return false;
	}
	$('#message').css('border','1px solid #c00000');
	
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
			company_url: company_url,
			country: country,
			contact: contact,
			message: message,
			ip_schedule: ip_schedule,
			tape_out_schedule: tape_out_schedule,
			process_node: process_node,
			ip_product: ip_product,
			news_updated: news_updated,
		},
		cache: false,
		success: function(result) {}
	});
	
	setTimeout(function(){
		$('#contactfrm').trigger("reset");
		document.getElementById('success_msg').innerHTML = '<span style="color:green !important;">Thank you! Our team member will contact you soon.</span>';
		document.getElementById('loader_msg').innerHTML = 'Submit';	
	}, 5000);

}
</script>

<script src="tether/tether.min.js"></script>
<script src="jarallax/jarallax.js"></script>
<script src="smooth-scroll/smooth-scroll.js"></script>
<script src="js/script.js"></script>
</body>
</html>
