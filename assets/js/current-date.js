var inputs = document.new_task;
var datefield = inputs.date;
var timefield = inputs.time;

datefield.addEventListener('focus', function() {
    datefield.type = "date";
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    }
    if(mm<10){
        mm='0'+mm
    }
    today = yyyy+'-'+mm+'-'+dd;
    datefield.setAttribute("min", today);
});

timefield.addEventListener('focus', function() {
    timefield.type = "time";
    if (datefield.value === new Date()) {
        var time = new Date();
        var hh = time.getHours();
        var ii = time.getMinutes();
        if(hh<10){
            hh='0'+hh
        }
        if(ii<10){
            ii='0'+ii
        }
        current_time = hh+':'+ii;
        timefield.setAttribute("min", current_time);
    }
});