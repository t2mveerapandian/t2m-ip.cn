<?php
$title = "Disclaimer | T2M-IP";
$meta_description = "Looking for leadership, state of the art, silicon proven, semiconductor IP &amp; Software for your next SoC? T2M, your one stop technology supplier and provider";

include('common/header.php');
?>

<section class="mbr-section mbr-section-hero mbr-section-full3 "  style="background-image: url(images/contact-bg.png); background-size:cover;">

 

  <div class="mbr-table-cell2">

  <div class="container inner-page-container height2" style="background-color: rgba(255,255,255,0.95);">
            <div class="row">

<div class="col-lg-12 col-md-12 col-sm-12"> <h3>Disclaimer </h3> <div class="bor-bt" style="width:104px;"></div>

<div class="row container" style="padding-top:10px;">
<?php
$data = ORM::for_table('sys_cms')->where(array('id'=>1))->find_one();
?>
<div class="gdpr"><?php echo $data['cms_description'];?></div>

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
