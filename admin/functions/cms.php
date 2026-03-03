<?php

class Cms
{
	public function __construct()
	{
		//echo "class";
	}
	
	public function index()
	{
		//echo "index";
	}
	
	public function add_page($data)
	{
		$check = ORM::for_table('sys_cms')->where(array('cms_title'=>$data['_post']['page_title']))->find_one();
		
		if(isset($check->id) && $check->id > 0)
		{
			$_SESSION['message_err'] = 'Page title already exists.';
			header("location:../add_page.php");
			exit;
		}
		
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='add')
		{
			$page = ORM::for_table('sys_cms')->create();
			
			
			
			
			$page->cms_title 			= ucwords(addslashes($data['_post']['page_title']));
			$page->cms_slug 			= str_replace(' ', '_', strtolower((addslashes($data['_post']['page_title']))));
			$page->cms_description  	= $data['_post']['description'];	 	 
			$page->created_date  		= time();
			$page->cms_status  			= 1;
			
			$page->save();
			
			$_SESSION['success'] = 'Page added successfully.';
			header("location:../manage_pages.php");
			exit;	
		}
		else
		{
			$_SESSION['message_err'] = 'Something went wrong.';
			header("location:../add_page.php");
			exit;
		}
	}
	
	public function edit_page($data)
	{
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='edit')
		{
			$page = ORM::for_table('sys_cms')->find_one($data['_get']['id']);
			
			if(!isset($page->id))
			{
				header("location:../index.php");
				exit;
			}
			
		
			
			
			$page->cms_title 			= ucwords(addslashes($data['_post']['page_title']));
			$page->cms_description  	= $data['_post']['description'];	 	 
			
			$page->save();
			
			
			$_SESSION['success'] = 'Page updated successfully.';
			header("location:../manage_pages.php");
			exit;	
		}
		else
		{
			header("location:../index.php");
			exit;
		}
	}
	
	public function delete_page($data)
	{
		if(isset($data['_get']['id']) && $data['_get']['id']!='')
		{
			$check = ORM::for_table('sys_cms')->find_one($data['_get']['id']);
			if(isset($check->id) && $check->id > 0)
			{
				
				$check->delete();
				$check->save();
				$_SESSION['success'] = 'Page deleted successfully.';
				header("location:../manage_pages.php");
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

