<?php 
$conn=new mysqli("localhost","root","1234","student",3307);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST['userName'];
    $sql = $conn->prepare("DELETE FROM student_list WHERE s_name = ?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $response = array("message" => "Data deleted successfully.");
    echo json_encode($response);
}

?>