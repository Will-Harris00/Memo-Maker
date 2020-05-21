<?php
if (isset($_POST['apply_prefs_btn'])) {
    if (!empty($_POST['background'])) {
        $bg = str_replace(' ', '', htmlentities($_POST['background']));
        setcookie('bg', $bg, time() + 31536000, '/wjph202', 'students.emps.ex.ac.uk', 0);
    }
    if (!empty($_POST['foreground'])) {
        $fg = str_replace(' ', '', htmlentities($_POST['foreground']));
        setcookie('fg', $fg, time() + 31536000, '/wjph202', 'students.emps.ex.ac.uk', 0);
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