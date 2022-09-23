<?php
session_start();
require_once 'login.php';
include 'redir.php';
echo<<<_HEAD1
<html>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Multipurpose Saas Startup HTML Template">
        <meta name="author" content="DynamicLayers">
       
        <title>search compounds</title>
        
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
    <style>
    .input-w  input{
        
    }
</style>
</head>
<body>
_HEAD1;
include 'menuf.php';
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
$query = "select * from Manufacturers";
$result = mysql_query($query);
if(!$result) die("unable to process query: " . mysql_error());
$rows = mysql_num_rows($result);
$smask = $_SESSION['supmask'];
$page= isset($_GET["page"]) ?$_GET["page"]:"1";
$limit=10;
$start=($page-1)*$limit;
if($_GET){
  $_SESSION["post"]=$_GET;
}else{
  if($_GET["page"]){
    $_GET=$_SESSION["post"];
  }
}
$firstmn = False;
$mansel = "(";
for($j = 0 ; $j < $rows ; ++$j)
  {
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
$setpar = isset($_GET['natmax']);

echo <<<_MAIN1
<div style="text-align:center;font-size:35px">
  <div>
  This is the Catalogue Retrieval Page
  </div>
  <div style="text-align:center;font-size:20px">
  <br>
  <div>
  Please enter the range you want to search
  </div>
_MAIN1;
?>
<form action="p2smilesex.php" method="get"><pre>
  <div  class="input-w" style="text-align:center; font-size: 44.5%;">
       Max Atoms      <input type="text" placeholder="81 is max Atoms " name="natmax"/>    Min Atoms    <input type="text" placeholder="14 is min Atoms "  name="natmin"/>
       <div></div>
       Max Carbons    <input type="text" name="ncrmax"  placeholder="37 is max Carbons " />    Min Carbons  <input type="text"  placeholder="3 is min Carbons " name="ncrmin"/>
       <div></div>
       Max Nitrogens  <input type="text" name="nntmax"  placeholder="4 is max Nitrogens " />    Min Nitrogens<input type="text"   placeholder="2 is min Nitrogens "  name="nntmin"/>
       <div></div>
       Max Oxygens    <input type="text" name="noxmax" placeholder="4 is max Oxygense "/>    Min Oxygens  <input type="text"   placeholder="3 is min Oxygens "name="noxmin"/>
  </div>
                 <!-- <div style="text-align:center;margin:10px 0"><input type="submit" value="list" style="padding:5px 20px" /></div>-->
<input type="submit" value ="List the Results" class="btn btn-default" />
                </form>
<?php
if($setpar) {
  $firstsl = False;
  $compsel = "select catn,id,ManuID from Compounds where (";
   $countSQL = "select count(*) as total from Compounds where (";
  if (($_GET['natmax'] != "") && ($_GET['natmin']!="")) {
    $compsel = $compsel."(natm > ".get_post('natmin')." and  natm < ".get_post('natmax').")";
      $countSQL = $countSQL."(natm > ".get_post('natmin')." and  natm < ".get_post('natmax').")";
    $firstsl = True;
  }
  if (($_GET['ncrmax']!="") && ($_GET['ncrmin']!="")) {
    if($firstsl) $compsel = $compsel." and ";
    $compsel = $compsel."(ncar > ".get_post('ncrmin')." and  ncar < ".get_post('ncrmax').")";
      $countSQL = $countSQL."(ncar > ".get_post('ncrmin')." and  ncar < ".get_post('ncrmax').")";
    $firstsl = True;
  }
  if (($_GET['nntmax']!="") && ($_GET['nntmin']!="")) {
    if($firstsl) $compsel = $compsel." and ";
    $compsel = $compsel."(nnit > ".get_post('nntmin')." and  nnit < ".get_post('nntmax').")";
      $countSQL = $countSQL."(nnit > ".get_post('nntmin')." and  nnit < ".get_post('nntmax').")";
    $firstsl = True;
  }
  if (($_GET['noxmax']!="") && ($_GET['noxmin']!="")) {
    if($firstsl) $compsel = $compsel." and ";
    $compsel = $compsel."(noxy > ".get_post('noxmin')." and  noxy < ".get_post('noxmax').")";
      $countSQL = $countSQL."(noxy > ".get_post('noxmin')." and  noxy < ".get_post('noxmax').")";
    $firstsl = True;
  }
  if($firstsl) {

    $compsel = $compsel.") and ".$mansel;
    $countSQL = $countSQL.") and ".$mansel;


    $page = new Page();
    $result = mysql_query($countSQL);
    $page->total(mysql_fetch_assoc($result));
    $result = mysql_query($compsel . ' ' . $page->limit());


    echo '<div style="text-align:center;font-size:14px"><pre style="    overflow: hidden;">';
    echo "The Query used for this search was";
    echo "\n";
    echo "\n";
    echo $compsel;
    echo "\n";
    echo "</pre></div>";
//     $result = mysql_query($slist);
     if(!$result) die("unable to process query: " . mysql_error());
     $rows = mysql_num_rows($result);
     if($rows > 100) {
       echo "<pre>\nToo many results ",$rows," Max is 100\n</pre>\n";
     } else  {
?>

<div class="table-responsive">
<table  class="table table-bordered" >
<tr>
  <th>Cataloge ID</th>
  <th>manufacturer</th>
  <th>Smiles String</th>
  <th>Structure</th>
  <th>Link</th>
</tr>
<?php
     echo <<<_TABLESET
_TABLESET;
     for($j = 0 ; $j < $rows ; ++$j)
       {
	 $row = mysql_fetch_row($result);
         $cid = $row[1];
         $compselsmi = "select smiles from Smiles where cid = ".$cid;
         $resultsmi = mysql_query($compselsmi);
         $smilesrow = mysql_fetch_row($resultsmi);
         $convurl = "https://cactus.nci.nih.gov/chemical/structure/".urlencode($smilesrow[0])."/image";
//         $convstr = base64_encode(file_get_contents($convurl));
	 printf("<tr>
              <td ><a href='jmoltest.php?cid={$row[0]}' target=\"_blank\">%s</a></td>
              <td>%s</td>
              <td>%s</td>
              <td><img  src=\"%s\"></img></td>
              <td> <a href=\"%s\" target=\"_blank\">Link</a> </td>
          </tr>\n",$row[0],$snm[$row[2]-1],$smilesrow[0],$convurl,$convurl);

       }
     echo "</table>";
echo $page->show();
echo "</div> \n";
     ?>

     <?php
     }
  } else {
    echo "<pre>\nNo Query Given\n</pre>\n";
  }
}
echo <<<_TAIL1
</body>
</html>
_TAIL1;
function get_post($var)
{
    $post = isset($_GET[$var]) ? $_GET[$var] : '';
    if (empty($post)) {
        $post = isset($_GET[$var]) ? $_GET[$var] : '';
    }
  return mysql_real_escape_string($post);
}
?>
