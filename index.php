<?php
$title = "复杂半导体硅 IP 核、软件、解决方案提供商 - T2M IP";
$meta_description = "T2M是世界上最大的独立半导体技术授权业务发展公司，为帮助客户加速产品开发的进程，我们与合作伙伴向市场提供复杂的系统级技术、半导体IP核、软件、Turnkey Design服务、KGD、SoC和破坏性技术。
";
$meta_keywords = "WiFi、ZigBee、4G、5G、GNSS、DVB, ISDB, DTMB解调器/调制器, 视频解码器/编码器, USB, MIPI, HDMI,DP, 以太网";

include('common/header.php');
$t2m_overview = ORM::for_table('homepagetext')->where('id',3 )->find_one();
$kgd = ORM::for_table('homepagetext')->where('id',4 )->find_one();
?>


<section class="content web mbr-section mbr-section-hero mbr-section-full mbr-parallax-background mbr-section-with-arrow mbr-after-navbar" id="header1-36" style="background-image: url(images/background-1.jpg); background-attachment: fixed;">

 


<div class="mbr-table-cell">

        <div class="container">
            <div class="row">
                
<div class="b4"><a href="<?=getMenuLink('1');?>"><img src="images/c1.png" class="img-fluid"></a><a href="<?=getMenuLink('2');?>"><img src="images/c2.png" class="img-fluid"></a><a href="<?=getMenuLink('3');?>"><img src="images/c3.png" class="img-fluid"></a><a href="<?=getMenuLink('4');?>"><img src="images/c4.png" class="img-fluid"></a><a href="<?=getMenuLink('5');?>"><img src="images/c5.png" class="img-fluid"></a><a href="<?=getMenuLink('6');?>"><img src="images/c6.png" class="img-fluid"></a></div>
<div class="b5"><a href="<?=getMenuLink('7');?>"><img src="images/br1.png" class="img-fluid"></a><a href="<?=getMenuLink('8');?>"><img src="images/br2.png" class="img-fluid"></a><a href="<?=getMenuLink('9');?>"><img src="images/br3.png" class="img-fluid"></a><a href="<?=getMenuLink('10');?>"><img src="images/br6.png" class="img-fluid"></a><a href="<?=getMenuLink('11');?>"><img src="images/br4.png" class="img-fluid"></a><a href="<?=getMenuLink('12');?>"><img src="images/br5.png" class="img-fluid"></a><a href="<?=getMenuLink('13');?>"><img src="images/br8.png" class="img-fluid"></a><a href="<?=getMenuLink('14');?>"><img src="images/br7.png" class="img-fluid"></a></div>
<div class="b3">
    <div style="width:100%; float:left;">
      <div style="width:60%; float:left;">    
       <a href="<?=getMenuLink('15');?>"><img src="images/usb40gbps-new.jpg" class="img-fluid" style="width:108px;margin-right: 0px; margin-top: 10px;"></a>
       </div>
       <div style="width:40%; float:right;">    
       <a href="<?=getMenuLink('16');?>"><img src="images/i4.png" class="img-fluid"></a>
       </div>
    </div>
    
    <a href="<?=getMenuLink('17');?>"><img src="images/i2.png" class="img-fluid" style="width:85px;"></a>
    <a href="<?=getMenuLink('18');?>"><img src="images/i6.png" class="img-fluid  display"></a>
    
    <div style="width:100%; float:left;">
      <div style="width:50%; float:left;"> 
      <a href="<?=getMenuLink('21');?>" class="img-fluid"><img src="images/ddr-new.png" style="width:85px;margin-right: 0px;"></a>
      </div>
       <div style="width:50%; float:right;">    
       <a href="<?=getMenuLink('20');?>"><img src="images/pci.png" class="img-fluid" style="width:85px;margin-top:-2px;"></a>
       </div>
    </div>
   
   <a href="<?=getMenuLink('40');?>"><img src="images/ethernet-new.png" class="img-fluid"></a>
   
   <div style="width:100%; float:left;">
      <div style="width:50%; float:left;"> 
      <a href="<?=getMenuLink('39');?>" class="img-fluid"><img src="images/can-fd.png" style="width:85px;margin-right: 0px;margin-top: 0px;"></a>
      </div>
       <div style="width:50%; float:right;">    
       <a href="<?=getMenuLink('38');?>" class="text" style="margin-top:-2px;">LIN</a>
       </div>
    </div>
    
    <div style="width:100%; float:left;">
      <div style="width:50%; float:left;"> 
      <a href="<?=getMenuLink('42');?>" class="text" style="margin-top:-10px;font-size: 15px;">ADC / DAC</a>
      </div>
       <div style="width:50%; float:right;">    
       <a href="<?=getMenuLink('41');?>"><img src="images/jesd204.png" class="img-fluid" style="width:85px;margin-top:-2px;"></a>
       </div>
    </div>
    
    <div style="width:100%; float:left;">
      <div style="width:50%; float:left;"> 
      <a href="<?=getMenuLink('22');?>"><img src="images/i5.png" class="img-fluid" style="width: 70px;margin-top: -19px;"></a>
      </div>
       <div style="width:50%; float:right;">    
       <a href="<?=getMenuLink('19');?>" class="text" style="width:85px;margin-top:-8px;">SerDes</a>
       </div>
    </div>
