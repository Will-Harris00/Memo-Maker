function formatDate(strdate) {
    var dt = new Date(strdate),
    month = '' + (dt.getMonth() + 1),
    day = '' + dt.getDate(),
    year = dt.getFullYear();
    hour = dt.getHours();
    min = dt.getMinutes();
    if (month.length < 2) { month = '0' + month; }
    if (day.length < 2) { day = '0' + day; }
    if (hour.length < 2) { hour = '0' + hour; }
    if (min.length < 2) { min = '0' + min; }
    return [year, month, day].join('-') + [hour,min].join(':');
}