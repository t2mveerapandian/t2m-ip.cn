<?php
include_once('config.php') ; 

if(isset($_POST['submit']))
{	
	$name              = addslashes($_POST['name']);
	$email             = $_POST['email'];
	
    // Validate reCAPTCHA box 
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
           
    
    $d = ORM::for_table('sys_contact')->create();
    $d->name = $name; 
    $d->email = $email;
    $d->save();
    
    echo $message = '<p>Hi !</p>
				<p>Name : '.$name.'</p>
				<p>Email-Id : '.$email.'</p>
				';

				$subject = "Enquiry from T-2-M";

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				$headers .= 'From: faiz05rajput@gmail.com' . "\r\n" .
				'Reply-To: faiz05rajput@gmail.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();


				$mail = mail('faiz05rajput@gmail.com', $subject, $message, $headers);
      $_SESSION['message_success'] = 'Thank You for Submitting  your Query';
      header('Location: ../index.php');
    
   // echo '<script language="javascript">';
  //  echo 'alert("Thank You for Submitting  your Query")';
 //   echo '</script>';
    
			
            
           } else{ 
               // echo '<script language="javascript">';
             //   echo 'alert("Captcha code is required.")';
             //   echo '</script>';
             $_SESSION['message_error'] = 'Captcha code is required';
              header('Location: ../index.php');
               }
        }
        
        ?>