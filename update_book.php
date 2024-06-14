<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    include "db_connect.php";
    include "php/func-book.php";
    include "php/func-author.php";

    if (isset($_GET['book_id'])) {
        $book_id = $_GET['book_id'];
        $book = get_book_by_id($conn, $book_id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $author_id = $_POST['author_id'];
            $description = $_POST['description'];
            $genre = $_POST['genre'];
            $cover = $_FILES['cover']['name'] ? $_FILES['cover']['name'] : $book['cover'];
            $file = $_FILES['file']['name'] ? $_FILES['file']['name'] : $book['file'];

            if ($_FILES['cover']['name']) {
                move_uploaded_file($_FILES['cover']['tmp_name'], "uploads/cover/" . $cover);
            }
            if ($_FILES['file']['name']) {
                move_uploaded_file($_FILES['file']['tmp_name'], "uploads/file/" . $file);
            }

            if (update_book($conn, $book_id, $title, $author_id, $description, $genre, $cover, $file)) {
                header("Location: admin.php");
            } else {
                echo "Error updating book.";
            }
        }

        $authors = get_all_authors($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Edit Book</h1>
    <form action="update_book.php?book_id=<?=$book_id?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?=$book['title']?>" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <select class="form-control" id="author" name="author_id" required>
                <?php foreach ($authors as $author) { ?>
                    <option value="<?=$author['author_id']?>" <?=($author['author_id'] == $book['author_id']) ? 'selected' : ''?>><?=$author['name']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required><?=$book['description']?></textarea>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" value="<?=$book['genre']?>" required>
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Cover</label>
            <input type="file" class="form-control" id="cover" name="cover">
            <img src="uploads/cover/<?=$book['cover']?>" width="100">
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">File</label>
            <input type="file" class="form-control" id="file" name="file">
            <a href="uploads/file/<?=$book['file']?>"><?=$book['file']?></a>
        </div>
        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
    <!-- Back Arrow -->
        <a href="admin.php" class="d-block my-3">
            <img src="img/back-arrow.PNG" alt="Back" width="30">
        </a>
</div>
</body>
</html>
<?php
    } else {
        echo "Book not found.";
    }
} else {
    header("Location: login.php");
    exit;
}
?>