</div>
<div class="b1">
    <a href="<?=getMenuLink('23');?>"><img src="images/w1.png" class="img-fluid" style="margin: 5px auto !important;"></a>
    <a href="<?=getMenuLink('46');?>"><p style="color:#002762!important;text-align:center; font-weight:bold;">5.4/Low Energy/ Dual Mode</p></a>
    <a href="<?=getMenuLink('44');?>"><img src="images/lc3-plus.png" class="img-fluid" style="margin: 5px auto !important;"></a>
    
    <div class="d-flex" style="justify-content: space-around;">
     <a href="<?=getMenuLink('45');?>"><img src="images/hi-resolution-audio.png" class="img-fluid" style="margin: 5px auto 0 !important;"></a>
      <a href="<?=getMenuLink('43');?>"><img src="images/lc3.png" class="img-fluid" style="margin: 5px auto 0 !important;"></a>
      </div>
      
    <a href="<?=getMenuLink('25');?>"><img src="images/w3.png" class="img-fluid" style="margin: 5px auto !important;"></a>
    <a href="<?=getMenuLink('24');?>"><img src="images/w4.png" class="img-fluid" style="margin: 5px auto !important;"></a>
    <a href="<?=getMenuLink('27');?>"><img src="images/w5.png" class="img-fluid" style="margin: 5px auto !important;"></a>
    <a href="<?=getMenuLink('28');?>"><img src="images/w6.png" class="img-fluid" style="margin: 5px auto !important;"></a>
</div>
<div class="b2 pt-3">
<a href="<?=getMenuLink('29');?>"><img src="images/a2.png" class="img-fluid"></a>
<a href="<?=getMenuLink('30');?>"><img src="images/a1.png" class="img-fluid"></a>
<a href="<?=getMenuLink('31');?>"><img src="images/a3.png" class="img-fluid"></a>
<a href="<?=getMenuLink('32');?>"><img src="images/a5.png" class="img-fluid"></a>
<a href="<?=getMenuLink('33');?>"><img src="images/a4.png" class="img-fluid"></a>
<a href="<?=getMenuLink('34');?>"><img src="images/a6.png" class="img-fluid"></a>
<a href="<?=getMenuLink('35');?>"><img src="images/a7.png" class="img-fluid"></a>
<a href="<?=getMenuLink('36');?>"><img src="images/a8.png" class="img-fluid"></a></div>

            </div>
        </div>
    </div>  

</section>



<section class="mobile" >


