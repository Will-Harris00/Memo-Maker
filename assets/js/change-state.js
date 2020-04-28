function toggleState(importid, taskid, userid) {
        let checkbox = document.getElementById("check-" + taskid.toString());
        if (importid != null) {
                let url = "http://students.emps.ex.ac.uk/dm656/";
                state = 0
                let toggle_url = url + "uncheck.php/";
                if (checkbox.checked) {
                        state = 1
                        toggle_url = url + "check.php/";
                }
                let request = new XMLHttpRequest();
                /* With async set to true the user does not have to wait for
                   the web service to handle the query and send a response. */
                request.open('PUT', toggle_url + importid.toString(), true);
                request.setRequestHeader('Content-Type', 'text/xml');
                let xml = "<user><id>" + userid.toString() + "</id></user>";
                request.onload = function () {
                        let query = new XMLHttpRequest();
                        query.open("POST", "inc/update-state.inc.php", true);
                        query.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        query.onreadystatechange = function () {
                                if (query.readyState === 4 && query.status === 200) {
                                        alert(query.responseText);
                                }
                        };
                        query.onload = function () {
                                window.location.replace("inc/view-tasks.inc.php");
                        };
                        query.send("importid=" + importid + "&state=" + state);
                };
                request.send(xml);
        } else {
                var state
                var request = new XMLHttpRequest();
                state = 0
                if (checkbox.checked) {
                        state = 1
                }
                request.open("POST", "inc/change-state.inc.php", true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.onreadystatechange = function () {
                        if (request.readyState === 4 && request.status === 200) {
                                if (state === 1) {
                                        string = "complete."
                                } else {
                                        string = "incomplete"
                                }
                                alert("This local task will be marked as " + string);
                                alert(request.responseText);
                        }
                };
                request.onload = function () {
                        window.location.replace("inc/view-tasks.inc.php");
                };
                request.send("taskid=" + taskid + "&state=" + state);
        }
}