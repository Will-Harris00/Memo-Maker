<?php
    session_start();
    if (isset($_GET["name"])) {
        if (isset($_GET["add"]) and (isset($_GET["value"]))) {
            $_SESSION[$_GET["name"]]=$_GET["value"];
        }
        if (isset($_GET["rem"])) {
            unset($_SESSION[$_GET["name"]]);
        }
    }
    print_r($_SESSION);
?>

<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="get">
    <input type="text" name="name">
    <input type="submit" name="rem" value="REMOVE"><br>
    <input type="text" name="value">
    <input type="submit" name="add" value="ADD">
</form>