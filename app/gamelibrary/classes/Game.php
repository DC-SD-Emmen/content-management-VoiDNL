<?php

class Game {
    private $id;
    private $title;
    private $genre;
    private $platform;
    private $releaseYear;
    private $rating;
    private $imageName;

    /// Set Function

    public function setID($id) {
        $this->id = $id;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function setGenre($genre) {
        $this->genre = $genre;
    }
    public function setPlatform($platform) {
        $this->platform = $platform;
    }
    public function setReleaseYear($releaseYear) {
        $this->releaseYear = $releaseYear;
    }
    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function setImageName($imageName) {
        $this->imageName = $imageName;
    }

    /// Get Function

    public function getID() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }   
    public function getGenre() {
        return $this->genre;
    }
    public function getPlatform() {
        return $this->platform;
    }   
    public function getReleaseYear() {
        return $this->releaseYear;
    }
    public function getRating() {
        return $this->rating;
    }

    public function getImageName() {
        return $this->imageName;
    }
}