<?php 
include 'mailer_function.php';
$connection = new mysqli("localhost", "root", "1234", "mailer_system", 3307);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user into the database
    $stmt = $connection->prepare("INSERT INTO users (email, password,status) VALUES (?, ?, 'pending')");
    $stmt->bind_param("ss", $email, $password);
    if ($stmt->execute()) {
        
        $id=$connection->insert_id;
        $subject = "Registration Confirmation";
        $message = "Click the link below to confirm your registration:\n\n http://localhost:8080/confirm.php?user_id=$id";
        if (sendEmail($email, $subject, $message)) {
            echo "Registration successful! A confirmation email has been sent.";
        } else {
            echo "Registration successful, but failed to send confirmation email.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Register</h1>
    <form action="register.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>