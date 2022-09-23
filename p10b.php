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
$manarray = array();
$manid = array();
get_manarray($manarray,$manid);
echo <<<_MAIN1
    <pre>
This is the property retrieval Page  
    </pre>
_MAIN1;
  if (($_POST['tgval'] != "") && ($_POST['cval']!="")) {
    $mychoice=get_post('tgval');
    $myvalue=get_post('cval');
    $compsel = "select * from Compounds where ";
    if($mychoice == "mw") {
      $compsel = $compsel."( mw > ".($myvalue - 1.0)." and  mw < ".($myvalue + 1.0).")";
    }
    if($mychoice == "TPSA") {
      $compsel = $compsel."( TPSA > ".($myvalue - 0.1)." and  TPSA < ".($myvalue + 0.1).")";
    }
    if($mychoice == "XlogP") {
      $compsel = $compsel."( XlogP > ".($myvalue - 0.1)." and  XlogP < ".($myvalue + 0.1).")";
    }
    echo "<pre>";
    //    echo $compsel;
    echo "\n";
    $result = mysql_query($compsel);
    if(!$result) die("unable to process query: " . mysql_error());
    $rows = mysql_num_rows($result);
    if($rows > 10000) {
      echo "Too many results ",$rows," Max is 10000\n";
    } else  {
      echo<<<TABLESET_
<table border="1">
  <tr>
    <th>CAT Number</th>
    <th>Manufacturer</th>
    <th>Property</th>
  </tr>
TABLESET_;
      for($j = 0 ; $j < $rows ; ++$j)
	{
	  echo "<tr>";
	  $row = mysql_fetch_row($result);
	  printf("<td><a href=showprops.php?cid=%s>%s</a></td> <td>%s</td>", $row[0],$row[11],$manarray[$row[10] - 1]);
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
