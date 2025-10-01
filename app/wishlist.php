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

    //get wishlist games for user
    $wishlistGames = $userManager->getWishlistGames($user_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WISHLIST</title>
    <link rel="stylesheet" href="wishlist.css">
    <h1>WISHLIST</h1>
</head>
<body>
    
</body>
</html>
<div id="gameGrid">

    <?php foreach ($wishlistGames as $gameObject): ?>

    <div class="gameCard">
        <a href='gamedetails.php?id=<?php echo $gameObject->getID(); ?>'> 
            <img src="./upload/<?php echo $gameObject->getImageName(); ?>" alt="game image" style="width:100%">
        </a>
    </div>
    
    <?php endforeach; ?>

</div>