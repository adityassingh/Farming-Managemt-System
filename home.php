<!DOCTYPE html>
<?php 
if (isset($_POST['sendmessage'])) {
	# code...
	$name = $_POST['Name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];

	if (empty($name)|| empty($email) || empty($phone) || empty($message)) {
		# code...
		if (strlen($phone)<10 || strlen($phone)>10) {
			# code...
			header('Location:home.php?error=Invalid Input');

			exit();
		}
		else
		{
require "mailer/src/PHPMailer.php";
require "mailer/src/OAuth.php";
require "mailer/src/SMTP.php";
require "mailer/src/POP3.php";
require "mailer/src/Exception.php";

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'sammyhack90@gmail.com';                     // SMTP username
    $mail->Password   = '#@$#code121';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('sammyhack90@gmail.com', 'Farming Management');
    $mail->addAddress($email, $name);     // Add a recipient
              // Name is optional
    $mail->addReplyTo('sammyhack90@gmail.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Activate Your Pixxy Walls Account';
    $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
<!--[if gte mso 9]><xml>
<o:OfficeDocumentSettings>
<o:AllowPNG/>
<o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings>
</xml><![endif]-->
<title>Christmas Email template</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0 ">
<meta name="format-detection" content="telephone=no">
<!--[if !mso]><!-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<!--<![endif]-->
<style type="text/css">
body {
    margin: 0 !important;
    padding: 0 !important;
    -webkit-text-size-adjust: 100% !important;
    -ms-text-size-adjust: 100% !important;
    -webkit-font-smoothing: antialiased !important;
}
img {
    border: 0 !important;
    outline: none !important;
}
p {
    Margin: 0px !important;
    Padding: 0px !important;
}
table {
    border-collapse: collapse;
    mso-table-lspace: 0px;
    mso-table-rspace: 0px;
}
td, a, span {
    border-collapse: collapse;
    mso-line-height-rule: exactly;
}
.ExternalClass * {
    line-height: 100%;
}
.em_defaultlink a {
    color: inherit !important;
    text-decoration: none !important;
}
span.MsoHyperlink {
    mso-style-priority: 99;
    color: inherit;
}
span.MsoHyperlinkFollowed {
    mso-style-priority: 99;
    color: inherit;
}
 @media only screen and (min-width:481px) and (max-width:699px) {
.em_main_table {
    width: 100% !important;
}
.em_wrapper {
    width: 100% !important;
}
.em_hide {
    display: none !important;
}
.em_img {
    width: 100% !important;
    height: auto !important;
}
.em_h20 {
    height: 20px !important;
}
.em_padd {
    padding: 20px 10px !important;
}
}
@media screen and (max-width: 480px) {
.em_main_table {
    width: 100% !important;
}
.em_wrapper {
    width: 100% !important;
}
.em_hide {
    display: none !important;
}
.em_img {
    width: 100% !important;
    height: auto !important;
}
.em_h20 {
    height: 20px !important;
}
.em_padd {
    padding: 20px 10px !important;
}
.em_text1 {
    font-size: 16px !important;
    line-height: 24px !important;
}
u + .em_body .em_full_wrap {
    width: 100% !important;
    width: 100vw !important;
}
}
</style>
</head>

<body class="em_body" style="margin:0px; padding:0px;" bgcolor="#efefef">
<table class="em_full_wrap" valign="top" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef" align="center">
  <tbody><tr>
    <td valign="top" align="center"><table class="em_main_table" style="width:700px;" width="700" cellspacing="0" cellpadding="0" border="0" align="center">
        <!--Header section-->
        <tbody><tr>
          <td style="padding:15px;" class="em_padd" valign="top" bgcolor="#f6f7f8" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody>
            </tbody></table></td>
        </tr>
        <!--//Header section-->
        <!--Banner section-->
        <tr>
          <td valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>
                <td valign="top" align="center"><img class="em_img" alt="merry Christmas" style="display:block; font-family:Arial, sans-serif; font-size:30px; line-height:34px; color:#000000; max-width:700px;" src="https://i.imgur.com/siUH8tJ.jpg" width="700" border="0" height="345"></td>
              </tr>
            </tbody></table></td>
        </tr>
        <!--//Banner section-->
        <!--Content Text Section-->
                 <tr>
          <td style="padding:35px 70px 30px;" class="em_padd" valign="top" bgcolor="#0d1121" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>
                <td style="font-family:Open Sans, Arial, sans-serif; font-size:16px; line-height:30px; color:#ffffff;" valign="top" align="center">Hello</td>
              </tr>
              <tr>
                <td style="font-size:0px; line-height:0px; height:15px;" height="15">&nbsp;</td>
<!--—this is space of 15px to separate two paragraphs ---->
              </tr>
              <tr>
                <td style="font-family:Open Sans, Arial, sans-serif; font-size:18px; line-height:22px; color:#fbeb59; letter-spacing:2px; padding-bottom:12px;" valign="top" align="center">Please Click on the link below we provide to activate your Account on Pixxy Walls</td>
              </tr>

<tr>
                <td style="font-family:Open Sans, Arial, sans-serif; font-size:18px; line-height:22px; color:#fbeb59; text-transform:uppercase; letter-spacing:2px; padding-bottom:12px;" valign="top" align="center"> <center><a href="https://192.168.0.105/dashboard/pexels/confirm.php?token="><button  style="width:120px;height:40px;background-color:teal;border-radius:10px;font-size:16px;text-align:center;color:#fff;text-decoration;none;outline:none;">Activate Account</button></a></center></td>
              </tr>
            </tbody></table></td>
        </tr>

        <!--//Content Text Section-->
        <!--Footer Section-->
        <tr>
          <td style="padding:38px 30px;" class="em_padd" valign="top" bgcolor="#f6f7f8" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody><tr>
                <td style="padding-bottom:16px;" valign="top" align="center"><table cellspacing="0" cellpadding="0" border="0" align="center">
                </table></td>
              </tr>
              <tr>
                <td style="font-family:Open Sans, Arial, sans-serif; font-size:11px; line-height:18px; color:#999999;" valign="top" align="center"><a href="#" target="_blank" style="color:#999999; text-decoration:underline;"> | <a href="#" target="_blank" style="color:#999999; text-decoration:underline;">From Sumit(Developer)-Pixxy Walls</a><br>
                  © 2019 Pixxy Walls. All Rights Reserved.<br></td>
              </tr>
            </tbody></table></td>
        </tr>

      </tbody></table></td>
  </tr>
</tbody></table>
<div class="em_hide" style="white-space: nowrap; display: none; font-size:0px; line-height:0px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
</body></html>';
    $mail->AltBody = 'Message From Farming Management';

    $mail->send();
    
    header('Location:home.php?message=Thanks for Subscribing!');
}
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error:{$mail->ErrorInfo}";
}
		}
	}
	
}

 ?>
