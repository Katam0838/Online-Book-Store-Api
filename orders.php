<?php
session_start();

# Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    # Database Connection File
    include "../db_conn.php";

    # Validation helper function
    include "func-validation.php";

    /** 
      If all input fields are filled
    **/
    if (isset($_POST['customer_id']) &&
        isset($_POST['book_id'])      &&
        isset($_POST['quantity'])     &&
        isset($_POST['total_price'])) {

        # Get data from POST request
        $customer_id = $_POST['customer_id'];
        $book_id     = $_POST['book_id'];
        $quantity    = $_POST['quantity'];
        $total_price = $_POST['total_price'];

        # Simple form validation
        $text = "Customer ID";
        $location = "../create-order.php";
        $ms = "error";
        is_empty($customer_id, $text, $location, $ms, "");

        $text = "Book ID";
        $location = "../create-order.php";
        $ms = "error";
        is_empty($book_id, $text, $location, $ms, "");

        $text = "Quantity";
        $location = "../create-order.php";
        $ms = "error";
        is_empty($quantity, $text, $location, $ms, "");

        $text = "Total Price";
        $location = "../create-order.php";
        $ms = "error";
        is_empty($total_price, $text, $location, $ms, "");

        # Insert new order into the database
        $sql = "INSERT INTO Orders (customer_id, book_id, order_date, quantity, total_price)
                VALUES (?, ?, NOW(), ?, ?)";
        $stmt = $conn->prepare($sql);
        $res  = $stmt->execute([$customer_id, $book_id, $quantity, $total_price]);

        # Check if the query was successful
        if ($res) {
            # Success message
            $sm = "Order successfully created!";
            header("Location: ../create-order.php?success=$sm");
            exit;
        } else {
            # Error message
            $em = "Unknown Error Occurred!";
            header("Location: ../create-order.php?error=$em");
            exit;
        }
    } else {
        $em = "All fields are required!";
        header("Location: ../create-order.php?error=$em");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
