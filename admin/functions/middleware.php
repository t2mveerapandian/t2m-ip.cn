<?php
include "/var/www/t2m-ip.cn/public_html/common/config.php";

class Middleware extends ORM
{
	public $request_data = array();
	public function __construct()
	{
		$config = ORM::for_table('sys_appconfig')->find_one(1);
		if(isset($_GET['module']) && $_GET['module']!='')
		{
			$class_name = $_GET['module'];
			$file_name = $class_name.".php";
			if(file_exists($file_name))
			{
				include($file_name);
				$result_data = new $class_name();
				
				if(isset($_GET['action']) && $_GET['action']!='')
				{
					$method_name = $_GET['action'];
					if(method_exists($result_data, $method_name))
					{
						if(isset($_GET) && count($_GET)>0)
						{
							$this->request_data['_get'] = $_GET;
						}
						if(isset($_POST) && count($_POST)>0)
						{
							$this->request_data['_post'] = $_POST;
						}
						if(isset($_PUT) && count($_PUT)>0)
						{
							$this->request_data['_put'] = $_PUT;
						}
						if(isset($_DELETE) && count($_DELETE)>0)
						{
							$this->request_data['_delete'] = $_DELETE;
						}
						if(isset($_FILES) && count($_FILES)>0)
						{
							$this->request_data['_files'] = $_FILES;
						}
						$data = $result_data->$method_name($this->request_data);
					}
					else
					{
						$data = $result_data->index();
					}
				}
				else
				{
					$data = $result_data->index();
				}					
				return $data;
			}
			else
			{
				return "Page Not Found.";
			}
		}
		else
		{
			return "Page Not Found.";
		}
	}
}

$data = new middleware();
return $data;
?>

