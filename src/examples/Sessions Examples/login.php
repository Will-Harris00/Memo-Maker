<?php
if(isset($_POST['login'])) {
    // it checks whether the user clicked login button or not
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == 'Diego' && $password == '1234') {
        session_start();
        $_SESSION['user'] = $username;
        header("location: secure.php");
        exit();
     } else {
        echo "Invalid Username or Password";
    }
}
?>

<html>
<head>
    <title>Login Page</title>
</head>

<body>
<form action="<?php echo $_SESSION['PHP_SCRIPT']; ?>" method="post">
    Username: <input type="text" name="username">
    <br/>
    Password: <input type="password" name="password">
    <br/>
    <input type="submit" name="login" value="LOGIN">
</form>
</body>
</html>