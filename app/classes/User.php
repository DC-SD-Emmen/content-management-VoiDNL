<?php


    class User {

        //private user_id, user_email, user_name
        private $user_id;
        private $user_email;
        private $user_name;

        //construct add parameters for user_id, user_email, user_name
        public function __construct($user_id, $user_email, $user_name) {
            $this->user_id = $user_id;
            $this->user_email = $user_email;
            $this->user_name = $user_name;
        }

        //getters
        public function getID() {
            return $this->user_id;
        }

        public function getEmail() {
            return $this->user_email;
        }

        public function getName() {
            return $this->user_name;
        }

        //setters
        public function setEmail($user_email) {
            $this->user_email = $user_email;
        }

        public function setName($user_name) {
            $this->user_name = $user_name;
        }

        public function setID($user_id) {
            $this->user_id = $user_id;
        }

    }

?>