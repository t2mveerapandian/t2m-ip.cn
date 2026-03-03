<?php
include('image_resize.php');
					
class Activities
{
	public function __construct()
	{
		//echo "class";
	}
	
	public function index()
	{
		//echo "index";
	}
	
	public function addcoupan($data)
	{
		
		
		
		
		if(isset($data['_post']))
		{
		
		
			
			$discount 	=  $data['_post']['discount'];	
			$number = $data['_post']['noofcoupan'];
			
			
			for($i = 0 ;$i < $number; $i++)	
			{
			     	$sys_promo = ORM::for_table('sys_promo')->create();	
				
					$sys_promo->coupan   = RandomString(12);
					$sys_promo->value = $discount;	
					$sys_promo->status = 1 ;				
					$sys_promo->save();
			}
		
			

			
			
			
			
			
			$_SESSION['success'] = 'Activity added successfully.';
			header("location:../manage_coupans.php");
			exit;	
		}
		else
		{
			$_SESSION['message_err'] = 'Something went wrong.';
			header("location:../add_coupan.php");
			exit;
		}
	}
	
	
	
	
}

 function RandomString($length = 12) {
    $randstr;
    srand((double) microtime(TRUE) * 1000000);
    //our array add all letters and numbers if you wish
    $chars = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'p',
        'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5',
        '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 
        'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

    for ($rand = 0; $rand <= $length; $rand++) {
        $random = rand(0, count($chars) - 1);
        $randstr .= $chars[$random];
    }
    return $randstr;
}

?>

