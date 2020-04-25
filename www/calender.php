<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>College Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        * {
            margin:0;
            box-sizing: border-box;
        }
        body {
            font-family: "Lato", sans-serif;
        }

        ul {
            list-style-type: none;
        }



        .wrapper {
            background-color: #fff;
            width: 100vw;
            height: 100vh;
            display: flex;
        }

        .calendar {
            margin: auto;
            width: 350px;
            background-color: #fff;
            box-shadow: 0px 0px 15px 4px rgba(0, 0, 0, 0.2);

        }

        .month {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 25px 10px;
            text-align: center;
            background-color: #1E90FF;
            color: #fff;
        }

        .weekdays {
            background-color: #1E90FF;
            color: #fff;
            padding: 0px 0;
            display: flex;
        }

        .days {
            font-weight: 300;
            padding: 10px 0;
            display: flex;
            flex-wrap: wrap;
        }

        .weekdays div,
        .days div {
            text-align: center;
            width: 14.28%;
        }

        .days div {
            padding: 10px 0;
            margin-bottom: 10px;
            transition: all 0.4s;
        }

        .prev_date {
            color: #999;
        }

        .today {
            background-color: #1E90FF;
            color: #fff;
        }

        .days div:hover {
            cursor: pointer;
            background-color: #dfe6e9;
        }

        .prev,
        .next {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 23px;
            background-color: #1E90FF;
            /*rgba(0, 0, 0, 0.1);*/
            transition: all 0.4s;
        }

        .prev:hover,
        .next:hover {
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.2);
        }

        #month {
            font-size: 30px;
            font-weight: 500;
        }
    </style>
</head>

<body onload="renderDate()">
    <div class="wrapper">
        <div class="calendar">
            <div class="month">
                <div class="prev" onclick="moveDate('prev')">
                    <span>&#10094;</span>
                </div>
                <div>
                    <h2 id="month"></h2>
                    <p id="date_str"></p>
                </div>
                <div class="next" onclick="moveDate('next')">
                    <span>&#10095;</span>
                </div>
            </div>
            <div class="weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div class="days">

            </div>
        </div>
    </div>
    <script>
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
    </script>
</body>

</html>