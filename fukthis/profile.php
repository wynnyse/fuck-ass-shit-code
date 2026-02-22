<?php
session_start();
include "connection.php";
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM accounts WHERE id='$user_id'"));
$posts = mysqli_query($conn,"SELECT * FROM posts WHERE user_id='$user_id' ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link rel="stylesheet" href="design.css">
</head>

    <body>
        <div class="nav">
            <a href="dashboard.php">Home ?</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="container">
            
            <h2><?php echo $user['firstname']." ".$user['lastname']; ?></h2>

            <p>Username: <?php echo $user['username']; ?></p>
            
            <h3>Your Posts</h3>
            <?php while($post = mysqli_fetch_assoc($posts)){ ?>

            <div class="post">
                <?php echo $post['content']; ?><br>
                <small><?php echo $post['created_at']; ?></small>
            </div>
            <?php } ?>

        </div>
    </body>
</html>