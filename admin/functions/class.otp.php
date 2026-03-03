<?php
require "db.php";

class otp
{
	public function send_otp($user_id, $type, $otp, $entity, $otp_type, $date, $status)
	{
		global $con;
		$result = mysqli_query($con, "insert into otp set user_id = '$user_id', type='$type', otp='$otp', entity='$entity', otp_type='$otp_type', date='$date', status='$status'");
		if($result)
			return 1;
		else "Otp not send successfully.";
	}
	
	public function check_expiry($id)
	{
		global $con;
		$query = mysqli_query($con, "select date from otp where id = '$id'");
		$result = mysqli_fetch_object($query);
		
		$timing_difference = time() - $result->date;
		
		if(OTP_TIMING > $timing_difference)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}

?>