<?php
    if (setcookie("name","",time()-3600))
        echo "Cookie 'name' set to 'Diego' to expire on 'time() - 3600'";
    else
        echo "Error";
?>