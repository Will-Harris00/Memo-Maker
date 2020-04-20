function toggleState(importid, taskid, userid) {
    let checkbox = document.getElementById("check-" + taskid.toString());
    let url = "http://students.emps.ex.ac.uk/dm656/";
    let toggle_url = url + "uncheck.php/";
    if (checkbox.checked) toggle_url = url + "check.php/";

    let request = new XMLHttpRequest();
    /* With async set to true the user does not have to wait for
       the web service to handle the query and send a response. */
    request.open('PUT', toggle_url + importid.toString(), true);
    request.setRequestHeader('Content-Type', 'text/xml')
    let xml = "<user><id>" + userid.toString() + "</id></user>";

    request.unload = function() {
        window.location.replace("view-tasks.php");
    };
    request.send(xml);
}