<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
       <li data-target="#demo" data-slide-to="3"></li>
    <li data-target="#demo" data-slide-to="4"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="#"><img src="images/mobile-bg1.jpg" alt="banner1" class="img-fluid"></a>
     
    </div>
    <div class="carousel-item">
      <img src="images/mobile-bg2.jpg" alt="banner2"  class="img-fluid">
    
    </div>
    <div class="carousel-item">
      <img src="images/mobile-bg3-new.png" alt="banner3"  class="img-fluid">
      
    </div>
      <div class="carousel-item">
      <img src="images/mobile-bg4.jpg" alt="banner3"  class="img-fluid">
       
    </div>
      <div class="carousel-item">
      <img src="images/mobile-bg5.jpg" alt="banner3"  class="img-fluid">
       
    </div>
  </div>


</div>



</section>




<section class="news-sec"  id="header3-3z" > <div class="container"> <div class="row home-even no-gutters"> 

<div class="col-md-4 col-sm-4 col-12">


  <div class="events"> <div class="events-head"> <h3>活动</h3> </div> <div class="events-body"> 



  <div class="slider">

<?php
$evnt_arr = ORM::for_table('sys_events')->where(array('is_featured'=>'0'))->limit(3)->order_by_asc('sort_order')->find_many();
foreach($evnt_arr as $evnt):
$banner = $evnt['banner'];
$start_date = date('dS M', strtotime($evnt['start_date']));
$end_date = date('dS M Y', strtotime($evnt['end_date']));
?>
<div class="newip-body latest_ips_cont">
<div class="float-l" style="width:30%;"> 
<a href="<?php echo $datae['evnt']; ?>" target="_blank"><img src="<?php echo SITE_URL.'admin/images/events/'.$banner;?>" class="d-block" style="width: 80px;"></a>
</div> 
<div class="float-r" style="width:70%;"> 
<p style=" font-size: 14px;"><?php echo $start_date;?> - <?php echo $end_date;?></p>
<a href="<?php echo SITE_URL.'event/'.$evnt['slug']; ?>">Meeting request</a>
</div>

</div>
<?php endforeach; ?>



</div>






</div> 
</div> 
</div>


<div class="col-md-4 col-sm-4 col-12">
  <div class="events"> <div class="events-head newip-head"> <h3>最新的IP产品</h3> </div> <div class="events-body"> <div class="latestip-body  latest_ips_cont">
<ul> 
<?php
$latest_ip_arr = ORM::for_table('sys_products')->where(array('is_latest'=>1,'status'=>1))->limit(3)->order_by_desc('id')->find_many();
foreach($latest_ip_arr as $ip_latest):
?>
<li class=""><a href="<?php echo SITE_URL.$ip_latest['slug']; ?>" target="_blank" ><?php echo substr($ip_latest['title'], 0, 45);?></a></li>
<?php endforeach; ?>
</ul> 
</div> </div> </div> </div>


<div class="col-md-4 col-sm-4 col-12">
  <div class="events"> <div class="events-head"> <h3> 新闻中心</h3> </div> <div class="events-body"> <div class="newip-body latest_ips_cont">

  <div class="slider">
  <?php
$latest_news_arr = ORM::for_table('sys_blog')->where(array('status'=>1))->limit(8)->order_by_desc('created_date')->find_many();
foreach($latest_news_arr as $news_latest):
?>
<h6><a href="<?php echo SITE_URL.'news/'.$news_latest['slug']; ?>" target="_blank" ><?php echo $news_latest['blog_title'];?></a></h6>
<?php endforeach; ?>
</div>
 
</div></div> </div> </div>

</div></div>
</section>



<section class="web mbr-section mbr-section-hero mbr-section-full mbr-parallax-background M-10" style="background-image: url(images/background-2.jpg);">

  <div class="mbr-table-cell">

        <div class="container">
    
<div class="row">             
<div class="col-md-6 col-sm-6 col-12">
  <div class="wow fadeInUp  animated" data-wow-delay="1.6s" style="visibility: visible; animation-delay:1.6s; animation-name: fadeInUp;">
  <div class="graphics" ><img src="images/graphic3.png"></div></div>
