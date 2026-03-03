<section class="sigup bg-blue top-layer"><div class="container-fluid">
<div class="lower-newsletter"> 
<form id="frmsubscribehome" method="post" action=""> 
<input type="hidden" id="frm" value="subscribehome">
<div class="container  email_newsletter_container"> 
  <div class="row"> 
  <div class="col-lg-3 col-sm-12   col-12 col-md-3 my-1"> <div class="text_cont"> <h3><i class="fa fa-envelope fa-2x" aria-hidden="true"></i> 注册并订阅T2M最新产品资讯</h3> <p></p></div> </div> 
<div class="col-lg-3 col-sm-12  col-12 col-md-3 my-1"> <input type="name" class="form-control" id="name"  placeholder="Name*"></div>

 <div class="col-lg-3 col-sm-12  col-12 col-md-3 my-1"> <input type="email" class="form-control" id="email"  placeholder="Email Id*"></div>

  <div class="col-lg-2 col-sm-12  col-12 col-md-2 my-1"> <div class="recaptcha"> <div class="wpcf7-form-control-wrap"><div data-sitekey="6Lcu79siAAAAALzz13S3Bsvs8568tYRxLmEWGvb-" class="wpcf7-form-control g-recaptcha wpcf7-recaptcha"></div> </div></div> </div> 

  <div class="col-lg-1 col-sm-12  col-12 col-md-1 my-1"> 

    <button type="button" onclick="submitfrm();" id="loader_msg" class="meeting-btn">订阅</button>
	<p style="color:#fff !important;
    font-size: 10px;
    width: 100%;" id="captcha_error"></p>  
<p style="color:#fff !important;
    font-size: 12px;
    width: 100%;" id="success_msg"><p>
   </div> 


</div> </div>
</form>
</div>
</div></section>
<footer>

    <div class="container"> 

        <div class="col-lg-12 col-sm-12">

            <div class="row"> 


                    <div class="col-lg-3 col-md-3 col-sm-12">


                    </div>


                  


                   <div class="col-lg-6 col-md-6 col-sm-12 web" style="margin-top: 28px;">

                     
<div style="float: left; width: 100%;">
 <ul class="links-footer mt-2 dis-inline" >

 <li><a href="<?php echo SITE_URL;?>contact.php" style="font-size: 16px; padding: 0 3px;">联系我们 &nbsp; | </a></li>                         
<li><a href="<?php echo SITE_URL;?>career.php" style="font-size: 16px; padding: 0 3px;">招聘职位 &nbsp; | </a></li>
 <li><a href="<?php echo SITE_URL;?>global-reach.php" style="font-size: 16px; padding: 0 3px;"> T2M全球分部 &nbsp; | </a></li>
<li><a href="<?php echo SITE_URL;?>download-ip.php" style="font-size: 16px; padding: 0 3px;">IP品类目录下载 </a></li>

                          </ul>

</div>

                    </div>







  <div class="col-lg-6 col-md-6 col-sm-12 mobile" style="margin-top: 28px;">

                     
<div style="float: left; width: 100%;">
 <ul class="links-footer mt-2 dis-inline" >

 <li><a href="<?php echo SITE_URL;?>contact.php" style="font-size: 16px; padding: 0 3px;">联系我们 &nbsp; | </a></li>                         
<li><a href="<?php echo SITE_URL;?>career.php" style="font-size: 16px; padding: 0 3px;">招聘职位 &nbsp; | </a></li>
 <li><a href="<?php echo SITE_URL;?>global-reach.php" style="font-size: 16px; padding: 0 3px;"> T2M全球分部 &nbsp; | </a></li>
<li><a href="<?php echo SITE_URL;?>download-ip.php" style="font-size: 16px; padding: 0 3px;">IP品类目录下载 | </a></li>
<li><a href="<?php echo SITE_URL;?>press-release.php" style="font-size: 16px; padding: 0 3px;"> 新闻中心 | </a></li>
<li><a href="<?php echo SITE_URL;?>upcoming-event.php" style="font-size: 16px; padding: 0 3px;"> 活动 | </a></li>


                          </ul>

</div>

                    </div>







                    <div class="col-lg-3 col-md-3 col-sm-12">

                        <h4>关注</h4>

                        <div class="social" style="float: left; width: auto; margin-left:0px;"> <ul>
           <li class="instali"><a href="<?php echo $d['weibo'];?>" class="tran3s round-border instasocial" target="_blank"><img src="<?php echo SITE_URL.'images/weibo-icon.png';?>" style="width:20px;"></a></li>
		<li class="instali"><a href="<?php echo $d['facebook'];?>" class="tran3s round-border" target="_blank"><img src="<?php echo SITE_URL.'images/insta.png';?>" ></a></li>
		<li><a href="<?php echo $d['linkedin'];?>" class="tran3s round-border" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
		<li><a href="<?php echo $d['twitter'];?>" class="tran3s round-border" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
 </ul></div>

 
<div style="float: left; width: 100%;">
 <ul class="links-footer mt-2" style="display: inline-flex;">

                         
          <li ><a href="<?php echo SITE_URL;?>disclaimer.php">免责声明  | </a></li>
         <li class="mx-1"><a href="<?php echo SITE_URL;?>gdpr.php">隐私政策</a></li></ul>

</div>

                    </div>
            </div>

        </div>
    </div>

    
</footer>
<div class="container"> <div class="row"> <div class="col-md-12  col-sm-12 text-center "> <p class="copy"><?php echo $d['copyright'];?> <a href="https://beian.mps.gov.cn/#/query/webSearch?code=31010602008135" rel="noreferrer" target="_blank">沪公网安备31010602008135</a></p> </div> </div> </div> 


<script>$(document).ready(function() {
 // executes when HTML-Document is loaded and DOM is ready

// breakpoint and up  
$(window).resize(function(){
  if ($(window).width() >= 980){  

      // when you hover a toggle show its dropdown menu
      $(".navbar .dropdown-toggle").hover(function () {
         $(this).parent().toggleClass("show");
         $(this).parent().find(".dropdown-menu").toggleClass("show"); 
       });

        // hide the menu when the mouse leaves the dropdown
      $( ".navbar .dropdown-menu" ).mouseleave(function() {
        $(this).removeClass("show");  
      });
  
    // do something here
  } 
});  
  
  

// document ready  
});

function submitfrm(){
	
	var frm = $('#frm').val();
	var name = $('#name').val();
	var email = $('#email').val();
	
	var recaptcha_response = $('#g-recaptcha-response').val();
	
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
	

	if(recaptcha_response == ''){
	  document.getElementById('captcha_error').innerHTML = 'Invalid captcha';
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
			name: name,
			email: email,
		},
		cache: false,
		success: function(result) {}
	});
	
	setTimeout(function(){
		$('#frmsubscribehome').trigger("reset");
		document.getElementById('success_msg').innerHTML = '<span style="color:green !important;">Thank you</span>';
		document.getElementById('loader_msg').innerHTML = 'Submit';	
	}, 5000);

}
</script>
