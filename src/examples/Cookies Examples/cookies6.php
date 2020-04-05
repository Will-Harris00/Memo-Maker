<?php
    if (setcookie("name","Diego",0,"","emps.ex.ac.uk"))
        echo "Cookie 'name' set to 'Diego' for domain 'emps.ex.ac.uk'";
    else
        echo "Error";
?>