<?php
session_start();
include 'redir.php';
require_once 'login.php';
echo<<<_HEAD1
<html>
<style>
/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 20px;
  margin-bottom: -6px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container input {
  position: relative;
  opacity: 0;
  cursor: pointer;
}
.bsun {
    width: 100%;
    margin-bottom: 20px;
    margin-top: 20px;
 
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
     left: 200px;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 100%;
	background: white;
}
.select-list {
display: flex;
    align-items: center;
    flex-direction: row;
    flex-wrap: wrap;
    margin: 0 200px;

}
.select-list label {
  width: 50%;
  padding: 0 30px;
  margin-bottom: 20px;
}
</style>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Multipurpose Saas Startup HTML Template">
        <meta name="author" content="DynamicLayers">
       
        <title>stats&histogram</title>
        
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
$dbfs = array("natm","ncar","nnit","noxy","nsul","ncycl","nhdon","nhacc","nrotb","mw","TPSA","XLogP");
$nms = array("n atoms","n carbons","n nitrogens","n oxygens","n sulphurs","n cycles","n H donors","n H acceptors","n rot bonds","mol wt","TPSA","XLogP");
echo <<<_MAIN1
<div style="text-align:center;font-size:35px">
  <div>
  This is the Statistics and Histogram Page 
  </div>
  <br>

_MAIN1;
echo '<form action="p3.php" method="post"><pre class="select-list">';
for($j = 0 ; $j <sizeof($dbfs) ; ++$j) {
  if($j == 0) {
   echo "<label class=\"container\">{$nms[$j]}<input type='radio' name='tgval' value='{$dbfs[$j]}'><span class='checkmark'></span></label>";
  } else {
      echo "<label class=\"container\">{$nms[$j]}<input type='radio' name='tgval'  checked=\"checked\" value='{$dbfs[$j]}'><span class='checkmark'></span></label>";
  }
  echo "\n";
}

echo '<div class="bsun"><input type="submit" value ="Submit" class="btn btn-default" /> </div> ';
echo '</pre></form>';

if(isset($_POST['tgval']))
   {

     $chosen = 0;
     $tgval = $_POST['tgval'];
     for($j = 0 ; $j <sizeof($dbfs) ; ++$j) {
       if(strcmp($dbfs[$j],$tgval) == 0) $chosen = $j;
     }
     printf(" Statistics for %s <br />\n",$dbfs[$chosen],$nms[$chosen]);
     //Your mysql and statistics calculation goes here
     $db_server = mysql_connect($db_hostname,$db_username,$db_password);
     if(!$db_server) die("Unable to connect to database: " . mysql_error());
     mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
     $query = sprintf("select AVG(%s), STD(%s) from Compounds",$dbfs[$chosen],$dbfs[$chosen]);
     $result = mysql_query($query);
     if(!$result) die("unable to process query: " . mysql_error());
     $row = mysql_fetch_row($result);

//     printf(" Average %f Standard Dev %f <br /><br />\n",$row[0],$row[1]);
     echo "<div style='width: 100%;text-align: center;    display: flex;
    align-items: center;
    margin-top: 15px;
    justify-content: center;
}'><table style='width: 500px' class=\"table table-bordered \">
  <thead>
    <tr>
      <th scope=\"col\">Average</th>
      <th scope=\"col\">Standard Dev</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope=\"row\">{$row[0]}</th>
      <td>{$row[1]}</td>
    </tr>
   
  </tbody>
</table></div";
   }

   if(isset($_POST['tgval']))
   {
     $chosen = 0;
     $tgval = $_POST['tgval'];
     for($j = 0 ; $j <sizeof($dbfs) ; ++$j) {
       if(strcmp($dbfs[$j],$tgval) == 0) $chosen = $j;
     }
     $db_server = mysql_connect($db_hostname,$db_username,$db_password);
     if(!$db_server) die("Unable to connect to database: " . mysql_error());
     mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
     $query = "select * from Manufacturers";
     $result = mysql_query($query);
     if(!$result) die("unable to process query: " . mysql_error());
     $rows = mysql_num_rows($result);
     $smask = $_SESSION['supmask'];
     $firstmn = False;
     $mansel = "(";
     for($j = 0 ; $j < $rows ; ++$j) {
      $row = mysql_fetch_row($result);
      $sid[$j] = $row[0];
      $snm[$j] = $row[1];
      $sact[$j] = 0;
      $tvl = 1 << ($sid[$j] - 1);
      if($tvl == ($tvl & $smask)) {
        $sact[$j] = 1;
        if($firstmn) $mansel = $mansel." or ";
        $firstmn = True;
        $mansel = $mansel." (ManuID = ".$sid[$j].")";
      }
     }
     $mansel = $mansel.")";
     $comtodo = "./histog.py ".$dbfs[$chosen]." \"".$nms[$chosen]."\" \"".$mansel."\"";
     $output = base64_encode(shell_exec($comtodo));
     echo <<<_imgput
     <pre>
     <img  src="data:image/png;base64, $output" />
     </pre>
_imgput;
   }

echo <<<_TAIL1


</body>


</html>
_TAIL1;

?>
