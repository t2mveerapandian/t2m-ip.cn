<?php
include_once('../common/config.php') ; 

if(!isset($_SESSION['id']))
{
	header("location:index.php");
	exit;
}

if(isset($_POST['event_slug']) && $_POST['event_slug']!=''){
$slug = trim($_POST['event_slug']);	
$no_of_order = ORM::for_table('sys_events')->where('slug',$slug)->find_many()->as_array();
$count = count($no_of_order);
if($count > 0){
echo 0;
}
}

?>