<?php
require('../config.php');
$action = $_REQUEST['action'];


// check action

switch($action)
{
	case 'getcityhotels' : getcityhotels();
				   break;
	
	case 'logout' : logout();
					break;
	
	case 'registration' : registration();
					break;
	
				   
	case 'forget_password' : forget_password();
					break;
				   
	
				   
	case 'contact_mail' : 	contact_mail();
								break;
                                
    case 'hotel_login' :     hotel_login();
                                break;                            
	
    case 'hotel_forget_password' :     hotel_forget_password();
                                       break;

				   
	default : 		blank();
}
 code for user edit patient profile

function getcityhotels()
{

}



// code for connect patient to the doctor

function create_connection()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$get_type = mysqli_real_escape_string($con, $_GET['change']);
		
		$change = array('1'=>'pconnect_doctors', '2'=>'pconnect_labs');
		$table = $change[$_GET['change']];
		
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$url = explode('?', $_GET['url']);
		
		$field = array('pconnect_doctors'=>'doctor_id', 'pconnect_labs'=>'lab_id');
								
		$result = mysqli_query($con, "insert into $table set patient_id = '$_SESSION[id]', ".$field[$table]." = '$id', date = ".time().", status = '0'");
		if($result)
		{
			$table 	   = $_SESSION['type'];
			$type 	   = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
			$user 	   = $type[$table];
			
			
			$note = "You have new patient request.";
			notification($_SESSION['id'], $user, $id, $get_type+1, $note, time(), 1);
			
			header("location:".$url[0]."?msg=1&id=$id");
			exit();
		}
		else
		{
			header("location:".$url[0]."?msg=2&id=$id");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

//code for upload documents like prescription, test-report

function upload_document()
{
	if(isset($_POST['type']) && $_POST['type']!='' && isset($_SESSION['id']) && $_SESSION['id']!='')
	{ 
		global $con;
		$type = mysqli_real_escape_string($con, $_POST['type']);
		//$detail = mysqli_real_escape_string($con, $_POST['detail']);
		$illness = mysqli_real_escape_string($con, $_POST['illness']);
		$doctor_name = ucwords(mysqli_real_escape_string($con, $_POST['doctor_name']));
		$document_date = mysqli_real_escape_string($con, $_POST['document_date']);
		list($month, $date, $year) = explode('/', $document_date);
		$document_date = mktime(0, 0, 0, $month, $date, $year);
		$allowed_extension = array('pdf', 'PDF');
		//$file = explode('.', $_FILES['document']['name']);
		$extension = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
		
		
		if($type == 1)
		{
			$clinic_address = mysqli_real_escape_string($con, $_POST['clinic_address']);
			$doctor_phone = mysqli_real_escape_string($con, $_POST['doctor_phone']);
		}
		elseif($type == 2)
		{
			$lab_name = mysqli_real_escape_string($con, $_POST['lab_name']);
			$page_number = mysqli_real_escape_string($con, $_POST['page_number']);
		}
		//echo $_FILES['document']['size']; echo "location:../".$_SESSION['type']."/upload_documents.php?msg=1";die();
		if(in_array($extension, $allowed_extension) && $_FILES['document']['size'] < 1000000)
		{
			$file_temp_name = $_FILES['document']['tmp_name'];
			$handle = fopen($file_temp_name, "rb");
			$contents = fread($handle, filesize($file_temp_name));
			$byteArray = unpack("N*",$contents);
			fclose($handle);
			$serialized_data = serialize($byteArray);
			
			$time = time();
			$filename = md5($time).".".$extension;
			/*
			$upload = move_uploaded_file($_FILES['document']['tmp_name'], '../'.$_SESSION['type'].'/document/'.$_SESSION['id'].'/'.$filename);
			
			
			if($upload)
			{*/
		
				if($type == 1)
				{
					//echo "insert into document_detail set document_type = '$type', patient_id = '$_SESSION[id]', document_name = '$filename', illness = '$illness', doctor_name = '$doctor_name', document_date = '$document_date', doctor_phone = '$doctor_phone', address = '$clinic_address', uploaded_date = ".time().", status = '1', document_data = '$serialized_data'";
					
					$document_detail = mysqli_query($con, "insert into document_detail set document_type = '$type', patient_id = '$_SESSION[id]', document_name = '$filename', illness = '$illness', doctor_name = '$doctor_name', document_date = '$document_date', doctor_phone = '$doctor_phone', address = '$clinic_address', uploaded_date = ".time().", status = '1', document_data = '$serialized_data'");
				}
				elseif($type == 2)
				{
					$document_detail = mysqli_query($con, "insert into document_detail set document_type = '$type', patient_id = '$_SESSION[id]', document_name = '$filename', illness = '$illness', doctor_name = '$doctor_name', document_date = '$document_date', address = '$lab_name', pageno = '$page_number', uploaded_date = ".time().", status = '1', document_data = '$serialized_data'");
				}
				//echo $serialized_data; echo "<br/>".$upload;echo "<br/>".$document_detail;
				//die();
					
				if($document_detail)
				{
					$query = mysqli_query($con, "select first_name, email, mobile_number from ".$_SESSION['type']." where id = '".$_SESSION['id']."'");
					$user = mysqli_fetch_object($query);
					
					// send successful message on the phone
					
					$message = "Your%20document%20Uploaded%20Successfully.";	
					send_sms($message, $user->mobile_number);
					
					// send successful message on the email
					
					$message = '<p>Hi '.$user->first_name.'!</p>
								<p>Your document Uploaded Successfully.</p>
								';	
					
					$subject = "Upload Document";
					
					send_email($user->email, $user->first_name, $message, $subject, $user->email);
					
					header("location:../".$_SESSION['type']."/upload_documents.php?msg=2");
					exit();
				}
				else
				{
					header("location:../".$_SESSION['type']."/upload_documents.php?msg=3");
					exit();
				}
			/*}
			else
			{
				header("location:../".$_SESSION['type']."/upload_documents.php?msg=4");
				exit();
			}*/
		}
		else
		{
			header("location:../".$_SESSION['type']."/upload_documents.php?msg=1");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
} 


//code for upload documents like prescription, test-report

function edit_upload_document()
{
	if(isset($_POST['type']) && $_POST['type']!='' && isset($_SESSION['id']) && $_SESSION['id']!='' && is_numeric($_POST['edit_document']))
	{ 
		global $con;
		$id = mysqli_real_escape_string($con, $_POST['edit_document']);
		$type = mysqli_real_escape_string($con, $_POST['type']);
		//$detail = mysqli_real_escape_string($con, $_POST['detail']);
		$illness = mysqli_real_escape_string($con, $_POST['illness']);
		$doctor_name = ucwords(mysqli_real_escape_string($con, $_POST['doctor_name']));
		$document_date = mysqli_real_escape_string($con, $_POST['document_date']);
		list($month, $date, $year) = explode('/', $document_date);
		$document_date = mktime(0, 0, 0, $month, $date, $year);
		$allowed_extension = array('pdf', 'PDF');
		//$file = explode('.', $_FILES['document']['name']);
		$extension = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
		
		
		if($type == 1)
		{
			$clinic_address = mysqli_real_escape_string($con, $_POST['clinic_address']);
			$doctor_phone = mysqli_real_escape_string($con, $_POST['doctor_phone']);
		}
		elseif($type == 2)
		{
			$lab_name = mysqli_real_escape_string($con, $_POST['lab_name']);
			$page_number = mysqli_real_escape_string($con, $_POST['page_number']);
		}
		
		$check = mysqli_query($con, "select id, document_data, document_name from document_detail where id = '$id'");
		if(mysqli_num_rows($check) > 0)
		{
			if($_FILES['document']['name']=='')
			{
				$result = mysqli_fetch_object($check);
				$serialized_data = $result->document_data;
				$filename = $result->document_name;
				
			}
			elseif($_FILES['document']['name']!='' && in_array($extension, $allowed_extension) && $_FILES['document']['size'] < 1000000)
			{
				$file_temp_name = $_FILES['document']['tmp_name'];
				$handle = fopen($file_temp_name, "rb");
				$contents = fread($handle, filesize($file_temp_name));
				$byteArray = unpack("N*",$contents);
				fclose($handle);
				$serialized_data = serialize($byteArray);
				
				$time = time();
				$filename = md5($time).".".$extension;
				
			}
			else
			{
				header("location:../".$_SESSION['type']."/upload_documents.php?msg=1&id=$id");
				exit();
			}
			if($type == 1)
			{
				$document_detail = mysqli_query($con, "update document_detail set document_type = '$type', document_name = '$filename', illness = '$illness', doctor_name = '$doctor_name', document_date = '$document_date', doctor_phone = '$doctor_phone', address = '$clinic_address', uploaded_date = ".time().", status = '1', document_data = '$serialized_data' where id='$id'");
			}
			elseif($type == 2)
			{
				$document_detail = mysqli_query($con, "update document_detail set document_type = '$type', document_name = '$filename', illness = '$illness', doctor_name = '$doctor_name', document_date = '$document_date', address = '$lab_name', pageno = '$page_number', uploaded_date = ".time().", status = '1', document_data = '$serialized_data' where id='$id'");
			}
					
			if($document_detail)
			{
				$query = mysqli_query($con, "select first_name, email, mobile_number from ".$_SESSION['type']." where id = '".$_SESSION['id']."'");
				$user = mysqli_fetch_object($query);
				
				// send successful message on the phone
				
				$message = "Your%20document%20Updated%20Successfully.";	
				send_sms($message, $user->mobile_number);
				
				// send successful message on the email
				
				$message = '<p>Hi '.$user->first_name.'!</p>
							<p>Your document Updated Successfully.</p>
							';	
				
				$subject = "Updated Document";
				
				send_email($user->email, $user->first_name, $message, $subject, $user->email);
				
				header("location:../".$_SESSION['type']."/view_documents.php?msg=7");
				exit();
			}
			else
			{
				header("location:../".$_SESSION['type']."/upload_documents.php?msg=3");
				exit();
			}
		}
		else
		{
			header("location:../".$_SESSION['type']."/upload_documents.php?msg=3");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
} 

// code download file

function view_file()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$result= mysqli_query($con, "select document_name, document_data from document_detail where id = '$id' and patient_id = '$_SESSION[id]' and status = '1'");
		if($result)
		{
			$fetch = mysqli_fetch_assoc($result);
			
			$unserialized_data =  unserialize($fetch['document_data']);
			$fp = fopen($fetch['document_name'], 'w');
			
			function fwrite_stream($fp, $string) {
				for ($written = 0; $written < strlen($string); $written += $fwrite) {
					$fwrite = fwrite($fp, substr($string, $written));
					if ($fwrite === false) {
						return $written;
					}
				}
				return $written;
			}
			
			foreach($unserialized_data as $key=>$value)
			{ 
				$value = pack("N*", $value);
				
				fwrite_stream($fp, $value);
			}
			fclose($fp);
			
			$extension = pathinfo($fetch['document_name'], PATHINFO_EXTENSION);
			
			if($extension == 'png' || $extension == 'PNG' || $extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG')
			{
				header ('Content-Type: image/'.$extension);	
			}
			elseif($extension == 'pdf' || $extension == 'PDF')
			{
				header("Content-type:application/pdf");
				
			}
			

			// It will be called downloaded.pdf
			//header("Content-Disposition:attachment;filename=".$fetch['document_name']);

			// The PDF source is in original.pdf
			readfile($fetch['document_name']);
			unlink($fetch['document_name']);
			
			echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			<script type="text/javascript">
$(document).ready(function () {
    //Disable full page
	window.open("http://localhost/antriksh/site/functions/patient_function.php?action=view_file&id=46", "Title", "width=550,height=400,toolbar=0,location=no,directories=no,statusbar=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no");
    });</script>';
			
			echo "<script type='text/javascript'>window.location='../'.$_SESSION[type].'/view_documents.php?msg=1'</script>";
			exit();
		}
		else
		{
			header("location:../".$_SESSION['type']."/view_documents.php?msg=2");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}
// code download file

function download_document()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && $_SESSION['download-document']==$_GET['id'])
	{
		global $con;
		$id = mysqli_real_escape_string($con, $_GET['id']);
		
		if(isset($_GET['type']) && $_GET['type'] == 'patient')
		{
			$query = "select document_name, document_data from document_detail where id = '$id' and patient_id = '$_SESSION[id]' and status = '1'";
		}
		elseif(isset($_GET['type']) && $_GET['type'] == 'doctor')
		{
			$query = "select document_name, document_data from doctor_document where id = '$id' and doctor_id = '$_SESSION[id]' and (status = '1' or status = '0')";
		}
		
		$result= mysqli_query($con, $query);
		if(mysqli_num_rows($result) > 0)
		{
			$fetch = mysqli_fetch_assoc($result);
			
			$unserialized_data =  unserialize($fetch['document_data']);
			$fp = fopen($fetch['document_name'], 'w');
			function fwrite_stream($fp, $string) {
				for ($written = 0; $written < strlen($string); $written += $fwrite) {
					$fwrite = fwrite($fp, substr($string, $written));
					if ($fwrite === false) {
						return $written;
					}
				}
				return $written;
			}
			
			foreach($unserialized_data as $key=>$value)
			{ 
				$value = pack("N*", $value);
				fwrite_stream($fp, $value);
			}
			fclose($fp);
			
			
			//$file = '../'.$_SESSION['type'].'/document/'.$_SESSION[id].'/'.$fetch['document_name'];
			$file = $fetch['document_name'];
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.$file.'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			
			unlink($file);
			unset($_SESSION['download-document']);
			//header("location:../'.$_SESSION['type'].'/view_documents.php?msg=1");
			echo "<script type='text/javascript'>window.location='../'.$_SESSION[type].'/view_documents.php?msg=1'</script>";
			exit();
		}
		else
		{
			header("location:../".$_SESSION['type']."/view_documents.php?msg=2");
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

function delete_document()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && $_SESSION['delete-document']==$_GET['id'])
	{
		global $con;
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$result = mysqli_query($con, "select document_name from document_detail where id in ($id) and status = '1'");
		if(mysqli_num_rows($result)>0)
		{
			$fetch = mysqli_fetch_assoc($result);
			//unlink('../'.$_SESSION['type'].'/document/'.$fetch['document_name']);
			$delete = mysqli_query($con, "delete from document_detail where id in ($id) and status = '1'");
			if($delete)
			{
				$query = mysqli_query($con, "select first_name, email, mobile_number from ".$_SESSION['type']." where id = '".$_SESSION['id']."'");
				$user = mysqli_fetch_object($query);
				
				// send successful message on the phone
				
				$message = "Your%20Document%20Deleted%20Successfully.";	
				send_sms($message, $user->mobile_number);
				
				// send successful message on the email
				
				$message = '<p>Hi '.$user->first_name.'!</p>
							<p>Your Document Deleted Successfully.</p>
							';	
				
				$subject = "Delete Document";
				
				send_email($user->email, $user->first_name, $message, $subject, $user->email);
				unset($_SESSION['delete-document']);
				header("location:../".$_SESSION['type']."/view_documents.php?msg=4");
				exit();
			}
		}
		else
		{
			header("location:../".$_SESSION['type']."/view_documents.php?msg=3");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

// code for share document to the doctor

function share_document()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$document_id = mysqli_real_escape_string($con, $_POST['sid']);
		foreach($_POST['did'] as $var => $val)
		{
			$doctor_id[$var] = mysqli_real_escape_string($con, $val);
		}
		sort($doctor_id);
		$dids = implode(',', $doctor_id);
		$check = mysqli_query($con, "select doctor_id from sharing_document where document_id = '$document_id' and status = '1'");
		if(mysqli_num_rows($check)>0)
		{
			/*
			$fetch = mysqli_fetch_assoc($check);
			$pre_ids = explode(',', $fetch['doctor_id']);
			$new_ids = array_unique(array_merge($pre_ids, $doctor_id));
			sort($new_ids);
			$dids = implode(',', $new_ids);
			*/
			if(count($_POST['did'])==0)
			{
				$result = mysqli_query($con, "delete from sharing_document where document_id = '$document_id' and status = '1'");
			}
			else
			{
				$result = mysqli_query($con, "update sharing_document set doctor_id = '$dids', sharing_date = ".time()." where document_id = '$document_id' and status = '1'");
			}
			
			if($result)
			{
				header("location:../".$_SESSION['type']."/view_documents.php?msg=8");
				exit();
			}
			else
			{
				header("location:../".$_SESSION['type']."/view_documents.php?msg=6");
				exit();
			}
		}
		else
		{
			$result = mysqli_query($con, "insert into sharing_document set doctor_id = '$dids', document_id = '$document_id', sharing_date = ".time().", status = '1'");
			if($result)
			{  
				header("location:../".$_SESSION['type']."/view_documents.php?msg=5");
				exit();
			}
			else
			{
				header("location:../".$_SESSION['type']."/view_documents.php?msg=6");
				exit();
			}
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


function check_booking()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		
		$check_date = mysqli_real_escape_string($con, $_POST['check_date']);
		$clinic_id = mysqli_real_escape_string($con, $_POST['clinic']);
		$doctor_id = mysqli_real_escape_string($con, $_POST['did']);
		
		list($month, $date, $year) = explode('/', $check_date);
		$check_date1 = mktime(0, 0, 1, $month, $date, $year);
		
		$mydate = getdate(date("U", $check_date1));
		
		
		
		
		$book_time = mysqli_query($con, "select appointment_time, appointment_date, payment_status from booking_appointment where patient_id = '$_SESSION[id]' and doctor_id = '$doctor_id' and appointment_date ='$check_date1'");
		if(mysqli_num_rows($book_time)>0)
		{
			$book =array();
			$payment =array();
			while($fetch_book_time = mysqli_fetch_object($book_time))
			{
				$book_date = date('m/d/Y', $fetch_book_time->appointment_date);
				if($check_date == $book_date)
				{
					array_push($book, $fetch_book_time->appointment_time);
					array_push($payment, $fetch_book_time->payment_status);
				}
			}
		}
		
		$timing = mysqli_query($con, "select * from doctor_availability where doctor_id = '$doctor_id' and clinic_id = '$clinic_id' and working_days = '$mydate[weekday]'");
		if(mysqli_num_rows($timing)>0)
		{
			$item = mysqli_num_rows($timing);
			$time_slot = array();
			while($fetch = mysqli_fetch_object($timing))
			{
				$starttime = $fetch->working_start_hours;  // your start time
				$endtime = $fetch->working_end_hours;  // End time
				$duration = '30';  // split by 30 mins

				$start_time    = strtotime($starttime); //change to strtotime
				$end_time      = strtotime($endtime); //change to strtotime

				$add_mins  = $duration * 60;

				while($start_time < $end_time) // loop between time
				{
				   array_push($time_slot, date("g:i A", $start_time));
				   $start_time += $add_mins; // to check endtime
				}
			}
			sort($time_slot);
			array_unique($time_slot);
			//echo "<pre>";print_r($time_slot);
			//echo "<pre>";print_r($book);
			//echo "<pre>";print_r($payment);
			
			$detail = array();
			if(count($book)>0)
			{
				foreach($time_slot as $prop=>$value)
				{
					if(in_array($value, $book))
					{
						foreach($book as $key=>$val)
						{
							if($val == $value)
							{
								array_push($detail, $value."__".$payment[$key]);
								
								if(($array_key = array_search($value."__0", $detail)) !== false && array_search($value."__1", $detail)) {
									unset($detail[$array_key]);
								}
							}
						}
					}
					else
					{
						array_push($detail, $value."__2");
					}
				}
			}
			else
			{
				foreach($time_slot as $prop=>$value)
				{
					array_push($detail, $value."__2");
				}
			}
			$data = serialize($detail);
		}
		else
		{
			$data = 1;
		}
		
		header("location:../patients/book_appointment.php?id=$doctor_id&cid=$clinic_id&date=$check_date&result=".$data);
		
		exit();
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


// code for booking appointment

function book_appointment()
{
	// check data is set or not in the post if it's not set go the home page
	
		
	if(isset($_POST['date']) && $_POST['date']!='' && isset($_POST['did']) && $_POST['did']!='')
	{
		if(isset($_POST['timeslot']) && $_POST['timeslot']!='')
		{
			global $con;
			
			// prevent post data for sql injection
			
			$check_date 	= mysqli_real_escape_string($con, $_POST['date']);
			$timeslot 		= mysqli_real_escape_string($con, $_POST['timeslot']);
			$reason 		= mysqli_real_escape_string($con, $_POST['comment']);
			$patient_id 	= $_SESSION['id'];
			$doctor_id 		= mysqli_real_escape_string($con, $_POST['did']);
			$payment 		= mysqli_real_escape_string($con, $_POST['payment']);
			
			// create appointment time in the time format
			
			list($month, $date, $year) = explode('/', $check_date);
			$appointment_date = mktime(0, 0, 1, $month, $date, $year);
			
			
			// insert data into the database
			if($payment == 'Yes')
			{
				$payment_status = 1;
			}
			else
			{
				$payment_status = 0;
				
				$query = mysqli_query($con, "select id from booking_appointment where doctor_id = '$doctor_id' and appointment_time = '$timeslot' and appointment_date = '$appointment_date' and status='1'");
				if(mysqli_num_rows($query)>0)
				{
					header("location:../".$_SESSION['type']."/book_appointment.php?id=".$doctor_id."&msg=5&status=info");
					exit();
				}
			}
			
			$result = mysqli_query($con, "insert into booking_appointment set patient_id = '$patient_id', doctor_id = '$doctor_id', payment_status = '$payment_status', appointment_time = '$timeslot', appointment_date = '$appointment_date', reason = '$reason', booking_date = '".time()."', status = '1'");
			
			// if query execute successfully shows successful message otherwise shows error message on the relevant page
			
			if($result)
			{
				$query = mysqli_query($con, "select email, first_name, mobile_number from patients where id = ".$_SESSION['id']." and (status = '1' or status = '2')");
				
				$user = mysqli_fetch_object($query);
				
				// send successful message on the phone
					
				$message = 'Hi%20'.$user->first_name.'%20Your%20Appointment%20book%20with%20Mr/Mrs%20.%20Appointment%20Date%20:%20'.$check_date.'%20Appointment%20Time%20:%20'.$timeslot.'.';
							
				send_sms($message, $user->mobile_number);
						
				// send successful message on the email
				$message = '<p>Hi '.$user->first_name.'!</p>
							<p>Your Appointment book with Mr/Mrs .</p>
							<p>Appointment Date : '.$check_date.'</p>
							<p>Appointment Time : '.$timeslot.'</p>
							<p>Please wait for the approval.</p>
							';	
					
				$subject = "Appointment Booking";
				
				send_email($user->email, $user->first_name, $message, $subject, $user->email);
				
				$table 	   = $_SESSION['type'];
				$type 	   = array('patients'=>'1', 'doctors'=>'2', 'clinics'=>'3', 'labs'=>'4', 'pharmacy'=>'5');
				$user 	   = $type[$table];
				
				$note = "Your have new appointment booking.";
				notification($_SESSION['id'], $user, $doctor_id, 2, $note, time(), 1);
				
				
				header("location:../".$_SESSION['type']."/book_appointment.php?id=".$doctor_id."&msg=1&status=success");
				exit();
			}
			else
			{
				header("location:../".$_SESSION['type']."/book_appointment.php?id=".$doctor_id."&msg=2&status=error");
				exit();
			}
		}
		else
		{
			header("location:../".$_SESSION['type']."/book_appointment.php?id=".$doctor_id."&msg=4&status=danger");
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

function document_access()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$doctor_id = $_SESSION['document-access'];
		$result = mysqli_query($con, "select id, document_access from pconnect_doctors where patient_id = '$_SESSION[id]' and doctor_id = '$doctor_id' and status = '1'");
		if(mysqli_num_rows($result)>0)
		{
			$fetch = mysqli_fetch_object($result);
			if($fetch->document_access == 1)
			{
				$permission = 0;
				$access = 'Deny';
			}
			elseif($fetch->document_access == 0)
			{
				$permission = 1;
				$access = 'Grant';
			}
			$query = mysqli_query($con, "update pconnect_doctors set document_access = '$permission' where id = '$fetch->id'");
			if($query)
			{
				$result = mysqli_query($con, "select email, first_name, mobile_number from patients where id = ".$_SESSION['id']." and (status = '1' or status = '2')");
				
				$user = mysqli_fetch_object($result);
				
				// send message on phone
				
				$message = 'Hi%20'.$user->first_name.'.!%20'.$access.'%20Access%20Permission%20Successfully.';
							
				send_sms($message, $user->mobile_number);
				
				// send message on email
				
				$message = '<p>Hi '.$user->first_name.'!</p>
							<p>'.$access.' Access Permission Successfully.</p>
							';	
					
				$subject = "Access Permission";
				
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
							<p>'.$access.' Access Permission Successfully.</p>
							';
				
				$mail->Subject = "Access Permission"; //Subject od your mail
				$mail->AddAddress($user->email, ""); //To address who will receive this email
				$mail->MsgHTML(trim($content)); //Put your body of the message you can place html code here

				$send = $mail->Send();
				*/
				
				// send sms on phone
				
				header("location:../".$_SESSION['type']."/connected_doctor.php?msg=4");
				exit();
			}
		}
		else
		{
			header("location:../".$_SESSION['type']."/connected_doctor.php?msg=11");
			exit();
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}


// code for patient feedback to the doctor

function feedback()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		global $con;
		$doctor_id = mysqli_real_escape_string($con, $_POST['id']);
		$user_type = mysqli_real_escape_string($con, $_POST['user_type']);
		$points    = mysqli_real_escape_string($con, $_POST['points']);
		$comment    = mysqli_real_escape_string($con, $_POST['comment']);
		$check = mysqli_query($con, "select id from reviews where patient_id = '$_SESSION[id]' and user_id='$doctor_id' and usertype='$user_type' and status = '1'");
		if(mysqli_num_rows($check)>0)
		{
			header("location:../".$_SESSION['type']."/cancel_appointment.php?msg=3");
			exit();
		}
		else
		{
			$result = mysqli_query($con, "insert into reviews set patient_id = '$_SESSION[id]', user_id='$doctor_id', usertype='$user_type', review='$comment', review_points='$points', review_date='".time()."', status = '0'");
			if($result)
			{  
				header("location:../".$_SESSION['type']."/cancel_appointment.php?msg=4");
				exit();
			}
			else
			{
				header("location:../".$_SESSION['type']."/cancel_appointment.php?msg=2");
				exit();
			}
		}
	}
	else
	{
		header("location:../index.php");
		exit();
	}
}

// code for cancel appointment to the doctor


function cancel_appointment()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($_GET['id']) && $_GET['id']!='' && $_SESSION['cancel-apppointment']==$_GET['id'])
	{
		global $con;
		$appointment_id = mysqli_real_escape_string($con, $_GET['id']);
		
		$check = mysqli_query($con, "select * from booking_appointment where patient_id = '$_SESSION[id]' and id='$appointment_id'");
		if(mysqli_num_rows($check)>0)
		{
			$booking = mysqli_fetch_object($check);
			if($booking->payment_status == 0)
			{
				mysqli_query($con, "update booking_appointment set status = '5' where id = '$appointment_id'");
				header("location:../".$_SESSION['type']."/appointment_history.php?&msg=5&status=success");
				exit();
			}
			else
			{
				mysqli_query($con, "update booking_appointment set status = '5' where id = '$appointment_id'");
				
				$timeslotArr = explode(" ",$booking->appointment_time);
				$AM = trim($timeslotArr[1]);
				$hourminArr = explode(":",$timeslotArr[0] );
				$hour = $hourminArr[0];
				$min = $hourminArr[1];
				
				if($AM == 'PM')
				{
				  $hour = $hour + 12 ;
				}
				
				$cuurtime = time();
				$exactappointmenttime =  ($hour *3600 ) +  ($min * 60 ) + $booking->appointment_date;
												
				$difference = $exactappointmenttime - $cuurtime  ;
				
				
				// before 2 days
				 
				 if($difference > 172800 )
				 {
				   $case  = 'case1' ;
				 }
				 else if($difference > 86400 )
				 {
					 $case  = 'case2' ;
				 }
				  else if($difference > 14400 )
				 {
					 $case  = 'case3' ;
				 }
				 else
				 {
				   $case  = 'case4' ;
				 }
				 
				 mysqli_query($con, "insert into cancel_appointment set appointment_id = '$appointment_id' ,patient_id='$_SESSION[id]', doctor_id='$booking->doctor_id', cancellation_time ='$cuurtime', cancel_by='PT' ,cancellation_case ='$case'");
				 
				$query1 = mysqli_query($con, "select email, first_name, mobile_number from patients where id = ".$_SESSION['id']." and (status = '1' or status = '2')");
				
				$patient = mysqli_fetch_object($query1);
				 
				$query2 = mysqli_query($con, "select email, first_name, mobile_number from doctors where id = ".$booking->doctor_id." and (status = '1' or status = '2')");
				
				$doctor = mysqli_fetch_object($query2);
				
				// send successful message on the phone to the patient
					
				$message = 'Hi%20'.$patient->first_name.'.%20Your%20Appointment%20Cancelled%20Successfully.';
							
				send_sms($message, $patient->mobile_number);
						
				// send successful message on the email to the patient
				$message = '<p>Hi '.$patient->first_name.'!</p>
							<p>Your Appointment Cancelled Successfully.</p>
							<p>Date :'.date('d-m-Y', $booking->appointment_date).'.</p>
							<p>Time :'.$booking->appointment_time.'.</p>
							';	
					
				$subject = "Cancel Appointment";
				
				send_email($patient->email, $patient->first_name, $message, $subject, $patient->email);
				
				// send successful message on the phone to the doctor
					
				$message = 'Hi%20'.$doctor->first_name.'.%20Your%20Appointment%20Cancel%20by%20'.$patient->first_name.'.';
							
				send_sms($message, $doctor->mobile_number);
						
				// send successful message on the email to the doctor
				$message = '<p>Hi '.$doctor->first_name.'!</p>
							<p>Your Appointment Cancel by '.$patient->first_name.'.</p>
							<p>Date :'.date('d-m-Y', $booking->appointment_date).'.</p>
							<p>Time :'.$booking->appointment_time.'.</p>
							';	
					
				$subject = "Cancel Appointment";
				
				send_email($doctor->email, $doctor->first_name, $message, $subject, $doctor->email);
				
				
				 
				 
				unset($_SESSION['cancel-apppointment']); 
				header("location:../".$_SESSION['type']."/appointment_history.php?&msg=5&status=success");
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


function notification($user_id, $user_type, $suser_id, $suser_type, $message, $date, $status)
{
	global $con;
	$result = mysqli_query($con, "insert into notification set user_id = '$user_id' , user_type = '$user_type', suser_id = '$suser_id' , suser_type = '$suser_type', message = '$message', date = '$date', status = '$status'");
	if($result)
		return 1;
}

function blank()
{
	header("location:../index.php");
	exit();
}
?>