<?php

session_start();
if(isset($_POST['fn']) &&
   isset($_POST['sn']))
  {
    echo<<<_HEAD1
    <html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Multipurpose Saas Startup HTML Template">
        <meta name="author" content="DynamicLayers">
       
        <title>home</title>
        
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
		
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="css/fontawesome.min.css">
        <!-- Themify Icons CSS -->
        <link rel="stylesheet" href="css/themify-icons.css">
        <!-- Elegant Line Icons CSS -->
        <link rel="stylesheet" href="css/elegant-line-icons.css">
        <!-- Elegant Icons CSS -->
        <link rel="stylesheet" href="css/elegant-font-icons.css">
        <!-- Saasbiz Icons CSS -->
        <link rel="stylesheet" href="css/saasbiz-icons.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="css/animate.min.css">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="css/nice-select.css">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Slicknav CSS -->
        <link rel="stylesheet" href="css/slicknav.min.css">
        <!-- Pricing CSS -->
        <link rel="stylesheet" href="css/pricing-table.css">
        <!-- Odometer CSS -->
        <link rel="stylesheet" href="css/odometer.min.css">
        <!-- Venobox CSS -->
        <link rel="stylesheet" href="css/venobox/venobox.css">
		<!-- OWL-Carousel CSS -->
        <link rel="stylesheet" href="css/owl.carousel.css">
		<!-- Main CSS -->
        <link rel="stylesheet" href="css/main.css">
		<!-- Responsive CSS -->
        <link rel="stylesheet" href="css/responsive.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <link href="style/mybasic.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
_HEAD1;
    include 'menuf.php';
    $_SESSION['forname'] = $_POST['fn'];
    $_SESSION['surname'] = $_POST['sn'];
    $smask =  $_SESSION['supmask'];
echo <<<_TAIL1
<div style="display:flex;">
  <div style="width:50%"> 
    <img src="./images/2.png" alt="" style="width:100%;transform: rotate(180deg">
  </div>
  <div style="width:50%"> 
    <div style="text-align:center;font-size: 30px;font-weight: bold;">
      Welcome to Complib Website!
      
    </div>
    <br>

    This website contains compounds from four different manufacturers.
    The ability to select the manufacturer you are looking for by clicking the select suppliers button.
    The ability to click the search of compounds through correlations button.
    Display of compounds by properties through property search button.
    Display of compounds by different manufacturers through properties of manufacturer button.
  </div>
</div>
<div> 
  <div style="text-align:center;font-size: 15px;font-weight: bold;background:#4242e8;color:#fff;width:100%;"> 
    <div>
      This is the end of the webiste.
    </div>
    <div>
    If you have any problem of good advice, please contact xxxxx.
    </div>
    <div>
    Thank you for using Complib Website!
    </div>
  </div>
  <div> 
  </div>
</div>


</body>
</html>
_TAIL1;
    } else {
  header('location: http://mscidwd.bch.ed.ac.uk/s2051418/test_wsj/complib.php');
  }
?>
