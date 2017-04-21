<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>REST training</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
            
    </head>
    <body>
        <form id="addBook" method="POST" action="index.php">    
            <h1>Add a new book</h1>
            <label>Title:
                <input type="text" name="title" placeholder="Write a title">
            </label>
            <label>Author:
                <input type="text" name="author" placeholder="Write author's name">
            </label>
            <input type="submit" value="Save the book">
        </form>
    <script src="script.js"></script>
    </body>
</html>
