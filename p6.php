<?php
session_start();
include 'redir.php';
require_once 'login.php';
echo<<<_HEAD1
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/mybasic.css">
</head>
<body>
_HEAD1;
include 'menuf.php';
include 'myfuncs.php';
$db_server = dbset($db_hostname,$db_username,$db_password,$db_database);
$dbfs = array();
$dbid = array();
get_manarray($dbfs,$dbid);
echo <<<_MAIN1
    <pre>
This is the Display Page  
    </pre>
_MAIN1;
if(isset($_POST['tgval'])) 
   {
     $chosen = 0;
     $tgval = $_POST['tgval'];
     $compnm = $_POST['compid'];
     for($j = 0 ; $j <sizeof($dbfs) ; ++$j) {
       if(strcmp($dbfs[$j],$tgval) == 0) {
          $chosen = $j;
          $supid = $dbid[$j];
       } 
     } 
     printf("%s from %s </p>",$compnm,$dbfs[$chosen]); 
     $query = sprintf("select id from Compounds where ManuID='%s' and catn='%s'",$supid,$compnm);
     $result = mysql_query($query);
     if(!$result) printf("can't find compound %s from manufacturer %s </p>",$compnm,$dbfs[$chosen]);
     else {
	$row = mysql_fetch_row($result);
     	$compid = $row[0];
        echo $compid;
        echo "<p><a href=jmoltest.php?cid=$compid>Display</a></p>";
     }
   }
echo '<form action="p6.php" method="post"><pre>';
for($j = 0 ; $j <sizeof($dbfs) ; ++$j) {
  if($j == 0) {
     printf(' %15s <input type="radio" name="tgval" value="%s" checked"/>',$dbfs[$j],$dbfs[$j]);
  } else {
     printf(' %15s <input type="radio" name="tgval" value="%s"/>',$dbfs[$j],$dbfs[$j]);
  }
  echo "\n";
}
echo 'compound id  <input type="text" name="compid"/>';
echo '<input type="submit" value="OK" />';
echo '</pre></form>';
echo <<<_TAIL1
</body>
</html>
_TAIL1;

?>

