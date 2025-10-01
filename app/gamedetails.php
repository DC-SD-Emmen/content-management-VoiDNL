<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Details</title>
    <link rel="stylesheet" href="gamelibrary.css">
    <style>
        p {
            font-size: 18px;
            color: white;
            text-align: center;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 20px;
            color: red;
            text-decoration: none;
            border: 2px solid red;
            padding: 10px;
            hover: background-color: red;
            hover: color: white;
        }
    </style>
</head>
<body>

    <?php

        $id = $_GET['id'];

        // echo "de game id: " . $id;

        //spl autoloader //classes
        spl_autoload_register(function ($class_name) {
            include 'classes/' . $class_name . '.php';
        });

        $database = new Database();
        $gamemanager = new GameManager($database->getConnection());

        //nu wil je 1 game ophalen, aan de hand van de ID die is meegestuurd

        //deze functie om 1 game op te halen die wil je maken in de GameManager class

        //maar op deze pagina wil die je functie oproepen

        //zodat je hier die details over die game kan laten zien

        $game = $gamemanager->getGame($id);
        
        echo "<p><img src='upload/" . $game->getImageName() . "' alt='game image' style='width:300px;'></p>";
        echo "<p>Title: " . $game->getTitle() . "</p>";
        echo "<p>Genre: " . $game->getGenre() . "</p>";
        echo "<p>Platform: " . $game->getPlatform() . "</p>";
        echo "<p>Release Year: " . $game->getReleaseYear() . "</p>";
        echo "<p>Rating: " . $game->getRating() . "</p>";
        
       
        //hier moet nog code komen zodat je de game details op het scherm kan laten zien
        //je kan ook kijken bij index.php hoe je dat daar hebt gedaan

        //add link to 'add to wishlist' page, passing the game id
        echo "<p><a href='addtowishlist.php?game_id=" . $game->getID() . "'>Add to Wishlist</a></p>";

        //back button (go back to index.php)
        echo "<p><a href='index.php'>Back to Game Library</a></p>";


 
    ?>
    
</body>
</html>