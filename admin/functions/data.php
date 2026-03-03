<?php
session_start();date_default_timezone_set('America/Los_Angeles');
require "db.php";
require "class.otp.php";
define('base_url', "http://localhost/antriksh/site");
//define('base_url', "http://spiral.com");



$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if(isset($request->action) && $request->action!='')
{
	$action = $request->action;
}

else
{
	header("location:../index.php");
	exit();
}	


switch($action)
{
	case 'states' 					: states($request);
										break;
	
	case 'location' 				: location($request);
										break;
	
	case 'speciality' 				: speciality($request);
										break;
	
	case 'doctorlist' 				: doctorlist($request);
										break;
	
	case 'get_state' 				: get_state($request);
										break;
				   
	case 'get_patient' 				: get_patient($request);
										break;
				   
	case 'get_doctor' 				: get_doctor($request);
										break;
				   
	case 'get_document' 			: get_document($request);
										break;
				   
	case 'get_clinic' 				: get_clinic($request);
										break;
				   
	case 'check_booking' 			: check_booking($request);
										break;
				   
	case 'email_otp' 				: email_otp($request);
										break;
				   
	case 'otp_oemail' 				: otp_oemail($request);
										break;
				   
	case 'verify_old_email' 		: verify_old_email($request);
										break;
				   
	case 'change_email' 			: change_email($request);
										break;
				   
	case 'otp_ophone' 				: otp_ophone($request);
										break;
				   
	case 'verify_old_phone' 		: verify_old_phone($request);
										break;
				   
	case 'phone_otp' 				: phone_otp($request);
										break;
				   
	case 'change_phone' 			: change_phone($request);
										break;
				   
	case 'document_detail' 			: document_detail($request);
										break;
				   
	case 'session_booking' 			: session_booking($request);
										break;
				   
				   
	case 'filter' 					: filter($request);
										break;
				   
	case 'send_otp' 				: send_otp($request);
										break;
				   
	case 'download_document' 		: download_document($request);
										break;
				   
	case 'delete_document' 			: delete_document($request);
										break;
				   
	case 'document_access' 			: document_access($request);
										break;
				   
	case 'disconnect_patient' 		: disconnect_patient($request);
										break;
				   
	case 'get_doctor_ids' 			: get_doctor_ids($request);
										break;
				   
	case 'doctor_document_detail' 	: doctor_document_detail($request);
										break;
				   
	case 'penalty_detail' 			: penalty_detail($request);
										break;
				   
	case 'cancel_appointment' 			: cancel_appointment($request);
										break;
				   
	default : 		blank();
}

// code for fetch states

