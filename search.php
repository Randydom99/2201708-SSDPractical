<?php
require 'validate.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchTerm = trim($_POST['search']);
    
    if (validateXSS($searchTerm) && validateSQLInjection($searchTerm)) {
        header('Location: result.php?search=' . urlencode($searchTerm));
        exit;
    } else {
        // Clear the input if validation fails
        $searchTerm = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Search Page</h1>
    <form action="search.php" method="post">
        <label for="search">Enter search term:</label>
        <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" required>
        <button type="submit">Submit</button>
    </form>
    <?php
    if (!empty($searchTerm)) {
        echo '<p style="color:red;">Invalid input detected. Please try again.</p>';
    }
    ?>
</body>
</html>