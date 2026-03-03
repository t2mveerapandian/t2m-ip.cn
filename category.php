<?php
$title = "Category | T2M-IP";
$meta_description = "Looking for leadership, state of the art, silicon proven, semiconductor IP &amp; Software for your next SoC? T2M, your one stop technology supplier and provider";

include('common/header.php');

$mct_id = $_GET['mct'];
$sct_id = $_GET['sct'];
$dct = ORM::for_table('sys_course_categories')->where('id',$mct_id )->find_one();
$sctd = ORM::for_table('sys_course_categories')->where('id',$sct_id )->find_one();
?>


<section class=" mbr-section mbr-section-hero mbr-section-full3 " style="background-image: url(images/press-bg.jpg);  background-size:cover;">

 

  <div class="mbr-table-cell2">

        <div class="container inner-page-container height " >
            <div class="">



<div class="row ">

<div class="col-lg-12 col-md-12 col-sm-12 ">

<div id="content">
<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#red" data-toggle="tab" class="active"><?php echo $dct['title']; ?></a></li><li class="active"><a href="#red" data-toggle="tab" class="active"><?php echo $sctd['title']; ?></a></li>
    </ul>
</div>

<div id="my-tab-content" class="tab-content">
<div class="tab-pane active" id="red">
	<div class="press-box">
	<?php
	$prod_arr = ORM::for_table('sys_products')->where(array('category'=>$sct_id,'status'=>1))->order_by_asc('sort_order')->find_many(); 
	foreach($prod_arr as $prd): ?>
	<div class="row col-lg-12 col-md-12 col-sm-12">
	<a href="<?php echo SITE_URL.$prd['slug']; ?>"><h5><?php echo $prd['title'];?></h5></a>
	</div>
	<?php endforeach; ?>
	
	</div>
</div>
      
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




<script src="tether/tether.min.js"></script>
 <script src="jarallax/jarallax.js"></script>
   <script src="smooth-scroll/smooth-scroll.js"></script>
    <script src="js/script.js"></script>
</body>



</html>
