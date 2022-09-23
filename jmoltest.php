<?php
session_start();
require_once 'login.php';
include 'redir.php';
require_once 'myfuncs.php';
$cid = 1;
if(isset($_GET['cid'])) {
  $cid = $_GET['cid'];
}
echo <<<_endstart
<!DOCTYPE html>
<html>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Multipurpose Saas Startup HTML Template">
        <meta name="author" content="DynamicLayers">
       
        <title>details</title>
        
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
<title>JSmol demo with DB access</title>
<meta charset="utf-8">
<script type="text/javascript" src="jsmol/JSmol.min.js"></script>
<script type="text/javascript"> 

$(document).ready(function() {

Info = {
	width: 400,
	height: 400,
	debug: false,
	j2sPath: "../test_wsj/jsmol/j2s",
	color: "0xC0C0C0",
  disableJ2SLoadMonitor: true,
  disableInitialConsole: true,
	addSelectionOptions: false,
        readyFunction: null,
        src: "http://mscidwd.bch.ed.ac.uk/s2051418/test_wsj/getmol_disp.php?cid=$cid"

}

$("#mydiv").html(Jmol.getAppletHtml("jmolApplet0",Info))

});

</script>
</head>
<body>
_endstart;
include 'menuf.php';

$dbfs = array("catn","natm","ncar","nnit","noxy","nsul","ncycl","nhdon","nhacc","nrotb","mw","TPSA","XLogP");
$nms = array("catid","n atoms","n carbons","n nitrogens","n oxygens","n sulphurs","n cycles","n H donors","n H acceptors","n rot bonds","mol wt",
"TPSA","XLogP");
$rowid = array(11,1,2,3,4,5,6,7,8,9,12,13,14);
if(isset($_GET['cid'])) {
    $db_server = dbset($db_hostname,$db_username,$db_password,$db_database);
     $cid = $_GET['cid'];
     $query = "select * from Compounds where id=$cid";

     $result = mysql_query($query);
     if(!result) die("unable to process query: " . mysql_error());
	 echo '<div style="text-align:center;font-size:30px">';
     echo " Compound details";

	 echo '</div>';
	 echo '<br>';
     echo "<table class='table table-bordered' id=\"myTable\" width =\"100%\" border=\"2\" cellspacing=\"1\" align=\"center\"><thead><tr>";
    for($k = 0 ; $k < sizeof($dbfs) ; ++$k) {
      echo "<th>".$nms[$k]."</th>";
    }
    echo "</tr>\n</thead>\n<tbody>\n";
    $row = mysql_fetch_row($result);
    echo "<tr>";
    for($k = 0 ; $k < sizeof($dbfs) ; ++$k) {
       echo "<td>".$row[$rowid[$k]]."</td>";
    }
    echo "</tr>\n";
    echo "</tbody>\n</table>\n";
mysql_close($db_server);
} else {
echo<<<_FAILM
<pre>
No Compound selected
</pre>
_FAILM;
}
echo '<br>';
echo <<<_endpage

This illustrates that the applet
<span id=mydiv style="text-align:center"></span>
<br>
<p>
<br>
<a href="javascript:Jmol.script(jmolApplet0, 'spin on')">spin on</a>
<a href="javascript:Jmol.script(jmolApplet0, 'spin off')">spin off</a>
</p>
</body>
</html>
_endpage;
?>

