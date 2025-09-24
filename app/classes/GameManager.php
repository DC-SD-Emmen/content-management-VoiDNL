<?php

    class GameManager {

        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function getAllGames() {
            try {
                $stmt = $this->conn->prepare("SELECT * FROM games");
                $stmt->execute();

                //zet de fetch modus naar associative array
                //dit is een constante die je kan gebruiken om de data op te halen
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                //fetch alle records en stop ze in result
                $result = $stmt->fetchAll();

                $gamesArray = [];

                foreach($result as $dataGame) {
                    $game = new Game();
                    $game->setID($dataGame['id']);
                    $game->setTitle($dataGame['title']);
                    $game->setGenre($dataGame['genre']);
                    $game->setPlatform($dataGame['platform']);
                    $game->setReleaseYear($dataGame['release_year']);
                    $game->setRating($dataGame['rating']);
                    $game->setImageName($dataGame['imagename']);
                    $gamesArray[] = $game;
                }

                return $gamesArray;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public function addGame($title, $genre, $platform, $releaseyear, $rating, $imageName) {

            try {
              //eerst de statement klaar zetten, met placeholders als value
                $stmt = $this->conn->prepare("INSERT INTO games (title, genre, platform, release_year, rating, imagename) VALUES (:title, :genre, :platform, :release_year, :rating, :imagename)");
              //met bindparam de variabele binden aan de placeholder
              //waarom: omdat je dan geen sql injection kan doen
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':genre', $genre);
                $stmt->bindParam(':platform', $platform);
                $stmt->bindParam(':release_year', $releaseyear);
                $stmt->bindParam(':rating', $rating);
                $stmt->bindParam(':imagename', $imageName);
                $stmt->execute();
                echo "New record created successfully";
                } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

        }

        public function fileUpload($image) {
            $target_dir = "upload/";
            $target_file = $target_dir . basename($image["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if image file is a actual image or fake image
            
              $check = getimagesize($image["tmp_name"]);
              if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
              } else {
                echo "File is not an image.";
                $uploadOk = 0;
              }
            
            // Check if file already exists
            if (file_exists($target_file)) {
              echo "Sorry, file already exists.";
              $uploadOk = 0;
            }
            
            // Check file size
            if ($image["size"] > 5000000) {
              echo "Sorry, your file is too large.";
              $uploadOk = 0;
            }
            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            }
            
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
              if (move_uploaded_file($image["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $image["name"])). " has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }
        }

        public function getGame($gameID) {

          try {
            // Prepare the SQL statement to prevent SQL injection
            $stmt = $this->conn->prepare("SELECT * FROM games WHERE id = :id");
            
            // Bind the parameter to the statement
            $stmt->bindParam(':id', $gameID);
            
            //  Execute the statement
            $stmt->execute();

            // Set the fetch mode to associative array
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            //make new game object
            $game = new Game();

            // Loop through the result and set the game properties
            foreach($result as $dataGame) {
                $game->setID($dataGame['id']);
                $game->setTitle($dataGame['title']);
                $game->setGenre($dataGame['genre']);
                $game->setPlatform($dataGame['platform']);
                $game->setReleaseYear($dataGame['release_year']);
                $game->setRating($dataGame['rating']);
                $game->setImageName($dataGame['imagename']);
            }

            // Return the game object
            return $game;

          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
        }

    }



?>