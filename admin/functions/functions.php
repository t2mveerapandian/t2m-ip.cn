<?php
session_start();
date_default_timezone_set('America/Los_Angeles');

if(isset($_GET['action']) && $_GET['action']!='')
{
	$action = $_GET['action'];
}

else
{
	header("location:../index.php");
	exit();
}	

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
				   
	
				   
	case 'contact_mail' : 	contact_mail();
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
		
		$email = mysqli_real_escape_string($con, $_POST['username']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
				
		// check type of the user
		
		  $d = ORM::for_table('sys_users')->where('username',$username)->find_one();
          if($d)
		  {
		  
		   print_r($d);
		   exit;
		  
		      if($d->password  == md5($password))
			  {
			    
				     header("location:dashboard.php");
					 exit();
			  }
			  else
		      {
					header("location: index.php?msg=1");
					exit();
		      }
			  
		  }
		
		else
		{
			header("location:../index.php?msg=1");
			exit();
		}
	}
	
}

// code for user logout

function logout()
{
	// session variables unset or destroy
	
	unset($_SESSION['id']);
	unset($_SESSION['type']);
	session_destroy();
	header("location:../index.php");
}

//code for patient registration

function registration()
{
	global $con;
	$call_otp = new otp();
	// sanitize data
	
	if(isset($_SESSION['security_code']) && $_SESSION['security_code'] == $_POST['captcha_code'])
	{
		$type = $_POST['type'];
		if(isset($_POST['name']) && $_POST['name']!='')
		{
			$name = ucwords(mysqli_real_escape_string($con, $_POST['name']));
		}
		else
		{
			$first_name = ucfirst(mysqli_real_escape_string($con, $_POST['first_name']));
			$last_name = ucfirst(mysqli_real_escape_string($con, $_POST['last_name']));
		}
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
		//$password = mysqli_real_escape_string($con, $_POST['password']);
		//$password = md5($password);
		
		$user = array('1'=>'patients', '2'=>'doctors', '3'=>'clinics', '4'=>'labs', '5'=>'pharmacy');
		$table = $user[$type];
		
		$user_type = array('1'=>'PT', '2'=>'DC', '3'=>'CL', '4'=>'DL', '5'=>'PH');
		$user_id = $user_type[$type];
		
		// check email id exists in the database or not if exists go the register page shows relevant error otherwise go the else section and register user
		
		$check = mysqli_query($con, "select id from $table where (email = '$email' or mobile_number = '$phone_number') and (status = '1' or status = '2')");
		if(mysqli_num_rows($check)>0)
		{
			header("location:../index.php?msg=1");
			exit();
		}
		else
		{
			$mobile_otp = generate_otp();
			$email_otp = generate_otp();
			
			
			// insert data in database
			if($type == 1 || $type == 2)
			{
				$register = mysqli_query($con, "insert into $table set first_name = '$first_name', last_name = '$last_name', email = '$email', mobile_number = '$phone_number', status='0', date_added = ".time());
			}
			elseif($type == 3 || $type == 4 || $type == 5)
			{
				$register = mysqli_query($con, "insert into $table set clinic_name = '$name', email = '$email', phone_number = '$phone_number', status='0', date_added = ".time());
			}
			if($register)
			{
				// Generate user spiral id
				
				$id = mysqli_insert_id($con);
				
				mkdir('../'.$table.'/document/'.$id);
				
				/*
				$alpha = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
				shuffle($alpha);
				$catch = array_rand($alpha, 3);
				$username = $alpha[$catch[0]].$alpha[$catch[1]].$alpha[$catch[2]].$id.rand(1,99);
				*/
				
				$username = $user_id.$id;
				
				// update spiral id of user in the database
				
				$call_otp->send_otp($id, $type, $mobile_otp, $phone_number, 'sms', time(), '0');
				
				
				//mysqli_query($con, "insert into otp set user_id = '$id', type='$type', otp='$mobile_otp', entity='$phone_number', otp_type='sms', date='".time()."', status='0'");
				
				$phone_id = mysqli_insert_id($con);
				
				$call_otp->send_otp($id, $type, $email_otp, $email, 'email', time(), '0');
				
				//mysqli_query($con, "insert into otp set user_id = '$id', type='$type', otp='$email_otp', entity='$email', otp_type='email', status='0'");
				
				$email_id = mysqli_insert_id($con);
				
				$call_otp->send_otp($id, $type, '', '', 'new user', time(), '0');
				
				//mysqli_query($con, "insert into otp set user_id = '$id', type='$type', otp_type='new user', status='0'");
				
				mysqli_query($con, "update $table set username = '$username' where id = '$id'");
				
				if(isset($first_name) && $first_name!='' && isset($last_name) && $last_name!='')
				{
					$name = $first_name." ".$last_name;
				}
				
				
				// send otp sms to the verification of phone number
				
				$message = "Spiral%20Account%20Confirmation%20Message.%20Your%20One%20Time%20Password%20(OTP)%20is%20$mobile_otp";
				
				send_sms($message, $phone_number);
				
				// send otp mail to the user for the verification of email-Id
				
				/*
				$to      = $email;
				$subject = 'Account Register Confirmation';
				
				$message = '<p>Hi $name!</p>
							<p>Help us secure your Spiral account by verifying your email address ($email). This lets you access all of Spiral features.</p>
							<p>OTP for email verification = $email_otp</p>
							';			
				$headers = 'From: spiral.com' . "\r\n" .
					'Reply-To: info@spiral.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
				*/
				
				$message = '<p>Hi '.$name.'!</p>
							<p>Help us secure your Spiral account by verifying your email address ('.$email.'). This lets you access all of Spiral features.</p>
							<p>OTP for email verification = '.$email_otp.'</p>
							';
				
				$subject = "Account Register Confirmation";
				
				send_email($email, $name, $message, $subject, $email);
				
				// notification code
				
				$note = "New user registered with us username = $username.";
			    notification($id, $type, '', '', $note, time(), 1);
				
				// notification code
				
				$note = "Need to change your password.";
			    notification($id, $type, '', '', $note, time(), 1);
				
				
				/*
				$email = $email;
				$mail	= new PHPMailer; // call the class 
				$mail->IsSMTP(); 
				$mail->Host = SMTP_HOST; //Hostname of the mail server
				$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
				$mail->SMTPAuth = true; //Whether to use SMTP authentication
				$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
				$mail->Password = SMTP_PWORD; //Password for SMTP authentication
				$mail->AddReplyTo($email,$name); //reply-to address
				$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
				
				$content = '<p>Hi '.$name.'!</p>
							<p>Help us secure your Spiral account by verifying your email address ('.$email.'). This lets you access all of Spiral features.</p>
							<p>OTP for email verification = '.$email_otp.'</p>
							';
				
				$mail->Subject = "Account Register Confirmation"; //Subject od your mail
				$mail->AddAddress($email, ""); //To address who will receive this email
				$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

				$send = $mail->Send();
				*/
				
				$_SESSION['nid'] = $id;
				$_SESSION['ntype'] = $type;
				$_SESSION['eid'] = $email_id;
				$_SESSION['mid'] = $phone_id;
				header("location:../index.php?msg=2");
				exit();
			}
		}
	}
	else
	{
		header("location:../index.php?msg=10");
		exit();
	}
	
}

