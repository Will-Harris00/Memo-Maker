// get selected row
// display selected row data in text input

var table = document.getElementById("tasks_table"),rIndex;

for(var i = 1; i < table.rows.length; i++)
{
    table.rows[i].onclick = function()
    {
        rIndex = this.rowIndex;
        console.log(rIndex);

        document.getElementById("name").value = this.cells[0].innerHTML;
        document.getElementById("description").value = this.cells[1].innerHTML;
        document.getElementById("due").value = this.cells[2].innerHTML;
        document.getElementById("state").value = this.cells[3].innerHTML;
        document.getElementById("edit").style.visibility = "visible";
    };
}


// edit the row
function editRow()
{
    table.rows[rIndex].cells[0].innerHTML = document.getElementById("name").value;
    table.rows[rIndex].cells[1].innerHTML = document.getElementById("description").value;
    table.rows[rIndex].cells[2].innerHTML = document.getElementById("due").value;
    table.rows[rIndex].cells[3].innerHTML = document.getElementById("state").value;
    document.getElementById("edit").style.visibility = "hidden";
}