<div class="interface-bg custom-sec-img wow fadeInLeft animated" data-wow-delay="1.0s"><img src="images/interface-bg.png" class="interface-img">
<a href="<?=getMenuLink('19');?>" class="text2 ">SerDes</a>
  <div class="i-1"><a href="<?=getMenuLink('15');?>"><img src="images/i1.png"></a></div>
  <div class="ddr"><a href="<?=getMenuLink('21');?>"><img src="images/ddr.png"></a></div>
   <div class="i-n"><a href="<?=getMenuLink('20');?>"><img src="images/pci.png"></a></div> 
<div class="interface-2"><img src="images/interface2.png" class="zoom-cont full"></div>
 <div class="i-2"><a href="<?=getMenuLink('17');?>"><img src="images/i2.png"></a></div>
  <div class="i-3"><a href="<?=getMenuLink('16');?>"><img src="images/i4.png"></a></div>
   <div class="i-4"><a href="<?=getMenuLink('22');?>"><img src="images/i5.png"></a></div>
    <div class="i-5"><a href="<?=getMenuLink('18');?>"><img src="images/i6.png"></a></div>
</div>
<div class="wow fadeInDown  animated" data-wow-delay="0.8s" style="visibility: visible; animation-delay:0.8s; animation-name: fadeInDown;">
  <div class="graphics2" ><img src="images/graphic2.png"></div></div>

</div>  
<div class="col-md-6 col-sm-6 col-12 ">
<div>
<ul id="wk-bf8" class="uk-switcher uk-text-left uk-margin-top uk-margin-left2" data-uk-check-display="">
    
    <li aria-hidden="false" class="uk-active"><div class="uk-panel siWhoWeAreContentSwitcher2">
      <div class="cellular wow fadeInRight  animated" data-wow-delay="2s" style="visibility: visible; animation-delay: 2s; animation-name: fadeInRight;"></div>
           <div class="siABoutUsBackgroundCircle12" ></div>
           <div class="siABoutUsBackgroundCircle22"> </div>
           <div class="siABoutUsBackgroundCircle32" > </div>
           <div class="siABoutUsBackgroundCircle42" ></div> 

<div class="animate ">
      <div class="circle-animation" style="animation-delay:1s"></div><div class="circle-animation"  style="animation-delay:1.5s"></div><div class="circle-animation" style="animation-delay: 2s"></div>
</div>
<div class="br-products siHomeSwitcherContent2 wow fadeInRight  animated" data-wow-delay="1s" style="visibility: visible; animation-delay:1s; animation-name: fadeInRight;">
  <img src="images/broadcst.png" class="br-tital zoom-cont full2">
  <img src="images/mod.png" class="br-tital223 zoom-cont full223">
  <img src="images/demod.png" class="br-tital224  zoom-cont full224">
  <a href="<?=getMenuLink('7');?>"><img src="images/bd1.png" class="t1  wow fadeInRight  animated" data-wow-delay="1.1s"></a>
   <a href="<?=getMenuLink('8');?>"><img src="images/bd2.png" class="t2  wow fadeInRight  animated" data-wow-delay="1.4s"></a>
  <a href="<?=getMenuLink('9');?>"><img src="images/bd3.png" class="t3  wow fadeInRight  animated"  data-wow-delay="1.7s"></a>
  <a href="<?=getMenuLink('10');?>"><img src="images/bd5.png" class="t4 wow fadeInRight  animated" data-wow-delay="2s"></a>
  <a href="<?=getMenuLink('11');?>"><img src="images/bd7.png" class="t5 wow fadeInRight  animated" data-wow-delay="2.3s"></a>
  <a href="<?=getMenuLink('12');?>"><img src="images/bd8.png" class="t6 wow fadeInRight  animated" data-wow-delay="2.6s"></a>
  <a href="<?=getMenuLink('13');?>"><img src="images/bd4.png" class="t7 wow fadeInRight  animated" data-wow-delay="2.9s"></a>
  <a href="<?=getMenuLink('14');?>"><img src="images/bd6.png" class="t8 wow fadeInRight  animated" data-wow-delay="3s"></a>
            
            </div>                
            
        </div>
              
    </li>
</ul>
</div>



</div>  


            </div>
        </div>
    </div> 


</section>




