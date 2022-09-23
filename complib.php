<?php
session_start();
require_once 'login.php';
echo<<<_HEAD1
<html>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Multipurpose Saas Startup HTML Template">
        <meta name="author" content="DynamicLayers">
       
        <title>login</title>
        
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
<head>
<link href="style/mybasic.css" rel="stylesheet" type="text/css" />
</head>
<body>
_HEAD1;
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
$query = "select * from Manufacturers";
     $result = mysql_query($query);
     if(!$result) die("unable to process query: " . mysql_error());
     $rows = mysql_num_rows($result);
     $mask = 0;
     mysql_close($db_server);
     for($j = 0 ; $j < $rows ; ++$j)
     {
       $mask = (2 * $mask) + 1;
     }
$_SESSION['supmask'] = $mask;
   echo <<<_EOP
<script>
   function validate(form) {
   fail = ""
   if(form.fn.value =="") fail = "Must Give Forname "
   if(form.sn.value == "") fail += "Must Give Surname"
   if(fail =="") return true
       else {alert(fail); return false}
   }
</script>
<div style="height:calc(100vh);display:flex;align-items:center;">
   <form action="indexp.php" method="post" onSubmit="return validate(this)">
      <div>
      <span>First Name</span><input type="text" name="fn"/></div>
      <div><span>Second Name</span><input type="text" name="sn"/></div>
      <div style="justify-content:center;">
         <input class="buttom"   type="submit" value="Login" />
      </div>
   </form>
</div>

_EOP;

echo <<<_TAIL1
</pre>
</body>
<style>
   *{
      padding:0;
      margin:0;
   }
   body{
      background-size: cover;
      background-image: url(./images/1.png);
      background-repeat: no-repeat;
   }
   form{
       height: 230px;
      background: #fff;
      width: 300px;
      margin: 0 auto;
      padding: 30px;
      font-size: 20px;
      box-shadow: 0px 0px 10px 5px #cccccc;
      font-size:20px;
      font-weigth:blod;
   }
   form div{
      display:flex;
      justify-content:space-between;
      margin:10% 0;
   }
   form div span,
   form div input{
      width:50%;
   }
   form input{
      height:30px;
   }
   .buttom:hover{
              background-color: rgb(30, 146, 241);
    border-color: #b9e563;
    color: #FFF;
   }
   .buttom{
     background-color: rgb(30, 146, 241);
    border-color: #A5DE37;
    color: #FFF;
        color: #666
    font-weight: 300;
    font-size: 16px;
    font-family: "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    text-decoration: none;
    text-align: center;
    line-height: 40px;
    height: 40px;
    padding: 0 40px;
    margin: 0;
    display: inline-block;
    appearance: none;
    cursor: pointer;
    border: none;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-transition-property: all;
    transition-property: all;
    -webkit-transition-duration: .3s;
    transition-duration: .3s;
    margin-bottom: 15px;
   }
</style>
</html>
_TAIL1;

?>
