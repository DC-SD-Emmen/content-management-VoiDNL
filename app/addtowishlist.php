<?php

    session_start();

    //autoloader
    spl_autoload_register(function ($class_name) {
        include 'classes/' . $class_name . '.php';
    });

    //check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $database = new Database();
    $userManager = new UserManager($database->getConnection());
    $gameManager = new GameManager($database->getConnection());

    //get user id from session
    $user_id = $_SESSION['user_id'];
    //get game id from query string
    $game_id = $_GET['game_id'];

    //add game to wishlist
    $added = $userManager->addToWishlist($user_id, $game_id);

    if($added) {
        echo "Game added to your wishlist. <a href='index.php'>Go back to library</a>.";
    } else {
        echo "Error adding game to wishlist. <a href='index.php'>Go back to library</a>.";
    }

?>