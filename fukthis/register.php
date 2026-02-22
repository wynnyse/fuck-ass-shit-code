<?php
include "connection.php";

if(isset($_POST['register'])){
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $username  = $_POST['username'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO accounts(firstname,lastname,username,password)
              VALUES('$firstname','$lastname','$username','$password')";

    if(mysqli_query($conn,$query)){
        header("Location: login.php");
        exit;
    } else {
        $error = "Username already exists!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="design.css">
</head>
    <body>
        <div class="container">
        <h2>Create Account</h2>
        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

            <form method="POST">

                <input type="text" name="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" placeholder="Last Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>

            <button name="register">Sign Up</button>
            
            </form>

        <p style="text-align:center;">yo account ? <a href="login.php">here</a></p>
        </div>
    </body>
</html>