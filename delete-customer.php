<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
  header("Location: login.php");
  exit;
}

if (isset($_GET['id'])) {
  include "db_conn.php";
  $id = $_GET['id'];
  $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
  $stmt->execute([$id]);
}

header("Location: admin.php");
exit;
?>
