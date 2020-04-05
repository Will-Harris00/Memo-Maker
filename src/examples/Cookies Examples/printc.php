<html>
<?php
    if (isset($_COOKIE["name"]))
        echo "Cookie set: " . $_COOKIE["name"];
    else
        echo "Cookie not set";
?>
</html>