<?php
session_start();
include "connection.php";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn,"SELECT * FROM accounts WHERE username='$username'");
    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['firstname'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="design.css">
</head>

    <body>
        <div class="container">
        <h2>Login</h2>
        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button name="login">Login</button>
            </form>

        <p style="text-align:center;">no no account? <a href="register.php">here</a></p>
        </div>
    </body>
</html>