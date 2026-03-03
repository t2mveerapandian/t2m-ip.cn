<?php
$title = "Search | T2M-IP";
$meta_description = "Looking for leadership, state of the art, silicon proven, semiconductor IP &amp; Software for your next SoC? T2M, your one stop technology supplier and provider";

include('common/header.php');
$mysqli_q = new mysqli($db_host,$db_user,$db_password,$db_name);
if (!$mysqli_q->set_charset('latin1')) {
    die('Error loading character set latin1: ' . $mysqli_q->error);
}
?>

<section class="mbr-section mbr-section-hero mbr-section-full3 "  style="background-image: url(images/contact-bg.png); background-size:cover;">

 

  <div class="mbr-table-cell2">

  <div class="container" style="background-color: rgba(255,255,255,0.95);">
            <div class="row">

<div class="col-lg-12 col-md-12 col-sm-12"> <h3>Search Results for “<?php if(isset($_GET['s']) && $_GET['s']!=''){ echo $_GET['s']; } ?>” </h3> <div class="bor-bt" style="width:104px;"></div>

<div class="row container" style="padding-top:10px;">
	<?php
	$search = trim($_GET['s']);	
	$prod_data_arr = $mysqli_q->query("SELECT slug,title from sys_products where title like '%$search%' and status=1")->fetch_all(MYSQLI_ASSOC);
	$news_data_arr = $mysqli_q->query("SELECT slug,blog_title from sys_blog where blog_title like '%$search%' and status=1")->fetch_all(MYSQLI_ASSOC);
	
	$chkcount = count($prod_data_arr) + count($news_data_arr);
	if($chkcount > 0){ ?>

 <ul>
	<?php
	foreach($prod_data_arr as $prod_d): 
	?>
	<li style="padding:3px;"><a href="<?php echo SITE_URL.$prod_d['slug']; ?>" style="color:#000;" target="_blank"><?php echo $prod_d['title'];?></a></li>
	<?php endforeach; ?>
	<?php
	foreach($news_data_arr as $news_d): 
	?>
	<li style="padding:3px;"><a href="<?php echo SITE_URL.'news/'.$news_d['slug']; ?>" style="color:#000;" target="_blank"><?php echo $news_d['blog_title'];?></a></li>
	<?php endforeach; ?>
</ul>
	<?php }else{ ?>
	<p style="height:400px;">No record found.</p>
	<?php }?>

</div>


</div>
            </div>
        </div>
    </div> 

    

</section>

<style type="text/css">
.footer2 { position: relative!important;
</style>



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

