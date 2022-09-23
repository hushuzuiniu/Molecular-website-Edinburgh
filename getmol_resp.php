<?php
require_once 'login.php';
if(isset($_GET['cid'])) {
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
     $cid = $_GET['cid'];
     $query = "select molecule from Molecules where cid=$cid";
     $result = mysql_query($query);
     if(!result) die("unable to process query: " . mysql_error());
     $row = mysql_fetch_row($result);
     echo base64_decode($row[0]);
mysql_close($db_server);
}
?>