function states($request)
{
	if(isset($request->city) && $request->city!='')
	{
		global $con;
		$city = mysqli_real_escape_string($con, $request->city);
		$query = mysqli_query($con, "select * from state where country_id = '99' and state_name like '$city%'");
		
		$states = array();
		
		while($data = mysqli_fetch_assoc($query))
		{
			array_push($states, $data['state_name']);
		}
		
		echo json_encode($states);
		exit;
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

// code for fetch location

function location($request)
{
	if(isset($request->location) && $request->location!='')
	{
		global $con;
		$location = mysqli_real_escape_string($con, $request->location);
		//$query = mysqli_query($con, "select distinct(city) from clinics where status = '1' and city like '$location%' order by city");
		$query = mysqli_query($con, "select distinct(name) from city where status = '1' and name like '$location%' order by name");
		
		$location = array();
		
		while($data = mysqli_fetch_assoc($query))
		{
			array_push($location, $data['name']);
		}
		
		echo json_encode($location);
		exit;
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


// code for fetch speciality

function speciality($request)
{
	if(isset($request->speciality) && $request->speciality!='')
	{
		global $con;
		$speciality = mysqli_real_escape_string($con, $request->speciality);
		$query = mysqli_query($con, "select name from specialities where status = '1' and name like '$speciality%' order by name");
		
		$specialities = array();
		
		while($data = mysqli_fetch_assoc($query))
		{
			array_push($specialities, $data['name']);
		}
		
		echo json_encode($specialities);
		exit;
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function doctorlist($request)
{
	if(isset($request->city) && $request->city!='' && isset($request->location) && $request->location!='' && isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$city = mysqli_real_escape_string($con, $request->city);
		$location = mysqli_real_escape_string($con, $request->location);
		$speciality = mysqli_real_escape_string($con, $request->speciality);
		
		$result = mysqli_query($con, "select C.clinic_name, C.address, D.id, D.first_name, D.last_name, D.profile_image, D.speciality, D.mobile_number from doctors as D inner join doctor_clinic_map as M on D.id = M.doctor_id inner join clinics as C on M.clinic_id = C.id where D.speciality like '".$speciality."%' and C.city like '".$location."%' and C.state like '".$city."%' and D.status = '1'");
		
		$doctors = array();
		$i = 1;
		while($detail = mysqli_fetch_object($result))
		{
			$detail->num = $i;
			array_push($doctors, $detail);
			$i++;
		}
		
		echo json_encode($doctors);
		exit();
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

function get_state($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$query = mysqli_query($con, "select state_name from state where country_name='$request->country'");
			
		$state = array();
		
		while($data = mysqli_fetch_assoc($query))
		{
			array_push($state, $data['state_name']);
		}
		
		echo json_encode($state);
		exit;	
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

function get_patient($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$id = mysqli_real_escape_string($con, $request->id);
		$query = mysqli_query($con, "select first_name, last_name, username, email, profile_image, mobile_number, gender, dob, blood_group, street_address, locality, city, state, country, pincode, language from patients where id = '$id'");
		$user = mysqli_fetch_assoc($query);
		echo json_encode($user);
		exit();
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function get_doctor($request)
{
	if((isset($_SESSION['id']) && $_SESSION['id']!='') || (isset($request->id) && $request->id!=''))
	{
		global $con;
		$user = array();
		$id = mysqli_real_escape_string($con, $request->id);
		$query = mysqli_query($con, "select id, first_name, last_name, gender, dob, ug_degree, ug_institude, pg_degree, pg_institude, other_education, designation, practice_type, consult_fee, language_spoken, speciality, expertise, exprince, awards, registration_no, registration_state, statement, notes, username, email, profile_image, mobile_number, emergency_availiability, emergency_number, emergency_address, emergency_charges from doctors where id = '$id'");
		$user['doctor'] = mysqli_fetch_assoc($query);
		
		$doctors = mysqli_query($con, "select C.id, C.clinic_name, C.clinic_image, C.address from clinics as C inner join doctor_clinic_map as M on M.clinic_id = C.id where M.doctor_id = '$id'");
		$i=0;
		$clinic = array();
		$clinic_timing = array();
		while($fetch = mysqli_fetch_assoc($doctors))
		{
			$fetch['num'] = $i+1;
			array_push($clinic, $fetch);
				
			$timing = mysqli_query($con, "select clinic_id, working_days, working_start_hours, working_end_hours from doctor_availability where doctor_id = '$id' and clinic_id = '$fetch[id]'");
			if(mysqli_num_rows($timing)>0)
			{
				while($fetch_timing = mysqli_fetch_object($timing))
				{
					array_push($clinic_timing, $fetch_timing);
				}
			}$i++;
		}
		$user['clinic'] = $clinic;
		$user['clinic_timing'] = $clinic_timing;
		echo json_encode($user);
		exit();
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function get_document($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$id = mysqli_real_escape_string($con, $request->id);
		$query = mysqli_query($con, "select D.*, T.name from sharing_document as S inner join document_detail as D on S.document_id = D.id inner join document as T on T.id = D.document_type where find_in_set(".$_SESSION['id'].", S.doctor_id) and D.id = '$id' order by D.id");
		$user = mysqli_fetch_assoc($query);
		echo json_encode($user);
		exit();
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

function get_clinic($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$id = mysqli_real_escape_string($con, $request->id);
		//$query = mysqli_query($con, "select D.*, C.clinic_name, C.address, C.city, C.zipcode, C.state, C.country, C.clinic_image, C.mobile_number  from clinics as C inner join doctor_availability as D on D.clinic_id = C.id where D.doctor_id = '$_SESSION[id]' and D.clinic_id = '$id'");
		
		$query1 = mysqli_query($con, "select clinic_name, address, city, zipcode, state, country, clinic_image, mobile_number  from clinics where id = '$id'");
		
		$clinic = mysqli_fetch_assoc($query1);
		
		$query2 = mysqli_query($con, "select * from doctor_availability where doctor_id = '$_SESSION[id]' and clinic_id = '$id'");
		
		$detail = array();
		array_push($detail, $clinic);
		while($user = mysqli_fetch_object($query2))
		{
			array_push($detail, $user);
		}
		
		
		echo json_encode($detail);
		exit();
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function check_booking($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		
		$check_date = mysqli_real_escape_string($con, $request->date);
		$clinic_id = mysqli_real_escape_string($con, $request->cid);
		$doctor_id = mysqli_real_escape_string($con, $request->did);
		
		list($month, $date, $year) = explode('/', $check_date);
		$check_date = mktime(0, 0, 0, $month, $date, $year);
		
		$detail = array();
		
		$timing = mysqli_query($con, "select * from doctor_availability where doctor_id = '$doctor_id' and clinic_id = '$clinic_id'");
		if(mysqli_num_rows($timing)>0)
		{
			while($fetch = mysqli_fetch_object($timing))
			{
				$detail = $fetch;
			}
		}
		echo json_encode($detail);
		exit();
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function otp_oemail($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$call_otp = new otp();
		
		$id = $_SESSION['id'];
		$table = $_SESSION['type'];
		
		$user_type = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
		$type = $user_type[$table];
		
		$check = mysqli_query($con, "select email, first_name from $table where id = '$id'");
		$user 	 = mysqli_fetch_object($check);
			
		//mysqli_query($con, "update $table set status = '1', email = '$email' where id = '$id'");
		
		$otp_check = mysqli_query($con, "select id from otp where user_id = '$id' and type='$type' and otp_type = 'email'");
		if(mysqli_num_rows($otp_check) > 0)
		{
			mysqli_query($con, "delete from otp where user_id = '$id' and type='$type' and otp_type = 'email'");
		}
		
		
		$otp = generate_otp();
		
		$call_otp->send_otp($id, $type, $otp, $user->email, 'email', time(), '0');
		
		//mysqli_query($con, "insert into otp set user_id = '$id', entity = '$user->email', type = '$type', otp = '$otp', otp_type = 'email', status = '0'");
		
		
		// send otp sms to the old email-id
		/*
		$to      = $user->email;
		$subject = 'Email Verification';
		
		$message = '<p>Hi $user->first_name!</p>
					<p>OTP for email verification = $otp</p>
					';			
		$headers = 'From: spiral.com' . "\r\n" .
			'Reply-To: info@spiral.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
		*/
		
		$message = '<p>Hi '.$user->first_name.'!</p>
					<p>OTP for email verification = '.$otp.'</p>
					';
		
		$subject = "Email Verification";
		
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
		$mail->AddReplyTo($email, $user->first_name); //reply-to address
		$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
		
		$content = '<p>Hi $user->first_name!</p>
					<p>OTP for email verification = $otp</p>
					';
		
		$mail->Subject = "Email Verification"; //Subject od your mail
		$mail->AddAddress($email, ""); //To address who will receive this email
		$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

		$send = $mail->Send();
		*/
		
		$detail['msg'] = "OTP send successfully on your email-id.";
		$detail['otp'] = "Old";
		echo json_encode($detail);
		exit();
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function verify_old_email($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->otp) && $request->otp!='')
	{
		global $con;
		$call_otp = new otp();
		
		$otp = mysqli_real_escape_string($con, $request->otp);
		$id = $_SESSION['id'];
		$table = $_SESSION['type'];
		
		$user_type = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
		$type = $user_type[$table];
		
		$check = mysqli_query($con, "select id from otp where user_id = '$id' and type = '$type' and otp = '$otp' and otp_type = 'email'");
		if(mysqli_num_rows($check) > 0)
		{
			$result = mysqli_fetch_object($check);
			$expiry = $call_otp->check_expiry($result->id);
			
			if($expiry > 0)
			{
				mysqli_query($con, "delete from otp where user_id = '$id' and type = '$type' and otp = '$otp' and otp_type = 'email'");
				$detail['msg'] = "Verify Old Email-Id Successfully.";
				
				echo json_encode($detail);
				exit();
			}
			else
			{
				$detail['msg'] = "OTP Expire.";
				$detail['otp'] = "Old";
				echo json_encode($detail);
				exit();
			}
		}
		else
		{
			$detail['msg'] = "Invalid OTP.";
			$detail['otp'] = "Old";
			echo json_encode($detail);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

function email_otp($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->email) && $request->email!='')
	{
		global $con;
		$call_otp = new otp();
		
		$email = mysqli_real_escape_string($con, $request->email);
		$id = $_SESSION['id'];
		$table = $_SESSION['type'];
		
		$user_type = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
		$type = $user_type[$table];
		
		$check_email = mysqli_query($con, "select id from $table where email = '$email' and (status = '1' or status = '2')");
		if(mysqli_num_rows($check_email) == 0)
		{
			$check = mysqli_query($con, "select email, first_name from $table where id = '$id'");
			if(mysqli_num_rows($check) > 0)
			{
				
				$user 	 = mysqli_fetch_object($check);
				
				$otp_check = mysqli_query($con, "select id from otp where user_id = '$id' and type='$type' and otp_type = 'email'");
				if(mysqli_num_rows($otp_check) > 0)
				{
					mysqli_query($con, "delete from otp where user_id = '$id' and type='$type' and otp_type = 'email'");
				}
				
				$otp = generate_otp();
				
				$call_otp->send_otp($id, $type, $otp, $email, 'email', time(), '0');
				
				//mysqli_query($con, "insert into otp set user_id = '$id', entity = '$email', type = '$type', otp = '$otp', otp_type = 'email', status = '0'");
				
				/*
				$to      = $email;
				$subject = 'Email Verification';
				
				$message = '<p>Hi $user->first_name!</p>
							<p>OTP for email verification = $otp</p>
							';			
				$headers = 'From: spiral.com' . "\r\n" .
					'Reply-To: info@spiral.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
				*/
				
				$message = '<p>Hi '.$user->first_name.'!</p>
							<p>OTP for email verification = '.$otp.'</p>
							';
		
				$subject = "Email Verification";
				
				send_email($email, $user->first_name, $message, $subject, $email);
				
				/*
				$email = $email;
				$mail	= new PHPMailer; // call the class 
				$mail->IsSMTP(); 
				$mail->Host = SMTP_HOST; //Hostname of the mail server
				$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
				$mail->SMTPAuth = true; //Whether to use SMTP authentication
				$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
				$mail->Password = SMTP_PWORD; //Password for SMTP authentication
				$mail->AddReplyTo($email,$user->first_name); //reply-to address
				$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
				
				$content = '<p>Hi $user->first_name!</p>
							<p>OTP for email verification = $otp</p>
							';	
				
				$mail->Subject = "Email Verification"; //Subject od your mail
				$mail->AddAddress($email, ""); //To address who will receive this email
				$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

				$send = $mail->Send();
				*/
				
				$_SESSION['email'] = $email;
				$detail['msg'] = "OTP send successfully on your email-id.";
				$detail['otp'] = "New";
				echo json_encode($detail);
				exit();
			}
		}
		else
		{
			$detail['msg'] = "Email-Id Already Exists.";
			echo json_encode($detail);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

function change_email($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->otp) && $request->otp!='')
	{
		global $con;
		$call_otp = new otp();
		
		$otp = mysqli_real_escape_string($con, $request->otp);
		$id = $_SESSION['id'];
		$table = $_SESSION['type'];
		$email = $_SESSION['email'];
		
		$user_type = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
		$type = $user_type[$table];
		
		$check = mysqli_query($con, "select id from otp where user_id = '$id' and entity = '$email' and type = '$type' and otp = '$otp' and otp_type = 'email'");
		if(mysqli_num_rows($check) > 0)
		{
			$result = mysqli_fetch_object($check);
			$expiry = $call_otp->check_expiry($result->id);
			
			if($expiry > 0)
			{
				$fetch = mysqli_query($con, "select email, mobile_number, first_name from $table where id = '$_SESSION[id]'");
				$user = mysqli_fetch_object($fetch);
				
				mysqli_query($con, "update $table set email = '$_SESSION[email]' where id = '$id'");
				mysqli_query($con, "delete from otp where user_id = '$id' and entity = '$email' and type = '$type' and otp = '$otp' and otp_type = 'email'");
				
				
				// send sms to the old email
				/*
				$to      = $user->email;
				$subject = 'Email Update Confirmation';
				
				$message = '<p>Hi $user->first_name!</p>
							<p>Email-Id Changed Successfully.</p>
							';			
				$headers = 'From: spiral.com' . "\r\n" .
					'Reply-To: info@spiral.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					
				mail($to, $subject, $message, $headers);
				*/
				
				$message = '<p>Hi '.$user->first_name.'!</p>
							<p>Email-Id Changed Successfully.</p>
							';
			
				$subject = "Email Update Confirmation";
				
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
				$mail->AddReplyTo($email,$user->first_name); //reply-to address
				$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
				
				$content = '<p>Hi $user->first_name!</p>
							<p>Email-Id Changed Successfully.</p>
							';
				
				$mail->Subject = "Email Update Confirmation"; //Subject od your mail
				$mail->AddAddress($email, ""); //To address who will receive this email
				$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

				$send = $mail->Send();
				*/
				
				// send sms to the new email
				/*
				$to      = $email;
				$subject = 'Email Verification';
				
				$message = '<p>Hi $user->first_name!</p>
							<p>Email-Id Changed Successfully.</p>
							';			
				$headers = 'From: spiral.com' . "\r\n" .
					'Reply-To: info@spiral.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					
				mail($to, $subject, $message, $headers);
				*/
				
				$message = '<p>Hi '.$user->first_name.'!</p>
							<p>Email-Id Changed Successfully.</p>
							';
			
				$subject = "Email Verification";
				
				send_email($_SESSION['email'], $user->first_name, $message, $subject, $_SESSION['email']);
				
				/*
				$email = $_SESSION['email'];
				$mail	= new PHPMailer; // call the class 
				$mail->IsSMTP(); 
				$mail->Host = SMTP_HOST; //Hostname of the mail server
				$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
				$mail->SMTPAuth = true; //Whether to use SMTP authentication
				$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
				$mail->Password = SMTP_PWORD; //Password for SMTP authentication
				$mail->AddReplyTo($email,$user->first_name); //reply-to address
				$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
				
				$content = '<p>Hi $user->first_name!</p>
							<p>Email-Id Changed Successfully.</p>
							';
				
				$mail->Subject = "Email Verification"; //Subject od your mail
				$mail->AddAddress($email, ""); //To address who will receive this email
				$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

				$send = $mail->Send();
				*/
				
				// send sms to the phone
				
				$message = 'Hi%20'.$user->first_name.'!%20Email-Id%20Changed%20Successfully.';
							
				send_sms($message, $user->mobile_number);
				
				
				unset($_SESSION['email']);
				$detail['msg'] = "Email-Id Changed Successfully.";
				echo json_encode($detail);
				exit();
			}
			else
			{
				$detail['msg'] = "OTP Expire.";
				$detail['otp'] = "New";
				echo json_encode($detail);
				exit();
			}
		}
		else
		{
			$detail['msg'] = "Invalid OTP.";
			$detail['otp'] = "New";
			echo json_encode($detail);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function otp_ophone($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$call_otp = new otp();
		
		$id = $_SESSION['id'];
		$table = $_SESSION['type'];
		
		$user_type = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
		$type = $user_type[$table];
		
		$check = mysqli_query($con, "select mobile_number, first_name from $table where id = '$id'");
		$user 	 = mysqli_fetch_object($check);
			
		//mysqli_query($con, "update $table set status = '1', email = '$email' where id = '$id'");
		
		$otp_check = mysqli_query($con, "select id from otp where user_id = '$id' and type='$type' and otp_type = 'sms'");
		if(mysqli_num_rows($otp_check) > 0)
		{
			mysqli_query($con, "delete from otp where user_id = '$id' and type='$type' and otp_type = 'sms'");
		}
		
		$otp = generate_otp();
		
		$call_otp->send_otp($id, $type, $otp, $user->mobile_number, 'sms', time(), '0');
		
		//mysqli_query($con, "insert into otp set user_id = '$id', entity = '$user->mobile_number', type = '$type', otp = '$otp', otp_type = 'sms', status = '0'");
		
		// send otp sms to the old phone
		
		$message = 'One%20Time%20Password(OTP)%20'.$otp;
					
		send_sms($message, $user->mobile_number);
		
		$detail['msg'] = "OTP send successfully on your phone.";
		$detail['otp'] = "Old";
		echo json_encode($detail);
		exit();
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function verify_old_phone($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->otp) && $request->otp!='')
	{
		global $con;
		$call_otp = new otp();
		
		$otp = mysqli_real_escape_string($con, $request->otp);
		$id = $_SESSION['id'];
		$table = $_SESSION['type'];
		
		$user_type = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
		$type = $user_type[$table];
		
		$check = mysqli_query($con, "select id from otp where user_id = '$id' and type = '$type' and otp = '$otp' and otp_type = 'sms'");
		if(mysqli_num_rows($check) > 0)
		{
			$result = mysqli_fetch_object($check);
			$expiry = $call_otp->check_expiry($result->id);
			
			if($expiry > 0)
			{
				mysqli_query($con, "delete from otp where user_id = '$id' and type = '$type' and otp = '$otp' and otp_type = 'sms'");
				$detail['msg'] = "Verify Old Phone Successfully.";
				
				echo json_encode($detail);
				exit();
			}
			else
			{
				$detail['msg'] = "OTP Expire.";
				$detail['otp'] = "Old";
				echo json_encode($detail);
				exit();
			}
		}
		else
		{
			$detail['msg'] = "Invalid OTP.";
			$detail['otp'] = "Old";
			echo json_encode($detail);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}



function phone_otp($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->phone) && $request->phone!='')
	{
		global $con;
		$call_otp = new otp();
		
		$phone = mysqli_real_escape_string($con, $request->phone);
		$id = $_SESSION['id'];
		$table = $_SESSION['type'];
		
		$user_type = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
		$type = $user_type[$table];
		
		$check_phone = mysqli_query($con, "select id from $table where mobile_number = '$phone' and (status = '1' or status = '2')");
		if(mysqli_num_rows($check_phone) == 0)
		{
			$check = mysqli_query($con, "select mobile_number, first_name from $table where id = '$id'");
			if(mysqli_num_rows($check) > 0)
			{
				
				$user 	 = mysqli_fetch_object($check);
				
				//mysqli_query($con, "update $table set status = '1', email = '$email' where id = '$id'");
				
				$otp_check = mysqli_query($con, "select id from otp where user_id = '$id' and type='$type' and otp_type = 'sms'");
				if(mysqli_num_rows($otp_check) > 0)
				{
					mysqli_query($con, "delete from otp where user_id = '$id' and type='$type' and otp_type = 'sms'");
				}
				
				$otp     = generate_otp();
				
				$call_otp->send_otp($id, $type, $otp, $phone, 'sms', time(), '0');
				
				//mysqli_query($con, "insert into otp set user_id = '$id', entity = '$phone', type = '$type', otp = '$otp', otp_type = 'sms', status = '0'");
				
				// send otp sms to the new phone
				
				$message = 'One%20Time%20Password(OTP)%20'.$otp;
							
				send_sms($message, $phone);
				
				$_SESSION['phone'] = $phone;
				$detail['msg'] = "OTP send successfully on your phone.";
				$detail['otp'] = "New";
				echo json_encode($detail);
				exit();
			}
		}
		else
		{
			$detail['msg'] = "Phone Number Already Exists.";
			echo json_encode($detail);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

function change_phone($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->otp) && $request->otp!='')
	{
		global $con;
		$call_otp = new otp();
		
		$otp = mysqli_real_escape_string($con, $request->otp);
		$id = $_SESSION['id'];
		$table = $_SESSION['type'];
		$phone = $_SESSION['phone'];
		
		$user_type = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
		$type = $user_type[$table];
		
		$check = mysqli_query($con, "select id from otp where user_id = '$id' and entity = '$phone' and type = '$type' and otp = '$otp' and otp_type = 'sms'");
		if(mysqli_num_rows($check) > 0)
		{
			$result = mysqli_fetch_object($check);
			$expiry = $call_otp->check_expiry($result->id);
			
			if($expiry > 0)
			{
				$fetch = mysqli_query($con, "select email, mobile_number, first_name from $table where id = '$_SESSION[id]'");
				$user = mysqli_fetch_object($fetch);
				
				mysqli_query($con, "update $table set mobile_number = '$phone' where id = '$id'");
				mysqli_query($con, "delete from otp where user_id = '$id' and entity = '$phone' and type = '$type' and otp = '$otp' and otp_type = 'sms'");
				
				// send sms to the email
				/*
				$to      = $user->email;
				$subject = 'Phone Update Confirmation';
				
				$message = '<p>Hi $user->first_name!</p>
							<p>Phone Number Changed Successfully.</p>
							';			
				$headers = 'From: spiral.com' . "\r\n" .
					'Reply-To: info@spiral.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					
				mail($to, $subject, $message, $headers);
				*/
				
				$message = '<p>Hi '.$user->first_name.'!</p>
							<p>Phone Number Changed Successfully.</p>
							';
			
				$subject = "Phone Update Confirmation";
				
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
				$mail->AddReplyTo($email,$user->first_name); //reply-to address
				$mail->SetFrom("webmaster@savekid.co.in", "Spiral"); //From address of the mail
				
				$content = '<p>Hi $user->first_name!</p>
							<p>Phone Number Changed Successfully.</p>
							';
				
				$mail->Subject = "Phone Update Confirmation"; //Subject od your mail
				$mail->AddAddress($email, ""); //To address who will receive this email
				$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

				$send = $mail->Send();
				*/
				
				//send sms on old number
				
				$message = 'Hi%20'.$user->first_name.'!%20Phone%20Number%20Changed%20Successfully.';
							
				send_sms($message, $user->mobile_number);
				
				//send sms on new number
				
				send_sms($message, $phone);
				
				unset($_SESSION['phone']);
				
				$detail['msg'] = "Phone Number Changed Successfully.";
				echo json_encode($detail);
				exit();
			}
			else
			{
				$detail['msg'] = "OTP Expire.";
				$detail['otp'] = "New";
				echo json_encode($detail);
				exit();
			}
		}
		else
		{
			$detail['msg'] = "Invalid OTP.";
			$detail['otp'] = "New";
			echo json_encode($detail);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function document_detail($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->id) && $request->id!='')
	{
		global $con;
		$document_id = mysqli_real_escape_string($con, $request->id);
		$id = $_SESSION['id'];
		
		$check = mysqli_query($con, "select E.name, D.id, D.document_type, D.doctor_name, D.doctor_phone, D.illness, D.document_date, D.document_name, D.detail, D.address, D.pageno, D.uploaded_date from document_detail as D inner join document as E on E.code = D.document_type where D.patient_id = '$id' and D.id = '$document_id'");
		if(mysqli_num_rows($check) > 0)
		{
			$detail = mysqli_fetch_object($check);
			echo json_encode($detail);
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


function doctor_document_detail($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->id) && $request->id!='')
	{
		global $con;
		$document_id = mysqli_real_escape_string($con, $request->id);
		$id = $_SESSION['id'];
		
		$check = mysqli_query($con, "select id, achievement_date, degree_name, doctor_id, document_name, document_type, institute_name, issuance_place, status, uploaded_date, validity from doctor_document where id = '$document_id' and doctor_id = '$id'");
		if(mysqli_num_rows($check) > 0)
		{
			$detail = mysqli_fetch_object($check);
			echo json_encode($detail);
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

// code for filtering

function filter($request)
{
	if(((isset($request->price) && $request->price) || (isset($request->location) && $request->location) || (isset($request->days) && $request->days)))
	{
		global $con;
		$search_type = mysqli_real_escape_string($con, $_SESSION['search_type']);
		$city = mysqli_real_escape_string($con, $_SESSION['city']);
		$speciality = mysqli_real_escape_string($con, $_SESSION['speciality']);
		$emergency = mysqli_real_escape_string($con, $request->emergency);
		
		
		if(isset($request->price) && $request->price!='' && isset($request->location) && !empty($request->location) && isset($request->days) && !empty($request->days))
		{
			$price = mysqli_real_escape_string($con, $request->price);
			$location = $request->location;
			$days = $request->days;
		}
		elseif((isset($request->price) && $request->price!='') || (isset($request->location) && !empty($request->location)) || (isset($request->days) && empty($request->days)))
		{
			$price = mysqli_real_escape_string($con, $request->price);
			$location = $request->location;
			$days = 'All';
		}
		elseif((isset($request->price) && $request->price!='') || (isset($request->location) && empty($request->location)) || (isset($request->days) && !empty($request->days)))
		{
			$price = mysqli_real_escape_string($con, $request->price);
			$location = $_SESSION['location'];
			$days = $request->days;
		}
		elseif((isset($request->price) && $request->price!='') || (isset($request->location) && empty($request->location)) || (isset($request->days) && empty($request->days)))
		{
			$price = mysqli_real_escape_string($con, $request->price);
			$location = $_SESSION['location'];
			$days = 'All';
		}
		elseif((isset($request->price) && $request->price=='') || (isset($request->location) && !empty($request->location)) || (isset($request->days) && !empty($request->days)))
		{
			$price = 'All';
			$location = $request->location;
			$days = $request->days;
		}
		elseif((isset($request->price) && $request->price=='') || (isset($request->location) && !empty($request->location)) || (isset($request->days) && empty($request->days)))
		{
			$price = 'All';
			$location = $request->location;
			$days = 'All';
		}
		elseif((isset($request->price) && $request->price=='') || (isset($request->location) && empty($request->location)) || (isset($request->days) && !empty($request->days)))
		{
			$price = 'All';
			$location = $_SESSION['location'];
			$days = $request->days;
		}
		
		if($price=='All')
		{
			$price = '';
			$order = '';
		}
		else
		{
			preg_match_all('!\d+!', $request->price, $min_max_price);
			$price = "and D.consult_fee >= '".$min_max_price[0][0]."' and D.consult_fee <= '".$min_max_price[0][1]."'";
			$order = "order by D.consult_fee";
		}
		
		if(count($request->location)==0)
		{
			$location = "and C.city in ('".$_SESSION['location']."')";
		}
		else
		{
			$location = implode("','", $request->location);
			$location = "and C.city in ('".$location."')";
		}
		
		if(count($request->days)==0)
		{
			$days = '';
		}
		else
		{
			$days = implode("','", $request->days);
			$days = "and DA.working_days in ('".$days."')";
		}
		if($emergency == 'Yes')
		{
			$emergency = "and D.emergency_availiability = 'Yes'";
		}
		else
		{
			$emergency = '';
		}
		
		if(isset($_SESSION['search_type']) && $search_type == 'clinics')
		{
			$_SESSION['search_type'] = $search_type;
			$result = mysqli_query($con, "select * from clinics where city like '$location%' and state like '$city' and (status = '1' or status ='2')");
		}
		elseif(isset($_SESSION['search_type']) && $search_type == 'pharmacy')
		{
			$_SESSION['search_type'] = $search_type;
			$result = mysqli_query($con, "select * from pharmacy where city like '$location%' and state like '$city' and  and (status = '1' or status ='2')");
		}
		elseif(isset($_SESSION['search_type']) && $search_type == 'labs')
		{
			$_SESSION['search_type'] = $search_type;
			$result = mysqli_query($con, "select * from labs where city like '$location%' and state like '$city' and (status = '1' or status ='2')");
		}
		else
		{
			$_SESSION['search_type'] = 'doctor';
			
			
			if($days=='')
			{
				$result = mysqli_query($con, "select C.clinic_name, C.address, C.city, C.state, D.id, D.first_name, D.last_name, D.profile_image, D.designation, D.exprince, D.speciality, D.mobile_number, D.consult_fee from doctors as D inner join doctor_clinic_map as M on D.id = M.doctor_id inner join clinics as C on M.clinic_id = C.id where D.speciality like '".$speciality."%'".$location." ".$price." ".$days." ".$emergency." and C.state like '".$city."%' and (D.status = '1' or D.status = '2') group by D.id ".$order);
			}
			else
			{
				$result = mysqli_query($con, "select C.clinic_name, C.address, C.city, C.state, D.id, D.first_name, D.last_name, D.profile_image, D.designation, D.exprince, D.speciality, D.mobile_number, D.consult_fee from doctors as D inner join doctor_clinic_map as M on D.id = M.doctor_id inner join clinics as C on M.clinic_id = C.id inner join doctor_availability as DA on M.doctor_id = DA.doctor_id where D.speciality like '".$speciality."%'".$location." ".$price." ".$days." ".$emergency." and C.state like '".$city."%' and (D.status = '1' or D.status = '2') group by D.id ".$order);
			}
		
			//$_SESSION['search_count'] = mysqli_num_rows($result);
			
		}
		
		if(mysqli_num_rows($result)>0)
		{
			$detail = array();
			while($fetch = mysqli_fetch_object($result))
			{
				array_push($detail, $fetch);
			}
			//$_SESSION['search_detail'] = $detail;
			echo json_encode($detail);
			exit();
		}
		else
		{
			$msg = 'Not Available';
			echo json_encode($msg);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


// code for set doctorid in session for booking

function session_booking($request)
{
	$_SESSION['book_doctor_id'] = $request->doctor_id;
	echo $_SESSION['book_doctor_id'];
	exit();
}


// code for send otp

function send_otp($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->to) && $request->to!='')
	{
		global $con;
		$call_otp = new otp();
		$type = mysqli_real_escape_string($con, $request->type);
		$to   = mysqli_real_escape_string($con, $request->to);
		
		$user_type = $_SESSION['type'];
		
		
		$user1 = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
		$type1 = $user1[$user_type];
		
		$email_otp     = generate_otp();
		$phone_otp = generate_otp();
		
		
			
		if($type == 'download document' || $type == 'delete document' || $type == 'document access' || $type == 'disconnect patient' || $type == 'cancel apppointment')
		{
			$document_id   = mysqli_real_escape_string($con, $request->id);
			if($type == 'download document')
			{
				$_SESSION['download-document'] = $document_id;
			}
			elseif($type == 'delete document')
			{
				$_SESSION['delete-document'] = $document_id;
			}
			elseif($type == 'document access')
			{
				$_SESSION['document-access'] = $document_id;
			}
			elseif($type == 'disconnect patient')
			{
				$_SESSION['disconnect-patient'] = $document_id;
			}
			elseif($type == 'cancel apppointment')
			{
				$_SESSION['cancel-apppointment'] = $document_id;
			}
			
			$query = mysqli_query($con, "select mobile_number from ".$user_type." where id = '$_SESSION[id]' and status = '2'");
			$user = mysqli_fetch_object($query);
				
			
			$check = mysqli_query($con, "select id from otp where otp_type = '$type' and user_id = '$_SESSION[id]' and type = '$type1'");
			if(mysqli_num_rows($check) > 0)
			{
				$fetch = mysqli_fetch_object($check);
				mysqli_query($con, "update otp set otp = '$phone_otp', date='".time()."' where id = '$fetch->id'");
				
			}
			else
			{
				$call_otp->send_otp($_SESSION['id'], $type1, $phone_otp, $user->mobile_number, $type, time(), '0');
				
				//mysqli_query($con, "insert into otp set user_id = '$_SESSION[id]', entity = '$user->mobile_number', type = '$type1', otp = '$phone_otp', otp_type = '$type', status = '0'");
			}
			
			// send otp on phone
				
			$msg = 'One%20Time%20Password(OTP)%20'.$phone_otp.'.';
						
			send_sms($msg, $user->mobile_number);
			
			$message['msg'] = 'OTP send successfully on your phone.';
			echo json_encode($message);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


// code for download document

function download_document($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->otp) && $request->otp!='')
	{
		global $con;
		$otp = mysqli_real_escape_string($con, $request->otp);
		
		$check = mysqli_query($con, "select id from otp where user_id = '$_SESSION[id]' and otp = '$otp' and otp_type = 'download document' and (type = '1' or type = '2' or type = '3' or type = '4' or type = '5')");
		if(mysqli_num_rows($check)>0)
		{
			$fetch = mysqli_fetch_object($check);
			mysqli_query($con, "delete from otp where id = '$fetch->id'");
			
			
			$message['msg'] = 'Click Download Button.';
			
			echo json_encode($message);
			exit();
		}
		else
		{
			$message['msg'] = 'Invalid OTP.';
			echo json_encode($message);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

// code for delete document

function delete_document($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->otp) && $request->otp!='')
	{
		global $con;
		$call_otp = new otp();
		
		$otp = mysqli_real_escape_string($con, $request->otp);
		
		$check = mysqli_query($con, "select id from otp where user_id = '$_SESSION[id]' and otp = '$otp' and otp_type = 'delete document' and (type = '1' or type = '2' or type = '3' or type = '4' or type = '5')");
		if(mysqli_num_rows($check)>0)
		{
			$fetch = mysqli_fetch_object($check);
			$expiry = $call_otp->check_expiry($fetch->id);
			
			if($expiry > 0)
			{
				mysqli_query($con, "delete from otp where id = '$fetch->id'");
				
				$message['msg'] = 'Click Delete Button.';
				echo json_encode($message);
				exit();
			}
			else
			{
				$message['msg'] = 'OTP Expire.';
				echo json_encode($message);
				exit();
			}
		}
		else
		{
			$message['msg'] = 'Invalid OTP.';
			echo json_encode($message);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}
// code for cancel apppointment

function cancel_appointment($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->otp) && $request->otp!='')
	{
		global $con;
		$call_otp = new otp();
		
		$otp = mysqli_real_escape_string($con, $request->otp);
		
		$check = mysqli_query($con, "select id from otp where user_id = '$_SESSION[id]' and otp = '$otp' and otp_type = 'cancel apppointment' and (type = '1' or type = '2' or type = '3' or type = '4' or type = '5')");
		if(mysqli_num_rows($check)>0)
		{
			$fetch = mysqli_fetch_object($check);
			$expiry = $call_otp->check_expiry($fetch->id);
			
			if($expiry > 0)
			{
				mysqli_query($con, "delete from otp where id = '$fetch->id'");
				
				$message['msg'] = 'Click Cancel Button.';
				echo json_encode($message);
				exit();
			}
			else
			{
				$message['msg'] = 'OTP Expire.';
				echo json_encode($message);
				exit();
			}
		}
		else
		{
			$message['msg'] = 'Invalid OTP.';
			echo json_encode($message);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}
// code for document access

function document_access($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->otp) && $request->otp!='')
	{
		global $con;
		$call_otp = new otp();
		
		$otp = mysqli_real_escape_string($con, $request->otp);
		
		$check = mysqli_query($con, "select id from otp where user_id = '$_SESSION[id]' and otp = '$otp' and otp_type = 'document access' and type = '1'");
		if(mysqli_num_rows($check)>0)
		{
			$fetch = mysqli_fetch_object($check);
			$expiry = $call_otp->check_expiry($fetch->id);
			
			if($expiry > 0)
			{
				mysqli_query($con, "delete from otp where id = '$fetch->id'");
				
				$message['msg'] = 'Click Access Permission Button.';
				
				echo json_encode($message);
				exit();
			}
			else
			{
				$message['msg'] = 'OTP Expire.';
				echo json_encode($message);
				exit();
			}
		}
		else
		{
			$message['msg'] = 'Invalid OTP.';
			echo json_encode($message);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}
// code for disconnect patient

function disconnect_patient($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->otp) && $request->otp!='')
	{
		global $con;
		$call_otp = new otp();
		
		$otp = mysqli_real_escape_string($con, $request->otp);
		
		$check = mysqli_query($con, "select id from otp where user_id = '$_SESSION[id]' and otp = '$otp' and otp_type = 'disconnect patient' and type = '2'");
		if(mysqli_num_rows($check)>0)
		{
			$fetch = mysqli_fetch_object($check);
			$expiry = $call_otp->check_expiry($fetch->id);
			
			if($expiry > 0)
			{
				mysqli_query($con, "delete from otp where id = '$fetch->id'");
				
				$message['msg'] = 'Click Disconnect Button.';
				
				echo json_encode($message);
				exit();
			}
			else
			{
				$message['msg'] = 'OTP Expire.';
				echo json_encode($message);
				exit();
			}
		}
		else
		{
			$message['msg'] = 'Invalid OTP.';
			echo json_encode($message);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
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
	
	/*
	$curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, 'http://www.smsbusiness.in/api.php?username=FourFox&password=48095fc5&sender=Spiral&sendto='.$phone.'&message='.$message);
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

    $jsonData = json_decode(curl_exec($curlSession));
    curl_close($curlSession);
	
	
	echo "cccccccc_____".$jsonData;
	echo "<pre>";
	print_r($jsonData);
	*/
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


function get_doctor_ids($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->id) && $request->id!='')
	{
		global $con;
		$document_id = mysqli_real_escape_string($con, $request->id);
		
		$check = mysqli_query($con, "select doctor_id from sharing_document where document_id = '$document_id'");
		if(mysqli_num_rows($check) > 0)
		{
			$detail = mysqli_fetch_object($check);
			$detail = explode(',', $detail->doctor_id);
			echo json_encode($detail);
			exit();
		}
		else
		{
			$detail = array('none');
			echo json_encode($detail);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function penalty_detail($request)
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($request->id) && $request->id!='')
	{
		global $con;
		$appointment_id = mysqli_real_escape_string($con, $request->id);
		$type 			= mysqli_real_escape_string($con, $request->type);
		
		$check = mysqli_query($con, "select doctor_id from booking_appointment where id = '$appointment_id'");
		if(mysqli_num_rows($check) > 0)
		{
			$result = mysqli_fetch_object($check);
			
			$query = mysqli_query($con, "select * from cancellation_setting where doctor_id = '$result->doctor_id'");
			if(mysqli_num_rows($query) > 0)
			{
				$detail = mysqli_fetch_object($query);
				$detail->case = $type;
				$detail->available = 'Available';
				$detail->appointment_id = $appointment_id;
				echo json_encode($detail);
				exit();
			}
			else
			{
				$detail['available'] = 'Unavailable';
				$detail['case'] = $type;
				$detail['appointment_id'] = $appointment_id;
				echo json_encode($detail);
				exit();
			}
		}
		else
		{
			$detail = array('none');
			echo json_encode($detail);
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function blank()
{
	header("location:../index.php");
	exit();
}
?>