<?php
/// login pagina met een html formulier voor gebruikersnaam en wachtwoord
/// controleer de gebruikersnaam en het wachtwoord
/// als correct, start een sessie en sla de gebruikersinformatie op in de sessie
session_start();
//spl autoloader //classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

$database = new Database();
$userManager = new UserManager($database->getConnection());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    //fetch user by username
    try {
        $stmt = $database->getConnection()->prepare("SELECT * FROM users WHERE user_name = :user_name");
        $stmt->bindParam(':user_name', $user_name);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify($user_password, $row['user_password'])) {
            //password is correct, start session
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h2>LOGIN</h2>
    <form method="POST" action="">
        <label for="user_name">Username:</label><br>
        <input type="text" id="user_name" name="user_name" required><br>
        <label for="user_password">Password:</label><br>
        <input type="password" id="user_password" name="user_password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="newuser.php" id="newuser">Register here</a>.</p>
</body>
</html>