<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="./css/dash.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['admin_username']; ?></h1>

        <div class="dashboard-card">
            <h2>Recent Posts</h2>
            <?php
            // Include the database connection configuration
            require_once 'db_config.php';

            // Fetch recent posts from the database
            $sql = "SELECT * FROM posts ORDER BY published_at DESC LIMIT 5";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <p>
                        <a href="post.php?id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                        <br>
                        <span class="published-at">Published on: <?php echo htmlspecialchars($row['published_at']); ?></span>
                    </p>
                    <?php
                }
            } else {
                echo "<p>No posts found.</p>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>

        <!-- Add more dashboard cards or sections as needed -->

    </div>
    <!-- TODO: Display a list of existing posts and options to edit/delete -->
</body>
</html>