<section class="web mbr-section mbr-section-hero mbr-section-full mbr-section-with-arrow mbr-after-navbar" style="background-image: url(images/background-3.jpg); ">
  <div class="mbr-table-cell">
 <div class="container">

          <div class="row">
<div class="col-md-6 col-sm-6 col-12">

<div class="new">
<div class="cell-1 wow fadeInLeft animated" data-wow-delay="0.4s"><div class="view overlay zoom"><a href="<?=getMenuLink('1');?>"><img src="images/cell-1.png" class="zoom-cont"></a></div></div>
<div class="cell-2 wow fadeInLeft animated" data-wow-delay="0.6s"><div class="view overlay zoom"><a href="<?=getMenuLink('2');?>"><img src="images/cell-2.png"  class="zoom-cont"></a></div></div>
<div class="cell-3 wow fadeInLeft animated" data-wow-delay="0.8s"><div class="view overlay zoom"><a href="<?=getMenuLink('3');?>"><img src="images/cell-5.png"  class="zoom-cont"></a></div></div>
<div class="cell-4 wow fadeInLeft animated" data-wow-delay="0.8s"><div class="view overlay zoom"><a href="<?=getMenuLink('4');?>"><img src="images/cell-3.png"  class="zoom-cont"></a></div></div>
<div class="cell-5 wow fadeInLeft animated" data-wow-delay="0.6s"><div class="view overlay zoom"><a href="<?=getMenuLink('5');?>"><img src="images/cell-6.png"  class="zoom-cont"></a></div></div>
<div class="cell-6 wow fadeInLeft animated" data-wow-delay="0.2s"><div class="view overlay zoom"><a href="<?=getMenuLink('6');?>"><img src="images/cell-4.png"  class="zoom-cont"></a></div></div>
</div>
<div>  
    





<ul id="wk-bf8" class="uk-switcher uk-text-left uk-margin-top uk-margin-left" data-uk-check-display="">
    
    <li aria-hidden="false" class="uk-active"><div class="uk-panel siWhoWeAreContentSwitcher">
           <div class="siABoutUsBackgroundCircle1">
           </div>
           <div class="siABoutUsBackgroundCircle2"></div><div class="cellular-tital"><img src="images/cellular-tital.png"></div>
           <div class="siABoutUsBackgroundCircle3"> </div>

           <div class="siABoutUsBackgroundCircle4"></div>
          


<div class="animate2 ">
      <div class="circle-animation2" style="animation-delay: 0s"></div><div class="circle-animation2"  style="animation-delay: 1.5s"></div><div class="circle-animation2" style="animation-delay: 2.5s"></div>
</div>



<div class="siHomeSwitcherContent wow fadeInLeft animated" data-wow-delay="0.6s">
  <a href="#"><img src="images/ph.png" class="wireless"></a>
           <a href="<?=getMenuLink('23');?>"><img src="images/p1.png"></a>
           <a href="<?=getMenuLink('24');?>"><img src="images/p4.png"></a>
           <a href="<?=getMenuLink('37');?>"><img src="images/p3.png"></a>
           <a href="<?=getMenuLink('26');?>"><img src="images/p2.png"></a>
           <a href="<?=getMenuLink('27');?>"><img src="images/p5.png"></a>
            </div>                
            
        </div>
              
    </li>
</ul>

    
</div>
</div>


