<?php
$con = mysqli_connect("localhost", "gurue3_spiral", "Spiral@get");
mysqli_select_db($con, "gurue3_spiral");

define("SITE_URL", "http://savekid.co.in/spiral/");
define("BASE_URL", $_SERVER['DOCUMENT_ROOT']."/spiral/");

//$con = mysqli_connect("localhost", "root", "");
//mysqli_select_db($con, "antriksh");


//define("SITE_URL", "http://localhost/antriksh/site/");
//define("BASE_URL", $_SERVER['DOCUMENT_ROOT']."/antriksh/site/");

define("OTP_TIMING", 3*60);

?>