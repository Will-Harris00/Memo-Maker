<?php
    if (setcookie("name","Diego",0,"","www.google.com"))
        echo "Cookie 'name' set to 'Diego' for domain 'www.google.com'";
    else
        echo "Error";
?>