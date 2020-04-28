<?php
session_start();
if (!(isset($_SESSION['userid']))) {
    header("Location: ../login.php");
    exit();
}


if (isset($_POST['sync'])) {
    $userid = $_SESSION['userid'];
    require "handler.inc.php";

    $sql = "SELECT importid
            FROM Tasks 
            WHERE userid=? AND (importid IS NOT NULL OR importid != '')";

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
        mysqli_stmt_bind_result($stmt, $importid);
        /* Store the result */
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $num_removed = 0;
            while (mysqli_stmt_fetch($stmt)) {
                $user = new SimpleXMLElement('<user/>');
                $user->addChild('id', $userid);
                $user = $user->asXML();

                $url = "http://students.emps.ex.ac.uk/dm656/uncheck.php/" . $importid;

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
                    $num_removed += 1;
                    // The task was already checked
                    $state = 1;
                    /* We made an attempt to check an event that has already been marked
                       as complete, as a result no changes were made to the web service.
                       We are now able to remove this task from the local database. */

                    $sql = "DELETE FROM Tasks
                            WHERE importid = ?";

                    $query = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($query, $sql)) {
                        header("Location: ../view-tasks.php?error=sqltasksrequesterror&userid=" . $userid);
                        mysqli_stmt_close($query);
                        mysqli_close($conn);
                        exit();
                    } else {
                        mysqli_stmt_bind_param($query, "i", $importid);
                        mysqli_stmt_execute($query);
                    }
                }
            }
            mysqli_stmt_close($query);
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    if ($num_removed > 0) {
        echo $num_removed . " tasks have been removed.";
    } else {
        echo "All tasks are up to date.";
    }
    exit();
} else {
    header("Location: ../view-tasks.php");
}
?>
