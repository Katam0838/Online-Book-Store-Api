<?php  
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    include "db_conn.php";

    include "php/func-category.php";
    $categories = get_all_categories($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <a href="admin.php" class="btn btn-secondary my-3">Back to Admin</a>
        <h1 class="text-center my-5">All Categories</h1>
        
        <?php if ($categories == 0) { ?>
            <div class="alert alert-warning text-center p-5">
                <img src="img/empty.png" width="100"><br>
                There is no category in the database
            </div>
        <?php } else { ?>
            <table class="table table-bordered shadow">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $j = 0;
                    foreach ($categories as $category) {
                        $j++;
                    ?>
                    <tr>
                        <td><?=$j?></td>
                        <td><?=$category['name']?></td>
                        <td>
                            <a href="edit-category.php?id=<?=$category['id']?>" class="btn btn-warning">Edit</a>
                            <a href="php/delete-category.php?id=<?=$category['id']?>" class="btn btn-danger">Delete</a>
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
