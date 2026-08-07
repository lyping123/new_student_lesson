<?php
include_once('db.php');

//check if button delete is cli
if(isset($_GET['id']) && $_GET['action'] == 'delete'){
    //get the data using $_GET[], inisde the $_GET[] is the name on the url
    $id=$_GET['id'];

    //delete user query
    $Query="DELETE FROM users WHERE id='$id'";
    //cehck if the query run success then messagebox will show
    if($result=mysqli_query($conn,$Query)){
        echo "<script>
                window.location.href='index.php';
                alert('Record Successfully Delete')
                </script>";
    //messagebox will show when users fail to delete
    }else{
        echo "<script>alert('Record Fails To Delete')</script>";
    }
}

$search = "";
if(isset($_GET['search']) && $_GET['search'] == 'search'){
     $search .= " WHERE ".$_GET['searchsct']." LIKE '%".$_GET['searchtxt']."%'";
}
?>

<?php
$qry = "SELECT * FROM student_registration where id=0".$search;
$sql = mysqli_query($conn, $qry);
?>

<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white
}
.pull-left {
    float: right;
}

.block {
    background-color: #87CEEB
    width: 100%
    float:left;
}
</style>
<div class="block">
    <!--<span class="pull left">Welcome:<?=$_SESSION['username'];?></span>-->
    <span class="pull right"><button type="submit"onclick="window.location.href='add.php'">Add</button></span>
</div>
<br />
<br />
<form method="get" action="index.php>
 <label>Search</label><br>
<select name="searchsct>"
    <option value="u_name">Name</option>
    <option value="u_ic">IC</option>
    <option value="u_email">Email</option>
    <option value="u_gender">Gender</option>
    <option value="u_address">Address</option>
    <option value="u_phone">Phone</option>
</select>
<br>
<input type="text" name="searchtxt">
<br>
<button type="submit" name="search" value="search">Search</button>
<br><br>
</form>

<div class="container" style="overflow-x:auto">
    <table>
        <thead>
       <th>Name</th>
       <th>IC</th>
       <th>Email</th>
       <th>Gender</th>
       <th>Address</th>
       <th>Phone</th>
       <th>Edit</th>
       <th>Delete</th>
      </thead>
      <tbody>
      <?php while($row=mysqli_fetch_array($sql)){?>
        <tr>
            <td><?=$row['u_name'];?></td>
            <td><?=$row['u_ic'];?></td>
            <td><?=$row['u_email'];?></td>
            <td><?=$row['u_gender'];?></td>
            <td><?=$row['u_address'];?></td>
            <td><?=$row['u_phone'];?></td>
            <td>
                <button type="submit"onclick="window.location.href='edit.php?id=<?=$row['id'];?>'"class="btn btn-primary">Edit</button></td>
            <td>
                <!--<button type="button"onclick="window.location.href='index.php?id=<?=$row['id'];?>&action=delete'"class"btn btn-primary">Delete</button>-->
                <a href="index.php?id=<?=$row['id'];?>&action=delete"onclick="return confirm('Are you sure you want to Delete?');"><button type="button" class="btn btn-primary">Delete</button></a></td>
    </tr>
        <?php } ?>
        <?php
                $result=mysqli_num_rows($sql);
                for($sloop=0;$sloop<$result;$sloop++){
                    $row=mysqli_fetch_array($sql);
            ?>

        <tr>
                <td><?=$row['u_name'];?></td>
                <td><?=$row['u_ic'];?></td>
                <td><?=$row['u_email'];?></td>
                <td><?=$row['u_gender'];?></td>
                <td><?=$row['u_address'];?></td>
                <td><?=$row['u_phone'];?></td>
                <td>
                <button type="submit"onclick="window.location.href='edit.php?id=<?=$row['id'];?>'"class="btn btn-primary">Edit</button></td>
                <td>
                <button type="button"onclick="window.location.href='index.php?id=<?=$row['id'];?>&action=delete'"class="btn btn-primary">Delete</button></td>
       </tr>
      <?php } ?>
      </tbody>
    </table>
</div>