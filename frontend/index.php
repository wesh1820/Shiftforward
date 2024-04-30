<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hulpkas Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="sidebar.css">
    <!-- Voeg Chart.js toe -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Stijl voor het instellen van een CSS-grid */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<!-- Inhoud van het dashboard -->

<div class="main">
    <div class="payment-content">
        <div class="container">
        <h1>Hulpkas Overzicht</h1>
        <!-- Voeg een div toe voor de grid-container -->
        <div class="grid-container">
            <!-- Voeg canvas toe voor de eerste grafiek -->
            <canvas id="myChart1" width="300" height="300"></canvas>
            <!-- Voeg canvas toe voor de tweede grafiek -->
            <canvas id="myChart2" width="300" height="300"></canvas>
            <!-- Voeg canvas toe voor de derde grafiek -->
            <canvas id="myChart3" width="300" height="300"></canvas>
            <!-- Voeg canvas toe voor de vierde grafiek -->
            <canvas id="myChart4" width="300" height="300"></canvas>
            <!-- Voeg hier meer canvassen toe voor extra grafieken -->
        </div>
        </div>
    </div>
</div>

<script>
    // Code voor het maken van de eerste grafiek
    var ctx1 = document.getElementById('myChart1').getContext('2d');
    var myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Code voor het maken van de tweede grafiek
    var ctx2 = document.getElementById('myChart2').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'My First Dataset',
                data: [65, 59, 80, 81, 56, 55, 40],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {}
    });

    // Code voor het maken van de derde grafiek
    var ctx3 = document.getElementById('myChart3').getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['A', 'B', 'C', 'D', 'E'],
            datasets: [{
                label: 'Sample Data',
                data: [12, 19, 3, 5, 2],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Code voor het maken van de vierde grafiek
    var ctx4 = document.getElementById('myChart4').getContext('2d');
    var myChart4 = new Chart(ctx4, {
        type: 'line',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            datasets: [{
                label: 'Sales',
                data: [30, 25, 40, 35, 50],
                fill: false,
                borderColor: 'rgb(54, 162, 235)',
                tension: 0.1
            }]
        },
        options: {}
    });
</script>

</body>
</html>
