<!-- db1.php
     A PHP script to access the sailor database
     through MySQL
     -->
<html>

<head>
    <title> Insert a task </title>
    <link rel="stylesheet" href="https://ssl.gstatic.com/docs/script/css/add-ons1.css">
</head>
<center>
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
    $task_description = $_POST['task_description'];
    $case_id = $_POST['case_id'];

    // testing purpose (remove it after you complete testing!!!)
    print "task_id: " . $task_id . "<br />";
    print "task_description attr: " . $task_description . "<br />";
    print "case_id: " . $case_id . "<br />";

    // Clean up the given query (delete leading and trailing whitespace)
    trim($task_id);
    trim($task_description);
    trim($case_id);

    // remove the extra slashes
    $task_id = stripslashes($task_id);
    $task_description = stripslashes($task_description);
    $case_id = stripslashes($case_id);

    $query = 'INSERT INTO Task VALUES(' . $task_id . ',"' . $task_description . '",' . $case_id . ');';
    $query2 = 'SELECT * FROM Task where task_id =' . $task_id . ';';

  

    // Execute the query
    $result = mysql_query($query);
    if (!$result) {
        print "Error - the inesert query could not be executed";
        $error = mysql_error();
        print "<p>" . $error . "</p>";
        exit;
    }

    $result2 = mysql_query($query2);
    if (!$result) {
        print "Error - the retrive query could not be executed";
        $error = mysql_error();
        print "<p>" . $error . "</p>";
        exit;
    }

    // Get the number of rows in the result
    $num_rows = mysql_num_rows($result2);



    // Get the number of fields in the rows
    $num_fields = mysql_num_fields($result2);


    // Get the first row
    $row = mysql_fetch_array($result2);

    // Display the results in a table
    print "<table border='border'><caption> <h2> Show Insert </h2> </caption>";
    print "<tr align = 'center'>";

    // Produce the column labels
    $keys = array_keys($row);
    for ($index = 0; $index < $num_fields; $index++)
        print "<th>" . $keys[2 * $index + 1] . "</th>";

    print "</tr>";

    // Output the values of the fields in the rows
    for ($row_num = 0; $row_num < $num_rows; $row_num++) {

        print "<tr align = 'center'>";
        $values = array_values($row);

        for ($index = 0; $index < $num_fields; $index++) {
            $value = htmlspecialchars($values[2 * $index + 1]);
            print "<td>" . $value . "</td> ";
        }

        print "</tr>";
        $row = mysql_fetch_array($result2);
    }

    print "</table>";

    mysql_close($conn);
    ?>



    <br /><br />
    <a href="http://css1.seattleu.edu/~rudolph2/dbtest/db.html"> Go to Main Page </a>

</body>
</center>
</html>