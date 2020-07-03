
/*___________________________________ Accordion _____________________________________*/


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = '200px';
        }
    });
}



/*_____________________________________ Show time function ___________________________________*/

function showTime() {
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";

    if (h == 0) {
        h = 12;
    } else if (h > 12) {
        h = h - 12;
        session = "PM";
    }

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;

    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("time").innerText = time;
    document.getElementById("time").textContent = time;

    setTimeout(showTime, 1000);

}

showTime();



/*_____________________________________  Calender  ____________________________________*/

function show_calendar() {
    var element = document.getElementById("calendar");
    var arrow = document.getElementById('angle_arrow');
    element.classList.toggle("display");
    arrow.classList.toggle("rotate");
}


var dt = new Date();

function renderDate() {
    dt.setDate(1);
    var day = dt.getDay();
    var today = new Date();
    var endDate = new Date(
        dt.getFullYear(),
        dt.getMonth() + 1,
        0
    ).getDate();

    var prevDate = new Date(
        dt.getFullYear(),
        dt.getMonth(),
        0
    ).getDate();
    var months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ]
    document.getElementById("month").innerHTML = months[dt.getMonth()];
    document.getElementById("date_str").innerHTML = dt.toDateString();
    var cells = "";
    for (x = day; x > 0; x--) {
        cells += "<div class='prev_date'>" + (prevDate - x + 1) + "</div>";
    }
    console.log(day);
    for (i = 1; i <= endDate; i++) {
        if (i == today.getDate() && dt.getMonth() == today.getMonth()) cells += "<div class='today'>" + i +
            "</div>";
        else
            cells += "<div>" + i + "</div>";
    }
    document.getElementsByClassName("days")[0].innerHTML = cells;

}

function moveDate(para) {
    if (para == "prev") {
        dt.setMonth(dt.getMonth() - 1);
    } else if (para == 'next') {
        dt.setMonth(dt.getMonth() + 1);
    }
    renderDate();
}



/*___________________________________________ calculator _________________________________*/

function show_calculator(){
    var element = document.getElementById("calculator");

    element.classList.toggle("show");
}




/*____________________________side menu responsive____________________________________*/

function side_menu_open(){
    var menu = document.getElementById("menu");
    menu.classList.toggle("open");
}




/*_________________________________ Show welcome admin pop up ___________________________________*/

$(document).ready(function () {
    $(".welcome").css('display', 'flex');

    setTimeout(function () {
        $(".welcome").fadeOut(1000);
    }, 5000);

    $("#close").click(function () {
        $(".welcome").css('display', 'none');
    });
});




/*______________________________________  Logout function  ______________________________________*/

function getLogout() {
    window.location="logout";
}



/*______________________________________ check if the User Id exist ____________________________*/

$(document).ready(function () {
    checkLogout();
});

function checkLogout() {
    var check = "check";
    $.ajax({
        url:"action.php",
        type:"post",
        data:{ check:check },
        success:function(data,status){
            if (data==0) {
                getLogout();
            }else{
            }
        }
    });
}
setInterval(function () {
    checkLogout();
}, 5000);



/*_________________________________ Get the pro pic & name in sidebar ________________________*/

$(document).ready(function(){
    showDatas();
});
        
function showDatas() {
    var read = "read";
    $.ajax({
        url:"action.php",
        type:"post",
        data:{ read:read },
        success:function(data,status){
            $('#info').html(data);
        }
    });
}



/*___________________________________ Show notification count __________________________________*/

$(document).ready(function(){
    showCount();
});

function showCount() {
    var readcount = "readcount";
    $.ajax({
        url:"action.php",
        type:"post",
        data:{ readcount:readcount },
        success:function(data,status){
            $('#getcount').html(data);
        }
    });
}

setInterval(function () {
    showCount();
}, 30000);



/*___________________________________ Show notification dropdown _____________________________________*/

//dropdown

function show_notification() {
    var element = document.getElementById("notification");
    element.classList.toggle("show_noti_div");
}

//dropdown data

$(document).ready(function(){
    showNotifications();
});
        
function showNotifications() {
    var readnotify = "readnotify";
    $.ajax({
        url:"action.php",
        type:"post",
        data:{ readnotify:readnotify },
        success:function(data,status){
            $('#notify_records').html(data);
        }
    });
}

setInterval(function () {
    showNotifications();
}, 30000);



/*_________________________________ Read all notifications ___________________________________*/

function readAll() {
    var readall = "readall";
    $.ajax({
        url:"action.php",
        type:"post",
        data:{ readall:readall },
        success:function(result){
            var response=$.parseJSON(result);
            swal(""+response.title , ""+response.text ,""+response.icon);
            showNotifications();
            showCount();
        }
    });
}



/*______________________________ Mark as read when click on the dropdown ____________________________*/


function markRead(id) {
    var markread = "markread";
    $.ajax({
        url:"action.php",
        type:"post",
        data:{ markread:markread,id:id },
        success:function(data,status){
            showNotifications();
            window.location.href="notifications";
        }
    });
}