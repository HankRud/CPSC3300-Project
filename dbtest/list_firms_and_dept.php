<!-- db1.php
     A PHP script to access the sailor database
     through MySQL
     -->
<html>

<head>
    <title> LIST THE FIRMS </title>
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
     print "Error - Could not connect to MySQL ".$conn;
     exit;
}
// change to your default db for PDA6!!!
$dbname = "bw_db36";
$db = mysql_select_db($dbname, $conn);
if (!$db) {
    print "Error - Could not select the firm database ".$dbname;
    exit;
}

$query = 'SELECT firm_name,firm_id FROM Firm;';



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
	
    for ($index = 0; $index < $num_fields; $index++){
        $value = htmlspecialchars($values[2 * $index + 1]);
        print "<td>" . $value . "</td> ";
    }
    
    print "</tr>";
    $row = mysql_fetch_array($result);
}

print "</table>";

mysql_close($conn);
?>

    <!-- Find Department in a firm -->
    Find Depratments for Firm:
    <form name="f2" action="http://css1.seattleu.edu/~rudolph2/dbtest/list_departments.php" method="post">
        <input type="text" name="firm_id"/> 
        <label for="Firm ID">Firm ID </label> <br />
        <input type="submit" value="Find Departments" />
    </form>
    <br />

    <br /><br />
    <a href="http://css1.seattleu.edu/~rudolph2/dbtest/db.html"> Go to Main Page </a>

</body>
</center>
</html>