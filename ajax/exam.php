<?php
// ========== Step 1: Connect to the database ==========
$conn = new mysqli("localhost", "root", "", "recipe_book");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ========== Step 2: Handle the search bar ==========
// If the user typed something, use that keyword; otherwise show everything
$keyword = $_GET['keyword'] ?? '';

$sql = "SELECT * FROM recipes WHERE main_ingredient LIKE '%$keyword%' ";
$result = $conn->query($sql);   

$count = $result->num_rows;
$total_time = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Recipe Book</title>
</head>
<body>

<h1>My Recipe Book</h1>

<!-- Search bar: type an ingredient, e.g. Chicken -->
<form method="GET">
    Enter an ingredient: <input type="text" name="keyword" value="<?=$keyword; ?>">
    <button type="submit">Search</button>
</form>

<hr>

<?php while ($r = $result->fetch_assoc()): 

$total_time += $r['cooking_time'];
$shortest_time = 999999;
$shortest_name = "";
if ($r['cooking_time'] < $shortest_time) {
        $shortest_time = $r['cooking_time'];
        $shortest_name = $r['recipe_name'];
}
?>
    <div>
        <h3>
            <?=$r['recipe_name']; ?>
            <?php if ($r['main_ingredient'] == $shortest_name) echo "  <<< Fastest recipe!"; ?>
        </h3>
        <p>Main ingredient: <?=$r['main_ingredient']; ?></p>
        <p>Cooking time: <?=$r['cooking_time']; ?> minutes</p>
        <p>Instructions: <?=$r['instructions']; ?></p>
    </div>
    <hr>

<?php endwhile; ?>

<?php if ($count > 0): ?>
    <h2>Average cooking time: <?php echo round($total_time / $count, 1); ?> minutes</h2>
<?php else: ?>
    <p>No recipes found. Try a different keyword.</p>
<?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
