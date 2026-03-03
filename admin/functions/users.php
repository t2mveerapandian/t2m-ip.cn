<?php
require('/var/www/t2m-ip.cn/public_html/common/config.php');
date_default_timezone_set('America/Los_Angeles');
$action = $_REQUEST['action'];


// check action

switch($action)
{
	case 'login' : login();
				   break;

	
	case 'logout' : logout();
					break;
	
	case 'registration' : registration();
					break;
	
				   
	case 'forget_password' : forget_password();
					break;
				   
					   
	default : 		blank();
}

// code for user login

function login()
{
	// check values set in the POST or not if it's not set go to the index page
	
	if(isset($_POST['username']) && $_POST['username']!='' && isset($_POST['password']) && $_POST['password']!='')
	{	
		global $con;		
		// Prevent post variables for sql injection
		
		$username =   $_POST['username'];
		$password =  $_POST['password'];

		// check type of the user		
		$d = ORM::for_table('sys_users')->where('username',$username)->find_one();	
           
		if($d)
		{
		  	if($d->password  == md5($password))
			{
				$_SESSION['id'] 		= $d->id;		
				$_SESSION['role'] 		= $d->role;	
				$_SESSION['fullname'] 	= $d->fullname;    

				header("location:https://t2m-ip.cn/admin//dashboard.php");
				exit();
			}
			else
			{
				$_SESSION['message_err'] = 'Password is wrong.';	              
				header("location: https://t2m-ip.cn/admin//index.php");
				exit();
			}
		}
		else
		{
			$_SESSION['message_err'] = 'Username not exists.';	              
			header("location:https://t2m-ip.cn/admin/index.php");
			exit();
		}
	}
}


// code for user logout

function logout()
{
	// session variables unset or destroy
	
	unset($_SESSION['id']);
	unset($_SESSION['role']);
	unset($_SESSION['fullname']);
	header("location:../index.php"); 
	exit();
}

function forget_password()
{
	global $con;
	
	if(isset($_POST['email']) && $_POST['email']!='' )
	{
		$email = trim($_POST['email']);	
		
		$data = ORM::for_table('sys_users')->where('email',$email)->find_one();		 
		if($data)
		{
			$id  			= $data->id ;	
			$name 			= $data->fullname ;	
			$email  		= $data->email ;		  		
			$newpassword 	= rand(111111,999999); 
			$d = ORM::for_table('sys_users')->find_one($id);	
			$d->password = md5($newpassword);
			$d->save();

			//send email with new password

			$message = '<p>Hi '.$name.' !</p>
			<p>Your password had been updated.</p>
			<p>Your Username:'.$d->username.' </p>
			<p>New password: '.$newpassword.'</p>
			';

			$subject = "New Password Retrived ";

			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			$headers .= 'From: activitymanali.com' . "\r\n" .
			'Reply-To: admin@activitymanali.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();


			mail($email, $subject, $message, $headers);						  
			$_SESSION['success'] = 'Your password updated ,Please check your email for Username and New Password.';
			header('location:https://t2m-ip.cn/admin/index.php');
			exit;
		}
		else
		{
			$_SESSION['message_err'] = 'Email is not available in our records.';	              
			header("location: https://t2m-ip.cn/admin/index.php");
			exit();
		}
	}
}


function notification($user_id, $user_type, $suser_id, $suser_type, $message, $date, $status)
{
	global $con;
	$result = mysqli_query($con, "insert into notification set user_id = '$user_id' , user_type = '$user_type', suser_id = '$suser_id' , suser_type = '$suser_type', message = '$message', date = '$date', status = '$status'");
	if($result)
		return 1;
}



    
    
function blank()
{
	header("location:https://t2m-ip.cn/admin/index.php");
	exit();
}




?>
