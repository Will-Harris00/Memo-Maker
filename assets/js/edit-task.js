// get selected row
// display selected row data in text input

var table = document.getElementById("tasks_table"),rIndex;

for(var i = 1; i < table.rows.length; i++)
{
    table.rows[i].onclick = function()
    {
        rIndex = this.rowIndex;
        console.log(rIndex - 1);
        $import = document.getElementById("import_row_" + (rIndex - 1).toString()).value;
        if ($import !== "") {
            alert("This task was imported and cannot be modified.")
        } else {
            document.getElementById("taskid").value = document.getElementById("task_row_" + (rIndex - 1).toString()).value;
            document.getElementById("name").value = table.getElementsByClassName("name_scroll")[rIndex - 1].innerHTML;
            document.getElementById("description").value = table.getElementsByClassName("desc_scroll")[rIndex - 1].innerHTML;
            document.getElementById("date").value = formatDate(this.cells[2].innerHTML);
            document.getElementById("time").value = formatTime(this.cells[2].innerHTML);
            document.getElementById("state").value = table.getElementsByClassName("toggle_state")[rIndex - 1].value;
            document.getElementById("edit").style.visibility = "visible";
        }
    };
}

// edit the row
/* Need to write to database then reload page.
   This function only allows for local changes
   which would be lost upon refresh or timeout.
   This could be developed further to allow for multiple edits to be
   made on different tasks before submitting these changes all at once.
 */

/*
function editRow()
{
    table.getElementsByClassName("name_scroll")[rIndex - 1].innerHTML = document.getElementById("name").value;
    table.getElementsByClassName("desc_scroll")[rIndex - 1].innerHTML = document.getElementById("description").value;
    table.rows[rIndex].cells[2].innerHTML = outputDate(document.getElementById("due").value);
    table.rows[rIndex].cells[3].innerHTML = document.getElementById("state").value;
    document.getElementById("edit").style.visibility = "hidden";
}
*/

function formatDate(datetime) {
    var date = new Date(datetime),
        month = '' + (date.getMonth() + 1),
        day = '' + date.getDate(),
        year = '' + date.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}

function formatTime(datetime) {
    var time = new Date(datetime),
        hour = '' + time.getHours();
        min = '' + time.getMinutes();
    if (hour.length < 2) hour = '0' + hour;
    if (min.length < 2) min = '0' + min;
    return [hour, min].join(':');
}


/* this function goes with editRow */
/*
function outputDate(strdatetime) {
    var dt = new Date(strdatetime)
        date = '' + dt.getDate();
        year = '' + dt.getFullYear();
        hour = '' + dt.getHours();
        min = '' + dt.getMinutes();
    var weekdays = new Array(7);
    weekdays[0] = "Sun";
    weekdays[1] = "Mon";
    weekdays[2] = "Tue";
    weekdays[3] = "Wed";
    weekdays[4] = "Thu";
    weekdays[5] = "Fri";
    weekdays[6] = "Sat";
    var months = new Array(12);
    months[0] = "Jan";
    months[1] = "Feb";
    months[2] = "Mar";
    months[3] = "Apr";
    months[4] = "May";
    months[5] = "Jun";
    months[6] = "Jul";
    months[7] = "Aug";
    months[8] = "Sep";
    months[9] = "Oct";
    months[10] = "Nov";
    months[11] = "Dec";
    var day = weekdays[dt.getDay()];
    var month = months[dt.getDay()];
    if (hour.length < 2) hour = '0' + hour;
    if (min.length < 2) min = '0' + min;
    return day + " " + [date, month, year].join(', ') + ", " + [hour, min].join(':');
}

 */