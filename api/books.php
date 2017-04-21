<?php
require_once 'src/connection.php';
require_once 'src/Book.php';

$conn->query("SET CHARACTER SET utf8");

if($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET['id'])) {
        
        $id = $_GET['id'];
        $book = Book::load($conn, $id);
        $bookJSON = json_encode($book);
        echo $bookJSON;
        
    } else {
        $sql = "SELECT `id` FROM `book` ORDER BY `id` DESC";
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

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST = json_decode(file_get_contents('php://input'), true);
    if(isset($_POST['title']) && isset($_POST['author'])) {
      
        $title = $_POST['title'];
        $author = $_POST['author'];
       
        Book::create($conn, $title, $author);
    }    
}

if($_SERVER["REQUEST_METHOD"] === "DELETE") {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        Book::delete($conn, $id);
    }
}