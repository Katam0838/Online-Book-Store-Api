<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "db_conn.php";

    # Author helper function
    include "php/func-author.php";
    $authors = get_all_authors($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Authors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Authors</h1>
        <?php if ($authors == 0) { ?>
            <div class="alert alert-warning text-center p-5" role="alert">
                <img src="img/empty.png" width="100"><br>
                There are no authors in the database
            </div>
        <?php } else { ?>
            <table class="table table-bordered shadow mt-4">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Author Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 0;
                    foreach ($authors as $author) {
                        $i++;
                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$author['name']?></td>
                        <td>
                            <a href="edit-author.php?id=<?=$author['author_id']?>" class="btn btn-warning">Edit</a>
                            <a href="php/delete-author.php?id=<?=$author['author_id']?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        <a href="admin.php" class="btn btn-primary mt-3">Back to Admin</a>
    </div>
</body>
</html>
<?php } else {
    header("Location: login.php");
    exit;
} ?>
