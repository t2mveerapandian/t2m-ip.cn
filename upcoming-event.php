<?php
$title = "Upcoming events | T2M-IP";
$meta_description = "Looking for leadership, state of the art, silicon proven, semiconductor IP &amp; Software for your next SoC? T2M, your one stop technology supplier and provider";

include('common/header.php');
?>


<style>.mew{vertical-align: middle !important;}</style>


<section class="mbr-section mbr-section-hero mbr-section-full3" style="background-image: url(<?php echo IMG_URL;?>/event-bg.png); background-size:cover;">

 

  <div class="mbr-table-cell2">

        <div class="container inner-page-container offices height2" >


<div class="col-lg-12 col-md-12 col-sm-12 mt-2"> <h3>近期活动 </h3> <div class="bor-bt" style="width:160px;"></div></div> 

<div class="row col-lg-12 col-md-12 col-sm-12 mb-3">

<?php
$upcmg_data = ORM::for_table('sys_events')->where(array('is_featured'=>'0'))->limit(3)->order_by_asc('sort_order')->find_many();
foreach($upcmg_data as $datae):
$banner = $datae['banner'];
$start_date = date('dS M', strtotime($datae['start_date']));
$end_date = date('dS M Y', strtotime($datae['end_date']));
?>
<div class=" col-lg-4 col-md-12 col-sm-12 mt-3 ">
<div class=" row">

<div class="col-lg-6 col-md-6 col-sm-12 mt-2">
<a href="<?php echo $datae['link_url']; ?>" target="_blank"><img src="<?php echo SITE_URL.'admin/images/events/'.$banner;?>" class="bor1 d-block"></a>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 mt-1">
<p> <?php echo $start_date;?> - <?php echo $end_date;?></p>
<a href="<?php echo SITE_URL.'event/'.$datae['slug']; ?>" class="btn meeting" style="padding: 5px 17px !important;">预约参会</a>
</div>

</div> 
</div> 
<?php endforeach;?>


</div>








<div class="col-lg-12 col-md-12 col-sm-12 mt-5"> <h3>专题活动 </h3> <div class="bor-bt" style="width: 158px;"></div></div> 
<div class="row col-lg-12 col-md-12 col-sm-12">

<?php
$featrd_data = ORM::for_table('sys_events')->where(array('is_featured'=>'1'))->limit(3)->order_by_asc('sort_order')->find_many();
$chk = count($featrd_data);
if($chk > 0){
foreach($featrd_data as $dataf):
$banner = $dataf['banner'];
?>
<div class="col-lg-4 col-md-4 col-sm-12 mt-4">
<a href="<?php echo $dataf['link_url']; ?>" target="_blank"><img src="<?php echo SITE_URL.'admin/images/events/'.$banner;?>" class="d-block" style="margin: 0 auto; width:auto; height: 80px;"></a>
</div> 
<?php endforeach;
}else{ echo 'Currently, There is no featured event.'; }
?>
</div> 




<div class="row col-lg-12 col-md-12 col-sm-12 mt-5 ">


<div class="col-lg-6 col-md-6 col-sm-12">
<h3>特色IP </h3> <!--div class="bor-bt2" style="width:30%;"></div-->






        <!-- Top content -->
        <div class="mt-3">


<div class="mt-3" style="background-color:#fff;border: solid 1px #b9b4b4;padding: 2px;"><div class="marquee" id="mycrawler3">
<?php
$fip_data = ORM::for_table('sys_slider')->where(array('category'=>'1'))->order_by_asc('sort_order')->find_many();
$imc=1;
foreach($fip_data as $fipdata):
$imgfip = $fipdata['image'];
?>
<a href="<?php echo $fipdata['link_url']; ?>" target="_blank"><img src="<?php echo SITE_URL.'admin/images/sliders/'.$imgfip;?>" class="img-fluid mx-2 mew" alt="<?php echo 'img'.$imc;?>"></a>
<?php $imc++; endforeach;?>
  </div></div>
</div>

</div>


<div class="col-lg-6 col-md-6 col-sm-12" >
<h3>目标市场 </h3> <!--div class="bor-bt2" style="width:30%;"></div-->

 <!-- Top content -->
<div class="mt-3">
<div class="mt-3" style="background-color:#fff;border: solid 1px #b9b4b4;padding: 2px;"><div class="marquee" id="mycrawler2">
<?php
$tm_data = ORM::for_table('sys_slider')->where(array('category'=>'2'))->order_by_asc('sort_order')->find_many();
foreach($tm_data as $tmdata):
$imgtm = $tmdata['image'];
?>
<a href="<?php echo $tmdata['link_url']; ?>" target="_blank"><img src="<?php echo SITE_URL.'admin/images/sliders/'.$imgtm;?>" class="img-fluid mx-2"></a>
<?php endforeach;?>  </div>    
</div>

</div>

<!-- Top content -->
   
</div>
</div>
</div>	
	</div> 
</section>


<?php include('common/footer.php') ;?>
<script>
$(window).scroll(function(){
  var sticky = $('.sticky'),
      scroll = $(window).scrollTop();

  if (scroll >= 100) sticky.addClass('fixed');
  else sticky.removeClass('fixed');
});
</script>

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


  <!-- Javascript -->
<script type="text/javascript" src="js/crawler.js"></script>
<script type="text/javascript">
marqueeInit({
   uniqueid: 'mycrawler2',
   style: {
      'padding': '2px',
      'width': '600px',
      'height': '55px'
   },
   inc: 2, //speed - pixel increment for each iteration of this marquee's movement
   mouse: 'cursor driven', //mouseover behavior ('pause' 'cursor driven' or false)
   moveatleast: 3,
   neutral: 150,
   savedirection: true,
   random: true
});
</script>
<script type="text/javascript">
marqueeInit({
   uniqueid: 'mycrawler3',
   style: {
      'padding': '8px',
      'width': '600px',
      'height': '55px'
   },
   inc: 5, //speed - pixel increment for each iteration of this marquee's movement
   mouse: 'cursor driven', //mouseover behavior ('pause' 'cursor driven' or false)
   moveatleast:3,
   neutral: 150,
   savedirection: true,
   random: true
});
</script>
<script src="tether/tether.min.js"></script>
 <script src="jarallax/jarallax.js"></script>
   <script src="smooth-scroll/smooth-scroll.js"></script>
    <script src="js/script.js"></script>
</body>



</html>
