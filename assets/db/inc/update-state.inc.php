<?php
// This script handles change in state for remotely synced tasks.
session_start();
if (!(isset($_SESSION['userid']))) {
    header("Location: ../login.php");
    exit();
}

if (isset($_SESSION['tasks'])) {
    $userid = $_SESSION['userid'];
    $tasks = $_SESSION['tasks'];
    require "handler.inc.php";

    // The & symbol signifies that we are passing by reference to an item in the array.
    foreach($tasks as &$task) {
        $importid = $task['importid'];
        $taskid = $task['taskid'];

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
            // The task was already checked
            $_SESSION['response'] = $response;
            $state = 1;
            /* We made an attempt to check an event that has already been marked
               as complete, as a result no changes were made to the web service. */
        }
        if ($response == 401) {
            //  User tried to uncheck a task which they did not originally check.
            $_SESSION['response'] = $response;
            $state = 1;
        }
        $sql = "UPDATE Tasks 
                SET state=? 
                WHERE taskid=?";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../view-tasks.php?error=sqlpreferencesinserterror&userid=" . $userid);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ii", $state, $taskid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        $task['state'] = $state;
    }
    $_SESSION['tasks'] = $tasks;
    header("Location: ../view-tasks.php");
    exit();
} else {
    header("Location: view-tasks.inc.php");
    exit();
}
?>