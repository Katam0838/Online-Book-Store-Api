<?php  
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    include "db_conn.php";

    include "php/func-book.php";
    $books = get_all_books($conn);

    include "php/func-author.php";
    $authors = get_all_authors($conn);

    include "php/func-category.php";
    $categories = get_all_categories($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <a href="admin.php" class="btn btn-secondary my-3">Back to Admin</a>
        <h1 class="text-center my-5">All Books</h1>
        
        <?php if ($books == 0) { ?>
            <div class="alert alert-warning text-center p-5">
                <img src="img/empty.png" width="100"><br>
                There is no book in the database
            </div>
        <?php } else { ?>
            <table class="table table-bordered shadow" style="width:100%">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th style="width:10%">Author</th>
                        <th>Description</th>
                        <th style="width:10%">Category</th>
                        <th style="width:15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 0;
                    foreach ($books as $book) {
                        $i++;
                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td>
                            <img width="100" src="uploads/cover/<?=$book['cover']?>" >
                            <a class="link-dark d-block text-center" href="uploads/files/<?=$book['file']?>"><?=$book['title']?></a>
                        </td>
                        <td>
                            <?php 
                            foreach ($authors as $author) {
                                if ($author['author_id'] == $book['author_id']) {
                                    echo $author['name'];
                                }
                            }
                            ?>
                        </td>
                        <td><?=$book['description']?></td>
                        <td>
                            <?php 
                            foreach ($categories as $category) {
                                if ($category['id'] == $book['category_id']) {
                                    echo $category['name'];
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <a href="edit-book.php?id=<?=$book['book_id']?>" class="btn btn-warning">Edit</a>
                            <a href="php/delete-book.php?id=<?=$book['book_id']?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</body>
</html>

<?php 
} else {
    header("Location: login.php");
    exit;
}
?>
