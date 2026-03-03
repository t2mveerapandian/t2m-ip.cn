<?php  
include('common/config.php') ;
$d = ORM::for_table('sys_appconfig')->where('id',1 )->find_one();

$product_slug = trim($_GET['post_url']);
$product = ORM::for_table('sys_products')->where(array('slug'=>$product_slug) )->find_one();
$product_id = $product['id'];
$product_title = $product['title'];
$overview = $product['overview'];
$features = $product['features'];
$logo_1 = $product['logo_1'];
$logo_1_url = $product['logo_1_url'];
$logo_2 = $product['logo_2'];
$logo_2_url = $product['logo_2_url'];
$logo_3 = $product['logo_3'];
$logo_3_url = $product['logo_3_url'];

$catdata = ORM::for_table('sys_menu')->where(array('prod_id'=>$product_id) )->find_one();
$product_category = $catdata['cat_id'];

$catdata = ORM::for_table('sys_course_categories')->where(array('id'=>$product_category) )->find_one();
$pcat_id = $catdata['parent_category'];

$pcatdata = ORM::for_table('sys_course_categories')->where(array('id'=>$pcat_id) )->find_one();
$main_cat_title = $pcatdata['title'];

$meta_title = $product['meta_title'];
$meta_description=$product['meta_description'];
$meta_keywords=$product['meta_keyword'];
include('common/productHeader.php') ;


?>                                                                        
<div class="breadcrum">T2M <span style="font-size:20px;">&rsaquo;</span> <?php echo $main_cat_title;?> <span style="font-size:20px;">&rsaquo;</span> <?php echo $product_title;?> </div>
<section class=" mbr-section mbr-section-hero mbr-section-full4 "  style="background-image: url(<?php echo IMG_URL;?>bg-new.jpg); background-size:cover;">
<div class="mbr-table-cell2">
<div class="container inner-page-container pro-page-height">
<div class="row">

<div class="col-lg-3 col-md-3 col-sm-12 mt-p pro-box"> 

<?php
$subcat_data = ORM::for_table('sys_course_categories')->where(array('parent_category'=>$pcat_id))->order_by_asc('sort_order')->find_many();
foreach($subcat_data as $subcat):

$subcatid = $subcat['id'];
$prod_data_arr = ORM::for_table('sys_menu')->where(array('cat_id'=>$subcatid))->order_by_asc('sort_order')->find_many(); 
$podcnt = count($prod_data_arr);
$heightdiv = 50*$podcnt.'px';	
?>
<button class="accordion <?php if($product_category==$subcat['id']){ echo 'active';}?>" ><?php echo $subcat['title']; ?></button>
<div class="panel" <?php if($product_category==$subcat['id']){?> style="max-height: <?php echo $heightdiv;?>;" <?php }?>>
 <ul>
	<?php 
	foreach($prod_data_arr as $prod_d): 
	$pdd_d = ORM::for_table('sys_products')->where(array('id'=>$prod_d['prod_id'],'status'=>1) )->find_one();
	if($pdd_d['title']!=''){
	?>
	<li <?php if($product_id==$pdd_d['id']){?>class="active"<?php }?>><a href="<?php echo SITE_URL.$pdd_d['slug']; ?>" ><?php echo $pdd_d['title'];?></a></li>
	<?php } endforeach; ?>
  </ul>
</div>
<?php endforeach; ?>
</div>

<div class="col-lg-9 col-md-9 col-sm-12"> <h3 class="font-600 mb-2 font-29"><?php echo $product_title;?></h3>
<div class="right-panel">
<?php if($product_id > 0){ ?>
<h5 class="font-600">概述和功能介绍</h5>
<p><?php echo $overview;?></p>
<h5 class="font-600">功能描述</h5>
<?php echo $features;?>
<?php }else{ ?>
No record found!!
<?php }?>

</div>
<?php if($product_id > 0){ ?>
<div class="mt-3 below"><?php if($logo_1!='' && $logo_1_url!=''){?><a href="<?php echo $logo_1_url;?>" target="_blank"><img src="<?php echo SITE_URL.'admin/images/logo/'.$logo_1;?>"></a><?php }?> <?php if($logo_2!='' && $logo_2_url!=''){?><a href="<?php echo $logo_2_url;?>" target="_blank"><img src="<?php echo SITE_URL.'admin/images/logo/'.$logo_2;?>"></a><?php }?> <?php if($logo_3!='' && $logo_3_url!=''){?><a href="<?php echo $logo_3_url;?>" target="_blank"><img src="<?php echo SITE_URL.'admin/images/logo/'.$logo_3;?>"></a><?php }?> <a class="btn date-sheet" id="myBtn">索取数据表</a> </div> 
  <?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){ echo '<p style="color:green !important;">'.$_SESSION['msg'].'</p>'; $_SESSION['msg']=''; }?>
<?php }?>
            </div>
        </div>
    </div> 
</div> 
    

</section>


