<html>
Some Output<br>
<?php
    ob_end_flush();
    if (setcookie("name","Diego"))
        echo "Cookie 'name' set to 'Diego'";
    else
        echo "Error";
?>
</html>