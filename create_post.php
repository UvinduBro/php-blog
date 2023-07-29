<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <link rel="stylesheet" type="text/css" href="./css/createpost.css">
</head>
<body>
    <div class="container">
        <h1>Create New Post</h1>
        <form action="create_post_process.php" method="post">
            <label for="title">Title:</label>
            <input type="text" name="title" required>
            
            <label for="content">Content:</label>
            <textarea name="content" required></textarea>
            
            <input type="submit" value="Publish">
        </form>
    </div>