<html>
<head>
	<meta name="viewport" content="width=device-width,
	initial-scale=1.0">
	<meta charset="utf-8">
	<title>Website Design</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

	<link rel="stylesheet"  href="home-style.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
	<?php if (isset($_GET['error'])) {
		# code...
		echo '<script>alert("';echo $_GET['error'];echo '");</script>';
	} ?>

	<?php if (isset($_GET['message'])) {
		# code...
		echo '<script>alert("';echo $_GET['message'];echo '");</script>';
	} ?>
	<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<div class="container">
  <a class="navbar-brand" href="#">farmit</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-lg-auto">
      <li class="nav-item ">
        <a class="nav-link" href="#home">home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#Explore">Explore</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#Adventure">Adventure</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#Blog">Blog</a>
    <li class="nav-item">
        <a class="nav-link" href="#Contact">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Index</a>
      </li>
    </ul>
   
  </div>
</div>
</nav>
</header>
	<div class="jumbotron jumbotron-fluid height100p banner" id="home">
  <div class="container h100">
    <div class="contentBox h100">
    	<div>
    		<h1   data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="0">Farmer MAnagement System</h1>
    		<p data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="500">the website to deal with the farmer surplus production and the efforts to motivate the farmers to grow more crops via use of many resourses that can be used by the farmers in many different ways to be maintain further. </p>
    	</div>
    </div>
  </div>
</div>
<section class="sec1" id="Explore">
	<div class="container">
		<div class="row">
			<div class="offset-sm-2 col-sm-8">
				<div class="headerText text-center">
					<h2 data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="0">Explore the World</h2>
					<p data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="0">
						the world is full of chaos and negative thoughts to be maintained in this world all the world sholud be together to maintain this chaous of this and live a happy life here and live happily ever after and the world dgood place to live and continue ourlivelihood to become agood person.
					</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<div class="placeBox" data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="0">
				<div class="imgBx">
					<img src="a.jpg" class="img-fluid">
				</div>
				
			</div>
		</div>

		<div class="col-sm-4">
			<div class="placeBox" data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="500">
				<div class="imgBx">
					<img src="b.jpg" class="img-fluid">
				</div>
				
			</div>
		</div>

		<div class="col-sm-4">
			<div class="placeBox" data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="1000">
				<div class="imgBx">
					<img src="a.jpg" class="img-fluid">
				</div>
				
			</div>
		</div>
	</div>
