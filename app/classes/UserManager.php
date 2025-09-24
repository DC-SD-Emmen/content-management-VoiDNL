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
    }

?>