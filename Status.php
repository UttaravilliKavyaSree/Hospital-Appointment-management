<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://www.aamc.org/sites/default/files/Article-Academic-Health-Centers-927897070_0.jpg') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: Black;
        }

        .appointment-container {
            text-align: center;
        }

        .appointment-info {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
            color:Black;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s ease-in-out;
        }

        button {
            background: #3498db;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.2em;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background: #2980b9;
        }

        .appointment-status {
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <div class="appointment-container">
        <h2>Appointment Page</h2>

        <div class="appointment-info">
            <form id="appointmentForm" action="Schedule.html" method="post">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>

                <label for="hospital">Hospital Name:</label>
                <input type="text" id="hospital" name="hospital" required>

                <button type="submit">Schedule Appointment</button>
            </form>
        </div>



        <a href="Landing..html">Go to Home</a>
    </div>

    <script>

        function updateAppointmentStatus() {
            fetch('file:///C:/Users/uttar/OneDrive/Documents/WTLab mini project/Schedule.html')
                .then(response => response.json())
                .then(data => {
                    const statusMessage = document.getElementById('statusMessage');
                    if (data.length > 0) {
                        statusMessage.textContent = 'Appointments Scheduled:';
                        data.forEach(appointment => {
                            const appointmentInfo = document.createElement('p');
                            appointmentInfo.textContent = `- ${appointment}`;
                            statusMessage.appendChild(appointmentInfo);
                        });
                    } else {
                        statusMessage.textContent = 'No appointments scheduled at the moment.';
                    }
                })
                .catch(error => {
                    console.error('Error fetching appointments:', error);
                    const statusMessage = document.getElementById('statusMessage');
                    statusMessage.textContent = 'Error fetching appointments.';
                });
        }

        // Initial call to fetch and display appointments
        updateAppointmentStatus();
    </script>

</body>
</html>
