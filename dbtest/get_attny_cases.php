<!-- db1.php
     A PHP script to access the sailor database
     through MySQL
     -->
<html>

<head>
    <title> Access the cars database with MySQL </title>
    <link rel="stylesheet" href="https://ssl.gstatic.com/docs/script/css/add-ons1.css">
</head>

<body>
    <?php

    // Connect to MySQL

    $servername = "cs100.seattleu.edu";
    $username = "user36";
    $password = "1234abcdF!";

    $conn = mysql_connect($servername, $username, $password);

    if (!$conn) {
        print "Error - Could not connect to MySQL " . $conn;
        exit;
    }

    // change to your default db for PDA6!!!
    $dbname = "bw_db36";

    $db = mysql_select_db($dbname, $conn);
