<?php
session_start();
require_once 'login.php';
include 'redir.php';
echo<<<_HEAD1
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/mybasic.css">
</head>
<body>
_HEAD1;
include 'menuf.php';
echo<<<_MAIN1
    <pre>
This is the the documentation page. 
This website is based on a MySQL database consisting of 3 tables. Those tables are
1. the manufacturer table, which holds the name of each cehmical manufacturer who contributed
compounds to the main section.
2. the Compounds table which holds an entry for each compound. In addition to the compound name
and a referfence to the manufacturer table for each compound, it also holds detains about the chemical 
composition and some basic physical properties for each compound.
3. The structures table. This holds a reference to the compounds table and a copy of the coordinates of each compound.

These tables are formally defined as ......
The data for these tables was extracted from a master sdf file containing all the entries.
The method of extracting the data and populating the tables was .....
The website uses php sessions to link the pages. Overall the structure of the website is of a master login page, coupled
to an index page. from this index page there are hyperlinks to 7 functional pages.
Each page include a mechanism to detect if a current seeion is still valid and a redirect to the master login page if
no valid session is found. Each page also includes a a single menu page allowing access to each of the other pages.
The function of each page will now be described in detail
1. The manufacturer selection page...

2.The compound selection page...

3.The statistics page....

4.The correlations page....

5.The display page....

6. the documentation (this) page....

7. the exit page...  

Stylistically this website is controlled by one master cascading style sheet....

    </pre>
_MAIN1;
echo<<<_TAIL1
</body>
</html>
_TAIL1;
?>
