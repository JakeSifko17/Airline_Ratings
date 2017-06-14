<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Ratings</title>
</head>
<body>
<?php
if (empty($_POST['name']) || empty($_POST['airdate']) || empty($_POST['flighttime']) || empty($_POST['flightnumber']))
              echo "<p>Please Enter your Flight and Airline Details! Click your browsers back button to try again.</p>";
    else {
        $DBConnect = @mysql_connect("localhost", "root", "mgs314");
        if ($DBConnect === FALSE)
                   echo "<p>Unable to connect to the database
                        server.</p>"
                        . "<p>Error code " . mysql_errno()
                        . ": " . mysql_error() . "</p>";

        else {
          $DBName = "ratings";
          if (!@mysql_select_db($DBName, $DBConnect)) {
                      $SQLstring = "CREATE DATABASE $DBName";
                      $QueryResult = @mysql_query($SQLstring, $DBConnect);
                      if ($QueryResult === FALSE)
                           echo "<p>Unable to execute the query.</p>"
                           . "<p>Error code " . mysql_errno($DBConnect)
                           . ": " . mysql_error($DBConnect) . "</p>";
                      else 
                      echo "<p>You are our first Rating!</p>"; 
                    mysql_select_db($DBName, $DBConnect); }
                    $TableName = "planeratings";
                    $SQLstring = "SHOW TABLES LIKE '$TableName'"; 
                    $QueryResult = @mysql_query($SQLstring, $DBConnect); 
                     if (mysql_num_rows($QueryResult) == 0) {
                    $SQLstring = "CREATE TABLE $TableName (countID SMALLINT
                    NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                    name VARCHAR(40), airdate VARCHAR(40), flighttime VARCHAR(40), flightnumber VARCHAR(40), friendly VARCHAR(40), space VARCHAR(40), comfort VARCHAR(40), clean VARCHAR(40), noise VARCHAR(40))"; 
                     $QueryResult = @mysql_query($SQLstring, $DBConnect);
                if ($QueryResult===FALSE)
                    echo "<p>Unable to create the table.</p>"
                     . "<p>Error code " . mysql_errno($DBConnect)
                     . ": " . mysql_error($DBConnect) .
                     "</p>"; }
                    $AName = stripslashes($_POST['name']);
                    $AirDate = stripslashes($_POST['airdate']);
                    $FlightTime = stripslashes($_POST['flighttime']);
                    $FlightNumber = stripslashes($_POST['flightnumber']);
                    $FFriendly = stripslashes($_POST['friendliness']);
                    $FSpace = stripslashes($_POST['room']);
                    $FComfort = stripslashes($_POST['comfortlevel']);
                    $FClean = stripslashes($_POST['cleanliness']);
                    $FNoise = stripslashes($_POST['noiselevel']);
                    $SQLstring = "INSERT INTO $TableName VALUES
                    (NULL, '$AName', '$airDate', '$FlightTime', '$FlightNumber', '$Friendly', '$Room', '$Comfortlevel', '$Cleanliness', '$Noiselevel')";
                  $QueryResult = @mysql_query($SQLstring, $DBConnect);
                   if ($QueryResult === FALSE)
                         echo "<p>Unable to execute the
                              query.</p>"
                            . "<p>Error code " . mysql_errno($DBConnect)
                            . ": " . mysql_error($DBConnect) . "</p>";
                    else
                         echo "<h1>Thanks For Adding To Our Rankings!</h1>";
                }
               mysql_close($DBConnect);
          }

?>
</body>
</html>
