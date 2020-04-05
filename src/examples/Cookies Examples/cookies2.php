<?php
    if (setcookie("name","Diego",time()+3600))
        echo "Cookie 'name' set to 'Diego' to expire on 'time() + 3600'";
    else
        echo "Error";
?>