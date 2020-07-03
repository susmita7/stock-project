
//accordion


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

//clock


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





//show calculator


// function show_calculator() {
//     var show = document.querySelector("#calculator");

//     if (show.style.display == "none") {

//         gsap.to(show, {
//             y: 39,
//             duration: .6,
//             opacity: 1,
//             display: 'block'
//         });


//     } else {

//         gsap.to(show, {
//             y: -10,
//             duration: .6,
//             opacity: 0,
//             display: 'none'
//         });

//     }
// }


//show calendar


// function show_calendar() {
//     var show = document.getElementById('calendar');
//     var arrow = document.getElementById('angle_arrow');

//     show.style.display = 'none';

//     if (show.style.display === "none") {
//         gsap.to(show, {
//             y: 39,
//             duration: .6,
//             opacity: 1,
//             display: 'flex'
//         });

//         gsap.to(arrow, {rotation:180});

        
//     } 
//     else {
//         gsap.to(show, {
//             y: -10,
//             duration: .6,
//             opacity: 0,
//             display: 'none'
//         });

//         gsap.to(arrow, {rotation:0});
//     }


// }


function show_calendar() {
    var element = document.getElementById("calendar");
    var arrow = document.getElementById('angle_arrow');
    element.classList.toggle("display");
    arrow.classList.toggle("rotate");
}

function show_calculator(){
    var element = document.getElementById("calculator");

    element.classList.toggle("show");

}



// calendar


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




//notification

function show_notification() {
    var element = document.getElementById("notification");
    element.classList.toggle("show_noti_div");
}


function side_menu_open(){
    var menu = document.getElementById("menu");
    menu.classList.toggle("open");
}