</section>
<section class="sec2" id="Adventure">
	<div class="container h100">
		<div class="contentBox h100">
			<div>
				<h1 data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="1000">Adventure Is EveryWhere</h1>
				<p data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="1000">
					aadventure is a good thing the good addventurer is a personng who knows how to deal with the ruf condition of the life and behave properklyj adskf fsdak fdf dsf alfds fd f sadf odsfsdof sdf fds fo dosfa sdof odsf osdaf odsfosdf osfof sdaofsdaof osdf sodfosdfosd f.
				</p>
			</div>
		</div>
	</div>
</section>
<section class="blog" id="Blog">
	<div class="container">
		<div class="row">
			<div class="offset-sm-2 col-sm-8 ">
				<div class="headerText text-center">
					<h2 data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="0">Our Latest Post</h2>
					<p data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="0">
						aadventure is a good thing the good addventurer is a personng who knows how to deal with the ruf condition of the life and behave properklyj adskf fsdak fdf dsf alfds fd f sadf odsfsdof sdf fds fo dosfa sdof odsf osdaf odsfosdf osfof sdaofsdaof osdf sodfosdfosd f.
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6"data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="0">
				<div class="blogpost">
					<div class="imgBx">
						<img src="a.jpg" class="img-fluid">
					</div>
					<div class="content">
						<h1 >aadventure is a good thing the good addventurer is a personng </h1>
						<p>the world is full of chaos and negative thoughts to be maintained in this world all the world sholud be together to maintain this chaous of this and live a happy life here and live happily ever after and the world dgood place to live and continue ourlivelihood to become agood person...</p>
						<a href="#" class="btn btnD2">Read More</a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="col-sm-6" data-aos="fade-up"   data-aos-duration="500" data-aos-delay="1000">
				<div class="blogpost">
					<div class="imgBx">
						<img src="a.jpg" class="img-fluid">
					</div>
					<div class="content">
						<h1>aadventure is a good thing the good addventurer is a personng </h1>
						<p>the world is full of chaos and negative thoughts to be maintained in this world all the world sholud be together to maintain this chaous of this and live a happy life here and live happily ever after and the world dgood place to live and continue ourlivelihood to become agood person...</p>
						<a href="#" class="btn btnD2">Read More</a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="col-sm-6" data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="1000">
				<div class="blogpost">
					<div class="imgBx">
						<img src="a.jpg" class="img-fluid">
					</div>
					<div class="content">
						<h1>aadventure is a good thing the good addventurer is a personng </h1>
						<p>the world is full of chaos and negative thoughts to be maintained in this world all the world sholud be together to maintain this chaous of this and live a happy life here and live happily ever after and the world dgood place to live and continue ourlivelihood to become agood person...</p>
						<a href="#" class="btn btnD2">Read More</a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="col-sm-6" data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="1500">
				<div class="blogpost">
					<div class="imgBx">
						<img src="a.jpg" class="img-fluid">
					</div>
					<div class="content">
						<h1>aadventure is a good thing the good addventurer is a personng </h1>
						<p>the world is full of chaos and negative thoughts to be maintained in this world all the world sholud be together to maintain this chaous of this and live a happy life here and live happily ever after and the world dgood place to live and continue ourlivelihood to become agood person...</p>
						<a href="#" class="btn btnD2">Read More</a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="contact" id="Contact">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="headerText text-center">
					<h2 data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="0">Contact Us</h2>
					<p data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="0">the world is full of chaos and negative thoughts to be maintained in this world all the world sholud be together to maintain this chaous of this and live a happy life here and live happily ever after and the world dgood place to live and continue ourlivelihood to become agood person...</p>
				</div>
			</div>
		</div>
		<div class="row lcearfix">
			<div class="offset-sm-2 col-sm-8">
				<form data-aos="fade-up"   data-aos-duration="1000" data-aos-delay="0" action="" method="POST">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="Name" class="form-control">
					</div>
					<div class="form-group">
						<label>Eamil</label>
						<input type="text" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="phone" class="form-control">
					</div>
					<div class="form-group">
						<label>Message</label>
						<textarea class="form-control textarea" name="message"></textarea>
					</div>
					<div class="form-group text-center">
						<button class="btn btnD1" type="submit" name="sendmessage">Send</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</section>
<footer>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ul class="sci">
					<li><a href="#"><i class="fa fa-facebook"> </i></a></li>

						<li><a href="#"><i class="fa fa-twitter"> </i></a></li>

							<li><a href="#"><i class="fa fa-google-plus"> </i></a></li>

								<li><a href="#"><i class="fa fa-linkedin"> </i></a></li>

									<li><a href="#"><i class="fa fa-instagram"> </i></a></li>
					
				</ul>
			<p class="cpryt"> @ Copyright 2019 Nature Template by|Aditya Singh<a href="#"> Online Tutorials</a></p>	
			</div>
		</div>
	</div>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
<script type="text/javascript">
	$(document).scroll(function(){
		$('.navbar').toggleClass('scrolled',$(this).scrollTop() > $('.navbar').height());
	});
</script>
</body>
</html>