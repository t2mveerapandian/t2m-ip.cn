<?php



include('../common/config.php');

if(isset($_SESSION['id']) &&  $_SESSION['id'] != '' && isset($_SESSION['role']) && $_SESSION['role']!='')
{
	header("location:dashboard.php");
	exit;
}

	

?>

<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

  <meta charset="utf-8" />

  <title><?php echo  $config->company_name; ?> </title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <meta content="" name="description" />

  <meta content="" name="author" />

  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

  <link href="assets/css/metro.css" rel="stylesheet" />

  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

  <link href="assets/css/style.css" rel="stylesheet" />

  <link href="assets/css/style_responsive.css" rel="stylesheet" />

  <link href="assets/css/style_default.css" rel="stylesheet" id="style_color" />

  <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />

  <link rel="shortcut icon" href="favicon.ico" />

 

 

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="login">

  <!-- BEGIN LOGO -->

  <div class="logo">

    <!--<img src="assets/img/logo.png" alt="" > -->
<h3 style="color:#35aa47"><?php echo $config->company_name?></h3>
	

  </div>

  <!-- END LOGO -->

  <!-- BEGIN LOGIN -->

  <div class="content">

    <!-- BEGIN LOGIN FORM -->

    <form class="form-vertical login-form"  name="login-form"  action="<?php echo $config['site_url']; ?>admin/functions/users.php" method="post" >

	   <input type="hidden"  name="action" value="login"/>

      <h3 class="form-title">Login to your account</h3>

      <div class="alert alert-error hide">

        <button class="close" data-dismiss="alert"></button>

        <span>Enter any username and passowrd.</span>

      </div>

	  <?php  if(isset($_SESSION['success']))

								{ 

								?>

								<div class="alert alert-success">

									<button class="close" data-dismiss="alert"></button>

									<strong>Success!</strong> <?php echo $_SESSION['success']; ?>

								</div>

								<?php unset($_SESSION['success']); } ?>

	   <?php  if(isset($_SESSION['message_err']))

								{ 

								?>

                              <div class="alert alert-error">

									<button class="close" data-dismiss="alert"></button>

									<strong>Error!</strong> <?php echo $_SESSION['message_err']; ?>

								</div>

								<?php unset($_SESSION['message_err']); } ?>

      <div class="control-group">

        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

        <label class="control-label visible-ie8 visible-ie9">Username</label>

        <div class="controls">

          <div class="input-icon left">

            <i class="icon-user"></i>

            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" name="username" class="required"/>

          </div>

        </div>

      </div>

      <div class="control-group">

        <label class="control-label visible-ie8 visible-ie9">Password</label>

        <div class="controls">

          <div class="input-icon left">

            <i class="icon-lock"></i>

            <input class="m-wrap placeholder-no-fix" type="password" placeholder="Password" name="password" class="required"/>

          </div>

        </div>

      </div>

      <div class="form-actions">

       

        <button type="submit" class="btn green pull-right">

        Login <i class="m-icon-swapright m-icon-white" ></i>

        </button>            

      </div>

      <div class="forget-password" id="forgot">

        <h4>Forgot your username/password ?</h4>

        <p>

          no worries, click <a href="javascript:;" class="" id="forget-password">here</a>

          to reset your password.

        </p>

      </div>

      <!--div class="create-account">

        <p>

          Don't have an account yet ?&nbsp; 

          <a href="javascript:;" id="register-btn" class="">Create an account</a>

        </p>

      </div-->

    </form>

    <!-- END LOGIN FORM -->        

    <!-- BEGIN FORGOT PASSWORD FORM -->

    <form class="form-vertical forget-form" name="forget-form"  method="post" action="<?php echo  $config['site_url']; ?>admin/functions/users.php">

	 <input type="hidden"  name="action" value="forget_password"/>

      <h3 class="">Forget UserName/Password ?</h3>

      <p>Enter your e-mail address below to reset your password.</p>

	  

      <div class="control-group">

        <div class="controls">

          <div class="input-icon left">

            <i class="icon-envelope"></i>

            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email" />

          </div>

        </div>

      </div>

      <div class="form-actions">

        <button type="button" id="back-btn" class="btn">

        <i class="m-icon-swapleft"></i> Back

        </button>

        <button type="submit" class="btn green pull-right">

        Submit <i class="m-icon-swapright m-icon-white"></i>

        </button>            

      </div>

    </form>

    <!-- END FORGOT PASSWORD FORM -->

    <!-- BEGIN REGISTRATION FORM -->

    

    <!-- END REGISTRATION FORM -->

  </div>

  <!-- END LOGIN -->

  <!-- BEGIN COPYRIGHT -->

  <div class="copyright">

    <?php echo $config['copyright']; ?>

  </div>

  <!-- END COPYRIGHT -->

  <!-- BEGIN JAVASCRIPTS -->

   <script src="assets/js/jquery-1.8.3.min.js"></script>

  <script src="assets/bootstrap/js/bootstrap.min.js"></script>  

  <script src="assets/uniform/jquery.uniform.min.js"></script> 

  <script src="assets/js/jquery.blockui.js"></script>

  <script type="text/javascript" src="assets/jquery-validation/dist/jquery.validate.min.js"></script>

  <script src="assets/js/app.js"></script>

  <script>

    jQuery(document).ready(function() {     

      App.initLogin();

    });

  </script>

  <!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>