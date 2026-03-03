<?php

//error_reporting(E_ALL); ini_set('display_errors', 1); 

class Tutorial
{
	public function __construct()
	{
		//echo "class";
	}
	
	public function index()
	{
		//echo "index";
	}
	
	public function add_tutorial($data)
	{
		

		
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='add')
		{
			



                                $page = ORM::for_table('sys_tutorial')->create();			
			
			
			$page->tutorial_title 				= ucwords(addslashes($data['_post']['page_title']));
			$page->tutorial_slug 				= str_replace(' ', '_', strtolower((addslashes($data['_post']['page_title']))));
			$page->tutorial_short_description  	= $data['_post']['short_description'];	 	 
			$page->tutorial_description  		= $data['_post']['description'];	 	 
			$page->created_date  				= time();
			$page->tutorial_status  			= 1;
			$page->tutorial_url  				= $data['_post']['url'];	 	 
			$page->is_free  					= $data['_post']['is_free'];	 	 
			$page->tutorial_course_id  			= $data['_post']['tutorial_course_id'];	 	 
			
			$page->save();
			
			$_SESSION['success'] = 'Tutorial added successfully.';
			header("location:../manage_tutorial.php");
			exit;	
		}
		else
		{
			$_SESSION['message_err'] = 'Something went wrong.';
			header("location:../add_tutorial.php");
			exit;
		}
	}
	
	public function edit_tutorial($data)
	{
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='edit')
		{
			$page = ORM::for_table('sys_tutorial')->find_one($data['_get']['id']);
			
			if(!isset($page->id))
			{
				header("location:../index.php");
				exit;
			}
			
			if(isset($data['_files']['banner']['name']) && $data['_files']['banner']['name']!='')
			{
				if($page->tutorial_filepath!='')
				{
					unlink("../../images/tutorial/".$page->tutorial_filepath);
				}
				
				$extension = pathinfo($data['_files']['banner']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('mp4', 'mpg', 'wmv', 'mov', 'avi', 'flv', 'MP4', 'MPG', 'WMV', 'MOV', 'AVI', 'FLV');
				
				// check image file validation like jpg, png, gif. If it's valid file will be upload otherwise shows error message
				
				if(in_array($extension, $allowed_extension))
				{
					$banner_name = "tutorial_".time().".".$extension;
					$page->tutorial_filepath   = $banner_name;
					move_uploaded_file($data['_files']['banner']['tmp_name'], "../../images/tutorial/".$banner_name);
				}
				else
				{
					$_SESSION['message_err'] = 'Please upload only mp4, mpg, wmv, mov, avi, flv files.';
					header("location:../add_tutorial.php?id=".$data['_get']['id']);
					exit;
				}
			}
			
			
			$page->tutorial_title 				= ucwords(addslashes($data['_post']['page_title']));
			$page->tutorial_slug 				= str_replace(' ', '_', strtolower((addslashes($data['_post']['page_title']))));
			$page->tutorial_short_description  	= $data['_post']['short_description'];	 	 
			$page->tutorial_description  		= $data['_post']['description'];	 	 
			$page->tutorial_url  				= $data['_post']['url'];	 	 
			$page->is_free  					= $data['_post']['is_free'];	 	 
			$page->tutorial_course_id  			= $data['_post']['tutorial_course_id'];	 	 
			$page->save();


			
			
			$_SESSION['success'] = 'Tutorial updated successfully.';
			header("location:../manage_tutorial.php");
			exit;	
		}
		else
		{
			header("location:../index.php");
			exit;
		}
	}
	
	public function delete_tutorial($data)
	{
		if(isset($data['_get']['id']) && $data['_get']['id']!='')
		{
			$check = ORM::for_table('sys_tutorial')->find_one($data['_get']['id']);
			if(isset($check->id) && $check->id > 0)
			{
				unlink("../../images/tutorial/".$check->tutorial_filepath);
				$check->delete();
				$_SESSION['success'] = 'Tutorial deleted successfully.';
				header("location:../manage_tutorial.php");
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
}

?>