<div class="col-md-6 col-sm-6 col-12">
<div id="particles-js"></div>
<div class="audiosw2 custom-sec-img wow fadeInRight animated" data-wow-delay="1.0s"><!--img src="images/audiosw.png" class="audio-bg"-->
<div class="new-bgtrans">
    <a href="#"><img src="images/audio2.png" class="br-titalaa zoom-cont full2" style="top:0px !important"></a>
   
  <div class="aa1  wow fadeInRight" data-wow-delay="1.1s" style="visibility: visible; animation-delay: 1.1s; animation-name: fadeInRight;"><a href="<?=getMenuLink('29');?>"><img src="images/newa8.png"></a></div>
 <div class="aa2  wow fadeInRight" data-wow-delay="1.3s" style="visibility: visible; animation-delay: 1.3s; animation-name: fadeInRight;"><a href="<?=getMenuLink('30');?>"><img src="images/newa2.png"></a></div>
  <div class="aa3  wow fadeInRight" data-wow-delay="1.5s" style="visibility: visible; animation-delay: 1.5s; animation-name: fadeInRight;"><a href="<?=getMenuLink('31');?>"><img src="images/newa4.png"></a></div>
   <div class="aa4  wow fadeInRight" data-wow-delay="1.7s" style="visibility: visible; animation-delay: 1.7s; animation-name: fadeInRight;"><a href="<?=getMenuLink('32');?>"><img src="images/newa5.png"></a></div>
     <div class="aa5  wow fadeInRight" data-wow-delay="1.9s" style="visibility: visible; animation-delay: 1.9s; animation-name: fadeInRight;"><a href="<?=getMenuLink('33');?>"><img src="images/newa3.png"></a></div>
 <div class="aa6  wow fadeInRight" data-wow-delay="2s" style="visibility: visible; animation-delay: 2s; animation-name: fadeInRight;"><a href="<?=getMenuLink('34');?>"><img src="images/newa7.png"></a></div>
  <div class="aa7 wow fadeInRight" data-wow-delay="2.1s" style="visibility: visible; animation-delay: 2.1s; animation-name: fadeInRight;"><a href="<?=getMenuLink('35');?>"><img src="images/newa1.png"></a></div>
<div class="aa8 wow fadeInRight" data-wow-delay="2.3s" style="visibility: visible; animation-delay: 2.3s; animation-name: fadeInRight;"><a href="<?=getMenuLink('36');?>"><img src="images/newa6.png"></a></div>
</div>
</div>

 </div>

            </div>



        </div>
    </div> 

    
</section>


<section class="mobile">
</section>


<section class=" mbr-section mbr-section-hero mbr-section-full2 mbr-parallax-background mbr-section-with-arrow mbr-after-navbar" id="header1-36" style="background-image: url(images/background-2.jpg); ">

  <div class="mbr-table-cell">

        <div class="container">
            <div class="row text wow fadeInUp animated" data-wow-delay="0.6s">
			<?php echo $kgd->description;?>	
            </div>
        </div>
    </div> 

</section>


<section class="mbr-section mbr-section-hero mbr-section-full2  mbr-section-with-arrow mbr-after-navbar" id="header1-36" style="background-image: url(images/txt-bg3.jpg); background-attachment: fixed;">

  <div class="mbr-table-cell">

        <div class="container">
            <div class="row text wow fadeInUp animated" data-wow-delay="1.1s">
				<?php echo $t2m_overview->description;?>
            </div>
        </div>
    </div> 

</section>

<?php include('common/footerHome.php') ;?>
<!-- scripts -->
<script src="particles.js"></script>
<script src="js/app.js"></script>
<!-- stats.js -->
<script src="js/lib/stats.js"></script>
<script>
  var count_particles, stats, update;
  stats = new Stats;
  stats.setMode(0);
  stats.domElement.style.position = 'absolute';
  stats.domElement.style.left = '0px';
  stats.domElement.style.top = '0px';
  document.body.appendChild(stats.domElement);
  count_particles = document.querySelector('.js-count-particles');
  update = function() {
    stats.begin();
    stats.end();
    if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
      count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
    }
    requestAnimationFrame(update);
  };
  requestAnimationFrame(update);

$(window).scroll(function(){
  var sticky = $('.sticky'),
      scroll = $(window).scrollTop();

  if (scroll >= 100) sticky.addClass('fixed');
  else sticky.removeClass('fixed');
});

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
<!-- for text slider-->
<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js'></script>
<!-- <script  src="js/index.js"></script> -->
<script>
  
$('.slider').slick({
  vertical: true,
  autoplay: true,
  autoplaySpeed:3000,
  speed: 300
});

</script>
<script src="tether/tether.min.js"></script>
 <script src="jarallax/jarallax.js"></script>
   <script src="smooth-scroll/smooth-scroll.js"></script>
    <script src="js/script.js"></script>
     <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>