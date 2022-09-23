<?php
session_start();
require_once 'login.php';
include 'redir.php';
require_once 'myfuncs.php';
echo<<<_HEAD1
<html>
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
$setpar = isset($_POST['natmax']); 
echo <<<_MAIN1
    <pre>
This is the catalogue retrieval Page  
    </pre>
_MAIN1;
if($setpar) {
  $firstsl = False;
  $compsel = "select catn,id,ManuID from Compounds where (";
  if (($_POST['natmax'] != "") && ($_POST['natmin']!="")) {
    $compsel = $compsel."(natm > ".get_post('natmin')." and  natm < ".get_post('natmax').")";
    $firstsl = True;
  }
  if (($_POST['ncrmax']!="") && ($_POST['ncrmin']!="")) {
    if($firstsl) $compsel = $compsel." and ";
    $compsel = $compsel."(ncar > ".get_post('ncrmin')." and  ncar < ".get_post('ncrmax').")";
    $firstsl = True;
  }
  if (($_POST['nntmax']!="") && ($_POST['nntmin']!="")) {
    if($firstsl) $compsel = $compsel." and ";
    $compsel = $compsel."(nnit > ".get_post('nntmin')." and  nnit < ".get_post('nntmax').")";
    $firstsl = True;
  }
  if (($_POST['noxmax']!="") && ($_POST['noxmin']!="")) {
    if($firstsl) $compsel = $compsel." and ";
    $compsel = $compsel."(noxy > ".get_post('noxmin')." and  noxy < ".get_post('noxmax').")";
    $firstsl = True;
  }
  if($firstsl) {
    $compsel = $compsel.") and ".$mansel;
    echo "<pre>";
    echo "The Query used for this search was";
    echo "\n";
    echo $compsel;
    echo "\n";
    echo "</pre>";
     $result = mysql_query($compsel);
     if(!$result) die("unable to process query: " . mysql_error());
     $rows = mysql_num_rows($result);
     if($rows > 100) {
       echo "<pre>\nToo many results ",$rows," Max is 100\n</pre>\n";
     } else  {
     echo <<<_TABLESET
<table border="1">
<tr>
<th>Cataloge ID</th>
<th>Manufacturer</th>
<th>Smiles String</th>
</tr>
_TABLESET;
     for($j = 0 ; $j < $rows ; ++$j)
       {
	 $row = mysql_fetch_row($result);
         $cid = $row[1];
         $compselsmi = "select smiles from Smiles where cid = ".$cid;
         $resultsmi = mysql_query($compselsmi);
         $smilesrow = mysql_fetch_row($resultsmi);
         $convurl = "https://cactus.nci.nih.gov/chemical/structure/".urlencode($smilesrow[0])."/image";
	 printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$snm[$row[2]-1],$smilesrow[0]);

       }
     echo "</table>\n";
     }
  } else {
    echo "<pre>\nNo Query Given\n</pre>\n";
  }
} 
echo <<<_TAIL1
   <form action="p2smilesa.php" method="post"><pre>
       Max Atoms      <input type="text" name="natmax"/>    Min Atoms    <input type="text" name="natmin"/>
       Max Carbons    <input type="text" name="ncrmax"/>    Min Carbons  <input type="text" name="ncrmin"/>
       Max Nitrogens  <input type="text" name="nntmax"/>    Min Nitrogens<input type="text" name="nntmin"/>
       Max Oxygens    <input type="text" name="noxmax"/>    Min Oxygens  <input type="text" name="noxmin"/>
                   <input type="submit" value="list" />
</pre></form>

</body>
</html>
_TAIL1;
function get_post($var)
{
  return mysql_real_escape_string($_POST[$var]);
}
?>
