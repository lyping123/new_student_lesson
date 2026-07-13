<?php
$conn = mysqli_connect("localhost","root","qwe123","recipe_db");
$search = $_GET['search'] ?? '';
$where = $search ? " WHERE main_ingredient LIKE '%$search%'" : '';

$stats = mysqli_fetch_array(mysqli_query($conn, "SELECT AVG(cooking_time) avg, MIN(cooking_time) min FROM recipes$where"));
$result = mysqli_query($conn, "SELECT * FROM recipes$where");
?>

    <style>
    .card { 
        border:1px solid black; 
        padding:10px; 
        margin:10px; 
        width:200px; 
        display:inline-block; }
    .hi { 
        background:yellow; }
    </style> 

    <form>
        <input name="search" placeholder="Ingredient">
        <button>Search</button>
    </form>

    <p>Average Cooking Time: <?= round($stats['avg'],1) ?> mins</p>

    <?php while($row = mysqli_fetch_array($result)){ ?>
    <div class="card <?= $row['cooking_time']==$stats['min'] ? 'hi' : '' ?>">
        <h3>             <?= $row['recipe_name'] ?></h3>
        <p>Ingredient:   <?= $row['main_ingredient'] ?></p>
        <p>Time:         <?= $row['cooking_time'] ?> mins</p>
        <p>Instructions: <?= $row['instructions'] ?></p>
    </div>
    <?php } ?>