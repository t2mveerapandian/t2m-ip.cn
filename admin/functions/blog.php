<?php

class Blog
{
	public function __construct()
	{
		//echo "class";
	}
	
	public function index()
	{
		//echo "index";
	}
	
	public function add_blog($data)
	{
		$check = ORM::for_table('sys_blog')->where(array('blog_title'=>$data['_post']['blog_title']))->find_one();
		
		if(isset($check->id) && $check->id > 0)
		{
			$_SESSION['message_err'] = 'Blog title already exists.';
			header("location:../add_blog.php");
			exit;
		}
		
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='add')
		{
			$page = ORM::for_table('sys_blog')->create();
			
			
			
			
			$page->blog_title 			= addslashes($data['_post']['blog_title']);
			$slugd = $data['_post']['blog_slug'];
			$slug = generateslug($slugd,'sys_blog','add');
			
			$page->slug 				= $slug;
			$page->blog_description  	= $data['_post']['description'];
			$page->blog_cat_id  	    = $data['_post']['sys_category'];
			$page->meta_title  			= $data['_post']['meta_title'];
			$page->meta_description  	= $data['_post']['meta_description'];
			$page->meta_keyword  		= $data['_post']['meta_keyword'];
			$page->created_date  		= strtotime($data['_post']['created_date']);
			$page->status  		= 1;
			
			$page->save();
			
			$_SESSION['success'] = 'News added successfully.';
			header("location:../manage_blogs.php");
			exit;	
		}
		else
		{
			$_SESSION['message_err'] = 'Something went wrong.';
			header("location:../add_blog.php");
			exit;
		}
	}
	
	public function edit_blog($data)
	{
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='edit')
		{
			$page = ORM::for_table('sys_blog')->find_one($data['_get']['id']);
			
			if(!isset($page->id))
			{
				header("location:../index.php");
				exit;
			}
			
			
		if(isset($data['_post']['blog_slug']) && $data['_post']['blog_slug'] !="")
    	 {
            $slug = generateslug($data['_post']['blog_slug'],'sys_blog','edit');
    	 }
    	 else
    	 {
    	      $slug = generateslug($data['_post']['blog_title'],'sys_blog','edit');
    	 }
			
			$page->blog_title 			= addslashes($data['_post']['blog_title']);
			$page->slug 				= $slug;
			$page->blog_description  	= $data['_post']['description'];
			$page->blog_cat_id  	    = $data['_post']['sys_category'];
			$page->meta_title  			= $data['_post']['meta_title'];
			$page->meta_description  	= $data['_post']['meta_description'];
			$page->meta_keyword  		= $data['_post']['meta_keyword'];
			
			$page->save();
			
			
			$_SESSION['success'] = 'News updated successfully.';
			header("location:../manage_blogs.php");
			exit;	
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
			
			$page = ORM::for_table('sys_blog')->find_one($data['_get']['id']);
			if(!isset($page->id))
			{
				header("location:../index.php");
				exit;
			}
			else
			{
				
				$page->status = $data['_get']['status'];
				$page->save();
				$_SESSION['success'] = 'News status updated successfully.';
				header("location:../manage_blogs.php");
				exit;
			}
			
		}
		else
		{
			header("location:../index.php");
			exit;
		}
	}
	
	public function delete_blog($data)
	{
		if(isset($data['_get']['id']) && $data['_get']['id']!='')
		{
			$check = ORM::for_table('sys_blog')->find_one($data['_get']['id']);
			if(isset($check->id) && $check->id > 0)
			{
				;
				$check->delete();
				$_SESSION['success'] = 'News deleted successfully.';
				header("location:../manage_blogs.php");
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