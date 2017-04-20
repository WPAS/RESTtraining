<?php

class Book
{
    private $id;
    private $author;
    private $title;
    
    function __construct() {
        $this->id = -1;
        $this->author = "";
        $this->title = "";
    }    
    
    function getId() {
        return $this->id;
    }

    function getAuthor() {
        return $this->author;
    }

    function getTitle() {
        return $this->title;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAuthor($author) {
        $this->author = $author;
    }

    function setTitle($title) {
        $this->title = $title;
    }
    
    static public function create(mysqli $conn, $title, $author)
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
    
    static public function load(mysqli $conn, $id)
    {
        $id_safe = $conn->real_escape_string($id);
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
            $conn->real_escape_string($title), $conn->real_escape_string($author), $conn->real_escape_string($id) 
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
            $conn->real_escape_string($id) 
        );

        $result = $conn->query($sql);

        if ($result) {
            echo "Book was deleted!";
        } else {
            die("Error, Book was not deleted: " . $conn->errno);
        }
    }
}

