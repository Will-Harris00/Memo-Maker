<?php
// This script handles change in state for synchronised remote tasks.
session_start();
if (!(isset($_SESSION['userid']))) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['importid'])) {
    $userid = htmlspecialchars($_SESSION['userid']);
    $importid = htmlentities($_POST['importid']);
    $state = htmlentities($_POST['state']);
    require "handler.inc.php";

    $user = new SimpleXMLElement('<user/>');
    $user->addChild('id', $userid);
    $user = $user->asXML();

    $url = "http://students.emps.ex.ac.uk/dm656/check.php/" . $importid;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $user);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 300);
    $result = curl_exec($curl);
    $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($response == 200) {
        echo "200 Success - Task was unchecked successfully.";
        // Task was unchecked
        $state = 0;
        /* Because the response code was retrieved using the check method
           we need to ensure that the task is once again left unchecked. */

        $url = "http://students.emps.ex.ac.uk/dm656/uncheck.php/" . $importid;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $user);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 300);
        $result = curl_exec($curl);
        $other_response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    } elseif ($response == 409) {
        echo "409 Conflict - Tried to mark a task as done which was already marked complete.";
        // The task was already checked
        $state = 1;
        /* We made an attempt to check an event that has already been marked
           as complete, as a result no changes were made to the web service. */
    } if ($other_response == 401) {
        echo "401 Unauthorized - Tried to uncheck a task which the user did not originally check.";
        // User tried to uncheck a task which they did not originally check.
        $state = 1;
    }
    if (empty($userid) || empty($importid) || !isset($state)) {
        header("Location: ../view-tasks.php?error=emptyfields&userid=" . $userid);
        mysqli_close($conn);
        exit();
    } else {
        /* Matches only importid thereby updating the state of the
        remote task simultaneously for all users on the local site. */
        $sql = "UPDATE Tasks 
                SET state=? 
                WHERE importid=?";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../view-tasks.php?error=sqlpreferencesinserterror&userid=" . $userid);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ii", $state, $importid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            exit();
        }
    }
} else {
    header("Location: view-tasks.inc.php");
    exit();
}
?>