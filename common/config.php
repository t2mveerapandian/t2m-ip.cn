<?php ob_start();
session_start();
//ini_set('display_errors', 'on');
//define('_PS_DEBUG_SQL_', true);
$db_host	    = 'localhost';
$db_user        = 'xahlchedrobaplvubris';
$db_password    = '72swod6yuZEnIQ+wiPRaNVM240403!';
$db_name            = 'xahlchedrobaplvubris' ;
$_app_stage = 'Live';

require('orm.php');

ORM::configure("mysql:host=$db_host;dbname=$db_name;charset=latin1");

ORM::configure('username', $db_user);

ORM::configure('password', $db_password);

ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES latin1 COLLATE latin1_swedish_ci'));

ORM::configure('return_result_sets', true); // returns result sets

ORM::configure('logging', true);

define("SITE_URL", "https://t2m-ip.cn/");
define("IMG_URL", "https://t2m-ip.cn/images/");


























$config = ORM::for_table('sys_appconfig')->find_one(1);
$client  = @$_SERVER['HTTP_CLIENT_IP'];
$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = @$_SERVER['REMOTE_ADDR'];
$result  = array('country'=>'', 'city'=>'');
if(filter_var($client, FILTER_VALIDATE_IP)){
    $ip = $client;
}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
    $ip = $forward;
}else{
    $ip = $remote;
}



function generateslug($res,$table,$type) 
{
      
     // Using str_replace() function 
    // to replace the word 
    $res = str_replace( array( '\'', '"',
    ',','+', ';', '<', '>','(',')' ), ' ', $res);
   
    $res = preg_replace('/\s+/', ' ', $res);
	$res= str_replace('.' ,'-', $res);
    $res= str_replace(' ' ,'-', $res);
    
    $res = strtolower($res);
    $output = checkslug($res,$table,$type);
   
    return $output ;
    
}


function checkslug($str,$table,$type) 
{    
  
    $count = ORM::for_table($table)->where(array('slug'=>$str))->count();
    
    if($type == 'add')
    {
        
        if($count > 0)
        {
             
            $str = $str."1";
            return  checkslug($str,$table,$type);
        }
        else
        {
            return $str ;
        }
    }    
    else
    {
         
        if($count > 1)
        {
             
            $str = $str."1";
            return  checkslug($str,$table,$type);
        }
        else
        {
            return $str ;
        }
    }
    
}    


function getMenuLink($id) 
{ 
	$d = ORM::for_table('sys_slider_menu')->find_one($id);
	$output = $d->menu_link;
	if($output==''){
		$output = '#';
	}
    return $output ;
}

function shortenText($text, $maxlength = 40, $dots = true) {
    if(strlen($text) > $maxlength) {
        if ( $dots ) return substr($text, 0, ($maxlength - 4)) . ' ...';
        else return substr($text, 0, ($maxlength - 4));
    } else {
        return $text;
    }

}
?>
	
