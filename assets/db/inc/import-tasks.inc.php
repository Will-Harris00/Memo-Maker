<?php
session_start();
$url = "http://students.emps.ex.ac.uk/dm656/tasks.php";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 300);
$result = curl_exec($curl);
$response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

$_SESSION['imports'] = $result;
header("Location: ../import-tasks.php");
exit();
?>