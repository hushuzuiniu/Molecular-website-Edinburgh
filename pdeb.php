<?php
session_start();
include 'redir.php';
echo<<<_HEAD1
<html>
<body>
_HEAD1;
include 'menuf.php';
$smask = $_SESSION['supmask'];
echo <<<_MAIN1
    <pre>
This is the debug page
Current value of Supplier mask $smask;
reset to 31
    </pre>
_MAIN1;
$_SESSION['supmask'] = 31;
echo <<<_TAIL1
</body>
</html>
_TAIL1;

?>
