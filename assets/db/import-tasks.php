<?php
session_start();
require "header.php";
echo $_SESSION["imports"];
require "footer.php";
?>