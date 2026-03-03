<?php

class Career
{
	public function __construct()
	{
		//echo "class";
	}
	
	public function index()
	{
		//echo "index";
	}
	
	public function add_career($data)
	{
		
		
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='add')
		{
			$page = ORM::for_table('sys_career')->create();
			
			
			
			
			$page->job_title 			= $data['_post']['job_title'];
			$page->openings 			= $data['_post']['openings'];
			$page->job_description  	= $data['_post']['job_description'];	 	 
			$page->status  			= 1;
			
			$page->save();
			
			$_SESSION['success'] = 'Job post added successfully.';
			header("location:../manage_career.php");
			exit;	
		}
		else
		{
			$_SESSION['message_err'] = 'Something went wrong.';
			header("location:../add_career.php");
			exit;
		}
	}
	
	public function edit_career($data)
	{
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='edit')
		{
			$page = ORM::for_table('sys_career')->find_one($data['_get']['id']);
			
			if(!isset($page->id))
			{
				header("location:../index.php");
				exit;
			}
			
		
			
			
			$page->job_title 			= $data['_post']['job_title'];
			$page->openings 			= $data['_post']['openings'];
			$page->job_description  	= $data['_post']['job_description'];	 	 
			$page->status  			= 1;	 	 
			
			$page->save();
			
			
			$_SESSION['success'] = 'Job post updated successfully.';
			header("location:../manage_career.php");
			exit;	
		}
		else
		{
			header("location:../index.php");
			exit;
		}
	}
	
	public function status_update($data)
	{
		if(isset($data['_get']['action']) && $data['_get']['action']=='status_update')
		{
			$page = ORM::for_table('sys_career')->find_one($data['_get']['id']);
			
			if(!isset($page->id))
			{
				header("location:../index.php");
				exit;
			}
			
			$status	= $data['_get']['st'];
			
			if($status==1){
				$status = 0;
			}else{
			$status = 1;	
			}
		
			$page->status  = $status;	 	 
			$page->save();
			
			
			$_SESSION['success'] = 'Status updated successfully.';
			header("location:../manage_career.php");
			exit;	
		}
		else
		{
			header("location:../index.php");
			exit;
		}
	}
	
	public function delete_job($data)
	{
		if(isset($data['_get']['id']) && $data['_get']['id']!='')
		{
			$check = ORM::for_table('sys_career')->find_one($data['_get']['id']);
			if(isset($check->id) && $check->id > 0)
			{
				
				$check->delete();
				$check->save();
				$_SESSION['success'] = 'Job post deleted successfully.';
				header("location:../manage_career.php");
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

