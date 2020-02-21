
var time = new Date;

function updateTime(){
    time = new Date();
    setInterval(quit,300000);
}

function quit(){
    window.location.href = "logout.php?sess=scaduta";
}

