<?php
session_start();
if (!(isset($_SESSION['userid']))) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['export_btn'])) {
    $userid = $_SESSION['userid'];
    $taskid = $_POST['taskid'];
    $name = $_POST['name'];
    $due = $_POST['due'];
    $description = $_POST['description'];
    require "handler.inc.php";

    $request = "<taskinfo><name>" . $name .
        "</name><due>" . $due .
        "</due><description>" . $description .
        "</description></taskinfo>";

    $url = "http://students.emps.ex.ac.uk/dm656/add.php";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 300);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

    $result = curl_exec($curl);
    $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $xml = new SimpleXMLElement($result);
    $importid = $xml -> id;
    curl_close($curl);

    $sql = "UPDATE Tasks
            SET importid = ?
            WHERE taskid = ? AND userid = ?";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../view-tasks.php?error=sqluserinserterror&userid=" . $userid);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "iii", $importid, $taskid, $userid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        header("Location: ../view-tasks.php?exportedtask=success");
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    }
}
