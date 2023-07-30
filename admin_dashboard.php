<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

// Include the database connection configuration
require_once 'db_config.php';

// Function to delete a post by ID
function deletePost($conn, $post_id) {
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $post_id);
        mysqli_stmt_execute($stmt);
    }
}

// Check if the 'action' parameter is present in the URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $post_id = $_GET['id'];

    if ($action === 'delete') {
        // Delete the post and redirect back to the dashboard
        deletePost($conn, $post_id);
        header("Location: admin_dashboard.php");
        exit();
    } elseif ($action === 'edit') {
        // Redirect to the edit post page
        header("Location: edit_post.php?id=$post_id");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="./css/dash.css">
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['admin_username']; ?></h1>

    <a href="create_post.php">Create New Post</a>
    <br>

    <?php
    // Fetch posts from the database
    $sql = "SELECT * FROM posts ORDER BY published_at DESC";
    $result = mysqli_query($conn, $sql);

    // Check if there are posts to display
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="post-card">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p class="published-at">Published on: <?php echo htmlspecialchars($row['published_at']); ?></p>
                <p><?php echo substr(htmlspecialchars($row['content']), 0, 200) . '...'; ?></p>
                <div class="post-actions">
                    <a href="admin_dashboard.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="admin_dashboard.php?action=delete&id=<?php echo $row['id']; ?>">Delete</a>
                </div>
            </div>
            <hr>
            <?php
        }
    } else {
        echo "<p>No posts found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

</body>
</html>
