<?php
if(!(isset($_SESSION['forname']) &&
     isset($_SESSION['surname'])))
  {
  header('location: http://mscidwd.bch.ed.ac.uk/s2051418/test_wsj/complib.php');
  }
?>
