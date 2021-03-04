
function getDate(){
    var today = new Date();
    var date = today.getDate()+'.'+(today.getMonth()+1)+'.'+today.getFullYear()+'.';
    var time = today.getHours() + ":" + today.getMinutes();

    if(today.getHours() < 10){
        time = "0"+ today.getHours() + ':' + today.getMinutes();
    }
    if(today.getMinutes() < 10){
        time = today.getHours() + ':0' + today.getMinutes();
    }
    if(today.getMinutes() < 10 && today.getHours() < 10){
        time = "0"+ today.getHours() + ':0' + today.getMinutes();
    }
    if(today.getDate() < 10){
        var date = "0"+ today.getDate()+'.'+(today.getMonth()+1)+'.'+today.getFullYear()+'.';
    }
    if(today.getMonth() < 10){
        var date = today.getDate()+'.0'+(today.getMonth()+1)+'.'+today.getFullYear()+'.';
    }
    if(today.getDate() < 10 && today.getMonth() < 10){
        var date = "0"+ today.getDate()+'.0'+(today.getMonth()+1)+'.'+today.getFullYear()+'.';
    }
    var dateTime = date+' '+time;

    return dateTime;
}
setInterval(function(){
    document.getElementById('date-time').innerHTML = getDate();
}, 1000)

