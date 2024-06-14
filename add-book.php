<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "db_conn.php";

    # Category helper function
    include "php/func-category.php";
    $categories = get_all_categories($conn);

    # Author helper function
    include "php/func-author.php";
    $authors = get_all_authors($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>

    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="admin.php">Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <!-- Back Arrow -->
        <a href="admin.php" class="d-block my-3">
            <img src="img/back_arrow.png" alt="Back" width="30">
        </a>

        <form action="php/add-book.php" method="post" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem;" enctype="multipart/form-data">
            <h1 class="text-center pb-5 display-4 fs-3">Add New Book</h1>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?=htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?=htmlspecialchars($_GET['success']); ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label class="form-label">Book Title</label>
                <input type="text" class="form-control" name="book_title">
            </div>
            <div class="mb-3">
                <label class="form-label">Author</label>
                <select class="form-control" name="book_author">
                    <?php foreach ($authors as $author) { ?>
                        <option value="<?=$author['author_id']?>"><?=$author['name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select class="form-control" name="book_category">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?=$category['id']?>"><?=$category['name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="book_description" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" name="stock_quantity" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="text" class="form-control" name="price" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Book Cover</label>
                <input type="file" class="form-control" name="book_cover">
            </div>
            <div class="mb-3">
                <label class="form-label">File</label>
                <input type="file" class="form-control" name="book_file">
            </div>

            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
</body>
</html>

<?php } else {
    header("Location: login.php");
    exit;
} ?>
