<?php include_once "include/header.php";
if(isset($_REQUEST['course']) && $_REQUEST['course']!='')
{
	$course = ORM::for_table('sys_course')->where('course_slug', $_REQUEST['course'])->find_one();
	if(!isset($course->id))
	{
		header("location:index.php");
		exit();
	}
	
	$tutorials = ORM::for_table('sys_tutorial')->where('tutorial_course_id', $course->id)->find_many();
}
else
{
	header("location:index.php");
	exit();
}

function get_course($id)
{
	$course = ORM::for_table('sys_course')->where('id', $id)->find_one();
	return $course->course_title;
}

?>			
			<!-- 
			=============================================
				Theme Inner Banner
			============================================== 
			-->
			<div class="inner-banner">
				<div class="opacity">
					<div class="container">
						<h2><?php echo $course->course_title;?></h2>
						<ul>
							<li><a href="index.php" class="tran3s"><i class="fa fa-home"></i></a></li>
							<li>/</li>
							<li>Courses</li>
						</ul>
					</div> <!-- /.container -->
				</div> <!-- /.opacity -->
			</div> <!-- /.inner-banner -->


			<!-- 
			=============================================
				Course Details
			============================================== 
			-->
			<div class="course-details">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-xs-12">
							<div class="details-wrapper">
								
								<div class="course-info row">
									<div class="col-xs-4">
										<div>
											<i class="flaticon-time"></i>
											<p>Duration</p>
											<b><?php echo $course->course_duration;?></b>
										</div>
									</div>
									<div class="col-xs-4">
										<div>
											<i class="flaticon-bookmark"></i>
											<p>Course Price</p>
											<b><?php echo "INR ".number_format($course->course_price);?></b>
										</div>
									</div>
									<div class="col-xs-4">
										<div>
											<i class="flaticon-star"></i>
											<p><b>4.5</b> (23)</p>
											<ul>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
											</ul>
										</div>
									</div>
								</div> <!-- /.course-info -->
								<!--img src="images/course/29jpg" alt="" width="400" /-->
								<!--
								<p class="p1"><?php echo $course->course_short_description;?></p>
								
								<p class="btn btn-md s-bg-color" data-toggle="modal" data-target="#myModal" style="margin-bottom:20px; color:#fff">Read More</p>
								
								<div id="myModal" class="modal fade" role="dialog">
								  <div class="modal-dialog">

									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Description</h4>
									  </div>
									  <div class="modal-body">
										<p><?php echo $course->course_description;?></p>
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  </div>
									</div>

								  </div>
								</div>
								-->
								
								<div class="row">
									<ul style="margin-bottom:18px;" class="nav nav-tabs">
										<li class="<?php if(!isset($_GET['query_status'])) echo "active";?>"><a data-toggle="tab" href="#overview" aria-expanded="true">Overview</a></li>
										<li class=""><a data-toggle="tab" href="#course-content" aria-expanded="false">Course Content</a></li>
										<li class=""><a data-toggle="tab" href="#trainer-profile" aria-expanded="false">Trainer Profile</a></li>
										<li class=""><a data-toggle="tab" href="#question-answer" aria-expanded="false">Interview Questions &amp; Answer</a></li>
										<li class=""><a data-toggle="tab" href="#blog" aria-expanded="false">Blog</a></li>
										<li class="<?php if(isset($_GET['query_status']) && $_GET['query_status']==1) echo "active";?>"><a data-toggle="tab" href="#register" aria-expanded="false">Register For Online Demo</a></li>
									</ul>

									<div class="tab-content">
										<div id="overview" class="tab-pane fade <?php if(!isset($_GET['query_status'])) echo "active in";?>">
										  <h4>Overview</h4>
										
										  <div class="our-course course-grid popular-course" style="padding-top:10px;padding-left:30px;">
								
										  
										  <div class="row">
										  
										<?php echo $course->course_overview;?>
									 
									<?php
									if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='')
									{
										$check_payment = ORM::for_table('sys_payment')->where(array('user_id'=>$_SESSION['user_id'], 'course_id'=>$course->id, 'payment_status'=>'Paid'))->find_one();
									}	
										if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='' && isset($check_payment->id) && $check_payment->id!='')
										{
											foreach($tutorials as $tutorial)
											{
									?>
											<div class="col-lg-4 col-sm-6 col-xs-6">
											
											<div class="single-course">
												<div class="image-box">
													<a href="session_details.php?course=<?php echo $course->course_slug;?>&sid=<?php echo $tutorial->id ; ?>">	<img src='http://www.automationtraining4u.com/images/course/<?php echo $course->course_filepath;?>' alt='<?php echo $course->course_title;?>'></a>";
												</div>
												<div class="text">
													<!--<div class="image"><img src="images/course/4.jpg" alt=""></div>-->
													<div class="name clearfix">
														<?php if($tutorial->is_free==1)
														{
															echo "<strong class='s-color float-right'>Free</strong>";
														}
														else
														{
															echo "<strong class='s-color float-right'>Paid</strong>";
														}
														?>
													</div>
													<h5><?php echo $tutorial->tutorial_title;?></h5>
													<p><?php echo substr(strip_tags($tutorial->tutorial_short_description), 0, 150)."...";?></p>
													<!--
													<ul class="clearfix">
														<li class="float-left">
															<i class="flaticon-people"></i>
															<a href="#" class="tran3s">2,680</a>
														</li>
														<li class="float-left">
															<i class="flaticon-comments"></i>
															<a href="#" class="tran3s">13</a>
														</li>
														<li class="float-right">
															<i class="flaticon-heart"></i>
															<a href="#" class="tran3s">3</a>
														</li>
													</ul>
													-->
												</div>
											</div>
										</div>
										
									<?php	}
										}
										
										else
										{
										
																		
										
											foreach($tutorials as $tutorial)
											{
									?>		
											<div class="col-lg-4 col-sm-6 col-xs-6">
											<div class="single-course">
												<div class="image-box">
												
												<?php												
												 if($tutorial->is_free==1)
												 {												
												?>
												
												
												<a href="session_details.php?course=<?php echo $course->course_slug;?>&sid=<?php echo $tutorial->id ; ?>">	<img src='http://www.automationtraining4u.com/images/course/<?php echo $course->course_filepath;?>' alt='<?php echo $course->course_title;?>'></a>";
												
												
											<?php } else {?>
											
											<a href="<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='') echo  $config->site_url."checkout.php?course_id=".$course->id ;  else echo $config->site_url."signin.php?course_id=".$course->id; ?>" class="tran3s"><img src='http://www.automationtraining4u.com/images/course/<?php echo $course->course_filepath;?>' alt='<?php echo $course->course_title;?>'></a>
											
																				
											
											 <?php }?>
												
												</div>
												<div class="text">
													<!--<div class="image"><img src="images/course/4.jpg" alt=""></div>-->
													<div class="name clearfix">
														<?php if($tutorial->is_free==1)
														{
															echo "<strong class='s-color float-right'>Free</strong>";
														}
														else
														{
															echo "<strong class='s-color float-right'>Paid</strong>";
														}
														?>
													</div>
													<h5>
													<?php if($tutorial->is_free==1)
														{
														?>
														<a href="session_details.php?course=<?php echo $course->course_slug;?>&sid=<?php echo $tutorial->id ; ?>">	<?php echo $tutorial->tutorial_title;?></a>
														<?php }
														else
														{
															?>
															
															<a href="<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='') echo  $config->site_url."checkout.php?course_id=".$course->id ;  else echo $config->site_url."signin.php?course_id=".$course->id; ?>" class="tran3s"><?php echo $tutorial->tutorial_title;?></a>
													<?php	
														}
													?>
													</h5>
													<p><?php echo substr(strip_tags($tutorial->tutorial_short_description), 0, 150)."...";?></p>
													<!--
													<ul class="clearfix">
														<li class="float-left">
															<i class="flaticon-people"></i>
															<a href="#" class="tran3s">2,680</a>
														</li>
														<li class="float-left">
															<i class="flaticon-comments"></i>
															<a href="#" class="tran3s">13</a>
														</li>
														<li class="float-right">
															<i class="flaticon-heart"></i>
															<a href="#" class="tran3s">3</a>
														</li>
													</ul>
													-->
												</div>
											</div>
										</div>
										
									<?php	
											}
										}
									?>
									</div>
										</div>
										 <!-- /.row -->
								</div>
										<div id="course-content" class="tab-pane fade">
										  <h4>Course Content</h4>
										  <?php echo $course->course_content;?>
										</div>
										<div id="trainer-profile" class="tab-pane fade">
										  <h4>Trainer Profile</h4>
										  <?php echo $course->course_trainer_profile;?>
										</div>
										<div id="question-answer" class="tab-pane fade">
										  <h4>Interview Questions &amp; Answer</h4>
										  <?php echo $course->course_question_answer;?>
										</div>
										<div id="blog" class="tab-pane fade">
										  <h4>Blog</h3>
										  <?php echo $course->course_blog;?>
										</div>
										<div id="register" class="tab-pane fade contact-us-page <?php if(isset($_GET['query_status']) && $_GET['query_status']==1) echo "active in";?>">
										  <h4>Register For Online Demo</h4><br/>
										  	<div class="contact-us-form">
											<?php
												if(isset($_SESSION['success'])) echo "<p class='success'>".$_SESSION['success']."</p>";
												elseif(isset($_SESSION['error'])) echo "<p class='error'>".$_SESSION['error']."</p>";
											?>
											
											<form id="registerDemo" action="<?php echo $config->site_url."common/middleware.php?module=contact&action=query";?>" method="post" class="form-validation" autocomplete="off">
												<div class="row">
													<div class="col-sm-6 col-xs-12">
														<label>Enter Name</label>
														<div class="single-input">
															<input type="text" placeholder="" id="name" name="name" value="<?php if(isset($_SESSION['register']['name']) && $_SESSION['register']['name']!='') echo $_SESSION['register']['name'];?>">
															<span id="name-error" class="error"></span>
														</div> <!-- /.single-input -->
													</div> <!-- /.col- -->
													<div class="col-sm-6 col-xs-12">
														<label>Enter Email-Id</label>
														<div class="single-input">
															<input type="text" placeholder="" id="email" name="email" value="<?php if(isset($_SESSION['register']['email']) && $_SESSION['register']['email']!='') echo $_SESSION['register']['email'];?>">
															<span id="email-error" class="error"></span>
														</div> <!-- /.single-input -->
													</div> <!-- /.col- -->
												</div>	
												<div class="row">
													<div class="col-sm-6 col-xs-12">
														<label>Enter Contact No</label>
														<div class="single-input">
															<input type="text" placeholder="+91" id="phone_number" name="phone_number" maxlength="10" value="<?php if(isset($_SESSION['register']['phone_number']) && $_SESSION['register']['phone_number']!='') echo $_SESSION['register']['phone_number'];?>">
															<span id="phone-number-error" class="error"></span>
														</div> <!-- /.single-input -->
													</div> <!-- /.col- -->
													<div class="col-sm-6 col-xs-12">
														<label>Course</label>
														<div class="single-input">
															<input type="text" placeholder="" id="course" name="course" value="<?php echo $course->course_title;?>" readonly>
															<input type="hidden" placeholder="" name="course_slug" value="<?php echo $course->course_slug;?>" required>
															<span id="course-error" class="error"></span>
														</div> <!-- /.single-input -->
													</div> <!-- /.col- -->
												</div>	
												<div class="row">
													<div class="col-sm-6 col-xs-12">
														<label>Enter Your Message</label>
														<div class="single-input">
															<textarea placeholder="" name="message"><?php if(isset($_SESSION['register']['message']) && $_SESSION['register']['message']!='') echo $_SESSION['register']['message'];?></textarea>
														</div> <!-- /.single-input -->
													</div> <!-- /.col- -->
													<div class="col-sm-6 col-xs-12">
														<label>Captcha Code</label>
														<div class="single-input">
															<img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'>
															
														</div> <!-- /.single-input -->
														
														<label>Enter Captcha Code</label>
														<div class="single-input">
															<input id="captcha_code" name="captcha_code" type="text">
															<span id="captcha-error" class="error"></span>
															<span>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</span>
														</div> <!-- /.single-input -->
													</div> <!-- /.col- -->
												</div> <!-- /.row -->
												<input type="submit" name="submit" value="Submit" class="tran3s p-bg-color">
											</form>
											</div> <!-- /.contact-us-form -->
									
										</div>
									</div>
								</div>
								
								
								

								<!--
								<div class="course-feedback">
									<h3>Students Feedback</h3>
									<div class="feedback-container">
										<ul class="clearfix">
											<li class="float-left">
												<h2>4.9</h2>
												<p>Avarage rating (9)</p>
												<ul>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
												</ul>
											</li>
											<li class="float-left">
												<ul class="clearfix">
													<li>5 Star</li>
													<li><div style="width:77%;"></div></li>
													<li>87%</li>
													<li class="float-right">(5 Reviews)</li>
												</ul>
												<ul class="clearfix">
													<li>4 Star</li>
													<li><div style="width:70%;"></div></li>
													<li>70%</li>
													<li class="float-right">(2 Reviews)</li>
												</ul>
												<ul class="clearfix">
													<li>3 Star</li>
													<li><div style="width:60%;"></div></li>
													<li>32%</li>
													<li class="float-right">(1 Reviews)</li>
												</ul>
												<ul class="clearfix">
													<li>2 Star</li>
													<li><div style="width:45%;"></div></li>
													<li>10%</li>
													<li class="float-right">(1 Reviews)</li>
												</ul>
												<ul class="clearfix">
													<li>1 Star</li>
													<li><div style="width:2%;"></div></li>
													<li>0%</li>
													<li class="float-right">(0 Reviews)</li>
												</ul>
											</li>
										</ul>
									</div>
									<div class="single-review clearfix">
										<img src="images/course/30.jpg" alt="" class="float-left">
										<div class="text float-left">
											<div class="clearfix">
												<div class="float-left">
													<h6>Marie Karles</h6>
													<span>March 8, 2016 - 8:00am</span>
												</div>
												<ul class="float-right">
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
												</ul>
											</div>
											<p>Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium, totamru rem aperiam, eaque ipsa quae ab illo inventore</p>
										</div>
									</div>
									<div class="single-review clearfix">
										<img src="images/course/31.jpg" alt="" class="float-left">
										<div class="text float-left">
											<div class="clearfix">
												<div class="float-left">
													<h6>Jubayer Al Hasan</h6>
													<span>March 8, 2016 - 8:00am</span>
												</div>
												<ul class="float-right">
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
												</ul>
											</div>
											<p>Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium, totamru rem aperiam, eaque ipsa quae ab illo inventore</p>
										</div>
									</div>
									<div class="single-review clearfix">
										<img src="images/course/32.jpg" alt="" class="float-left">
										<div class="text float-left">
											<div class="clearfix">
												<div class="float-left">
													<h6>Rashed Ka.</h6>
													<span>March 8, 2016 - 8:00am</span>
												</div>
												<ul class="float-right">
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
												</ul>
											</div>
											<p>Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium, totamru rem aperiam, eaque ipsa quae ab illo inventore</p>
										</div>
									</div>
								</div>

								<div class="submit-review-form">
									<h3>Submit a Review</h3>
									<p>Your Ratings</p>
									<ul>
										<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
										<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
										<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
										<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
										<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
									</ul>
									<form action="#">
										<div class="row">
											<div class="col-sm-6">
												<label>Your Full Name</label>
												<input type="text" placeholder="Your Name">
											</div>
											<div class="col-sm-6">
												<label>E-mail</label>
												<input type="email" placeholder="sample@gmail.com">
											</div>
										</div>
										<label>Your Message</label>
										<textarea placeholder="Write Commnent..."></textarea>
										<input type="submit" value="Submit Review" class="s-bg-color">
									</form>
								</div>-->
							</div>
						</div>
						
						<!-- ************************* SIDEBAR ***************************** -->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="course-sidebar theme-sidebar">
								<div class="sidebar-course-information">
									<ul class="price clearfix">
										<li class="float-left"><strong class="s-color"><?php echo "INR ".number_format($course->course_price);?></strong></li>
										<li class="float-right"><a href="#" class="tran3s"><i class="flaticon-like"></i></a></li>
									</ul>
									
									<?php
										if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='' && isset($check_payment->id) && $check_payment->id!='')
										{
											echo "<a href='".$config->site_url."common/middleware.php?module=download&action=download&file=".$course->course_code_file."' class='tran3s s-bg-color take-course hvr-trim'><i class='fa fa-download'></i> Download Code</a><br/>";
										}
										else
										{
									?>
									
									<a href="<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='')  echo $config->site_url."checkout.php?course_id=".$course->id ; else echo $config->site_url."signin.php?course_id=".$course->id;?>" class="tran3s s-bg-color take-course hvr-trim">Buy this course</a>
									<?php }?>
									
								</div> <!-- /.sidebar-course-information -->

								<div class="sidebar-categories">
									<h4>Other Courses</h4>
									<ul>
										<?php
											$courses = ORM::for_table('sys_course')->where_not_equal('course_slug', $_REQUEST['course'])->find_many();
											foreach($courses as $course)
											{
												echo "<li><a href='course_details.php?course=".$course->course_slug."' class='tran3s'>".$course->course_title."</a></li>";
											}
										?>
									</ul>
								</div> <!-- /.sidebar-categories -->
							</div> <!-- /.course-sidebar -->
						</div> <!-- /.col- -->
					</div> <!-- /.row -->
				</div> <!-- /.container -->
			</div> <!-- /.our-course -->

			
