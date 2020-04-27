<?php
session_start();

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    require "handler.inc.php";

    $sql = "SELECT taskid, importid, name, description, due, state
            FROM Tasks 
            WHERE userid=?";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../view-tasks.php?error=sqltasksrequesterror&userid=" . $userid);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    } else {
        /* Bind variable to statement */
        mysqli_stmt_bind_param($stmt, "i", $userid);
        /* Execute statement */
        mysqli_stmt_execute($stmt);
        /* Bind result variables */
        mysqli_stmt_bind_result($stmt, $taskid, $importid, $name, $description, $due, $state);
        /* Store the result */
        mysqli_stmt_store_result($stmt);
        /* Array used to store the tasks */
        $tasks = array();
        if (mysqli_stmt_num_rows($stmt) > 0) {
            while (mysqli_stmt_fetch($stmt)) {
                /* Iterates over every matching row */
                array_push($tasks, array(
                    'taskid' => $taskid,
                    'userid' => $userid,
                    'importid' => $importid,
                    'name' => $name,
                    'description' => $description,
                    'due' => $due,
                    'state' => $state,
                ));
            }
        }
        // The & symbol signifies that we are passing by reference to an item in the array.
        foreach($tasks as &$task) {
            $importid = $task['importid'];

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
                $state = 1;
                /* We made an attempt to check an event that has already been marked
                   as complete, as a result no changes were made to the web service. */
            }
            if ($response == 401) {
                //  User tried to uncheck a task which they did not originally check.
                $state = 1;
                echo '<script type="text/javascript">alert("Task: ' . $name . ' was marked as complete by another user");</script>';
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
                mysqli_stmt_bind_param($stmt, "is", $state, $task['taskid']);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
            }
            $task['state'] = $state;
        }
        $_SESSION['tasks'] = $tasks;
        header("Location: ../view-tasks.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>