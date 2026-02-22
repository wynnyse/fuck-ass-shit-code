<?php
session_start();
include "connection.php";
$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'];

$post = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM posts WHERE id='$post_id' AND user_id='$user_id'"));
if(!$post){
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST['update'])){
    $content = $_POST['content'];
    mysqli_query($conn,"UPDATE posts SET content='$content' WHERE id='$post_id' AND user_id='$user_id'");
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="design.css">
</head>

    <body>
        <div class="container">

        <h2>Edit Post</h2>
        
            <form method="POST">
                <textarea name="content"><?php echo $post['content']; ?></textarea>
                <button name="update">Update</button>
            </form>

        </div>
    </body>
</html>