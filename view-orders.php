<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "db_conn.php";

    # Order helper function
    include "php/func-order.php";
    $orders = get_all_orders($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Orders</h1>
        <?php if ($orders == 0) { ?>
            <div class="alert alert-warning text-center p-5" role="alert">
                <img src="img/empty.png" width="100"><br>
                There are no orders in the database
            </div>
        <?php } else { ?>
            <table class="table table-bordered shadow mt-4">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Customer</th>
                        <th>Book</th>
                        <th>Order Date</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 0;
                    foreach ($orders as $order) {
                        $i++;
                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$order['customer_name']?></td>
                        <td><?=$order['title']?></td>
                        <td><?=$order['order_date']?></td>
                        <td><?=$order['quantity']?></td>
                        <td><?=$order['total_price']?></td>
                        <td>
                            <a href="edit-order.php?id=<?=$order['order_id']?>" class="btn btn-warning">Edit</a>
                            <a href="php/delete-order.php?id=<?=$order['order_id']?>" class="btn btn-danger">Delete</a>
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
