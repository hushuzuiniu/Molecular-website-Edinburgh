<?php
session_start();
#get the database access credentials
require_once 'login.php';
#get the page that redirects to the front page is not logged in
include 'redir.php';
# this block sends out the header html
echo<<<_HEAD1
<html>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Multipurpose Saas Startup HTML Template">
        <meta name="author" content="DynamicLayers">
       
        <title>help page</title>
        
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
#include the file that has the menu code
include 'menuf.php';

echo <<<_TAIL1
<h1> This is the help Page</h1>
<p>             In this page we provide general help and instrutions on how to use this website</p>
<pre>
  .
  .
  
  .
</pre>
<h2> Contact Details </h2>
<p> the author of this web site is B193818 </p>
<p> it is mostly based in part on the demostration web site provided in the course introduction to web site and database design and some css templates taken from Google.</p>
<p> Images were source from https://pixabay.com/illustrations/dna-biology-science-dna-helix-163710/ and https://www.istockphoto.com/photo/molecule-inside-liquid-bubble-gm1324201139-409620225</p>
<p> the following javascript libraries were used, library names and source web sites are given </p>
</body>
</html>
_TAIL1;
?>
