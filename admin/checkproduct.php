<?php
include_once('../common/config.php') ; 

if(!isset($_SESSION['id']))
{
	header("location:index.php");
	exit;
}




if(isset($_POST['prod_name']) && $_POST['prod_action']=='add' && $_POST['prod_name']!=''){
$title = $_POST['prod_name'];
$prod_cat = $_POST['prod_cat'];	
$no_of_order = ORM::for_table('sys_products')->where(array('title'=>$title, 'category'=>$prod_cat))->find_many()->as_array();
$count = count($no_of_order);
if($count > 0){
echo 0;
}

}else if(isset($_POST['prod_name']) && $_POST['prod_action']!='add' && $_POST['prod_name']!=''){

$prod_id= $_POST['prod_action'];	
$title = $_POST['prod_name'];
$no_of_order = ORM::for_table('sys_products')->where(array('title'=>$title, 'category'=>$prod_cat))->where_not_equal('id',$prod_id)->find_many()->as_array();
$count = count($no_of_order);

if($count > 0){
echo 0;
}	
}

if(isset($_POST['product_slug']) && $_POST['prod_action']=='add' && $_POST['product_slug']!=''){
$slug = trim($_POST['product_slug']);	
$no_of_order = ORM::for_table('sys_products')->where('slug',$slug)->find_many()->as_array();
$count = count($no_of_order);
if($count > 0){
echo 0;
}

}else if(isset($_POST['product_slug']) && $_POST['prod_action']!='add' && $_POST['product_slug']!=''){

$prod_id= $_POST['prod_action'];	
$slug = trim($_POST['product_slug']);
$no_of_order = ORM::for_table('sys_products')->where('slug',$slug)->where_not_equal('id',$prod_id)->find_many()->as_array();
$count = count($no_of_order);

if($count > 0){
echo 0;
}	
}

?>