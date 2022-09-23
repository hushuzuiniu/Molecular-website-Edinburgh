<?php
function dbset($db_hostname,$db_username,$db_password,$db_database)
{
  $db_server = mysql_connect($db_hostname,$db_username,$db_password);
  if(!$db_server) die("Unable to connect to database: " . mysql_error());
  mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());
  return $db_server;
}
function get_mansel($mymask)
{
$query = "select * from Manufacturers";
$result = mysql_query($query);
if(!$result) die("unable to process query: " . mysql_error());
$rows = mysql_num_rows($result);
$mansel = "(";
$firstmn = False;
for($j = 0 ; $j < $rows ; ++$j)
  {
    $row = mysql_fetch_row($result);
    $sid[$j] = $row[0];
    $snm[$j] = $row[1];
    $sact[$j] = 0;
    $tvl = 1 << ($sid[$j] - 1);

    if($tvl == ($tvl & $mymask)) {
        $sact[$j] = 1;
        if($firstmn) $mansel = $mansel." or ";
        $firstmn = True;
        $mansel = $mansel." (ManuID = ".$sid[$j].")";
      }
  }
$mansel = $mansel.")";
return $mansel;
}
function get_post($var)
{
  $post = isset($_POST[$var]) ? $_POST[$var] : '';
  if (empty($post)) {
      $post = isset($_GET[$var]) ? $_GET[$var] : '';
  }
  return mysql_real_escape_string($post);
}
function get_manarray(&$manarray,&$manid)
{
	$query = "select * from Manufacturers";
	$result = mysql_query($query);
	if(!$result) die("unable to process query: " . mysql_error());
	$manrows = mysql_num_rows($result);
	for($j = 0 ; $j < $manrows ; ++$j)
	  {
	    $row = mysql_fetch_row($result);
            $manid[$j] = $row[0];
	    $manarray[$j] = $row[1];
	  }
         return;
}
?>


