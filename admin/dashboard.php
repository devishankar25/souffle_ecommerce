<?php
include('../includes/db.php'); // Include database connection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Souffle</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEWIH"
        crossorigin="anonymous">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJWFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <style>
        @import url('http://fonts.googleapis.com/css?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Spartan', sans-serif;
            margin: 0;
            padding: 0;
        }

        .dashboard-content {
            text-align: center;
            margin: auto;
        }

        .dashboard_content_main {
            display: flex;
            flex-direction: row;
        }

        .col70 {
            width: 70%;
            margin: 5px auto;
            /* Adjusted margin */
        }

        .dashboard_slidebar .logo {
            width: 50%;
            height: 50%;
            object-fit: contain;
            margin-top: 5px;
        }

        #dashboardContainer {
            display: flex;
            flex-direction: row;
        }

        .image {
            background-color: azure;
            margin-top: 5px;
        }

        ul.dashboard_list li:hover {
            background: black;
            border-radius: 5px;
        }

        ul.dashboard_list li.list {
            background: black;
            border-radius: 5px;
        }

        dashboard_topnav a {
            color: #848383;
            font-size: 18px;
        }

        .subMenus {
            display: none;
        }

        .angle {
            float: right;
            font-size: 10px;
            margin-top: 7px;
        }

        .nav-item {
            display: block;
        }
    </style>
</head>

<body>

    <div class="dashboard-content text-center m-auto">
        <div class="dashboard_content_main">
            <div class="col70 m-5 m-auto">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description text-center m-1">
                        Here is breackdown of Purchase Orders by Status
                    </p>
                </figure>
            </div>

            <div class="col70 m-5">
                <figure class="highcharts-figure">
                    <div id="container_bar"></div>
                    <p class="highcharts-description text-center">
                        Here is breackdown of Purchase Orders by Status
                    </p>
                </figure>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Pie Chart
            var graphData = <?= json_encode($results) ?>;
            Highcharts.chart('container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Purchase Orders By Status'
                },
                tooltip: {
                    format: function() {
                        var point = this.point,
                            series = point.series;
                        return '<b>' + point.name + '</b>: ' + point.y;
                    }
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: [{
                            enabled: true,
                            distance: 20
                        }, {
                            enabled: true,
                            distance: -40,
                            format: '{point.y}',
                            style: {
                                fontSize: '1.2em',
                                textOutline: 'none',
                                opacity: 0.7
                            }
                        }],
                        filter: {
                            operator: '>',
                            property: 'percentage',
                            value: 10
                        }
                    }
                },
                series: [{
                    name: 'Status',
                    colorByPoint: true,
                    data: graphData
                }]
            });

            // Bar Chart
            var barGraphData = <?= json_encode($bar_chart_data) ?>;
            var barGraphCategory = <?= json_encode($categories) ?>;

            Highcharts.chart('container_bar', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Products Assigned To Supplier'
                },
                xAxis: {
                    categories: barGraphCategory,
                    crosshair: true,
                    accessibility: {
                        description: 'Suppliers'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Number of Products' // Corrected typo
                    }
                },
                tooltip: {
                    format: function() {
                        var point = this.point,
                            series = point.series;
                        return '<b>' + point.category + '</b>: ' + point.y;
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Suppliers',
                    data: barGraphData
                }]
            });
        });
    </script>
</body>

</html>