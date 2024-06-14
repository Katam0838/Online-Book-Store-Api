<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # If author ID is not set
    if (!isset($_GET['id'])) {
        # Redirect to admin.php page
        header("Location: admin.php");
        exit;
    }

    $id = $_GET['id'];

    # Database Connection File
    include "db_conn.php";

    # Author helper function
    include "php/func-author.php";
    $author = get_author_by_id($conn, $id);

    # If the ID is invalid
    if ($author == false) {
        # Redirect to admin.php page
        header("Location: admin.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>

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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Store</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-book.php">Add Book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-category.php">Add Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-author.php">Add Author</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-customer.php">Add Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Back Arrow -->
        <a href="admin.php" class="d-block my-3">
            <img src="img/back-arrow.PNG" alt="Back" width="30">
        </a>

        <form action="php/edit-author.php" method="post" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem;">
            <h1 class="text-center pb-5 display-4 fs-3">Edit Author</h1>
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
                <label class="form-label">Author Name</label>
                <input type="hidden" name="author_id" value="<?=$author['author_id']?>">
                <input type="text" class="form-control" name="author_name" value="<?=$author['name']?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>

<?php 
} else {
    header("Location: login.php");
    exit;
} 
?>
