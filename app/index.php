<?php

//start session
session_start();

//spl autoloader //classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

$database = new Database();
$gamemanager = new GameManager($database->getConnection());
$userManager = new UserManager($database->getConnection());

$gamesArray = $gamemanager->getAllGames();

//controleren of SESSION user bestaat
if (isset($_SESSION['user_name'])) {
    echo "<h2>Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!</h2>";
} else {
    //redirect to login page
    header("Location: login.php");
    exit();
}
    


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gamelibrary.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
        h1 {
            color: white;
            text-align: center;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-size: 50px;
        }
        h2 {
            color: white;
            text-align: center;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        #register-button{
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: blueviolet;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        #login-button{
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: blueviolet;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        #wishlist-button{
            position: absolute;
            top: 20px;
            left: 175px;
            padding: 10px 20px;
            background-color: blueviolet;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        #logout-button{
            position: absolute;
            top: 20px;
            right: 175px;
            padding: 10px 20px;
            background-color: blueviolet;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        #register-button:hover, #login-button:hover, #wishlist-button:hover, #logout-button:hover {
            background-color: indigo;
        }
    </style>
    <title>Game Library</title>
    <a href="newuser.php" id="register-button">REGISTER</a>
    <a href="login.php" id="login-button">LOGIN</a>
    <a href="wishlist.php" id="wishlist-button">WISHLIST</a>
    <a href="logout.php" id="logout-button">LOGOUT</a>
</head>
<body>
<h1>Game Library</h1>



    <div id="gameGrid">

      <?php foreach ($gamesArray as $gameObject): ?>

        <div class="gameCard">
            <a href='gamedetails.php?id=<?php echo $gameObject->getID(); ?>'> 
              <img src="upload/<?php echo $gameObject->getImageName(); ?>" alt="game image" style="width:100%">
            </a>
        </div>
       
      <?php endforeach; ?>

    </div>


    <button id="addGameButton" onclick='showForm()'>Add Game</button>
    <?php include 'addgame.php'; ?>

    <script>
        function showForm() {
            //if the form is not visible, show it
            var form = document.getElementById('formulier');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>

</body>
</html>