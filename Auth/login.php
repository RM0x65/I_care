<?php

$host = "localhost";
$user = "root";
$password = '';
$dbname = "icare";
$db = mysqli_connect($host, $user, $password, $dbname);

if (isset($_POST['register'])) {

    // Retrieve form data
    $name1 = $_POST['name1'];
    $pass  = $_POST['pass'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Prepare query
    $sql = "INSERT INTO patient (name1, pass, email, phone) 
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssss", $name1, $pass, $email, $phone);

    // Execute the query
    $saved = mysqli_stmt_execute($stmt);

    // If saving query is successful, redirect to the login page
    if ($saved) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($db);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h2>Registration Form</h2>
    <form method="POST" action="">
        <label for="name1">Name:</label><br>
        <input type="text" id="name1" name="name1" required><br>
        <label for="pass">Password:</label><br>
        <input type="password" id="pass" name="pass" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" required><br>
        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>