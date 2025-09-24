<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $servername = "localhost";
    $db_username = "root";
    $db_password = "root";
    $dbname = "users_login";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Databaseverbinding mislukt: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registratie succesvol!";
    } else {
        echo "Fout bij registratie: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratieformulier</title>
    <style>
    
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: white;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #0b62e6;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #1b4ef6;
        }
    </style>
</head>
<body>
    <form method="POST" id="registrationForm">
        <h2>Game Library Registration</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Register">
    </form>

</body>
</html>
