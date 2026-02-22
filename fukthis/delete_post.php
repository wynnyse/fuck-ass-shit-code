<?php
session_start();
include "connection.php";
$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'];

mysqli_query($conn,"DELETE FROM posts WHERE id='$post_id' AND user_id='$user_id'");
header("Location: dashboard.php?msg=Post deleted successfully");
exit;
?>