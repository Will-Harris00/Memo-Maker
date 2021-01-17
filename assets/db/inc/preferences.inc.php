<?php
$domain = ($_SERVER['HTTP_HOST'] != "localhost") ? $_SERVER['HTTP_HOST'] : false;
if (isset($_POST['apply_prefs_btn'])) {
    if (!empty($_POST['background'])) {
        $bg = str_replace(' ', '', htmlentities($_POST['background']));
        setcookie('bg', $bg, time()+60*60*24*7, '/', $domain, false);
    }
    if (!empty($_POST['foreground'])) {
        $fg = str_replace(' ', '', htmlentities($_POST['foreground']));
        setcookie('fg', $fg, time()+60*60*24*7, '/', $domain, false);
    }
    header("Location: ../account.php");
} else {
    if (isset($_COOKIE['bg'])) {
        $bg = str_replace(' ', '', htmlentities($_COOKIE['bg']));
    } else {
        $bg = "AliceBlue";
    }
    if (isset($_COOKIE['fg'])) {
        $fg = str_replace(' ', '', htmlentities($_COOKIE['fg']));
    } else {
        $fg = "PowderBlue";
    }
}
?>
