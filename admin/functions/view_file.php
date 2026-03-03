<?php
session_start();date_default_timezone_set('America/Los_Angeles');
require "db.php";
require "class.otp.php";

//ini_set('max_allowed_packet', '64M');
//ini_set('innodb_log_file_size', '64M');
//ini_set('innodb_lock_wait_timeout', 600); 

// check action is set or not if set go to the switch function otherwise go the index page

if(isset($_GET['action']) && $_GET['action']!='')
{
	$action = $_GET['action'];
}

else
{
	header("location:../index.php");
	exit();
}	


switch($action)
{
	case 'view_file' : view_file();
							   break;
	
	default : 		blank();
}


// code view file

function view_file()
{
	if(isset($_SESSION['id']) && $_SESSION['id']!='' && isset($_GET['id']) && is_numeric($_GET['id']))
	{
		global $con;
		$id = mysqli_real_escape_string($con, $_GET['id']);
		$pid = mysqli_real_escape_string($con, $_GET['patient_id']);
		
		if(isset($_GET['type']) && $_GET['type']=='patient_document')
		{
			$query = "select document_name, document_data from document_detail where id = '$id' and (patient_id = '$_SESSION[id]' or patient_id='$pid') and status = '1'";
		}
		elseif(isset($_GET['type']) && $_GET['type']=='doctor_document')
		{
			$query = "select document_name, document_data from doctor_document where id = '$id' and doctor_id = '$_SESSION[id]'";
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


function blank()
{
	header("location:../index.php");
	exit();
}
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
/*$(document).ready(function(e){
	$('.share').click(function(e){
		var share_id = $(this).attr('data');
		$('.sid').val(share_id);
	});
});*/
$(document).ready(function(e){alert("sssssss");
	$('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
	$("body").on("contextmenu",function(e){
        return false;
    });
	
});

$.ctrl = function(key, callback, args) {
    var isCtrl = false;
    $(document).keydown(function(e) {
        if(!args) args=[]; // IE barks when args is null
        
        if(e.ctrlKey) isCtrl = true;
        if(e.keyCode == key.charCodeAt(0) && isCtrl) {
            callback.apply(this, args);
            return false;
        }
    }).keyup(function(e) {
        if(e.ctrlKey) isCtrl = false;
    });        
};

$.ctrl('P', function() {
    alert("Disable Ctrl Key.");
});

window.open("http://localhost/antriksh/site/functions/view_file.php?action=view_file&id=46", "Title", "width=550,height=400,toolbar=0,location=no,directories=no,statusbar=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no");

</script>