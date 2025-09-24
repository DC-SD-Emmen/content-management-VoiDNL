<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $title = htmlspecialchars($_POST['title']);
  $genre = htmlspecialchars($_POST['genre']);
  $platform = htmlspecialchars($_POST['platform']);
  $releaseyear = htmlspecialchars($_POST['release_year']);
  $rating = htmlspecialchars($_POST['rating']);

  $image = $_FILES['image'];
  $imageName = $image['name'];

  $gamemanager->fileUpload($image);

  $gamemanager->addGame($title, $genre, $platform, $releaseyear, $rating, $imageName);
}

?>

  
  <form method='POST' style='display:none;' id='formulier' enctype='multipart/form-data'>
  <style>
      form {
        display: flex;
        flex-direction: column;
        width: 50%;
        margin: 0 auto;
        text-align: center;
      }
      label {
        margin-top: 10px;
        color: white;
        font-size: 20px;
      }
      input {
        margin-top: 5px;
        margin-bottom: 10px;
      }
    </style>
    <h1>Game Information</h1>
    <label for='title'>Title:</label>
    <input type='text' name='title' id='title' required>
    <br>
    <label for='genre'>Genre:</label>
    <input type='text' name='genre' id='genre' required>
    <br>
    <label for='platform'>Platform:</label>
    <input type='text' name='platform' id='platform' required>
    <br>
    <label for='release_year'>Release Year:</label>
    <input type='date' name='release_year' id='release_year' required>
    <br>
    <label for='rating'>Rating:</label>
    <input type='number' name='rating' id='rating' required>
    <br>
    <label for='image'>Image:</label>
    <input type='file' name='image' id='image' required>
    <br>
    <input type='submit' value='Add Game'>
    </form>
