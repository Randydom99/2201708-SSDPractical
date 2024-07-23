<?php
if (!isset($_GET['search'])) {
    header('Location: index.php');
    exit;
}
$searchTerm = htmlspecialchars($_GET['search']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Page</title>
</head>
<body>
    <h1>Search Result</h1>
    <p>Your search term: <?php echo $searchTerm; ?></p>
    <a href="index.php"><button>Return to Home Page</button></a>
</body>
</html>