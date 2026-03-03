<?php

class Course
{
	public function __construct()
	{
		//echo "class";
	}
	
	public function index()
	{
		//echo "index";
	}
	
	public function add_course($data)
	{
		
		$check = ORM::for_table('sys_products')->where(array('title'=>$data['_post']['course_title']))->find_one();
		
		if(isset($check->id) && $check->id > 0)
		{
			$_SESSION['message_err'] = 'Product title already exists.';
			header("location:../add_course.php");
			exit;
		}
		
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='add')
		{
			
			
		if(isset($data['_post']['is_latest']) && $data['_post']['is_latest'] !="")
    	 {
            $islatest = 1;
    	 }
    	 else
    	 {
    	      $islatest = 0;
    	 }
				
    /*				
    	 if(isset($data['_post']['slug']) && $data['_post']['slug'] !="")
    	 {
            $slug = generateslug($data['_post']['slug'],'sys_products','add');
    	 }
    	 else
    	 {
    	      $slug = generateslug($data['_post']['title'],'sys_products','add');
    	 }
	*/		
	
			$slugd = $data['_post']['slug'];
			$slug = generateslug($slugd,'sys_products','add');
			
			
			$page = ORM::for_table('sys_products')->create();
			
			if(isset($data['_files']['logo_1']['name']) && $data['_files']['logo_1']['name']!='')
			{
				$extension = pathinfo($data['_files']['logo_1']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' ,'jpg');
				
				if(in_array($extension, $allowed_extension))
				{
					$logo_1 = "logo_1_".time().".".$extension;
					$page->logo_1   = $logo_1;
					 move_uploaded_file($data['_files']['logo_1']['tmp_name'], "../images/logo/".$logo_1);
				}
				else
				{
					$page->logo_1   ='';
				}
			}
			
			if(isset($data['_files']['logo_2']['name']) && $data['_files']['logo_2']['name']!='')
			{
				$extension = pathinfo($data['_files']['logo_2']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' ,'jpg');
				
				if(in_array($extension, $allowed_extension))
				{
					$logo_2 = "logo_2_".time().".".$extension;
					$page->logo_2   = $logo_2;
					 move_uploaded_file($data['_files']['logo_2']['tmp_name'], "../images/logo/".$logo_2);
				}
				else
				{
					$page->logo_2   ='';
				}
			}
			
			
			if(isset($data['_files']['logo_3']['name']) && $data['_files']['logo_3']['name']!='')
			{
				$extension = pathinfo($data['_files']['logo_3']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' ,'jpg');
				
				if(in_array($extension, $allowed_extension))
				{
					$logo_3 = "logo_3_".time().".".$extension;
					$page->logo_3   = $logo_3;
					 move_uploaded_file($data['_files']['logo_3']['tmp_name'], "../images/logo/".$logo_3);
				}
				else
				{
					$page->logo_3   ='';
				}
			}
			
		  
			$page->title 				= $data['_post']['title'];
			$page->slug 				= trim($slug);
			$page->is_latest  			= $islatest;	
			$page->overview  			= $data['_post']['overview'];	
			$page->category  			= $data['_post']['category'];	
			$page->features  			= $data['_post']['features'];
			$page->logo_1_url   		= $data['_post']['logo_1_url'];
			$page->logo_2_url   		= $data['_post']['logo_2_url'];
			$page->logo_3_url   		= $data['_post']['logo_3_url'];			
			$page->meta_title  			= $data['_post']['meta_title'];
			$page->meta_description  	= $data['_post']['meta_description'];
			$page->meta_keyword  		= $data['_post']['meta_keyword'];
			$page->sort_order  			= $data['_post']['sort_order'];
			$page->created_date  		= time();
			$page->status  				= 0;
			
			$page->save();
			
			$_SESSION['success'] = 'product added successfully.';
			header("location:../manage_products.php");
			exit;	
		}
		else
		{
			$_SESSION['message_err'] = 'Something went wrong.';
			header("location:../add_product.php");
			exit;
		}
	}
	
	public function edit_course($data)
	{
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='edit')
		{
			
							
    	 if(isset($data['_post']['slug']) && $data['_post']['slug'] !="")
    	 {
            $slug = generateslug($data['_post']['slug'],'sys_products','edit');
    	 }
    	 else
    	 {
    	      $slug = generateslug($data['_post']['title'],'sys_products','edit');
    	 }
			
			if(isset($data['_post']['is_latest']) && $data['_post']['is_latest'] !="")
    	 {
            $islatest = 1;
    	 }
    	 else
    	 {
    	      $islatest = 0;
    	 }
			
			$page = ORM::for_table('sys_products')->find_one($data['_get']['id']);
			if(!isset($page->id))
			{
				header("location:../index.php");
				exit;
			}
			
	   		
	   	    $slugd = $data['_post']['slug'];
			$slug = generateslug($slugd,'sys_products','edit');
			
			
			
			if(isset($data['_files']['logo_1']['name']) && $data['_files']['logo_1']['name']!='')
			{
				$extension = pathinfo($data['_files']['logo_1']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' ,'jpg');
				
				if(in_array($extension, $allowed_extension))
				{
					$logo_1 = "logo_1_".time().".".$extension;
					$page->logo_1   = $logo_1;
					 move_uploaded_file($data['_files']['logo_1']['tmp_name'], "../images/logo/".$logo_1);
				}
				else
				{
					$page->logo_1   ='';
				}
			}
			
			if(isset($data['_files']['logo_2']['name']) && $data['_files']['logo_2']['name']!='')
			{
				$extension = pathinfo($data['_files']['logo_2']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' ,'jpg');
				
				if(in_array($extension, $allowed_extension))
				{
					$logo_2 = "logo_2_".time().".".$extension;
					$page->logo_2   = $logo_2;
					 move_uploaded_file($data['_files']['logo_2']['tmp_name'], "../images/logo/".$logo_2);
				}
				else
				{
					$page->logo_2   ='';
				}
			}
			
			
			if(isset($data['_files']['logo_3']['name']) && $data['_files']['logo_3']['name']!='')
			{
				$extension = pathinfo($data['_files']['logo_3']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' ,'jpg');
				
				if(in_array($extension, $allowed_extension))
				{
					$logo_3 = "logo_3_".time().".".$extension;
					$page->logo_3   = $logo_3;
					 move_uploaded_file($data['_files']['logo_3']['tmp_name'], "../images/logo/".$logo_3);
				}
				else
				{
					$page->logo_3   ='';
				}
			}
			
		
			$page->title 				= $data['_post']['title'];
			$page->slug 				= trim(strtolower($slug));
			$page->overview  			= $data['_post']['overview'];
			$page->is_latest  			= $islatest;	
			$page->category  			= $data['_post']['category'];
			$page->logo_1_url   		= $data['_post']['logo_1_url'];
			$page->logo_2_url   		= $data['_post']['logo_2_url'];
			$page->logo_3_url   		= $data['_post']['logo_3_url'];				
			$page->features  			= $data['_post']['features'];	 	 
			$page->meta_title  			= $data['_post']['meta_title'];
			$page->meta_description  	= $data['_post']['meta_description'];
			$page->meta_keyword  		= $data['_post']['meta_keyword'];
			$page->sort_order  			= $data['_post']['sort_order'];
			$page->save();
			
			
			$_SESSION['success'] = 'Product updated successfully.';
			header("location:../manage_products.php");
			exit;	
		}
		else
		{
			header("location:../index.php");
			exit;
		}
	}
	
	public function delete_course($data)
	{
		if(isset($data['_get']['id']) && $data['_get']['id']!='')
		{
			$check = ORM::for_table('sys_products')->find_one($data['_get']['id']);
			if(isset($check->id) && $check->id > 0)
			{
				
				
				$check->delete();
				$_SESSION['success'] = 'Product deleted successfully.';
				header("location:../manage_products.php");
				exit;
			}
			else
			{
				header("location:../index.php");
				exit;
			}
		}
		else
		{
			header("location:../index.php");
			exit;
		}
	}
	
	public function update_status($data)
	{
		
		if(isset($data['_get']['id']) && $data['_get']['id']!='')
		{
			
			$page = ORM::for_table('sys_products')->find_one($data['_get']['id']);
			if(!isset($page->id))
			{
				header("location:../index.php");
				exit;
			}
			else
			{
				
				$page->status = $data['_get']['status'];
				$page->save();
				$_SESSION['success'] = 'Product status updated successfully.';
				header("location:../manage_products.php");
				exit;
			}
			
		}
		else
		{
			header("location:../index.php");
			exit;
		}
	}
}

?>

