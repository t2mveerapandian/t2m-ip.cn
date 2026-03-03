<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $meta_title;?></title>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="<?php echo $meta_keywords;?>">
<meta name="description" content="<?php echo $meta_description;?>" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/style.css">
<script src="<?php echo SITE_URL;?>js/jquery.min.js"></script>
<script src="<?php echo SITE_URL;?>js/popper.min.js"></script>
<script src="<?php echo SITE_URL;?>js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/menu.css">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMG_URL;?>favicon.ico">
<!--link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'-->
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/animate.css">
<link rel="stylesheet" href="<?php echo SITE_URL;?>tether/tether.min.css">
<link rel="stylesheet" href="<?php echo SITE_URL;?>animate.css/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/brands.min.css" integrity="sha512-ym1f+T15aiJGZ1y6zs1XEpr8qheyBcOPqjFYNf2UfRmfIt5Pdsp7SD5O74fmsFB+rxxO6ejRqiooutodoNSjRQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/621236d81ffac05b1d7ac87c/1fsbicfvs';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-250511651-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-250511651-1');
</script>

<style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 99999; /* Sit on top */
  padding-top:0px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 50%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s

}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: #000;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #c00000;
  color: white;
}

.modal-body {padding: 0px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
.modal-body .form-control2{width: 77%;}

.fn{width:39% !important;}


@media only screen and (max-width: 746px){

.modal-content {
  width:90%;}
.modal-body .form-control2{width: 100%;}
}
.fn{width: 50%;}

</style>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css'>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div id="sticky" class="sticky">
<div class="header mb-3" id="myHeader">
<div class="container">    <div class="row ">
 <h3 class="text-center tagline2">经过生产验证的，复杂的半导体IP核</h3>
  <div class="col-lg-5 col-md-5 col-sm-5 col-5"><a href="<?php echo SITE_URL;?>"><img src="<?php echo IMG_URL;?>logo-tagwithout.png" class="logo"><img src="<?php echo IMG_URL;?>logo-tagwithout.png" class="logo logo2"></a> <h3 class="text-center tagline-index"> <?php echo $d->header_text;?></h3></div>
  <div class="col-lg-7 col-md-7 col-sm-7 col-7">
   
	<div class="grey-bg mt-3">
	<div class="social">
	<ul>
		<li class="instali"><a href="<?php echo $d['weibo'];?>" class="tran3s round-border instasocial" target="_blank"><img src="<?php echo SITE_URL.'images/weibo-icon.png';?>" style="width:20px;"></a></li>
		<li class="instali"><a href="<?php echo $d['facebook'];?>" class="tran3s round-border" target="_blank"><img src="<?php echo SITE_URL.'images/insta.png';?>" ></a></li>
		<li><a href="<?php echo $d['linkedin'];?>" class="tran3s round-border" target="_blank"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a></li>
		<li><a href="<?php echo $d['twitter'];?>" class="tran3s round-border" target="_blank"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a></li>
	</ul>
	</div>


 <div class="search-container">
    <form action="<?php echo SITE_URL;?>search.php" method="get">
      <input type="text" placeholder="搜索..." name="s" value="" required>
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>

<div class="dropdown">
<div class="barr dropdown-toggle" data-toggle="tooltip" data-placement="bottom" title="下载IP品类目录">
<a href="<?php echo SITE_URL;?>download-ip.php"><i class="fa fa-bars" aria-hidden="true" style="font-size: 18px; color:#fff;padding:0px 7px;"></i></a>
</div>
</div>

<div style="display:inline-block;">  <div class="slanted slanted-right slant-to-left">

    <nav class="navbar navbar-expand-lg">
    <ul class="navbar-nav">
		<li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL;?>">首页</a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL;?>press-release.php">新闻中心</a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL;?>upcoming-event.php">活动</a> </li>
		<li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL;?>contact.php">联系方式</a> </li>

 <span class="devider"> | </span> <div class="lang "><a href="https://t-2-m.com/" target="_blank">EN</a><!-- <a href="#"> 中文 </a> --></div>
    </ul>
</nav></div>
  </div>

</div>

  </div>

  </div> <!--MAIN row cloase-->

</div>
</div>

 <hr>
<nav class="navbar navbar-expand-sm navbar-expand-md bg-grey navbar-dark ">
 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <i class="fa fa-bars"></i>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      	  <li class="nav-item dropdown">
        <a class="nav-link" href="<?php $site_url?>/risc-v.php" id="navbarDropdown" role="button"  aria-haspopup="flase" aria-expanded="false">RISC-V</a>
	
      </li>
	<?php
	$pcat_data = ORM::for_table('sys_course_categories')->where(array('parent_category'=>0))->order_by_asc('sort_order')->find_many();
	foreach($pcat_data as $pcategory): ?>
	<li class="nav-item dropdown <?php if(isset($pcat_id) && $pcat_id==$pcategory['id']){ echo 'activee2'; }?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $pcategory['title']; ?></a>
		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		  <div class="container" style="display:block;">
            <div class="row">
			<?php
			$mcat_id = $pcategory['id'];
			$subcat_arr = ORM::for_table('sys_course_categories')->where(array('parent_category'=>$mcat_id))->order_by_asc('sort_order')->find_many();
			foreach($subcat_arr as $subcat_data): ?>
				<div class="col-md-3">
					<ul class="nav flex-column nav_accordian">
					  <span class="text-uppercase text-red"><?php if(isset($subcat_data->cat_icon) && $subcat_data->cat_icon!=''){ ?><span class="menu-icon"><img src="<?php echo SITE_URL.'admin/images/icons/'.$subcat_data->cat_icon;?>" style="width:18px;"></span><?php }?><?php echo $subcat_data['title']; ?></span>
						<?php
						$subcat_id = $subcat_data['id'];
						$prod_arr = ORM::for_table('sys_menu')->where(array('cat_id'=>$subcat_id))->order_by_asc('sort_order')->find_many(); 
						foreach($prod_arr as $prd):
						$pdd = ORM::for_table('sys_products')->where(array('id'=>$prd['prod_id'],'status'=>1) )->find_one();
						if($pdd['title']!=''){
						?>
						<li class="nav-item">
							<a class="nav-link <?php if($product_id==$pdd['id']){?>selectedd<?php }?>" href="<?php echo SITE_URL.$pdd['slug']; ?>"><?php echo shortenText($pdd['title']);?></a>
						</li>
					<?php } endforeach; ?> 
				  </ul>
                </div>
			<?php endforeach; ?>	  
            </div>
          </div>
          <!--  /.container  -->
        </div>
      </li>
	  <?php endforeach; ?>	
	
     
    </ul>
  </div>  
</nav>
                                                                          
</div>
