<?php
include "db_connect.php";
include "php/func-book.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $description = $_POST['description'];
    $genre = $_POST['genre'];

    $cover = $_FILES['cover']['name'];
    $cover_tmp = $_FILES['cover']['tmp_name'];
    move_uploaded_file($cover_tmp, "uploads/cover/$cover");

    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    move_uploaded_file($file_tmp, "uploads/file/$file");

    if (update_book($conn, $book_id, $title, $author_id, $description, $genre, $cover, $file)) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Error updating book.";
    }
}
?>
