<?php
session_start();
require_once 'login.php';
include 'redir.php';
require_once 'myfuncs.php';
echo<<<_HEAD1
<html>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Multipurpose Saas Startup HTML Template">
        <meta name="author" content="DynamicLayers">
       
        <title>property retrieval page</title>
        
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
<body>
_HEAD1;
include 'menuf.php';
$db_server = dbset($db_hostname,$db_username,$db_password,$db_database);
$manarray = array();
$manid = array();
get_manarray($manarray,$manid);
echo <<<_MAIN1
<div style="text-align:center;font-size:35px">
  <div>
  This is the Property retrieval Page
  </div>
  <br>
_MAIN1;
  if (($_GET['tgval'] != "") && ($_GET['cval']!="")) {
    $mychoice=get_post('tgval');
    $myvalue=get_post('cval');
    $compsel = "select * from Compounds where ";
    $countSQL = "select count(*) as total from Compounds where ";
    if($mychoice == "mw") {
      $compsel = $compsel."( mw > ".($myvalue - 1.0)." and  mw < ".($myvalue + 1.0).")";
      $countSQL = $countSQL."( mw > ".($myvalue - 1.0)." and  mw < ".($myvalue + 1.0).")";
    }
    if($mychoice == "TPSA") {
      $compsel = $compsel."( TPSA > ".($myvalue - 0.1)." and  TPSA < ".($myvalue + 0.1).")";
        $countSQL = $countSQL."( TPSA > ".($myvalue - 0.1)." and  TPSA < ".($myvalue + 0.1).")";
    }
    if($mychoice == "XlogP") {
      $compsel = $compsel."( XlogP > ".($myvalue - 0.1)." and  XlogP < ".($myvalue + 0.1).")";
      $countSQL = $countSQL."( XlogP > ".($myvalue - 0.1)." and  XlogP < ".($myvalue + 0.1).")";
    }
    $page = new Page();
    $result = mysql_query($countSQL);
    $page->total(mysql_fetch_assoc($result));
    $result = mysql_query($compsel . ' ' . $page->limit());

    if(!$result) die("unable to process query: " . mysql_error());
    $rows = mysql_num_rows($result);
    if($rows > 10000) {
      echo "Too many results ",$rows," Max is 10000\n";
    } else  {
      echo<<<TABLESET_

<table  class="table table-bordered" cellspacing=0  border="2" align="center" width="100%" >
  <tr align="center">
    <th data-type="">CAT Number</th>
    <th data-type="">Manufacturer</th>
    <th data-type="">Property</th>
  </tr>
TABLESET_;
      for($j = 0 ; $j < $rows ; ++$j)
	{

	  echo '<tr align="center" >';
	  $row = mysql_fetch_row($result);
	  printf("<td><a href=jmoltest.php?cid=%s target=\"_blank\">%s</a></td> <td>%s</td>", $row[0],$row[11],$manarray[$row[10] - 1]);
	  if($mychoice == "mw") {
	     printf("<td>%s</td> ", $row[12]);
	  }
	  if($mychoice == "TPSA") {
	     printf("<td>%s</td> ", $row[13]);
	  }
	  if($mychoice == "XlogP") {
	     printf("<td>%s</td> ", $row[14]);
	  }
          echo "</tr>";
	}
      echo "</table>";
      echo '<div style="    width: 100%;
    display: flex;
    justify-content: center;">';
     echo  $page->show();
      echo '<div>';
    }
  } else {
    echo "No Query Given\n";
  }
echo "</pre>";
echo <<<_TAIL1
</body>
</html>
_TAIL1;
?>
