<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

    # Database Connection File
    include "db_conn.php";

    # Book helper function
    include "php/func-book.php";
    $books = get_all_books($conn);

    # Author helper function
    include "php/func-author.php";
    $authors = get_all_authors($conn);

    # Category helper function
    include "php/func-category.php";
    $categories = get_all_categories($conn);

    # Customer helper function
    include "php/func-customer.php";
    $customers = get_all_customers($conn);

    # Order helper function
    include "php/func-order.php";
    $orders = get_all_orders($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Bootstrap 5 JS bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="admin.php">Admin Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#booksMenu" role="button" aria-expanded="false" aria-controls="booksMenu">Books</a>
                            <div class="collapse" id="booksMenu">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="add-book.php">Add Book</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="view-books.php">View Books</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#categoriesMenu" role="button" aria-expanded="false" aria-controls="categoriesMenu">Categories</a>
                            <div class="collapse" id="categoriesMenu">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="add-category.php">Add Category</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="view-categories.php">View Categories</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#authorsMenu" role="button" aria-expanded="false" aria-controls="authorsMenu">Authors</a>
                            <div class="collapse" id="authorsMenu">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="add-author.php">Add Author</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="view-authors.php">View Authors</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#customersMenu" role="button" aria-expanded="false" aria-controls="customersMenu">Customers</a>
                            <div class="collapse" id="customersMenu">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="add-customer.php">Add Customer</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="view-customers.php">View Customers</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ordersMenu" role="button" aria-expanded="false" aria-controls="ordersMenu">Orders</a>
                            <div class="collapse" id="ordersMenu">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="add-order.php">Add Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="view-orders.php">View Orders</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <!-- Main content here -->
                <h2>Welcome to the Admin Dashboard</h2>

                <!-- Alerts -->
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

                <!-- Content goes here, for example listing books -->
                <?php if ($books == 0) { ?>
                <div class="alert alert-warning text-center p-5" role="alert">
                    <img src="img/empty.png" width="100">
                    <br>
                    There are no books in the database
                </div>
                <?php } else { ?>
                <h4>All Books</h4>
                <table class="table table-bordered shadow" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th style="width:10%">Author</th>
                            <th>Description</th>
                            <th style="width:10%">Category</th>
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
                                <a class="link-dark d-block text-center" href="uploads/files/<?=$book['file']?>">
                                    <?=$book['title']?>  
                                </a>
                            </td>
                            <td>
                                <?php 
                                if ($authors == 0) {
                                    echo "Undefined";
                                } else { 
                                    foreach ($authors as $author) {
                                        if ($author['author_id'] == $book['author_id']) {
                                            echo $author['name'];
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td><?=$book['description']?></td>
                            <td>
                                <?php 
                                if ($categories == 0) {
                                    echo "Undefined";
                                } else { 
                                    foreach ($categories as $category) {
                                        if ($category['id'] == $book['category_id']) {
                                            echo $category['name'];
                                        }
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
                <?php if ($categories == 0) { ?>
    <div class="alert alert-warning text-center p-5" role="alert">
        <img src="img/empty.png" width="100">
        <br>
        There is no category in the database
    </div>
<?php } else { ?>
    <h4 class="mt-5">All Categories</h4>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Category Name</th>
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
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
<?php if ($authors == 0) { ?>
    <div class="alert alert-warning text-center p-5" role="alert">
        <img src="img/empty.png" width="100">
        <br>
        There is no author in the database
    </div>
<?php } else { ?>
    <h4 class="mt-5">All Authors</h4>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Author Name</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $k = 0;
            foreach ($authors as $author) {
                $k++;   
            ?>
            <tr>
                <td><?=$k?></td>
                <td><?=$author['name']?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
<?php if ($customers == 0) { ?>
    <div class="alert alert-warning text-center p-5" role="alert">
        <img src="img/empty.png" width="100">
        <br>
        There is no customer in the database
    </div>
<?php } else { ?>
    <h4 class="mt-5">All Customers</h4>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Customer Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $l = 0;
            foreach ($customers as $customer) {
                $l++;   
            ?>
            <tr>
                <td><?=$l?></td>
                <td><?=$customer['name']?></td>
                <td><?=$customer['email']?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
<?php if ($orders == 0) { ?>
    <div class="alert alert-warning text-center p-5" role="alert">
        <img src="img/empty.png" width="100">
        <br>
        There is no order in the database
    </div>
<?php } else { ?>
    <h4 class="mt-5">All Orders</h4>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Customer</th>
                <th>Book</th>
                <th>Order Date</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $m = 0;
            foreach ($orders as $order) {
                $m++;   
            ?>
            <tr>
                <td><?=$m?></td>
                <td><?=$order['customer_name']?></td>
                <td><?=$order['title']?></td>
                <td><?=$order['order_date']?></td>
                <td><?=$order['quantity']?></td>
                <td><?=$order['total_price']?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

            </main>
        </div>
    </div>
</body>
</html>

<?php } else {
    header("Location: login.php");
    exit;
} ?>
