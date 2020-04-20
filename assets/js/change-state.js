function toggleState(importid, taskid, userid) {
    alert("hi");
    let checkbox = document.getElementById("check-" + taskid.toString());
    let url = "http://students.emps.ex.ac.uk/dm656/";
    let toggle_url = url + "uncheck.php/";
    alert("hi");
    if (checkbox.checked) toggle_url = url + "check.php/";
    alert("hi");

    let request = new XMLHttpRequest();
    alert("hi");
    /* With async set to true the user does not have to wait for
       the web service to handle the query and send a response. */
    request.open('PUT', toggle_url + importid.toString(), true);
    request.setRequestHeader('Content-Type', 'text/xml')
    let xml = "<user><id>" + userid.toString() + "</id></user>";

    request.unload = function() {
        alert("hi");
        window.location.replace("view-tasks.php");
    };
    request.send(xml);
}