<?php
// this header needs to set according to where your frontend is running
header("Access-Control-Allow-Origin: http://localhost");

header("Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: plain/text');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods,Access-Control-Allow-Origin, Access-Control-Allow-Credentials, Authorization, X-Requested-With");

include_once "./db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['crud_req'] == 'register')
    registerUser($conn);


function registerUser($conn)
{

    $fName = $_POST['fName'];
    $lName  = $_POST['lName'];
  
    $email = $_POST['email'];
  

    if (empty($fName) || empty($lName)) {
        http_response_code(401);
        echo "All fields need to be filled!!!";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "bad email address";
        exit();
    }



    $sql = "Insert into demo (First_name, Last_name, email) values (?,?,?);";
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        echo "smething went wrong!!!";
        exit();
    }
    $stmt->bind_param('sss', $fName, $lName, $email);
    $stmt->execute();
    if ($stmt->affected_rows) {
        http_response_code(200);
        echo "Congratulation!!\n Registration successful\n";
    }
    exit();
}
