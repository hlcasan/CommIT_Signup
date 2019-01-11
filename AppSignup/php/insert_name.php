<?php
//First load the DB connection
require_once("db_connect.php");

//This will show errors in the browser if there are some
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($dbi) {
    //Build the SQL query
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $country = $_REQUEST['country'];

    $q = "INSERT INTO signup_names (name, age, country) VALUES (?,?,?)";

    //This should contain 1 when the line is inserted
    $insertedRows = 0;

    //prepare statement, execute, store_result
    if ($insertStmt = $dbi->prepare($q)) {
        //update bind parameter types & variables as required
        //s=string, i=integer, d=double, b=blob
        $insertStmt->bind_param("sis", $name, $age, $country);
        $insertStmt->execute();
        $insertedRows += $insertStmt->affected_rows;
    } else {
        echo "Error";
    }

    //echo($insertedRows);
    $insertStmt->close();
    $dbi->close();
}
// Return to main page
echo "OK: $insertedRows item added";

?>