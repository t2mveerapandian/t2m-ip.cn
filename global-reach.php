<?php
$title = "Global Reach | T2M-IP";
$meta_description = "Looking for leadership, state of the art, silicon proven, semiconductor IP &amp; Software for your next SoC? T2M, your one stop technology supplier and provider";

include('common/header.php');
?>

<section class="mbr-section mbr-section-hero mbr-section-full3 " style="background-image: url(images/global-bg.jpg); background-size:cover;">


 <div class="mbr-table-cell2">

        <div class="container inner-page-container offices height">
            <div class="">

<div class="col-lg-12 col-md-12 col-sm-12"> <h3 style="margin-top: -24px; padding-left: 37px;"><span><div class="earth"></div> </span> &nbsp; T2M全球分部</h3> <div class="bor-bt2" style="width:168px;margin-left: 49px;"></div></div> 

<div class="row col-lg-12 col-md-12 col-sm-12 mt-5">

<div class="col-lg-12 col-md-12 col-sm-12">

<div class="row">
<?php
$d_office = ORM::for_table('sys_offices')->order_by_asc('sort_order')->find_many();
foreach($d_office as $data) {
?>
<div class="col-lg-3 col-md-3 col-sm-12 my-5"><p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $data['country'] ; ?></p>
<?php if($data['email']!=''){ ?>
<p><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:<?php echo $data['email'] ; ?>"> <?php echo $data['email'] ; ?> </a></p>
<?php } if($data['contact']!=''){ ?>
<p><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo $data['contact'] ; ?>"> <?php echo $data['contact'] ; ?> </a></p>
<?php } if($data['whatsapp']!=''){ ?>
<p><i class="fa fa-brands fa-whatsapp" aria-hidden="true" style="color: #25D366;"></i><a href="https://api.whatsapp.com/send?phone=<?php echo $data['whatsapp']; ?>" target="_blank" > <?php echo $data['whatsapp']; ?></a> </p>
<?php } if($data['wechat']!=''){ ?>
<p><i class="fa fa-brands fa-weixin" aria-hidden="true" style="color:#27b63e;"></i><a href="weixin://dl/chat?<?php echo $data['wechat']; ?>" target="_blank" > <?php echo $data['wechat']; ?></a></p>
<?php } if($data['skype']!=''){ ?>
<p><i class="fa fa-brands fa-skype" aria-hidden="true" style="color:#00aff0;"></i><a href="skype:<?php echo $data['skype']; ?>?chat" target="_blank" > <?php echo $data['skype']; ?></a></p>
<?php }?>
</div>
<?php } ?>	
</div>

</div>
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
</script>

<script src="tether/tether.min.js"></script>
 <script src="jarallax/jarallax.js"></script>
   <script src="smooth-scroll/smooth-scroll.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
