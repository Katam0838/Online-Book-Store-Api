<?php  
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    include "db_conn.php";
    include "php/func-book.php";
    include "php/func-customer.php";
    
    $books = get_all_books($conn);
    $customers = get_all_customers($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>

    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
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

        <a href="admin.php" class="d-block my-3">
            <img src="img/back_arrow.png" alt="Back" width="30">
        </a>

        <form action="php/add-order.php" method="post" class="shadow p-4 rounded mt-5" style="width: 90%; max-width: 50rem;">
            <h1 class="text-center pb-5 display-4 fs-3">Add New Order</h1>
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
                <label class="form-label">Customer</label>
                <select name="customer_id" class="form-control">
                    <?php foreach ($customers as $customer) { ?>
                        <option value="<?=$customer['customer_id']?>"><?=$customer['name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Book</label>
                <select name="book_id" class="form-control">
                    <?php foreach ($books as $book) { ?>
                        <option value="<?=$book['book_id']?>"><?=$book['title']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Order Date</label>
                <input type="date" class="form-control" name="order_date">
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" min="1">
            </div>
            <button type="submit" class="btn btn-primary">Add Order</button>
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
