function syncTasks() {
    var request = new XMLHttpRequest();
    /* With async set to true the user does not have to wait for
       the web service to handle the query and send a response. */
    request.open('POST', "inc/sync-tasks.inc.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            alert("This will remove any remote tasks marked as completed.");
            alert(request.responseText)
        }
    };
    request.onload = function () {
        window.location.replace("inc/view-tasks.inc.php");
    };
    request.send("sync=True");
}