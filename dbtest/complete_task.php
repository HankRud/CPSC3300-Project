<!-- db1.php
     A PHP script to access the sailor database
     through MySQL
     -->
     <html>

<head>
    <title> Complete/Remove task </title>
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
    if (!$db) {
        print "Error - Could not select the sailor database " . $dbname;
        exit;
    }

    $task_id = $_POST['task_id'];
  
    // testing purpose (remove it after you complete testing!!!)
    print "task_id: " . $task_id . "<br />";


    // Clean up the given query (delete leading and trailing whitespace)
    trim($task_id);


    // remove the extra slashes
    $task_id = stripslashes($task_id);


    $query = 'DELETE FROM Task Where task_id='.$task_id .';';

    // Testing (remove it when testing is done!!!)
    print "<p>Query: " . $query . "</p>";

    // Execute the query
    $result = mysql_query($query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysql_error();
        print "<p>" . $error . "</p>";
        exit;
    }

    mysql_close($conn);
    ?>


    <br /><br />
    <a href="http://css1.seattleu.edu/~rudolph2/dbtest/db.html"> Go to Main Page </a>

</body>

</html>