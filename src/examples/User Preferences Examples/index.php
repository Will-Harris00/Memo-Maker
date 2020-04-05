<?php
$bg="white";
$fg="black";
if (isset($_COOKIE['bg'])) {
    $bg=$_COOKIE['bg'];
}
if (isset($_POST['background'])) {
    $bg=$_POST['background'];
    setcookie('bg', $bg, time()+3600);
}
if (isset($_COOKIE['fg'])) {
    $fg=$_COOKIE['fg'];
}
if (isset($_POST['foreground'])) {
    $fg=$_POST['foreground'];
    setcookie('fg', $fg, time()+3600);
}
?>
<html>
<head><title>Diego's Website</title></head>
<body bgcolor = "<?php echo $bg ?>" text="<?php echo $fg ?>">
<h1>Welcome to Diego's Website</h1>
I am a lecturer at the University of Exeter.
This year I am teaching Web-Development.

Would you like to <a href = "preferences.php">change your preferences?</a>
</body>
</html>