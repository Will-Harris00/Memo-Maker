// get selected row
// display selected row data in text input

var table = document.getElementById("tasks_table"),rIndex;

for(var i = 1; i < table.rows.length; i++)
{
    table.rows[i].onclick = function()
    {
        rIndex = this.rowIndex;
        console.log(rIndex - 1);
        document.getElementById("name").value = table.getElementsByClassName("name_scroll")[rIndex - 1].innerHTML;
        document.getElementById("description").value = table.getElementsByClassName("desc_scroll")[rIndex - 1].innerHTML;
        document.getElementById("due").value = formatDate(this.cells[2].innerHTML);
        document.getElementById("state").value = this.cells[3].innerHTML;
        document.getElementById("edit").style.visibility = "visible";
    };
}

// edit the row
function editRow()
{
    table.getElementsByClassName("name_scroll")[rIndex - 1].innerHTML = document.getElementById("name").value;
    table.getElementsByClassName("desc_scroll")[rIndex - 1].innerHTML = document.getElementById("description").value;
    table.rows[rIndex].cells[2].innerHTML = outputDate(document.getElementById("due").value);
    table.rows[rIndex].cells[3].innerHTML = document.getElementById("state").value;
    document.getElementById("edit").style.visibility = "hidden";
}

function formatDate(strdate) {
    var dt = new Date(strdate),
        month = '' + (dt.getMonth() + 1),
        day = '' + dt.getDate(),
        year = '' + dt.getFullYear();
        hour = '' + dt.getHours();
        min = '' + dt.getMinutes();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    if (hour.length < 2) hour = '0' + hour;
    if (min.length < 2) min = '0' + min;
    return [year, month, day].join('-') + "T" + [hour, min].join(':');
}

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