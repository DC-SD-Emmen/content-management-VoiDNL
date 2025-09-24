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
    </style>
    <title>Game Library</title>
    <a href="newuser.php">NIEUW ACCOUNT MAKEN</a>
</head>
<body>
<h1>Game Library</h1>

<?php

//spl autoloader //classes
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

$database = new Database();
$gamemanager = new GameManager($database->getConnection());
$userManager = new UserManager($database->getConnection());

$gamesArray = $gamemanager->getAllGames();


?>

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