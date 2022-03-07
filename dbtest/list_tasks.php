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
    if (!$db) {
        print "Error - Could not select database " . $dbname;
        exit;
    }




    $query = 'SELECT case_id, mycount
    FROM (SELECT T.case_id,COUNT(T.task_id) mycount
    FROM Task T
    GROUP BY T.case_id
    HAVING mycount In(Select MAX(maxcount) 
                        From (Select TS.case_id, Count(TS.task_id) maxcount
                            From Task TS
                            Group by TS.case_id )AS N) )AS X
    ;';


   

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

    print "Number of rows = $num_rows <br />";

    // Get the number of fields in the rows
    $num_fields = mysql_num_fields($result);
    print "Number of fields = $num_fields <br />";

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

    print"</table>";

    $query2=' SELECT T2.case_id, T2.task_id 
                From Task T2
                Where T2.case_id IN (SELECT case_id
    FROM (SELECT T.case_id,COUNT(T.task_id) mycount
    FROM Task T
    GROUP BY T.case_id
    HAVING mycount In(Select MAX(maxcount) 
                        From (Select TS.case_id, Count(TS.task_id) maxcount
                            From Task TS
                            Group by TS.case_id )AS N) )AS X)
    ;' ;
    

      // Execute the query
      $result2 = mysql_query($query2);
      if (!$result2) {
          print "Error - the retreive query could not be executed";
          $error2 = mysql_error();
          print "<p>" . $error2 . "</p>";
          exit;
      }
  
      // Get the number of rows in the result
      $num_rows = mysql_num_rows($result2);
  
      print "Number of rows = $num_rows <br />";
  
      // Get the number of fields in the rows
      $num_fields = mysql_num_fields($result2);
      print "Number of fields = $num_fields <br />";
  
      // Get the first row
      $row = mysql_fetch_array($result2);
  
      // Display the results in a table
      print "<table border='border'><caption> <h2> Second Query Results </h2> </caption>";
      print "<tr align = 'center'>";
  
      // Produce the column labels
      $keys = array_keys($row);
      for ($index2 = 0; $index < $num_fields; $index++)
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

</html>