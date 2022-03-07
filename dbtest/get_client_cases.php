<!-- db1.php
     A PHP script to access the sailor database
     through MySQL
     -->
<html>

<head>
    <title> Access the cars database with MySQL </title>
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
        print "Error - Could not connect to MySQL " . $servername;
        exit;
    }
    // change to your default db
    $dbname = "bw_db36";
    $db = mysql_select_db($dbname, $conn);
    if (!$db) {
        print "Error - Could not select the sailor database " . $dbname;
        exit;
    }

    // Get Firm ID and Department ID from _POST
    $firm_id = $_POST['firm_id']; 
    $dept_id = $_POST['dept_id']; 

    // Clean up the given query (delete leading and trailing whitespace)
    trim($firm_id);
    trim($dept_id);
    // remove the extra slashes
    $firm_id = stripslashes($firm_id);
    $dept_id = stripslashes($dept_id);
    // handle HTML special characters
    $firm_id_html = htmlspecialchars($firm_id);
    print "<p>Firm ID: " . $firm_id_html . "</p>";
    $dept_id_html = htmlspecialchars($dept_id);
    print "<p>Department ID: " . $dept_id_html . "</p>";


    $query = 'SELECT FC.firm_id,FC.client_name,FC.client_phone,CC.stateofcase,CC.ruling,CC.matter_description
              FROM Firm_Client FC
              JOIN ClientCase CC ON CC.client_ssn = FC.client_ssn
              Where FC.firm_id = "'.$firm_id.'" AND FC.dept_num = "'.$dept_id.'";';

    
    // Execute the query
    $result = mysql_query($query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysql_error();
        print "<p>" . $error . "</p>";
        exit;
    }

    // Get the number of rows in the result
    $num_rows = mysql_num_rows($result);
    

    // Get the number of fields in the rows
    $num_fields = mysql_num_fields($result);
   

    // Get the first row
    $row = mysql_fetch_array($result);

    // Display the results in a table
    print "<table border='border'><caption> <h2> Query Results </h2> </caption>";
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
        $row = mysql_fetch_array($result);
    }

    print "</table>";

    mysql_close($conn);
    ?>

    <br /> <br />
    <a href="http://css1.seattleu.edu/~rudolph2/dbtest/db.html"> Go to Main Page </a>
</body>
</center>
</html>