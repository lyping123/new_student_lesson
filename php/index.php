<?php 
    include "db.php";

    "Hello World <br>";
    
    $name="john";
    $age=31;
    $gender="male";
    $age+=5;
    
    "My name is $name, I am $age years old and I am a $gender.";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username=$_POST["username"];
        $password=$_POST["password"];

        $qry=$conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $qry->bind_param("ss",$username,$password);
        $qry->execute();
        $result=$qry->get_result();
        if($result->num_rows>0){
            echo "Login successful";
        }else{
            echo "Login failed";
        }
    }
    
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <div class="card">
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                </div>
                <a href="register.php">did not have account, click me for register</a><br>
                <button type="submit" name="login">Login</button>
            </form>
            
        </div>
    </div>
    
</body>
</html>