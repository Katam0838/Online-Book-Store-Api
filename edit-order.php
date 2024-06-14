<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "db_conn.php";

    # Book helper function
    include "php/func-book.php";
    $books = get_all_books($conn);

    # Customer helper function
    include "php/func-customer.php";
    $customers = get_all_customers($conn);

    # Order helper function
    include "php/func-order.php";

    if (isset($_GET['id'])) {
        $order_id = $_GET['id'];
        $order = get_all_orders($conn, $order_id);

        if ($order) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Order</h1>
        <form action="php/edit-order.php" method="post" class="shadow p-4 rounded mt-5">
            <input type="hidden" name="order_id" value="htmlspecialchars($order['order_id'])">
            <div class="mb-3">
                <label class="form-label">Customer</label>
                <select name="customer_id" class="form-control" required>
                    <?php foreach ($customers as $customer) { ?>
                        <option value="<?=htmlspecialchars($customer['customer_id'])?>" <?=isset($order['customer_id']) && $customer['customer_id'] == $order['customer_id'] ? 'selected' : ''?>>
                            <?=htmlspecialchars($customer['name'])?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Book</label>
                <select name="book_id" class="form-control" required>
                    <?php foreach ($books as $book) { ?>
                        <option value="<?=htmlspecialchars($book['book_id'])?>" <?=isset($order['book_id']) && $book['book_id'] == $order['book_id'] ? 'selected' : ''?>>
                            <?=htmlspecialchars($book['title'])?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="htmlspecialchars($order['quantity'])?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Order Date</label>
                <input type="date" name="order_date" class="form-control" value="htmlspecialchars($order['order_date'])" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
        <a href="view-orders.php" class="btn btn-secondary mt-3">Back to Orders</a>
    </div>
</body>
</html>
<?php 
        } else {
            echo "Order not found!";
        }
    } else {
        echo "Invalid Request!";
    }
} else {
    header("Location: login.php");
    exit;
} 
?>
