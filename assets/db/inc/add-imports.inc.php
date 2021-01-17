<?php
session_start();

if (isset($_POST['import_tasks'])) {
    $userid = htmlspecialchars($_SESSION['userid']);
    require "handler.inc.php";

    foreach($_POST['tasks'] as $import_id) {
        $url = "http://students.emps.ex.ac.uk/dm656/task.php/" . $import_id;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 300);
        $result = curl_exec($curl);
        $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $xml = new SimpleXMLElement($result);
        $fetch_name = $xml -> name;
        $fetch_due = $xml -> due;
        $fetch_description = $xml -> description;

        $sql = "INSERT INTO Tasks
                (userid, importid, name, description, due)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../import-tasks.php?error=sqluserinserterror&userid=" . $userid);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "iisss", $userid, $import_id, $fetch_name, $fetch_description, $fetch_due);
            mysqli_stmt_execute($stmt);
        }
    }
    header("Location: view-tasks.inc.php?importtasks=success");
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit();
} else {
    header("Location: ../import-tasks.php");
    exit();
}