function verify()
{
	global $con;
	$call_otp = new otp();
	
	$id = $_SESSION['nid'];
	$type = $_SESSION['ntype'];
	$eid = $_SESSION['eid'];
	$mid = $_SESSION['mid'];
	
	$user = array('1'=>'patients', '2'=>'doctors', '3'=>'clinics', '4'=>'labs', '5'=>'pharmacy');
	$table = $user[$type];
	
	$alpha = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
		
	shuffle($alpha);
	
	$catch = array_rand($alpha, 4);
	$password = $alpha[$catch[0]].$alpha[$catch[1]].$alpha[$catch[2]].$alpha[$catch[3]].rand(1,999999);
		
	if(isset($_POST['motp']) && $_POST['motp']!='' && isset($_POST['eotp']) && $_POST['eotp']!='')
	{
		
		$motp = mysqli_real_escape_string($con, $_POST['motp']);
		$eotp = mysqli_real_escape_string($con, $_POST['eotp']);
		
		
		$check1 = mysqli_query($con, "select * from otp where user_id = '$id' and type = '$type' and otp = '$motp'");
		
		
		$check2 = mysqli_query($con, "select * from otp where user_id = '$id' and type = '$type' and otp = '$eotp'");
		
		
		if(mysqli_num_rows($check1) > 0 && mysqli_num_rows($check2) > 0)
		{
			$check1_id = mysqli_fetch_object($check1);
		
			$expiry = $call_otp->check_expiry($check1_id->id);
			if($expiry > 0)
			{
				mysqli_query($con, "update $table set status = '2', password = '".md5($password)."' where id = '$id'");
				mysqli_query($con, "delete from otp where user_id = '$id' and type = '$type' and otp = '$motp'");
				mysqli_query($con, "delete from otp where user_id = '$id' and type = '$type' and otp = '$eotp'");
				$_SESSION['id'] = $id;
				$_SESSION['type'] = $table;
					
				$detail = mysqli_query($con, "select first_name, username, email, mobile_number from $table where id = '$id'");	
				$user = mysqli_fetch_object($detail);
				
				// send username and password to the user on phone
				
				$message = "Your%20Username=".$user->username."%20and%20Password=".$password;
					
				send_sms($message, $user->mobile_number);
				
				// send username and password to the user on email
				
				/*
				$to      = $user->email;
				$subject = 'Account Verification';
				
				$message = '<p>Hi $user->first_name!</p>
							<p>Your Spiral account by verification Successfully.</p>
							<p>Username : $user->username</p>
							<p>Password : $password</p>
							';		
				$headers = 'From: spiral.com' . "\r\n" .
					'Reply-To: info@spiral.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
				*/
				
				$message = '<p>Hi '.$user->first_name.'!</p>
							<p>Your spiral account verification Successfully.</p>
							<p>Username : '.$user->username.'</p>
							<p>Password : '.$password.'</p>
							';
				
				$subject = "Account Verification";
					
				send_email($user->email, $user->first_name, $message, $subject, $user->email);
				
				
				/*
				$email = $user->email;
				$mail	= new PHPMailer; // call the class 
				$mail->IsSMTP(); 
				$mail->Host = SMTP_HOST; //Hostname of the mail server
				$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
				$mail->SMTPAuth = true; //Whether to use SMTP authentication
				$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
				$mail->Password = SMTP_PWORD; //Password for SMTP authentication
				$mail->AddReplyTo($user->email,$user->first_name); //reply-to address
				$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
				
				$content = '<p>Hi '.$user->first_name.'!</p>
							<p>Your spiral account verification Successfully.</p>
							<p>Username : '.$user->username.'</p>
							<p>Password : '.$password.'</p>
							';	
				
				$mail->Subject = "Account Verification"; //Subject od your mail
				$mail->AddAddress($user->email, ""); //To address who will receive this email
				$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

				$send = $mail->Send();
				*/
				
				header("location:../$table/change_password.php");
				exit();
			}
			else
			{
				header("location:../index.php?msg=11");
				exit();
			}
		}
		elseif(mysqli_num_rows($check1) > 0 && mysqli_num_rows($check2) == 0)
		{
			$check1_id = mysqli_fetch_object($check1);
		
			$expiry = $call_otp->check_expiry($check1_id->id);
			if($expiry > 0)
			{
				mysqli_query($con, "update $table set status = '1', password = '".md5($password)."' where id = '$id'");
				mysqli_query($con, "delete from otp where user_id = '$id' and id = '$mid'");
				$_SESSION['id'] = $id;
				$_SESSION['type'] = $table;
				
				$msg = "Please Verify Your Email-Id.";
				notification($id, $type, '', '', $msg, time(), 1);
				
				
				$detail = mysqli_query($con, "select first_name, username, email, mobile_number from $table where id = '$id'");	
				$user = mysqli_fetch_object($detail);
				
				// send username and password to the user on phone
				
				$message = "Your%20Username=".$user->username."%20and%20Password=".$password;
					
				send_sms($message, $user->mobile_number);
				
				header("location:../$table/change_password.php");
				exit();
			}
			else
			{
				header("location:../index.php?msg=11");
				exit();
			}
		}
		elseif(mysqli_num_rows($check1) == 0)
		{
			header("location:../index.php?msg=4");
			exit();
		}
	}
	elseif(isset($_POST['motp']) && $_POST['motp']!='')
	{
		$motp = mysqli_real_escape_string($con, $_POST['motp']);
		
		$check1 = mysqli_query($con, "select * from otp where user_id = '$id' and type = '$type' and otp = '$motp' and id = '$mid'");
		
		
		if(mysqli_num_rows($check1) > 0)
		{
			$check1_id = mysqli_fetch_object($check1);
		
			$expiry = $call_otp->check_expiry($check1_id->id);
			
			if($expiry > 0)
			{
				mysqli_query($con, "update $table set status = '1', password = '".md5($password)."' where id = '$id'");
				mysqli_query($con, "delete from otp where user_id = '$id' and id = '$mid'");
				$_SESSION['id'] = $id;
				$_SESSION['type'] = $table;
				
				$msg = "Please Verify Your Email-Id.";
				notification($id, $type, '', '', $msg, time(), 1);
				
				
				$detail = mysqli_query($con, "select first_name, username, email, mobile_number from $table where id = '$id'");	
				$user = mysqli_fetch_object($detail);
				
				// send username and password to the user on phone
				
				$message = "Your%20Username=".$user->username."%20and%20Password=".$password;
					
				send_sms($message, $user->mobile_number);
				
				
				header("location:../$table/change_password.php");
				exit();
			}
			else
			{
				header("location:../index.php?msg=11");
				exit();
			}
		}
		else
		{
			header("location:../index.php?msg=4");
			exit();
		}
		
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

// code for send otp in change password

function send_otp()
{
	global $con;
	$call_otp = new otp();
	
	$table = $_SESSION['type'];
	$user = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
	if(isset($_POST['new_password']) && $_POST['new_password']!='' && isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		$password = mysqli_real_escape_string($con, $_POST['new_password']);
		
		$otp = generate_otp();
		
		$query = mysqli_query($con, "select mobile_number, email, first_name, mobile_number from $table where id = '$_SESSION[id]'");
		if(mysqli_num_rows($query)>0)
		{
			$fetch_user = mysqli_fetch_object($query);
			$check = mysqli_query($con, "select id from otp where user_id = '$_SESSION[id]' and otp_type = 'change_password' and type = '$user[$table]'");
			if(mysqli_num_rows($check)>0)
			{
				$fetch = mysqli_fetch_assoc($check);
				mysqli_query($con, "delete from otp where id = '$fetch[id]'");
			}
			
			$call_otp->send_otp($_SESSION['id'], $user[$table], $otp, '', 'change_password', time(), '0');
			
			//mysqli_query($con, "insert into otp set user_id = '$_SESSION[id]', type = '$user[$table]', otp = '$otp', otp_type = 'change_password'");
			
			// send otp to the user on phone
			
			$message = "One%20Time%20Password(OTP)%20for%20change%20your%20account%20password=".$otp;
				
			send_sms($message, $fetch_user->mobile_number);
			
			
			// send otp to the user on email
			
			/*
			$to      = $fetch_user->email;
			$subject = 'Account Verification';
			
			$message = '<p>Hi $fetch_user->first_name!</p>
						<p>One Time Password for change your account password.</p>
						<p>OTP : $otp</p>
						';		
			$headers = 'From: spiral.com' . "\r\n" .
				'Reply-To: info@spiral.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

			mail($to, $subject, $message, $headers);*/
			
			
			$message = '<p>Hi '.$user->first_name.'!</p>
						<p>One Time Password for change your account password.</p>
						<p>OTP : '.$otp.'</p>
						';
			
			$subject = "Account Verification";
				
			send_email($fetch_user->email, $user->first_name, $message, $subject, $fetch_user->email);
			
			/*
			$email = $fetch_user->email;
			$mail	= new PHPMailer; // call the class 
			$mail->IsSMTP(); 
			$mail->Host = SMTP_HOST; //Hostname of the mail server
			$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
			$mail->SMTPAuth = true; //Whether to use SMTP authentication
			$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
			$mail->Password = SMTP_PWORD; //Password for SMTP authentication
			$mail->AddReplyTo($fetch_user->email,$user->first_name); //reply-to address
			$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
			
			$content = '<p>Hi '.$user->first_name.'!</p>
						<p>One Time Password for change your account password.</p>
						<p>OTP : '.$otp.'</p>
						';		
			
			$mail->Subject = "Account Verification"; //Subject od your mail
			$mail->AddAddress($fetch_user->email, ""); //To address who will receive this email
			$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

			$send = $mail->Send();
			*/
			
			$_SESSION['password'] = $password;
			header("location:../$table/change_password.php?msg=3");
			exit();
		}
		else
		{
			header("location:../index.php");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

function new_change_password()
{
	global $con;
	$call_otp = new otp();
	
	$table = $_SESSION['type'];
	$user = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
	if(isset($_POST['otp']) && $_POST['otp']!='' && isset($_SESSION['password']) && $_SESSION['password']!='')
	{
		$otp = mysqli_real_escape_string($con, $_POST['otp']);
		$check = mysqli_query($con, "select id from otp where user_id = '$_SESSION[id]' and otp = '$otp' and otp_type = 'change_password' and type = '$user[$table]'");
		if(mysqli_num_rows($check)>0)
		{
			$result = mysqli_fetch_object($check);
			$expiry = $call_otp->check_expiry($result->id);
			if($expiry > 0)
			{
				$fetch = mysqli_fetch_assoc($check);
				mysqli_query($con, "delete from otp where id = '$fetch[id]'");
				mysqli_query($con, "update $table set password = '".md5($_SESSION['password'])."' where id = '$_SESSION[id]'");
				
				$msg = 'Password Changed Successfully.';
				notification($_SESSION['id'], $user[$table], '', '', $msg, time(), 1);
				
				unset($_SESSION['password']);
				
				$check_new_user = mysqli_query($con, "select id from otp where user_id = '$_SESSION[id]' and type = '$user[$table]' and otp_type = 'new user' and status = '0'");
				if(mysqli_num_rows($check_new_user) > 0)
				{
					mysqli_query($con, "delete from otp where user_id = '$_SESSION[id]' and type = '$user[$table]' and otp_type = 'new user' and status = '0'");
					header("location:../$table/edit_profile.php?msg=4");
					exit();
				}
				else
				{
					header("location:../$table/change_password.php?msg=1");
					exit();
				}
			}
			else
			{
				header("location:../$table/change_password.php?msg=11");
				exit();
			}
		}
		else
		{
			header("location:../$table/change_password.php?msg=4");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function forget_password()
{
	global $con;
	$call_otp = new otp();
	if(isset($_POST['email']) && $_POST['email']!='' && isset($_POST['type']) && $_POST['type']!='')
	{
		$email = mysqli_real_escape_string($con, $_POST['email']);	
		$type = mysqli_real_escape_string($con, $_POST['type']);
		
		$user = array('1'=>'patients', '2'=>'doctors', '3'=>'clinics', '4'=>'labs', '5'=>'pharmacy');
		$table = $user[$type];
		
		$check = mysqli_query($con, "select * from $table where email = '$email' and (status = '1' or status = '2')");
		if(mysqli_num_rows($check) > 0)
		{
			$fetch = mysqli_fetch_assoc($check);
			$id	   = $fetch['id'];
			if(isset($fetch['first_name']) && isset($fetch['first_name']))
			{
				$name = $fetch['first_name']." ".$fetch['last_name'];
			}
			else
			{
				$name = $fetch['clinic_name'];
			}
			
			$otp = generate_otp();
			
			$call_otp->send_otp($id, $type, $otp, '', '', time(), '0');
			
			//mysqli_query($con, "insert into otp set user_id = '$id', type='$type', otp='$otp', status='0'");
			
			/*
			$to      = $email;
			$subject = 'Forget Password';
			$message = '<p>Hi $name!</p>
						<p>Please click the below highlighted link for changing your password.</p>
						<p><a href="'.base_url.'/functions/functions.php?action=change_password&msg=7&otp=$otp&id=$id&type=$type">Click Here</a></p>
						';
			$headers = 'From: spiral.com' . "\r\n" .
				'Reply-To: spiral.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

			mail($to, $subject, $message, $headers);
			*/
			
			$message = '<p>Hi '.$name.' !</p>
						<p>Please click the below highlighted link for changing your password.</p>
						<p><a href="'.SITE_URL.'index.php?msg=8&otp='.$otp.'&id='.$id.'&type='.$type.'">Click Here</a></p>
						';
			
			$subject = "Forget Password";
				
			send_email($email, $name, $message, $subject, $email);
			
			/*
			$email = $email;
			$mail	= new PHPMailer; // call the class 
			$mail->IsSMTP(); 
			$mail->Host = SMTP_HOST; //Hostname of the mail server
			$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
			$mail->SMTPAuth = true; //Whether to use SMTP authentication
			$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
			$mail->Password = SMTP_PWORD; //Password for SMTP authentication
			$mail->AddReplyTo($email,$name); //reply-to address
			$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
			
			$content = '<p>Hi '.$name.' !</p>
						<p>Please click the below highlighted link for changing your password.</p>
						<p><a href="'.SITE_URL.'index.php?msg=8&otp='.$otp.'&id='.$id.'&type='.$type.'">Click Here</a></p>
						';	
			
			$mail->Subject = "Forget Password"; //Subject od your mail
			$mail->AddAddress($email, ""); //To address who will receive this email
			$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

			$send = $mail->Send();
			*/
			
			header("location:../index.php?msg=6");
			exit();
		}
		else
		{
			header("location:../index.php?msg=5");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

function change_password()
{
	if(isset($_POST['change']) && $_POST['change']=='change')
	{
		global $con;
		$call_otp = new otp();
		
		$password = mysqli_real_escape_string($con, $_POST['new_password']);
		$id = mysqli_real_escape_string($con, $_POST['id']);
		$type = mysqli_real_escape_string($con, $_POST['type']);
		$otp = mysqli_real_escape_string($con, $_POST['otp']);
		
		$user = array('1'=>'patients', '2'=>'doctors', '3'=>'clinics', '4'=>'labs', '5'=>'pharmacy');
		$table = $user[$type];
		
		$check = mysqli_query($con, "select id from otp where user_id = '$id' and type = '$type' and otp = '$otp'");
		if(mysqli_num_rows($check) > 0)
		{
			$result = mysqli_fetch_object($check);
			
			$expiry = $call_otp->check_expiry($result->id);
			
			if($expiry > 0)
			{
				mysqli_query($con, "update $table set password = '".md5($password)."' where id = '$id'");
			
				mysqli_query($con, "delete from otp where id = '$id' and type = '$type' and otp = '$otp'");
				$result = mysqli_query($con, "select id, email, password from ".$table." where id = '$id' and (status = '1' or status = '2')");
			
				if(mysqli_num_rows($result) > 0)
				{
					$fetch = mysqli_fetch_assoc($result);
					$_SESSION['id'] = $fetch['id'];
					$_SESSION['type'] = $table;
					header("location:../".$table."/dashboard.php");
					exit();
				}
				else
				{
					header("location:../index.php");
					exit();
				}
			}
			else
			{
				header("location:../index.php");
				exit();
			}
		}
		else
		{
			header("location:../index.php");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


// code for verify email-id


function verify_email()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($_POST['otp']) && $_POST['otp']!='')
	{
		global $con;
		$call_otp = new otp();
		
		$otp = mysqli_real_escape_string($con, $_POST['otp']);
		$id = $_SESSION['id'];
		$table = $_SESSION['type'];
		
		$user_type = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
		$type = $user_type[$table];
		
		$fetch = mysqli_query($con, "select email, mobile_number, first_name from $table where id = '$_SESSION[id]'");
		$user = mysqli_fetch_object($fetch);
		
		$check = mysqli_query($con, "select id from otp where user_id = '$id' and entity = '$user->email' and type = '$type' and otp = '$otp' and otp_type = 'email'");
		if(mysqli_num_rows($check) > 0)
		{
			$result = mysqli_fetch_object($check);
			$expiry = $call_otp->check_expiry($result->id);
			if($expiry > 0)
			{
				mysqli_query($con, "update $table set status = '2' where id = '$id'");
				mysqli_query($con, "delete from otp where user_id = '$id' and entity = '$user->email' and type = '$type' and otp = '$otp' and otp_type = 'email'");
				
				
				// send sms to the email
				/*
				$to      = $user->email;
				$subject = 'Email-Id Verification';
				
				$message = '<p>Hi $user->first_name!</p>
							<p>Email-Id Verified Successfully.</p>
							';			
				$headers = 'From: spiral.com' . "\r\n" .
					'Reply-To: info@spiral.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					
				mail($to, $subject, $message, $headers);
				*/
				
				
				$message = '<p>Hi '.$user->first_name.'!</p>
							<p>Email-Id Verified Successfully.</p>
							';
				
				$subject = "Forget Password";
					
				send_email($user->email, $user->first_name, $message, $subject, $user->email);
				
				/*
				$email = $user->email;
				$mail	= new PHPMailer; // call the class 
				$mail->IsSMTP(); 
				$mail->Host = SMTP_HOST; //Hostname of the mail server
				$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
				$mail->SMTPAuth = true; //Whether to use SMTP authentication
				$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
				$mail->Password = SMTP_PWORD; //Password for SMTP authentication
				$mail->AddReplyTo($user->email, $user->first_name); //reply-to address
				$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
				
				$content = '<p>Hi '.$user->first_name.'!</p>
							<p>Email-Id Verified Successfully.</p>
							';	
				
				$mail->Subject = "Forget Password"; //Subject od your mail
				$mail->AddAddress($user->email, ""); //To address who will receive this email
				$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

				$send = $mail->Send();
				*/
				
				header("location:../$table/settings.php?msg=1");
				exit();
			}
			else
			{
				header("location:../$table/settings.php?msg=11");
				exit();
			}
		}
		else
		{
			header("location:../$table/settings.php?msg=2");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

// code for delete connection to the doctors and labs

function delete_connection()
{
	global $con;
	$change = array('1'=>'pconnect_doctors', '2'=>'pconnect_labs');
	$table = $change[$_GET['change']];
	$id = mysqli_real_escape_string($con, $_GET['id']);
	$url = explode('?', $_GET['url']);
	$field = array('pconnect_doctors'=>'doctor_id', 'pconnect_labs'=>'lab_id');
	
	// check user logged in or not if he is not logged in go the index page
	
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		//delete data from the database
		
		$result = mysqli_query($con, "delete from $table where ".$field[$table]." = '$id' and patient_id = '$_SESSION[id]'");
		
		// if query execute then go the relevant page shows successful message otherewise shows error message
		
		if($result)
		{	
			header("location:".$url[0]."?msg=10");
			exit();
		}
		else
		{
			header("location:".$url[0]."?msg=11");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

function searching()
{
	if(((isset($_POST['city']) && $_POST['city']!='') || (isset($_POST['location']) && $_POST['location']!='') || (isset($_POST['specialist']) && $_POST['specialist']!='')) || ((isset($_SESSION['city']) && $_SESSION['city']!='') || (isset($_SESSION['location']) && $_SESSION['location']!='') || (isset($_SESSION['speciality']) && $_SESSION['speciality']!='')))
	{
		global $con;
		if(isset($_POST['city']) || isset($_POST['location']) || isset($_POST['speciality']))
		{
			$search_type = mysqli_real_escape_string($con, $_POST['search_type']);
			$city = mysqli_real_escape_string($con, $_POST['city']);
			$location = mysqli_real_escape_string($con, $_POST['location']);
			$speciality = mysqli_real_escape_string($con, $_POST['speciality']);
		}
		elseif(isset($_SESSION['city']) || isset($_SESSION['location']) || isset($_SESSION['speciality']))
		{
			$search_type = mysqli_real_escape_string($con, $_SESSION['search_type']);
			$city = mysqli_real_escape_string($con, $_SESSION['city']);
			$location = mysqli_real_escape_string($con, $_SESSION['location']);
			$speciality = mysqli_real_escape_string($con, $_SESSION['speciality']);
		}
		
		$query_city = mysqli_query($con, "select name from city where state = '$city' and status = '1'");
		
		if(isset($_SESSION['city_detail']))
		{
			unset($_SESSION['city_detail']);
		}
			
		$city_detail = array();
		
		while($fetch = mysqli_fetch_object($query_city))
		{
			array_push($city_detail, $fetch->name);
		}
		
		$_SESSION['city_detail'] = $city_detail;
		
		
		$limit = 10;
		if(isset($_POST['city']) && isset($_POST['location']) && isset($_POST['speciality']))
		{
			$_SESSION['city'] = $city;
			$_SESSION['location'] = $location;
			$_SESSION['speciality'] = $speciality;
		}
		
		
		if(isset($_GET['focus']) && $_GET['focus']!='' && is_numeric($_GET['page']))
		{
			$page = mysqli_real_escape_string($con, $_GET['page']);
			if($page==1)
			{
				$start = 0;
			}
			else
			{
				$start = ($page-1)*$limit;	
			}
			
		}
		elseif(isset($_GET['previous']) && $_GET['previous']!='' && is_numeric($_GET['page']))
		{
			$page = mysqli_real_escape_string($con, $_GET['page']);
			$start = ($page-2)*$limit;
			if($page>1)
			{
				$page = $page-1;
			}
		}
		elseif(isset($_GET['next']) && $_GET['next']!='' && is_numeric($_GET['page']))
		{
			$page = mysqli_real_escape_string($con, $_GET['page']);
			$start = $page*$limit;
			$page = $page+1;
		}
		else
		{
			$start = 0;
			$page = 1;
		}
		
		
		if((isset($_POST['search_type']) || isset($_SESSION['search_type'])) && $search_type == 'clinics')
		{
			$_SESSION['search_type'] = $search_type;
			$result = mysqli_query($con, "select * from clinics where city like '$location%' and state like '$city' and (status = '1' or status ='2')");
		}
		elseif((isset($_POST['search_type']) || isset($_SESSION['search_type'])) && $search_type == 'pharmacy')
		{
			$_SESSION['search_type'] = $search_type;
			$result = mysqli_query($con, "select * from pharmacy where city like '$location%' and state like '$city' and  and (status = '1' or status ='2')");
		}
		elseif((isset($_POST['search_type']) || isset($_SESSION['search_type'])) && $search_type == 'labs')
		{
			$_SESSION['search_type'] = $search_type;
			$result = mysqli_query($con, "select * from labs where city like '$location%' and state like '$city' and (status = '1' or status ='2')");
		}
		else
		{
			$_SESSION['search_type'] = 'doctor';
			
			$query = mysqli_query($con, "select C.clinic_name, C.address, C.city, C.state, D.id, D.first_name, D.last_name, D.profile_image, D.designation, D.exprince, D.speciality, D.mobile_number, D.consult_fee from doctors as D inner join doctor_clinic_map as M on D.id = M.doctor_id inner join clinics as C on M.clinic_id = C.id where D.speciality like '".$speciality."%' and C.city like '".$location."%' and C.state like '".$city."%' and (D.status = '1' or D.status = '2') group by D.id");
		
			$_SESSION['search_count'] = mysqli_num_rows($query);
			
			
			$result = mysqli_query($con, "select C.clinic_name, C.address, C.city, C.state, D.id, D.first_name, D.last_name, D.profile_image, D.designation, D.exprince, D.speciality, D.mobile_number, D.consult_fee from doctors as D inner join doctor_clinic_map as M on D.id = M.doctor_id inner join clinics as C on M.clinic_id = C.id where D.speciality like '".$speciality."%' and C.city like '".$location."%' and C.state like '".$city."%' and (D.status = '1' or D.status = '2') group by D.id limit $start, $limit");
		}
		
		if(mysqli_num_rows($result)>0)
		{
			$detail = array();
			while($fetch = mysqli_fetch_object($result))
			{
				array_push($detail, $fetch);
			}
			$_SESSION['search_detail'] = $detail;
			
			/*
			if(isset($_POST['search_type']) && isset($_SESSION['search_type']) && $_POST['search_type']!='')
			{
				$city = mysqli_query($con, "select distinct(city) from $search_type where state = '$city' and (status = '1' or status ='2')");
			}
			else
			{
				$city = mysqli_query($con, "select distinct(city) from clinics where state = '$city' and (status = '1' or status ='2')");
			}
			*/
			
			
			
			header("location:../search.php?page=".$page);
			exit();
		}
		else
		{
			unset($_SESSION['search_detail']);
			unset($_SESSION['search_count']);
			$_SESSION['search_detail'] = "Not Available";
			header("location:../search.php");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function contact_mail()
{
	global $con;
	
	// sanitize data
	
	if(isset($_SESSION['security_code']) && $_SESSION['security_code'] == $_POST['captcha_mail'])
	{
		include 'library.php'; // include the library file
		include "class.phpmailer.php";
		include "class.smtp.php";
		
		$name = ucwords(mysqli_real_escape_string($con, $_POST['name']));
		$user_email = mysqli_real_escape_string($con, $_POST['email']);
		$mobile_number = mysqli_real_escape_string($con, $_POST['mobile_number']);
		$form_message = mysqli_real_escape_string($con, $_POST['message']);
		
		$message = '<html><head><style>td{padding:7px}
					</style></head><body>
					<table border="1">
					<tr><td colspan="2"><b>User Detail</b></td></tr>	
					<tr><td>Name</td><td>'.$name.'</td></tr>	
					<tr><td>Email-Id</td><td>'.$user_email.'</td></tr>	
					<tr><td>Mobile No.</td><td>'.$mobile_number.'</td></tr>	
					<tr><td>Message</td><td>'.$form_message.'</td></tr></body></html>'
					;
			
		$subject = "Customer Enquiry";
			
		$to = 'info@spiral.com';
		send_email($user_email, $user->name, $message, $subject, $to);
		
		/*
		$email = "info@spiral.com";
		$mail	= new PHPMailer; // call the class 
		$mail->IsSMTP(); 
		$mail->Host = SMTP_HOST; //Hostname of the mail server
		$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
		$mail->SMTPAuth = true; //Whether to use SMTP authentication
		$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
		$mail->Password = SMTP_PWORD; //Password for SMTP authentication
		$mail->AddReplyTo($user_email,$name); //reply-to address
		$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
		
		$content = '<html><head><style>td{padding:7px}
					</style></head><body>
					<table border="1">
					<tr><td colspan="2"><b>User Detail</b></td></tr>	
					<tr><td>Name</td><td>'.$name.'</td></tr>	
					<tr><td>Email-Id</td><td>'.$user_email.'</td></tr>	
					<tr><td>Mobile No.</td><td>'.$mobile_number.'</td></tr>	
					<tr><td>Message</td><td>'.$form_message.'</td></tr></body></html>'
					;
		
		$mail->Subject = "Customer Enquiry"; //Subject od your mail
		$mail->AddAddress($email, ""); //To address who will receive this email
		$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

		$send = $mail->Send();
		*/
		header("location:../contact.php?msg=c1");
		exit();
	}
	else
	{
		header("location:../contact.php?msg=c2");
		exit();
	}
	
}

function generate_otp()
{
	$otp = rand(111111, 999999);
	return $otp;
}


function send_sms($message, $phone)
{
	
	$jsonData = json_decode(file_get_contents('http://www.smsbusiness.in/api.php?username=FourFox&password=48095fc5&sender=Spiral&sendto='.$phone.'&message='.$message.'&xxx=aaa'));
	
	return $jsonData;
}


function send_email($email, $name, $message, $subject, $to)
{
	include 'library.php'; // include the library file
	include "class.phpmailer.php";
	include "class.smtp.php";
	
	$email = $email;
	$mail	= new PHPMailer; // call the class 
	$mail->IsSMTP(); 
	$mail->Host = SMTP_HOST; //Hostname of the mail server
	$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
	$mail->SMTPAuth = true; //Whether to use SMTP authentication
	$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
	$mail->Password = SMTP_PWORD; //Password for SMTP authentication
	$mail->AddReplyTo($email, $name); //reply-to address
	$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
	
	$content = $message;
	
	$mail->Subject = $subject; //Subject od your mail
	$mail->AddAddress($to, ""); //To address who will receive this email
	$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

	$send = $mail->Send();
}

function notification($user_id, $user_type, $suser_id, $suser_type, $message, $date, $status)
{
	global $con;
	$result = mysqli_query($con, "insert into notification set user_id = '$user_id' , user_type = '$user_type', suser_id = '$suser_id' , suser_type = '$suser_type', message = '$message', date = '$date', status = '$status'");
	if($result)
		return 1;
}


function resend_otp()
{
	global $con;
	$call_otp = new otp();
	
	$url = $_GET['back_url'];
	
	$id = $_SESSION['nid'];
	$type = $_SESSION['ntype'];
	
	$user = array('1'=>'patients', '2'=>'doctors', '3'=>'clinics', '4'=>'labs', '5'=>'pharmacy');
	$table = $user[$type];
	
	$mobile_otp = generate_otp();
	$email_otp = generate_otp();
	
	$query = mysqli_query($con, "select id from otp where user_id = '$id'");
	if(mysqli_num_rows($query) > 0)
	{
		mysqli_query($con, "delete from otp where user_id = '$id'");
	}
	
	// update spiral id of user in the database
	
	$result = mysqli_query($con, "select * from $table where id = '$id'");
	
	$user = mysqli_fetch_object($result);
	
	$call_otp->send_otp($id, $type, $mobile_otp, $user->mobile_number, 'sms', time(), '0');
	
	
	$phone_id = mysqli_insert_id($con);
	
	$call_otp->send_otp($id, $type, $email_otp, $user->email, 'email', time(), '0');
	
	$email_id = mysqli_insert_id($con);
	
	$call_otp->send_otp($id, $type, '', '', 'new user', time(), '0');
	
	if(isset($user->first_name) && $user->first_name!='' && isset($user->last_name) && $user->last_name!='')
	{
		$name = $user->first_name." ".$user->last_name;
	}
	else
	{
		$name = $user->clinic_name;
	}
	// send otp sms to the verification of phone number
	
	$message = "Spiral%20Account%20Confirmation%20Message.%20Your%20One%20Time%20Password%20(OTP)%20is%20".$mobile_otp;
	
	send_sms($message, $user->mobile_number);
	
	// send otp mail to the user for the verification of email-Id
	$message = '<p>Hi '.$name.'!</p>
				<p>Help us secure your Spiral account by verifying your email address ('.$user->email.'). This lets you access all of Spiral features.</p>
				<p>OTP for email verification = '.$email_otp.'</p>
				';
	
	$subject = "Account Register Confirmation";
	
	send_email($user->email, $name, $message, $subject, $user->email);
	header("location:../index.php?msg=".$url."&send=Resend Successfully.");
	exit();
}
	
function blank()
{
	header("location:../index.php");
	exit();
}
?>