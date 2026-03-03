<?php

class Gallery
{
	public function __construct()
	{
		//echo "class";
	}
	
	public function index()
	{
		//echo "index";
	}
	
	public function add_gallery($data)
	{
		if(isset($data['_post']['submit']) && $data['_post']['submit']=='add')
		{
			$gallery = ORM::for_table('sys_gallery')->create();
			
			if(isset($data['_files']['image']['name']) && $data['_files']['image']['name']!='')
			{
				$extension = pathinfo($data['_files']['image']['name'], PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF' ,'jpg');
				
				// check image file validation like jpg, png, gif. If it's valid file will be upload otherwise shows error message
				
				if(in_array($extension, $allowed_extension))
				{
					$banner_name = "gallery_".time().".".$extension;
					$gallery->image   = $banner_name;
					move_uploaded_file($data['_files']['image']['tmp_name'], "../../images/gallery/".$banner_name);
				}
				else
				{
					$_SESSION['message_err'] = 'Please upload only jpg, jpeg, png, gif files.';
					header("location:../add_gallery.php?id=".$data['_post']['activity_id']);
					exit;
				}
			}
			
			
			$gallery->activity_id 		= $data['_post']['activity_id'];
			$gallery->creationdate  	= time();
			
			$gallery->save();
			
			$_SESSION['success'] = 'Image added successfully.';
			header("location:../add_gallery.php?id=".$data['_post']['activity_id']);
			exit;	
		}
		else
		{
			$_SESSION['message_err'] = 'Something went wrong.';
			header("location:../index.php");
			exit;
		}
	}
	
	public function delete_gallery($data)
	{
		if(isset($data['_get']['gallery_id']) && $data['_get']['gallery_id']!='')
		{
			$check = ORM::for_table('sys_gallery')->find_one($data['_get']['gallery_id']);
			if(isset($check->id) && $check->id > 0)
			{
				unlink("../../images/gallery/".$check->image);
				
				$check->delete();
				
				$_SESSION['success'] = 'Image deleted successfully.';
				header("location:../add_gallery.php?id=".$data['_get']['id']);
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

