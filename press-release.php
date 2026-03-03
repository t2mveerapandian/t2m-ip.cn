<?php
$title = "Press release | T2M-IP";
$meta_description = "Looking for leadership, state of the art, silicon proven, semiconductor IP &amp; Software for your next SoC? T2M, your one stop technology supplier and provider";

include('common/header.php');
$mysqli_q = new mysqli($db_host,$db_user,$db_password,$db_name);
?>
<style type="text/css">
.list_container {
    overflow:auto;
    height: 150px;
  }
</style>

<section class=" mbr-section mbr-section-hero mbr-section-full3 " style="background-image: url(images/press-bg.jpg);  background-size:cover;">

 

  <div class="mbr-table-cell2">

        <div class="container inner-page-container height " >
            <div class="">



<div class="row ">

<div class="col-lg-8 col-md-8 col-sm-12 ">

<div id="content">
<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#red" data-toggle="tab" class="active">新闻稿</a></li>
        <li><a href="#orange" data-toggle="tab">行业新闻</a></li>
    </ul>


<div id="my-tab-content" class="tab-content">
<div class="tab-pane active" id="red">
	<div class="press-box">
	<?php
	if(isset($_GET['m']) && $_GET['m']!='' && $_GET['y']!=''){
	$months = trim($_GET['m']);
	$years = trim($_GET['y']);	
	$press_arr = $mysqli_q->query("SELECT * FROM sys_blog where blog_cat_id=2 and status=1 and MONTH(FROM_UNIXTIME(created_date))=".$months." and Year(FROM_UNIXTIME(created_date))=".$years." order by created_date desc")->fetch_all(MYSQLI_ASSOC);
	}else{	
	$press_arr = ORM::for_table('sys_blog')->where(array('blog_cat_id'=>2,'status'=>1))->limit(8)->order_by_desc('created_date')->find_many();
	}
	foreach($press_arr as $press_d): ?>
	<div class="row col-lg-12 col-md-12 col-sm-12">
	<p style="font-weight:500; width:100%;"><?php echo date('d M, Y', $press_d['created_date']);?></p>
	<a href="<?php echo SITE_URL.'news/'.$press_d['slug']; ?>"><h5><?php echo $press_d['blog_title'];?></h5></a>
	</div>
	<?php endforeach; ?>
	
	</div>
</div>
<div class="tab-pane" id="orange">
	<div class="press-box">
	
	<?php
	if(isset($_GET['m']) && $_GET['m']!='' && $_GET['y']!=''){
	$months = trim($_GET['m']);
	$years = trim($_GET['y']);	
	$industry_arr = $mysqli_q->query("SELECT * FROM sys_blog where blog_cat_id=1 and status=1 and MONTH(FROM_UNIXTIME(created_date))=".$months." and Year(FROM_UNIXTIME(created_date))=".$years." order by created_date desc")->fetch_all(MYSQLI_ASSOC);
	}else{
	$industry_arr = ORM::for_table('sys_blog')->where(array('blog_cat_id'=>1,'status'=>1))->limit(8)->order_by_desc('created_date')->find_many();
	}
	foreach($industry_arr as $indus_d): ?>
	<div class="row col-lg-12 col-md-12 col-sm-12">
	<p style="font-weight:500; width:100%;"><?php echo date('d M, Y', $indus_d['created_date']);?></p>
	<a href="<?php echo SITE_URL.'news/'.$indus_d['slug']; ?>"><h5><?php echo $indus_d['blog_title'];?></h5></a>
	</div>
	<?php endforeach; ?>
	
	</div>
</div>
      
</div>
	</div>
</div>

<div class="col-lg-4 col-md-4 col-sm-12">
<form id="subscribe1frm" method="post" action=""> 
<div class="bg-greyl py-3 px-4" style="display:inline-block;">
<input type="hidden" id="frm" value="subscribe1">
<input type="text" class="form-control mb-2" id="name" placeholder="Name*">
<input type="text" class="form-control mb-2" id="email" placeholder="E-mail ID*" >
<input type="text" class="form-control mb-2" id="contact" placeholder="Contact Number*">
<div style="width:100%;margin-top: 9px;"><div class="g-recaptcha2" style="height:54px; border:none !important;">
<div class="g-recaptcha  mt-0" style="transform: scale(0.67); -webkit-transform: scale(0.67); transform-origin: 0 0; -webkit-transform-origin: 0 0;" data-sitekey="6Lcu79siAAAAALzz13S3Bsvs8568tYRxLmEWGvb-"></div>
</div>
<div class="sub-btn">
  <button type="button" onclick="submitfrm();" id="loader_msg" class="btn more2 mt-2" style="color:#ffffff;"> 订阅</button></div>
</div>
<p style="float: left;
    color: red !important;
    font-size: 12px;
    width: 100%;" id="captcha_error"></p>  
<p style="float: left;
    color: red !important;
    font-size: 12px;
    width: 100%;" id="success_msg"><p>
</div>
</form>

<div class="arch">
  <h3>Archives</h3>
<ul class="list_container nav_accordiannewsp">
<?php
$arch = $mysqli_q->query("SELECT Year(FROM_UNIXTIME(created_date)) as year, Month(FROM_UNIXTIME(created_date)) as month, Count(*) as posts FROM sys_blog
 GROUP BY year, month order by MIN(created_date) desc")->fetch_all(MYSQLI_ASSOC);
$i=1;
foreach($arch as $arch_d): 
$monthName = strftime('%B', mktime(0, 0, 0, $arch_d['month']));
?>  
<li><a href="<?php echo SITE_URL;?>press-release.php?m=<?php echo $arch_d['month'];?>&y=<?php echo $arch_d['year'];?>"><?php echo $monthName.' '.$arch_d['year'].' ('.$arch_d['posts'].')';?></a> </li>
<?php $i++; endforeach; ?>
</ul>
</div>

  </div>


</div>



            </div>
        </div>
    </div> 

    

</section>


<?php include('common/footer.php') ;?>



<script src="js/wow.min.js"></script>
<script>
$('.nav_accordiannewsp').each(function(){
  var max = 3;
  if ( $(this).find("li").length > max ) {
    $(this)
      .find('li:gt('+max+')')
      .hide()
      .end()
      .append(
        $('<li><span style="padding-top:0px; font-weight:bold; font-size:12px;">view more...<span></li>').click( function(){
          $(this).siblings(':hidden').show().end().remove();
        })
    );
  }
});
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






<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
    //$('button').addClass('btn-primary').text('Switch to Orange Tab');
    $('button').click(function(){
      $('#tabs a[href=#orange]').tab('show');
    });
	

function submitfrm(){
	
	var frm = $('#frm').val();
	var name = $('#name').val();
	var email = $('#email').val();
	var contact = $('#contact').val();
	
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
			name: name,
			email: email,
			contact: contact,
		},
		cache: false,
		success: function(result) {}
	});
	
	setTimeout(function(){
		$('#subscribe1frm').trigger("reset");
		document.getElementById('success_msg').innerHTML = '<span style="color:green !important;">Thank you for your subscription.</span>';
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
