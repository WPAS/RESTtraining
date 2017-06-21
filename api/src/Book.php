<?php

class Book implements JsonSerializable
{
    private $id;
    private $author;
    private $title;
    
    public function __construct() {
        $this->id = -1;
        $this->author = "";
        $this->title = "";
    }    
    
    public function getId() {
        return $this->id;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getTitle() {
        return $this->title;
    }

    private function setId($id) {
        $this->id = $id;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    
    public static function create(mysqli $conn, $title, $author)
    {
        $sql = sprintf("INSERT INTO `book` (`title`, `author`) VALUES ('%s', '%s')",
            $conn->real_escape_string($title), $conn->real_escape_string($author)
        );

        $result = $conn->query($sql);

        if ($result) {
            echo "Book was saved!";
        } else {
            die("Error, Book not saved: " . $conn->errno);
        }
    }
    
    public static function load(mysqli $conn, $id)
    {
        $id_safe = (int) $conn->real_escape_string($id);
        $sql = "SELECT * FROM `book` WHERE `id` = $id_safe";
        $result = $conn->query($sql);

        if (!$result) {
            die('Query error: ' . $conn->error);
        }

        if (1 === $result->num_rows) {
            $data = $result->fetch_assoc();

            $book = new Book();

            $book->setId($data['id']);
            $book->setTitle($data['title']);
            $book->setAuthor($data['author']);

            return $book;
        } else {
            return false;
        }
    }
    
    static public function update(mysqli $conn, $title, $author, $id)
    {
        $sql = sprintf("UPDATE `book` SET `title` = '%s', `author` = '%s' WHERE id = '%s'",
            $conn->real_escape_string($title), $conn->real_escape_string($author), (int) $conn->real_escape_string($id) 
        );

        $result = $conn->query($sql);

        if ($result) {
            echo "Book was updated!";
        } else {
            die("Error, Book not updated: " . $conn->errno);
        }
    }

    static public function delete(mysqli $conn, $id)
    {
        $sql = sprintf("DELETE FROM `book` WHERE id = '%s'",
            (int) $conn->real_escape_string($id) 
        );

        $result = $conn->query($sql);

        if ($result) {
            echo "Book was deleted!";
        } else {
            die("Error, Book was not deleted: " . $conn->errno);
        }
    }
    
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}