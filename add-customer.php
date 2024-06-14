<?php
session_start();

# If the admin is not logged in, redirect to login page
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

# Database Connection File
include "db_conn.php";

# Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if (empty($name) || empty($email) || empty($address)) {
        $error = "All fields are required!";
    } else {
        # Insert the customer into the database
        $stmt = $conn->prepare("INSERT INTO customers (name, email, address) VALUES (:name, :email, :address)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        if ($stmt->execute()) {
            $success = "Customer added successfully!";
        } else {
            $error = "Failed to add customer!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- Bootstrap 5 JS bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <?php include 'nav.php'; ?>
    <h1 class="mt-5">Add Customer</h1>
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger" role="alert">
            <?=htmlspecialchars($error); ?>
        </div>
    <?php } ?>
    <?php if (isset($success)) { ?>
        <div class="alert alert-success" role="alert">
            <?=htmlspecialchars($success); ?>
        </div>
    <?php } ?>
    <!-- Back Arrow -->
        <a href="admin.php" class="d-block my-3">
            <img src="img/back_arrow.png" alt="Back" width="30">
        </a>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Customer</button>
    </form>
</div>
</body>
</html>
