<?php
session_start();
require_once 'login.php';
include 'redir.php';
echo<<<_HEAD1
<html>
<body>
_HEAD1;
include 'menuf.php';
require 'myfuncs.php';
$db_server = dbset($db_hostname,$db_username,$db_password,$db_database);
$manarray=array();
$manid=array();
get_manarray($manarray,$manid);
$manrows=count($manarray);
echo <<<_MAIN1
    <pre>
This is the database display Page  
    </pre>
<table border="1">
  <tr>
    <td>Manufacturer</td>
    <td>Min C</td>
    <td>Max C</td>
    <td>Avg C</td>
    <td>Min N</td>
    <td>Max N</td>
    <td>Avg N</td>
    <td>Min O</td>
    <td>Max O</td>
    <td>Avg O</td>
  </tr>
_MAIN1;
for($j = 0 ; $j < $manrows ; ++$j)
  {
    printf("<tr><td>%s</td>", $manarray[$j]);
    $compsel = "Select min(ncar) from Compounds where ManuID=".($j+1);
    $result = mysql_query($compsel);
    $row = mysql_fetch_row($result);
    printf("<td>%s</td>", $row[0]);
    $compsel = "Select max(ncar) from Compounds where ManuID=".($j+1);
    $result = mysql_query($compsel);
    $row = mysql_fetch_row($result);
    printf("<td>%s</td>", $row[0]);
    $compsel = "Select avg(ncar) from Compounds where ManuID=".($j+1);
    $result = mysql_query($compsel);
    $row = mysql_fetch_row($result);
    printf("<td>%s</td>", $row[0]);
    $compsel = "Select min(nnit) from Compounds where ManuID=".($j+1);
    $result = mysql_query($compsel);
    $row = mysql_fetch_row($result);
    printf("<td>%s</td>", $row[0]);
    $compsel = "Select max(nnit) from Compounds where ManuID=".($j+1);
    $result = mysql_query($compsel);
    $row = mysql_fetch_row($result);
    printf("<td>%s</td>", $row[0]);
    $compsel = "Select avg(nnit) from Compounds where ManuID=".($j+1);
    $result = mysql_query($compsel);
    $row = mysql_fetch_row($result);
    printf("<td>%s</td>", $row[0]);
    $compsel = "Select min(noxy) from Compounds where ManuID=".($j+1);
    $result = mysql_query($compsel);
    $row = mysql_fetch_row($result);
    printf("<td>%s</td>", $row[0]);
    $compsel = "Select max(noxy) from Compounds where ManuID=".($j+1);
    $result = mysql_query($compsel);
    $row = mysql_fetch_row($result);
    printf("<td>%s</td>", $row[0]);
    $compsel = "Select avg(noxy) from Compounds where ManuID=".($j+1);
    $result = mysql_query($compsel);
    $row = mysql_fetch_row($result);
    printf("<td>%s</td>", $row[0]);
    printf("</tr>%n");
  }
echo <<<_TAIL1
</table>
</body>
</html>
_TAIL1;
?>

