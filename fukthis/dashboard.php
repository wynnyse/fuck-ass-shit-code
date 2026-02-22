<?php
session_start();
include "connection.php";
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Add post
if(isset($_POST['post'])){
    $content = $_POST['content'];
    mysqli_query($conn,"INSERT INTO posts(user_id,content) VALUES('$user_id','$content')");
}

// Fetch posts
$posts = mysqli_query($conn,"SELECT posts.*, accounts.firstname
                             FROM posts 
                             JOIN accounts ON posts.user_id = accounts.id
                             ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="design.css">
    </head>

    <body>
        <div class="nav">

            <div>Welcome, <?php echo $_SESSION['name']; ?></div>

            <div><img src="hardware.png" width="50" height="50"></div>

            <div>
                <a href="profile.php">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <div class="container">
            <form method="POST">
            <textarea name="content" placeholder="post daw" required></textarea>
            <button name="post">Post</button>
            </form>
        </div>

        <?php while($post = mysqli_fetch_assoc($posts)){ ?>

        

        <div class="post">
            <b><?php echo $post['firstname']; ?></b><br>

            <?php echo $post['content']; ?><br>
            
            <small><?php echo $post['created_at']; ?></small><br>
            
            <?php if($post['user_id']==$user_id){ ?>
            
                <a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit</a> |
                <a href="delete_post.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            <?php } ?>
            
            <?php
            $comments = mysqli_query($conn,"SELECT comments.*, accounts.firstname
                                            FROM comments
                                            JOIN accounts ON comments.user_id = accounts.id
                                            WHERE post_id=".$post['id']."
                                            ORDER BY created_at ASC");
            while($comment = mysqli_fetch_assoc($comments)){
                echo "<div class='comment'><b>".$comment['firstname']."</b>: ".$comment['comment_text']."<br><small>".$comment['created_at']."</small></div>";
            }
            ?>
                <form method="POST" action="add_comment.php">

                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                    <input type="text" name="comment" placeholder="Write a comment..." required>
                    <button name="add_comment">Comment</button>

                </form>
        </div>
        <?php } ?>
    </body>

</html>