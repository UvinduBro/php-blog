<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="form-wrapper">
        <div class="container">
            <form action="login_process.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>
