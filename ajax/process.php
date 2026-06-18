<?php 
$conn=new mysqli("localhost","root","1234","student",3307);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST['userName'];
    $sql = $conn->prepare("SELECT * FROM student_list WHERE s_name LIKE ?");
    $like = '%' . $username . '%';
    $sql->bind_param("s", $like);
    $sql->execute();
    $result = $sql->get_result();
    $response=array();
    if($result->num_rows > 0){
        $s_name =array();
        while($row = $result->fetch_assoc()){
            $s_name[] = $row["s_name"]; 
        }
        $response["s_name"] = $s_name;
    } else {
        $response["s_name"] = "Student not found.";
    }
    echo json_encode($response);
}




?>