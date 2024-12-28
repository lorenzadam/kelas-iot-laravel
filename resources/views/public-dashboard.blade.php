<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard IoT</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, 'sans-serif';
        }

        .container {
            padding: 40px;
            display: block;
        }

        .header-text {
            color: #333;
            text-align: center;
        }

        .card-wrapper {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
            margin-top: 20px;
            width: 100%;
        }

        .card {
            width: 25%;
            border-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h3 {
            color: #333;
            font-size: 20px;
        }

        .card p {
            color: #666;
            margin-top: 10px;
        }

        #inputServo {
            margin-top: 10px;
        }

        #inputLcd {
            display: block;
            width: 100%;
            outline: none;
            border: 1px solid salmon;
            padding: 8px;
            border-radius: 8px;
            /* margin-top: 10px;
            margin-bottom: 10px; */
            margin: 10px 0;
        }

        #btnLcd {
            padding: 7px 12px;
            border-radius: 3px;
            background-color: salmon;
            color: white;
            outline: none;
            border: 1px solid salmon;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
        }

        td {
            color: #666;
        }

        .online {
            color: lightgreen;
        }

        .offline {
            color: red;
        }
    </style>
</head>
<body>
    <main>
        <section>
            <div class="container">
                <div class="header-wrapper">
                    <h1 class="header-text">Dashboard IoT <span id="status">Terputus</span></h1>
                </div>

                <div class="card-wrapper">
                    <div class="card">
                        <h3>Suhu</h3>
                        <p><span id="suhu">?</span>°C</p>
                    </div>
                    <div class="card">
                        <h3>Kelembapan</h3>
                        <p><span id="kelembapan">?</span>%</p>
                    </div>
                    <div class="card">
                        <h3>Posisi Servo</h3>
                        <input type="range" name="slider" id="inputServo" min="0" max="180" value="90">
                        <p id="valueServo">90°</p>
                    </div>
                    <div class="card">
                        <h3>Display LCD</h3>
                        <input type="text" name="inputLcd" id="inputLcd">
                        <button type="button" id="btnLcd">Kirim</button>
                    </div>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Perangkat</th>
                                <th>Status Perangkat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($devices as $device)
                            <tr>
                                <td>{{ $device->serial_number }}</td>
                                <td>
                                    <p class="online">Online</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

    <script>
        const host = 'wss://broker.emqx.io:8084/mqtt';
        const clientId = Math.random().toString(16).substr(2, 8);

        const options = {
            keepalive: 30,
            clientId: clientId,
            protocolId: 'MQTT',
            protocolVersion: 4,
            clean: true,
            reconnectPeriod: 1000,
            connectTimeout: 30 * 1000
        }

        const client = mqtt.connect(host, options);

        client.on('connect', () => {
            console.log('Berhasil Terhubung ke Broker MQTT');
            document.getElementById('status').innerHTML = 'Terhubung';
            console.log(clientId);
            client.subscribe("kelasiot/#", {qos: 1});
        });

        client.on('message', (topic, message) => {
            if(topic == "kelasiot/suhu"){
                document.getElementById('suhu').innerHTML = message;
            }

            if(topic == "kelasiot/kelembapan"){
                document.getElementById('kelembapan').innerHTML = message;
            }
        })

        const inputServo = document.getElementById('inputServo');
        const valueServo = document.getElementById('valueServo');

        inputServo.addEventListener('input', () => {
            valueServo.textContent = inputServo.value + '°';
        });

        const inputLcd = document.getElementById('inputLcd');
        const submitBtn = document.getElementById('btnLcd');

        submitBtn.addEventListener('click', () => {
            alert(inputLcd.value);
        });
    </script>
</body>
</html>
