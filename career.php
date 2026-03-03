<?php
$title = "招聘职位 | T2M-IP";
$meta_description = "Looking for leadership, state of the art, silicon proven, semiconductor IP &amp; Software for your next SoC? T2M, your one stop technology supplier and provider";

include('common/header.php');
?>
<style type="text/css">
.card{
	-webkit-box-shadow:none;
	box-shadow:none;
	border:none !important;
}
</style>
<section class=" mbr-section mbr-section-hero mbr-section-full3"  style="background-image: url(images/carrer.jpg);  background-size:cover;">

 

  <div class="mbr-table-cell2">

        <div class="container inner-page-container height2" >
            <div class="row">

<div class="col-lg-12 col-md-12 col-sm-12"> <h3>招聘职位 </h3> <div class="bor-bt" style=" width: 8%;"></div>

<div class="row">

 
<div class="col-lg-6 col-md-6 col-sm-12 my-3">

<form id="careerfrm" method="post" action="">
<input type="hidden" id="frm" value="career"> 
<select id="applied_for" class="form-control2">
<option value="">Job Position</option>
<?php
$dat_arr =  ORM::for_table('sys_career')->where(array('status'=>'1'))->limit(5)->order_by_desc('id')->find_many();
foreach($dat_arr as $dta):
?>
<option><?php echo $dta['job_title'];?></option>
<?php endforeach; ?> 
</select>
<p style="float: left; color: red !important;font-size: 12px; width: 100%;" id="applied_for_error"></p>  
<input type="text" class="form-control2" id="name" placeholder="Name*">
<input type="text" class="form-control2" id="email" placeholder="E-mail ID*">
<input type="text" class="form-control2" id="contact" placeholder="Contact number*">
<input type="text" class="form-control2" id="years_of_exp" placeholder="Years of Experience (Write 0, if not any)*">
 <div class="mt-2">
  <label for="myfile" >Upload your resume</label> <br>
  <input type="file" id="resume_file">
  <p style="float: left;color: red !important;font-size: 12px; width: 100%;" id="resume_error"></p><br><br> 
  <input type="hidden" id="resume" value="">
</div>

<div style="width:100%;"><div class="g-recaptcha2 career-captcha" style="border:none !important;">
<div class="g-recaptcha  mt-0" style="transform: scale(0.68); -webkit-transform: scale(0.68); transform-origin: 0 0; -webkit-transform-origin: 0 0;" data-sitekey="6Lcu79siAAAAALzz13S3Bsvs8568tYRxLmEWGvb-"></div>
</div><div class="sub-btn mx-2" style="float:left;">
<button type="button" onclick="submitfrm();" id="loader_msg" class="btn more2 mt-2 " style="padding:13px 24px !important; color:#fff;"> 提交</button> </div>
</div>
<p style="float: left;color: red !important;font-size: 12px; width: 100%;" id="captcha_error"></p>  
<p style="float: left; width: 100%;" id="success_msg"><p>

</form>

</div>



<div class="col-lg-6 col-md-6 col-sm-12 my-3 arch">


<h4>当前招募</h4>
<div id="accordion">
<?php
$i=1;
$data_arr =  ORM::for_table('sys_career')->where(array('status'=>'1'))->limit(5)->order_by_desc('id')->find_many();
foreach($data_arr as $data):
?>
<div class="card">
    <div id="<?php echo 'heading'.$i;?>">
      
        <span  data-toggle="collapse" data-target="<?php echo '#collapse'.$i;?>" aria-expanded="false" aria-controls="<?php echo 'collapse'.$i;?>">
          <image src="<?php echo SITE_URL;?>images/bullet-icon.png" style="width:12px;"> <b><?php echo $data['job_title'];?></b>
        </span>
     
    </div>
    <div id="<?php echo 'collapse'.$i;?>" class="collapse" aria-labelledby="<?php echo 'heading'.$i;?>" data-parent="#accordion">
      <div class="card-body pgn">
			<?php echo $data['job_description'];?>
	</div>
    </div>
  </div>
 
 <?php $i++; endforeach; ?> 
  
  
</div>
  </div>


</div>


</div>
            </div>
        </div>
    </div> 

    

</section>

<script>
$(document).ready(function(){

$("#resume_file").change(function(){
	
	var fd = new FormData();

	var files = $('#resume_file')[0].files;

	// Check file selected or not
	if(files.length > 0 ){

		fd.append('file',files[0]);

		$.ajax({
			url:'upload.php',
			type:'post',
			data:fd,
			contentType: false,
			processData: false,
			success:function(response){
				
				console.log(response);
				if(response==0){
				document.getElementById('resume_error').innerHTML = 'Error: only docx, doc, pdf format allowed';
				}else{
				document.getElementById('resume').value=response;	
				document.getElementById('resume_error').innerHTML = '';	
				}	
			}
		});
	}
});
});

function submitfrm(){
	
	var frm = $('#frm').val();
	var applied_for = $('#applied_for').val();
	var name = $('#name').val();
	var email = $('#email').val();
	var contact = $('#contact').val();
	var years_of_exp = $('#years_of_exp').val();
	var resume = $('#resume').val();
	
	var recaptcha_response = $('#g-recaptcha-response').val();
	
	if(applied_for == ''){
	  document.getElementById('applied_for_error').innerHTML = 'Please select Job Position';
	  $('#applied_for').css('border','2px solid red');
	  return false;
	}
	$('#applied_for').css('border','1px solid #c00000 ');
	document.getElementById('applied_for_error').innerHTML = '';
	
	if(name == ''){
	  $('#name').attr('placeholder','Please enter name');
	  $('#name').css('border','2px solid red');
	  return false;
	}
	$('#name').css('border','1px solid #c00000 ');

	if(email == ''){
	  $('#email').attr('placeholder','Please enter email');
	  $('#email').css('border','2px solid red');
	  return false;
	}
	$('#email').css('border','1px solid #c00000');

	if(email !=''){
	  var intRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  var check = intRegex.test(email);
	  if(check == false){
		$('#email').val('');
		$('#email').attr('placeholder','Please enter valid email');
		$('#email').css('border','2px solid red');
		return false;
	  } 
	}
	$('#email').css('border','1px solid #c00000');
	
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
	
	if(years_of_exp == ''){
	  $('#years_of_exp').attr('placeholder','Please enter Years of Experience');
	  $('#years_of_exp').css('border','2px solid red');
	  return false;
	}
	$('#years_of_exp').css('border','1px solid #c00000 ');
	
	if(recaptcha_response == ''){
	  document.getElementById('captcha_error').innerHTML = 'Please verify captcha';
	  return false;
	}
	document.getElementById('captcha_error').innerHTML = '';
	
	document.getElementById('loader_msg').innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
	 
	jQuery.ajax({
		url: "https://t2m-ip.cn/sendemail.php",
		type: "GET",
		crossDomain: true,
		dataType: 'jsonp',
		data: {
			frm : frm,
			applied_for: applied_for,
			name: name,
			email: email,
			contact: contact,
			years_of_exp: years_of_exp,
			resume: resume,
		},
		cache: false,
		success: function(result) {}
	});
	
	setTimeout(function(){
		$('#careerfrm').trigger("reset");
		document.getElementById('success_msg').innerHTML = '<span style="color:green !important;">You have successfully submitted.</span>';
		document.getElementById('loader_msg').innerHTML = 'Submit';	
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