<?php include_once "include/footer.php";?>
<script type="text/javascript">
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}


	
$('#registerDemo').submit(function(){


    $('#name-error').html('');
	$('#email-error').html('');
	$('#phone-number-error').html('');
	$('#course-error').html('');
	

	var emailRegex = /^[A-Za-z0-9._]*\@[A-Za-z0-9]*\.[A-Za-z]{2,5}$/;
	var alphaExp = /^[0-9a-zA-Z ]+$/;
	var phoneExp = /^[0-9]+$/;
	var name = $('#name').val();
	var email = $('#email').val();
	var phone_number = $('#phone_number').val();
	var course = $('#course').val();
	var captcha_code = $('#captcha_code').val();
	if(name == '')
	{
		$('#name-error').html('Name is required.');
		return false;
	}
	else if(email == '')
	{
		$('#email-error').html('Email-id is required.');
		return false;
	}
	else if(!emailRegex.test(email))
	{
		$('#email-error').html('Please provide valid email-id.');
		return false;
	}
	else if(phone_number=='')
	{
		$('#phone-number-error').html('Phone number is required.');
		return false;
	}
	else if(phone_number.length<10)
	{
		$('#phone-number-error').html('Please provide 10 digit phone number.');
		return false;
	}
	else if(!phoneExp.test(phone_number))
	{
		$('#phone-number-error').html('Please provide valid phone number.');
		return false;
	}
	else if(course=='')
	{
		$('#course-error').html('Course is required.');
		return false;
	}
	else if(captcha_code=='')
	{
		$('#captcha-error').html('Captcha is required.');
		return false;
	}
	else
	{
		return true;
	}
});
</script>