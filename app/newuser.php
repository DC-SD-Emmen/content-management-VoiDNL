<?php

    //start session
    session_start();

    //spl autoloader //classes
    spl_autoload_register(function ($class_name) {
        include 'classes/' . $class_name . '.php';
    });

    $database = new Database();
    $userManager = new UserManager($database->getConnection());

    //check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_email = $_POST['user_email'];
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];

        //insert user
        $inserted = $userManager->insertUser($user_email, $user_name, $user_password);

        if ($inserted) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error registering user.";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>Register New User</h2>
    <form method="POST" action="">
        <label for="user_email">Email:</label><br>
        <input type="email" id="user_email" name="user_email" required><br>
        <label for="user_name">Username:</label><br>
        <input type="text" id="user_name" name="user_name" required><br>
        <label for="user_password">Password:</label><br>
        <input type="password" id="user_password" name="user_password" required><br><br>
        <input type="submit" value="Register">
    </form>
    
</body>
</html>