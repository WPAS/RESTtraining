<?php
require_once 'src/connection.php';
require_once 'src/Book.php';

if($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET['id'])) {
        
        $id = $_GET['id'];
        $book = Book::load($conn, $id);
        $bookJSON = json_encode($book);
        echo $bookJSON;
        
    } else {
        $conn->query("SET CHARACTER SET utf8");

        $sql = "SELECT `id` FROM `book`";
        $result = $conn->query($sql);

        if (!$result) {
            die('Query error: ' . $conn->error);
        }

        if (0 !== $result->num_rows) {
            $books = [];
            foreach($result as $row){
                $id = $row['id'];
                $books[] = Book::load($conn, $id);
            }
            $booksJSON = json_encode($books);
            echo $booksJSON;

        } else {
            return false;
        }          
    }    
}


