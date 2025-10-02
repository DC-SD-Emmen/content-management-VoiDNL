<?php

    class UserManager {

        //private conn
        private $conn;

        //construct add parameter for conn
        public function __construct($conn) {
            $this->conn = $conn;
        }

        //public function insert user
        //use try and catch, user PDO
        public function insertUser($user_email, $user_name, $user_password) {
            try {
                $stmt = $this->conn->prepare("INSERT INTO users (user_email, user_name, user_password) VALUES (:user_email, :user_name, :user_password)");
                $stmt->bindParam(':user_email', $user_email);
                $stmt->bindParam(':user_name', $user_name);
                //hash the password
                $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
                $stmt->bindParam(':user_password', $hashed_password);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        //public function for get User by ID
        //use try and catch
        //use PDO
        //return User class object
        public function getUserByID($user_id) {
            try {
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = :user_id");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    return new User($row['user_id'], $row['user_email'], $row['user_name']);
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return null;
            }
        }

        //public function add to wishlist
        //use try and catch
        //use PDO
        public function addToWishlist($user_id, $game_id) {
            try {
                $stmt = $this->conn->prepare("INSERT INTO user_games (user_id, game_id) VALUES (:user_id, :game_id)");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':game_id', $game_id);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        //public function get wishlist games
        //use try and catch
        //use PDO
        //return array of Game class objects
        //name of table is user_games
        //name of table for games is games
        //name of table for users is users
        //user_id is foreign key in user_games
        //game_id is foreign key in user_games
        //use JOIN to get the games for the user
        //select all columns from games where user_id = :user_id
        public function getWishlistGames($user_id) {
            try {
                $stmt = $this->conn->prepare("SELECT g.* FROM games g JOIN user_games ug ON g.id = ug.game_id WHERE ug.user_id = :user_id");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $games = array();
                foreach ($result as $dataGame) {
                    $game = new Game();
                    $game->setID($dataGame['id']);
                    $game->setTitle($dataGame['title']);
                    $game->setGenre($dataGame['genre']);
                    $game->setPlatform($dataGame['platform']);
                    $game->setReleaseYear($dataGame['release_year']);
                    $game->setRating($dataGame['rating']);
                    $game->setImageName($dataGame['imagename']);
                    $games[] = $game;
                }
                return $games;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return array();
            }
            
        }
    }

?>