<?php 
include 'db.php';

$qry = $conn->prepare("SELECT *,records.checkin_date as checkin_date FROM records INNER JOIN visitor  ON records.token_id = visitor.id");
$qry->execute();
$result = $qry->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    </style>
<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Contact Number</th>
            <th>Check-in Date</th>
            <th>Check-in Status</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['contact_number']; ?></td>
            <td><?php echo $row['checkin_date']; ?></td>
            <td><?php echo $row['checkstatus']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    
</body>
</html>