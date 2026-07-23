<?php 
$connection = new mysqli("localhost", "root", "1234", "mailer_system", 3307);

$qry="UPDATE users SET status='confirmed' WHERE id=?";
$sttr=$connection->prepare($qry);
$sttr->bind_param("i", $_GET['user_id']);
if ($sttr->execute()) {
    echo "Your registration has been confirmed!";
} else {
    echo "Error confirming registration: " . $sttr->error;
}

?>