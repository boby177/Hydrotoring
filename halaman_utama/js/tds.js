
    const dataEC = [];
    // const dataHumidity = [];
    // const dataPh = [];
    const dataTDS = [];
    // const dataTemperature = [];
    // const dataSoil = [];

    var deviceId = [];
    var devSensorData = [];
    var devSensor = [];
    var i = 1;

    var date = new Date();
    var today = date.toDateString();
    today = today.substring(8,10);

    var dateWeb = [];
    var showChart = [];

    var refWeb = database.ref('sensor/data/realtime');

    refWeb.on('value', WebData, errData);
    function WebData(data){
        // dateWeb = [];
        // showChart = [];
        var webData = data.val();
        var keys = Object.keys(webData);
        // console.log(webData);
        // console.log(keys);
        for(var i = 0; i < keys.length; i++){
            var key = keys[i];
            deviceId.push('sensor/data/realtime/'+key);
            deviceId = removeDuplicateUsingFilter(deviceId);

            refSensor = database.ref(deviceId[i]);
            //buka function debSensorPath setiap ada value baru
            refSensor.on('value',sensorData,errData);

        }
        makeChart();
        updateStatus();
        // console.log(deviceId);
    }

    function devSensorPath(data){
        var webData = data.val();
        var keys = Object.keys(webData);
        console.log(keys);
        for(var i = 0; i < keys.length; i++){
            var key = keys[i];
            var date = deviceId+"/"+key;
            dateWeb.push(key);
            date = date.substring(37);
            devSensorData.push(date);
            devSensorData = removeDuplicateUsingFilter(devSensorData);
            if(key.substring(6,8) == today){
                var jam = key.substring(9);
                showChart.push(jam);

                var dateData = devSensorData[i];
                var refdateData = database.ref(dateData);
                // buka function sensorData setiap ada value
                refdateData.on('value',sensorData,errData);
            }
        }
    }

    function sensorData(data){
        var objectData = data.val();
        var keys = Object.keys(objectData);
        // console.log(keys);

        for(var i = 0; i < keys.length; i++){
            var key = keys[i];
            var hasil = objectData[key];
            // masukkan masing2 data kedalam array masing2 berdasarkan key yang didapat
            if(key == 'PPM'){
                dataTDS.push(hasil);
            }
            else if(key == 'EC'){
                dataEC.push(hasil);
            }
            // else if(key == 'Keasaman'){
            //     dataPh.push(hasil);
            // }else if(key == 'Kepekatan1'){
            //     dataTDS.push(hasil);
            // }
            // else if(key == 'Temperature'){
            //     dataTemperature.push(hasil);
            // }
            // else if(key == 'Soil'){
            //     dataSoil.push(hasil);
            // }
        }
        
    }

    function errData(err){
        console.log('Error!');
        console.log(err);
    }

    function updateStatus(){
        var d = new Date();
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        var year = d.getFullYear();
        var month = months[d.getMonth()];
        var day = d.getDate();
        var hours = d.getHours();
        var minutes = d.getMinutes();
        var seconds = d.getSeconds();

        var tahun = year.toString();
        var bulan = month.toString();
        var hari = day.toString();
        var jam = hours.toString();
        var menit = minutes.toString();

        var date = hari+" "+bulan+" "+tahun+" "+jam+":"+menit;

        document.querySelector("#date").innerHTML = "Last Updated " + date;
    }

    function clearData(){
        var dataSensor = document.querySelectorAll(".dataSensor");
        for(var i = 0; i < dataSensor.length; i++){
            dataSensor[i].remove();
        }
    }


    function removeDuplicateUsingFilter(arr){
        let unique_array = arr.filter(function(elem, index, self) {
            return index == self.indexOf(elem);
        });
        return unique_array
    }


    //chart
    function makeChart(){
        //ambil id untuk chart dari index.php
        var chartEC = document.getElementById('chartEC').getContext('2d');
        // var chartHumidity = document.getElementById('chartHumidity').getContext('2d');
        // var chartPh = document.getElementById('chartPh').getContext('2d');
        var chartTDS = document.getElementById('chartTDS').getContext('2d');
        // var chartTemperature = document.getElementById('chartTemperature').getContext('2d');
        // var chartSoil = document.getElementById('chartSoil').getContext('2d');
        
        showChart.push(i++);
        // showChart.push(date);
        // dateWeb.push(today);
        // devSensorData.push(date);

        // console.log("Humidity", dataHumidity);
        // console.log("Temperature",dataTemperature);
        console.log("PPM", dataTDS);
        console.log("EC",dataEC);

        var TDS = new Chart(chartTDS, {
            type: 'line',
            data: {
                labels: showChart,
                datasets: [{
                    label: 'Data Kepekatan Nutrisi (TDS)',
                    data: dataTDS,
                    fill: true,                  
                    backgroundColor: 'rgba(255, 99, 132, 1)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return value+' ppm';
                            },
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var EC = new Chart(chartEC, {
            type: 'bar',
            data: {
                labels: showChart,
                datasets: [{
                    label: 'Data EC (Electrical Conductivity)',
                    data: dataEC,
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    }    