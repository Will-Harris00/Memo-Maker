<?php
if (isset($_POST['apply_prefs_btn'])) {
    if (isset($_POST['background'])) {
        $bg = str_replace(' ', '', $_POST['background']);
        setcookie('bg', $bg, time() + 31536000, "/wjph202/Coursework/src/", "students.emps.ex.ac.uk", 0);
    }
    if (isset($_POST['foreground'])) {
        $fg = str_replace(' ', '', $_POST['foreground']);
        setcookie('fg', $fg, time() + 31536000, "/wjph202/Coursework/src/", "students.emps.ex.ac.uk", 0);
    }
    header("Location: ../account.php");
} else {
    if (isset($_COOKIE['bg'])) {
        $bg = str_replace(' ', '', $_COOKIE['bg']);
    } else {
        $bg = "AliceBlue";
    }
    if (isset($_COOKIE['fg'])) {
        $fg = str_replace(' ', '', $_COOKIE['fg']);
    } else {
        $fg = "PowderBlue";
    }
}
?>