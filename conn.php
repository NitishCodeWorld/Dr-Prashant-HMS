<?php session_start();

//error_reporting(0); // Error Reporting Off

error_reporting(0); // Error Reporting On

/*ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);*/

$servername = "localhost";

$username = "root";

$password = "";

$db = "dr_prashant_emr";  //billing db 

$folder_name="hms";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){

    die("Connection failed: " . $conn->connect_error);

}

$conn2 = new mysqli('localhost','root','','drprashant_emr_old'); //OLD System Connection

if ($conn2->connect_error) {

    die("Connection failed: " . $conn2->connect_error);

}

define("ADMIN_URL", "http://localhost/dr_prashant/hms/"); //main software

define("ADMIN_URL2", "http://localhost/dr_prashant/"); //root

define("PAGI_LIMIT", 30);

date_default_timezone_set("Asia/Kolkata");

date_default_timezone_get();

?>