<?php 
require_once "initDB.php";

// Patient data arrives through POST method..
$fname =  $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$pword = $_POST["pword"];
$phone = $_POST["phone"];
$dob = $_POST["dob"];
$gender = $_POST["gender"];


// Check if user with posted email and password already exists in database.
$sql_query = "SELECT * FROM patients WHERE email = '{$email}' AND pword = '{$pword}';"; 
$result = mysqli_query($conn, $sql_query);
if(mysqli_num_rows($result) > 0){
    echo "0";
    die();
}

// If not, create SQL statement from posted data and insert a new patient to DB.
$sql = <<<EOF
INSERT INTO patients (fname,lname,email,pword,phone,dob,gender)
VALUES ('{$fname}','{$lname}','{$email}','{$pword}','{$phone}','{$dob}','{$gender}');
EOF;

if (!mysqli_query($conn, $sql)){
    echo "insertion error";
    die();
}
// Return id of successfully inserted patient.
$patientId = mysqli_insert_id($conn);
echo "{$patientId}";

?>
