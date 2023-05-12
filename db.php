<?php
$server = "localhost";
$user = "root";
$pwd = "MYSQL_saurabh@5378*";
$db = "myapp";

$conn = new mysqli($server, $user, $pwd, $db);

 header("Content-Type: text/html");
if($conn->connect_errno)
{http_response_code(400);
    echo  $conn->connect_error; exit();}