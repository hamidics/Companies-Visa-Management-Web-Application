<?PHP
require_once("../library/db.php");
session_start();
include("check_login.php");
 login();
header('Content-type: images');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 15 Jul 2000 05:00:00 GMT");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Expires" CONTENT="-1">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>هرات هاست</title>
	<meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index,follow" />
	<link rel="stylesheet" type="text/css" media="all" href="css/calendar.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
	<link rel="Stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.1.custom.css"  />	
	<!--[if IE 7]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
	<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen, projection" /><![endif]-->
	
	<link rel="stylesheet" type="text/css" href="markitup/skins/markitup/style.css" />
	<link rel="stylesheet" type="text/css" href="markitup/sets/default/style.css" />
	<link rel="stylesheet" type="text/css" href="css/superfish.css" media="screen">

	<script type="text/javascript" language="JavaScript" src="js/JsFarsiCalendar.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/slide.js"></script>
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>

	<script type="text/javascript" src="js/hoverIntent.js"></script>
	<script type="text/javascript" src="js/superfish.js"></script>
	<link rel="stylesheet" type="text/css" href="js/validation/validationEngine.jquery.css" media="screen">
	<script type="text/javascript" src="js/validation/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="js/validation/jquery.validationEngine-en.js"></script>
	<script src="js/jquery.easy-confirm-dialog.js"></script>
	
<SCRIPT>
            jQuery(document).ready(function(){
                // binds form submission and fields to the validation engine
                jQuery("#myform").validationEngine();
            });

</SCRIPT>
	<script type="text/javascript">
		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});

	</script>
	<script type="text/javascript">
	$(function() {
		$(".confirm").easyconfirm();
		$("#alert").click(function() {
		
		});
	});
	</script>
	<script type="text/javascript" src="js/excanvas.pack.js"></script>
	<script type="text/javascript" src="js/jquery.flot.pack.js"></script>
    <script type="text/javascript" src="js/markitup/jquery.markitup.pack.js"></script>
	<script type="text/javascript" src="js/markitup/sets/default/set.js"></script>
  	<script type="text/javascript" src="js/custom.js"></script>
</head>
<body>

<div class="container" id="container">
    <div  id="header">
    	<div align="right" id="profile_info">
		    <img src="img/avatar.jpg" id="avatar" alt="avatar" align="right"/>
			<p align="right"><strong> خوش آمدید: </strong><?php echo $_SESSION['user_name']; ?>. <a href="homepage.php?logout=logout">خروج</a></p>
			
			
		</div>
		
		<div> <img src="img/logo.jpg" /></div>
		<div  id="header">
    	<div align="center" id="profile_info" style="width:954px; height:130px; margin-top:-4px">
		    <img src="img/3.jpg" id="avatar" alt="avatar" align="center"/>
		</div>
		
    </div><!-- end header -->