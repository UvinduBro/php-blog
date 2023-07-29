<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>X</title>

    
</head>
<body>


<!----<header>
        <div class="header-container">
            <div class="logo">
                <h1>X</h1>
            </div>
            <div class="social-icons">
                <a href="https://facebook.com/UvinduOnline" class="social-icon"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                <a href="https://twitter.com/UvinduBro" class="social-icon"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                <a href="https://linkedin.com/in/uvindubro" class="social-icon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
            </div>
        </div>
</header>---->


<div class="container">
<h1>කියවප​න්</h1>

    <?php
    // Include the database connection configuration
    require_once 'db_config.php';

    // Fetch posts from the database
    $sql = "SELECT * FROM posts ORDER BY published_at DESC";
    $result = mysqli_query($conn, $sql);

    // Check if there are posts to display
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="blog-card">
            <a href="post.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color: #1d1e1e;">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p><?php echo substr(htmlspecialchars($row['content']), 0, 200) . '...'; ?></p>
                <p class="published-at">Published on: <?php echo htmlspecialchars($row['published_at']); ?></p>
            </a>
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
</div>



<style>
    /* Reset some default styles */
body, h1, h2, p {
  margin: 0;
  padding: 0;
}

body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  line-height: 1.6;
  color: #333;
  background-color: #f9f9f9;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

header {
  background-color: #007bff;
  padding: 10px 0;
}

.header-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 800px;
  margin: 0 auto;
}

.logo {
  margin-left: 20px;
}

.logo h1 {
  color: #fff;
}

.social-icons {
  margin-right: 20px
}

.social-icon {
  margin-left: 10px;
}

/* The rest of your CSS styles... */

</style>
</body>
</html>
