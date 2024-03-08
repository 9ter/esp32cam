const axios = require('axios'); // Import axios module

var dayNumber;
var dataArray


function updateTime() {
    // Create a Date object to get the current time
    var currentTime = new Date();
    var currentDate = new Date();
    dayNumber = currentDate.getDay() || 7;

    var year = currentDate.getFullYear();
    var month = (currentDate.getMonth() + 1).toString().padStart(2, "0");
    var day = currentDate.getDate().toString().padStart(2, "0");
    var formattedDate = year + "-" + month + "-" + day;

    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();

    hours = (hours < 10) ? "0" + hours : hours;
    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;

    var timeString = hours + ":" + minutes + ":" + seconds;
    console.log("DAY " + dayNumber + " time " + timeString)


    if (dataArray != null) {
        for (var i = 0; i < dataArray.length; i++) {

            var timeParts = dataArray[i].time_stop.split(":");
            var hoursParts = parseInt(timeParts[0]);
            var minutesParts = parseInt(timeParts[1]);
            var secondsParts = parseInt(timeParts[2]);

            let camera = dataArray[i].camera
            let time_start = dataArray[i].time_start
            let time_stop = dataArray[i].time_stop

            //console.log(hoursParts + ":" + minutesParts + ":" + secondsParts);

            if (hoursParts == hours && minutesParts == minutes && secondsParts == seconds) {
                axios.get('http://localhost/esp32cam/classroom/search_linetoken.php', { params: { id: dataArray[i].classroom } })
                    .then(response => {
                        // Handle success
                        var line_token = response.data;
                        var line_token_array = Object.keys(line_token).map(function (key) {

                            return line_token[key];
                        });
                        var line_token = line_token_array[0].line_token
                        console.log(line_token);
                        combine_image2(camera, time_start, time_stop, line_token,formattedDate);

                    })
                    .catch(error => {
                        // Handle error
                        console.error('There was an error!', error);
                    });
            }

        }

    }

}


function query_queue() {
    axios.get('http://localhost/esp32cam/queue/search_queue.php', { params: { term: dayNumber } })
        .then(response => {
            // Handle success
            var data = response.data;
            dataArray = Object.keys(data).map(function (key) {
                return data[key];
            });
            console.log(dataArray);
        })
        .catch(error => {
            // Handle error
            console.error('There was an error!', error);
        });
}


function combine_image2(camera, time_start, time_stop, line_token,formattedDate) {

    axios.get('http://localhost/esp32cam/combine_image2.php', {
        params: {
            camera: camera,
            date: formattedDate,
            time_start: time_start,
            time_stop: time_stop,
            line_token: line_token,
        }
    })
        .then(response => {
            var camera_response = response.data;
            console.log(camera_response);
        })
        .catch(error => {
            // Handle error
            console.error('There was an error!', error);
        });
}

// Call updateTime function to update time initially
updateTime();
query_queue();

// Use setInterval to call updateTime function every 1 second

setInterval(updateTime, 1000);
setInterval(query_queue, 600000);