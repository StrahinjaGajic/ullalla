<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ullallà</title>
    <style>
        body,
        html{
            margin: 0;
            padding: 0;
            text-align: center; 
            font-weight: 100;
            height: 100%;

    }
        
        .wrapper {
            background: url('../img/bglogo.jpg') center no-repeat;
            background-size: cover;
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
        }


        h1{
            color: #fff;
            font-weight: bold;
            font-size: 40px;
            margin: 40px 0px 20px;
            text-transform: uppercase ;
            font-family: "Trajan Pro", Arial, sans-serif;
            letter-spacing: 2px;
        }
        
        .clockParent {
            display: table;
            width: 100%;
            height: 100%;
        }

        #clockdiv{
            font-family: sans-serif;
            color: #fff;
            font-weight: 100;
            text-align: center;
            font-size: 30px;
            display: table-cell;
            vertical-align: bottom;
            padding-bottom: 50px;
        }

        #clockdiv > div{
            padding: 10px;
            border-radius: 3px;
            background: #333;
            display: inline-block;
        }

        #clockdiv div > span{
            padding: 15px;
            border-radius: 3px;
            background: #000;
            display: inline-block;
        }

        .smalltext{
            padding-top: 5px;
            font-size: 16px;
            font-family: "Trajan Pro", Arial, sans-serif;
        }
        
    </style>
</head>
<body>
   <div class="wrapper">
    <div class="clockParent">
    <div id="clockdiv">
        <h1>O<span style="font-size: 50px;">n</span>li<span style="font-size: 50px;">n</span>e I<span style="font-size: 50px;">n</span></h1>
        <div>
            <span class="days"></span>
            <div class="smalltext">Days</div>
        </div>
        <div>
            <span class="hours"></span>
            <div class="smalltext">Hours</div>
        </div>
        <div>
            <span class="minutes"></span>
            <div class="smalltext">Minutes</div>
        </div>
        <div>
            <span class="seconds"></span>
            <div class="smalltext">Seconds</div>
        </div>
    </div>
    </div>
    </div>

    <script>
        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(id, endtime) {
            var clock = document.getElementById(id);
            var daysSpan = clock.querySelector('.days');
            var hoursSpan = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');
            var secondsSpan = clock.querySelector('.seconds');  

            function updateClock() {
                var t = getTimeRemaining(endtime);

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        var deadline = new Date(Date.parse('2018-02-01'));
            console.log(deadline);
        initializeClock('clockdiv', deadline);
    </script>
</body>
</html>
