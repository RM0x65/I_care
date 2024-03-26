<?php
session_start();

$host = "localhost";
$user = "root";
$password = '';
$dbname = "icare";
$db = mysqli_connect($host, $user, $password, $dbname);

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Prepare query
    $sql = "SELECT * FROM patient WHERE email = ? AND pass = ?";
    $stmt = mysqli_prepare($db, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $email, $pass);

    // Execute the query
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if user exists
    if ($user = mysqli_fetch_assoc($result)) {
        // User found, create session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $user['email'];
        $_SESSION['id'] = $user['id']; // Assuming 'id' is a column in your 'patient' table

        // Redirect to user profile page
        header("Location: profile.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login Form</h2>
    <form method="POST" action="">
        <label for="email">email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="pass">Password:</label><br>
        <input type="password" id="pass" name="pass" required><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>