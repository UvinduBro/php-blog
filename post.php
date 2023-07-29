<?php
// Include the database connection configuration
require_once 'db_config.php';

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch the post from the database based on the provided 'id'
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $post_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $post = mysqli_fetch_assoc($result);
        } else {
            // Redirect to a 404 page or any error page if the post with the given 'id' is not found
            header("Location: error_page.php");
            exit();
        }
    } else {
        // Redirect to a 500 page or any error page if the query preparation fails
        header("Location: error_page.php");
        exit();
    }
} else {
    // Redirect to a 404 page or any error page if the 'id' parameter is missing
    header("Location: error_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link rel="stylesheet" type="text/css" href="./css/post.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
        <p class="post-meta">Published on: <?php echo htmlspecialchars($post['published_at']); ?></p>
        <div class="post-content">
            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
        </div>
    </div>
</body>
</html>

