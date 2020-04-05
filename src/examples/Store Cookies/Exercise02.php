<?php
    switch ($_POST["exp"]) {
        case "keep": {
            if (isset($_POST["name"])) {
                setcookie("name",$_POST["name"],time()+3600);
                break;
            }
        }
        case "browser":
        {
            if (isset($_POST["name"])) {
                setcookie("name", $_POST["name"], 0);
                break;
            }
        }
        case "remove": {
            setcookie("name", "", time()-3600);
            break;
        }
    }
    echo "Value: " . $_COOKIE["name"];
?>

<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST">
    <input type="text" name="name"><br>
    <input type="radio" name="exp" value="keep" checked>keep<br>
    <input type="radio" name="exp" value="browser">browser<br>
    <input type="radio" name="exp" value="remove">remove<br>
    <input type="submit" name="rem" value="Submit">
</form>