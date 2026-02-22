<?php
session_start();
include "connection.php";
if(!isset($_SESSION['user_id'])) exit;

if(isset($_POST['add_comment'])){
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    mysqli_query($conn,"INSERT INTO comments(post_id,user_id,comment_text) VALUES('$post_id','$user_id','$comment')");
}

header("Location: dashboard.php");
exit;
?>