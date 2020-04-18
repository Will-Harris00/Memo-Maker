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
    table.rows[rIndex].cells[2].innerHTML = document.getElementById("due").value;
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