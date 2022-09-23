<?php
session_start();
require_once 'login.php';
include 'redir.php';
require_once 'myfuncs.php';
echo<<<_HEAD1
<html>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Multipurpose Saas Startup HTML Template">
        <meta name="author" content="DynamicLayers">
       
        <title>manufaturer display</title>
        
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
 <script src="js/vendor/jquery-1.12.4.min.js"></script>
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <link href="style/mybasic.css" rel="stylesheet" type="text/css" />
</head>
<body>
_HEAD1;
include 'menuf.php';
$dbfs = array("catn","natm","ncar","nnit","noxy","nsul","ncycl","nhdon","nhacc","nrotb","mw","TPSA","XLogP");
$nms = array("catid","n atoms","n carbons","n nitrogens","n oxygens","n sulphurs","n cycles","n H donors","n H acceptors","n rot bonds","mol wt","TPSA","XLogP");
$rowid = array(11,1,2,3,4,5,6,7,8,9,12,13,14);
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
$query = "select * from Manufacturers";
$result = mysql_query($query);
if(!$result) die("unable to process query: " . mysql_error());
$manrows = mysql_num_rows($result);
$manarray = array();
$manid = array();
$chosen = $_GET['tgval'];
for($j = 0 ; $j < $manrows ; ++$j)
  {
    $row = mysql_fetch_row($result);
    $manarray[$j] = $row[1];
    $manid[$j] = $j + 1;
  }
$query = "select * from Compounds where ManuID = ".$chosen;
$countSQL = "select count(*) as total from Compounds where ManuID = ".$chosen;

$page = new Page();
$result = mysql_query($countSQL);
$page->total(mysql_fetch_assoc($result));
if (isset($_GET['order'])) {
    $query .= " order by " . $_GET['order'] ."  desc";
}
$query = $query . ' ' . $page->limit();


$result = mysql_query($query);
if(!$result) die("unable to process query: " . mysql_error());
$resrows = mysql_num_rows($result);
echo <<<_MAIN1
<div style="text-align:center;font-size:35px">
  <div>
  This is the Manufacturer display page 
  </div>
  <br>
  <br>
_MAIN1;
    echo '<table id="table" class="table table-bordered" cellspacing=0  border="2" align="center" width="100%"><thead>
    <tr align="center">';
    for($k = 0 ; $k < sizeof($dbfs) ; ++$k) {
      echo "<th data-val='{$chosen}' data-order='{$_GET['order']}'   data-type='{$dbfs[$k]}'>".$nms[$k]."</th>";
    }
    echo "</tr>\n</thead>\n<tbody>\n";
    for($j = 0 ; $j < $resrows ; ++$j)
      {
         $row = mysql_fetch_row($result);
         echo '<tr align="center">';
         for($k = 0 ; $k < sizeof($dbfs) ; ++$k) {
           echo "<td>".$row[$rowid[$k]]."</td>";
         }
         echo "</tr>\n";
      }
      echo "</tbody>\n</table>\n";
    echo $page->show();
echo <<<_TAIL1
<script type="text/javascript">
$(function() {
    $('#table').find('th').click(function() {
  
       var type = $(this).attr('data-type');
      
       var val = $(this).attr('data-val')
     
       location.href = './p8bv2.php?p=1&tgval=' + val + '&order=' + type
    })
});
$(window).on('load', function () {
  $('#loader').hide();
  $('#loading').hide();
}) 
</script>
</body>
</html>
_TAIL1;
?>