<?php include('common/footer.php') ;?>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header"><span>索取数据表</span>
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
	<form id="productfrm" method="post" action="">
	<input type="hidden" id="frm" value="product">
	<input type="hidden" id="product" value="<?php echo $product_title;?>">	
	 <div class="offset-lg-2 col-lg-10 col-md-12 col-sm-12 my-3" style="padding-bottom:30px;">
		<div style="display: flex; width: 100%;">
		<input type="text" class="form-control2 mb-2 fn" id="first_name" placeholder="First Name*">
		<input type="text" class="form-control2 mb-2 fn" id="last_name" placeholder="Last Name*">
	</div>
	<input type="text" class="form-control2 mb-2" id="company_email" placeholder="Company E-mail ID*">
	<input type="text" class="form-control2 mb-2" id="contact" placeholder="Contact number*">
	<textarea style="resize: none;" class="form-control2 mb-1" id="description" placeholder="Description*"></textarea>
	<input type="text" class="form-control2 mbr-section-full3 mb-2" id="company" placeholder="Company">
	<input type="text" class="form-control2 mb-2" id="company_url" placeholder="Company URL">
	<input type="text" class="form-control2 mbr-section-full3 mb-2" id="linklayer" placeholder="IP Decision Schedule">
	<input type="text" class="form-control2 mb-1" id="country" placeholder="Country*">
	<div class="checkbox mt-2">
		<label><input type="checkbox" id="terms"> Yes, I understand your <a href="<?php echo SITE_URL;?>gdpr.php">Terms and Privacy Policy</a>
	</label>
	  </div>
	  <div class="checkbox">
		<label><input type="checkbox" id="news_updated" value="yes"> Yes, I please keep me updated with exciting <br> new IPs, NEWS and Events from T2M
	</label>
	  </div>
	  <div style="width:100%;margin-top: 9px; padding-bottom:5px;"><div class="g-recaptcha2" style="width:39%; height:30px; border:none !important;">
<div class="g-recaptcha  mt-0" style="transform: scale(0.67); -webkit-transform: scale(0.67); transform-origin: 0 0; -webkit-transform-origin: 0 0;" data-sitekey="6Lcu79siAAAAALzz13S3Bsvs8568tYRxLmEWGvb-"></div>
</div><div class="sub-btn">
  <button type="button" onclick="submitfrm();" id="loader_msg" class="btn more2 mt-2" style="padding: 5px 5% !important; color:#fff;"> Send</button></div>
</div><br>
<p id="policy_error" style="width:100%; float: left; padding-top: 20px;"></p>
<p id="captcha_error" style="width:100%; float: left; padding-top: 20px;"></p>
<p id="success_msg" style="width:100%; float: left; padding-top: 20px;"><p>
	</div>
	 </form>

    </div>
  </div>
</div>
<script>
function myFunction(x) {
  x.classList.toggle("change");
}
</script>

<script src="<?php echo SITE_URL;?>js/wow.min.js"></script>
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

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

$(document).ready(function(){
	var uri = window.location.toString();
	if (uri.indexOf("?") > 0) {
	    var clean_uri = uri.substring(0, uri.indexOf("?"));
	    window.history.replaceState({}, document.title, clean_uri);
	}
});


function submitfrm(){
	
	var frm = $('#frm').val();
	var product = $('#product').val();
	var first_name = $('#first_name').val();
	var last_name = $('#last_name').val();
	var company_email = $('#company_email').val();
	var contact = $('#contact').val();
	var description = $('#description').val();
	var company = $('#company').val();
	var company_url = $('#company_url').val();
	var linklayer = $('#linklayer').val();
	var country = $('#country').val();
	
	
	if($("#news_updated").prop('checked') == true){
		var news_updated = 'Yes';
	}else{
		var news_updated = 'No';
	}		
	
	var recaptcha_response = $('#g-recaptcha-response').val();
	
	if(first_name == ''){
	  $('#first_name').attr('placeholder','Please enter first name');
	  $('#first_name').css('border','2px solid red');
	  return false;
	}
	$('#first_name').css('border','1px solid #c00000 ');
	
	if(last_name == ''){
	  $('#last_name').attr('placeholder','Please enter last name');
	  $('#last_name').css('border','2px solid red');
	  return false;
	}
	$('#last_name').css('border','1px solid #c00000 ');
	

	if(company_email == ''){
	  $('#company_email').attr('placeholder','Please enter company email');
	  $('#company_email').css('border','2px solid red');
	  return false;
	}
	$('#company_email').css('border','1px solid #c00000');

	if(company_email !=''){
	  var intRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  var check = intRegex.test(company_email);
	  if(check == false){
		$('#company_email').val('');
		$('#company_email').attr('placeholder','Please enter valid company email');
		$('#company_email').css('border','2px solid red');
		return false;
	  } 
	}
	$('#company_email').css('border','1px solid #c00000');
	
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
	
	
	if(description == ''){
	  $('#description').attr('placeholder','Please enter description');
	  $('#description').css('border','2px solid red');
	  return false;
	}
	$('#description').css('border','1px solid #c00000 ');
	
	
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
			product: product,
			first_name: first_name,
			last_name: last_name,
			company_email: company_email,
			contact: contact,
			description: description,
			company: company,
			company_url: company_url,
			linklayer: linklayer,
			country: country,
			news_updated: news_updated,
		},
		cache: false,
		success: function(result) {}
	});
	
	setTimeout(function(){
		$('#productfrm').trigger("reset");
		document.getElementById('success_msg').innerHTML = '<span style="color:green !important;">Thank you! Our team member will contact you soon.</span>';
		document.getElementById('loader_msg').innerHTML = 'Send';	
	}, 5000);

}
</script>




<script src="<?php echo SITE_URL;?>tether/tether.min.js"></script>
 <script src="<?php echo SITE_URL;?>jarallax/jarallax.js"></script>
   <script src="<?php echo SITE_URL;?>smooth-scroll/smooth-scroll.js"></script>
    <script src="<?php echo SITE_URL;?>js/script.js"></script>
</body>



</html>
