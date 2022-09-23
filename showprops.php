<?php
require_once 'login.php';
echo<<<_HEAD1
<html>
<head>
</head>
<body>
_HEAD1;
include 'menuf.php';
$dbfs = array("catn","natm","ncar","nnit","noxy","nsul","ncycl","nhdon","nhacc","nrotb","mw","TPSA","XLogP");
$nms = array("catid","n atoms","n carbons","n nitrogens","n oxygens","n sulphurs","n cycles","n H donors","n H acceptors","n rot bonds","mol wt",
"TPSA","XLogP");
$rowid = array(11,1,2,3,4,5,6,7,8,9,12,13,14);
if(isset($_GET['cid'])) {
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
     $cid = $_GET['cid'];
     $query = "select * from Compounds where id=$cid";
     $result = mysql_query($query);
     if(!result) die("unable to process query: " . mysql_error());
     echo "<h1> Details for Compound $cid </h1>";
     echo "<table id=\"myTable\" width =\"70%\" border=\"2\" cellspacing=\"1\" align=\"center\"><thead><tr>";
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
echo<<<_TAIL
</body>
</html>
_TAIL;
?>
