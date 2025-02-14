<?php
include('db.php');
/*
$maths=0;
$science=0;
$arts=0;
$commerce=0;
$first=$_POST['q1'];
$second=$_POST['q2'];
$third=$_POST['q3'];
$forth=$_POST['q4'];
$fifth=$_POST['q5'];
$sixth=$_POST['q6'];
$seventh=$_POST['q7'];
$eighth=$_POST['q8'];
$ninth=$_POST['q9'];
$tenth=$_POST['q10']; 

//First MCQ
// First MCQ
if (isset($first) && is_array($first)) {
    foreach ($first as $selection) {
        if ($selection == '1a') {
            $maths++;
        } elseif ($selection == '1b') {
            $arts++;
            $science++;
        } elseif ($selection == '1c') {
            $arts++;
            $commerce++;
        } elseif ($selection == '1d' || $selection == '1e') {
            $commerce++;
        } elseif ($selection == '1f') {
            $arts++;
        } elseif ($selection == '1g' || $selection == '1h') {
            $science++;
            $maths++;
        }
    }
}

//second MCQ
if (isset($second) && is_array($second)) {
    foreach ($second as $selection) {
        if ($second=='2d'){
            $maths++;
        }elseif($second=='2h'){
            $arts++;
            $science++;
        }elseif($second=='2c'){
            $arts++;
            $commerce++;
        }elseif($second=='2b' or $second=='2g'){
            $commerce++;
        }elseif($second=='2f'){
            $arts++;
        }elseif($second=='2e' or $second=='2a'){
            $science++;
            $maths++;
        }        
    }
}

//third MCQ
if (isset($third) && is_array($third)) {
foreach ($third as $selection) {
if ($third=='3d'){
    $maths++;
}elseif($third=='3h'){
    $arts++;
    $science++;
}elseif($third=='3c'){
    $arts++;
    $commerce++;
}elseif($third=='3g' or $third=='3e'){
    $commerce++;
}elseif($third=='3f'){
    $arts++;
}elseif($third=='3a' or $third=='3b'){
    $science++;
    $maths++;
}
}
}

//forth MCQ
if (isset($forth) && is_array($forth)) {
foreach ($forth as $selection) {
if ($forth=='2d'){
    $maths++;
}elseif($forth=='2h'){
    $arts++;
    $science++;
}elseif($forth==''){
    $arts++;
    $commerce++;
}elseif($forth=='1d' or $forth=='1e'){
    $commerce++;
}elseif($forth=='1f'){
    $arts++;
}elseif($forth=='1g' or $forth=='1h'){
    $science++;
    $maths++;
}
}
}

//fifth MCQ
if (isset($fifth) && is_array($fifth)) {
foreach ($fifth as $selection) {
    if ($fifth=='5c'){
    $maths++;
    }elseif($fifth=='5f'){
        $arts++;
        $science++;
    }elseif($fifth=='5g'){
        $arts++;
        $commerce++;
    }elseif($fifth=='5b' or $fifth=='5d'){
        $commerce++;
    }elseif($fifth=='5a'){
        $arts++;
    }elseif($fifth=='5e' or $fifth=='5h'){
        $science++;
      $maths++;
    }
}
}

//Sixth MCQ
if (isset($sixth) && is_array($sixth)) {
foreach ($sixth as $selection) {
if ($sixth=='6a'){
    $maths++;
}elseif($sixth=='6g'){
    $arts++;
    $science++;
}elseif($sixth=='6b'){
    $arts++;
    $commerce++;
}elseif($sixth=='6h' or $sixth=='6c'){
    $commerce++;
}elseif($sixth=='6d'){
    $arts++;
}elseif($sixth=='6f' or $sixth=='6e'){
    $science++;
    $maths++;
}
}
}

//seventh MCQ
if (isset($seventh) && is_array($seventh)) {
foreach ($seventh as $selection) {
    if ($seventh=='7a'){
    $maths++;
}elseif($seventh=='7d'){
    $arts++;
    $science++;
}elseif($seventh=='7b'){
    $arts++;
    $commerce++;
}elseif($seventh=='7f' or $seventh=='7c'){
    $commerce++;
}elseif($seventh=='7e'){
    $arts++;
}elseif($seventh=='7g' or $seventh=='7h'){
    $science++;
    $maths++;
}
}
}

//eighth MCQ
if (isset($eighth) && is_array($eighth)) {
foreach ($eighth as $selection) {
if ($eighth=='8f'){
    $maths++;
}elseif($eighth=='8e'){
    $arts++;
    $science++;
}elseif($eighth=='8c'){
    $arts++;
    $commerce++;
}elseif($eighth=='8d' or $eighth=='8h'){
    $commerce++;
}elseif($eighth=='8a'){
    $arts++;
}elseif($eighth=='8g' or $eighth=='8b'){
    $science++;
    $maths;;
}
}
}

//Ninth MCQ
if (isset($ninth) && is_array($ninth)) {
foreach ($ninth as $selection) {
if ($ninth=='9a'){
    $maths++;
}elseif($ninth=='9h'){
    $arts++;
    $science++;
}elseif($ninth=='9c'){
    $arts++;
    $commerce++;
}elseif($ninth=='9f' or $ninth=='9e'){
    $commerce++;
}elseif($ninth=='9d'){
    $arts++;
}elseif($ninth=='9g' or $ninth=='9b'){
    $science++;
    $maths++;
}
}
}

//Tenth MCQ
if (isset($tenth) && is_array($tenth)) {
foreach ($tenth as $selection) {
if ($tenth=='10b'){
    $maths++;
}elseif($tenth=='10e'){
    $arts++;
    $science++;
}elseif($tenth=='10c'){
    $arts++;
    $commerce++;
}elseif($tenth=='10d' or $tenth=='10a'){
    $commerce++;
}elseif($tenth=='10g'){
    $arts++;
}elseif($tenth=='10h' or $tenth=='10f'){
    $science++;
    $maths++;
}
}
}
//echo "maths".$maths."  science".$science."  arts".$arts."  commerce".$commerce;

// Calculate total responses
$total = $maths + $science + $arts + $commerce;
$total = $total == 0 ? 1 : $total; // Avoid division by zero

// Calculate percentages
$mathsPercentage = round(($maths / $total) * 100, 2);
$sciencePercentage = round(($science / $total) * 100, 2);
$artsPercentage = round(($arts / $total) * 100, 2);
$commercePercentage = round(($commerce / $total) * 100, 2);

// Find the maximum percentage and corresponding subject
$percentages = [
    'Maths' => $mathsPercentage,
    'Science' => $sciencePercentage,
    'Arts' => $artsPercentage,
    'Commerce' => $commercePercentage
];

$maxSubject = array_keys($percentages, max($percentages))[0]; // Get subject with max percentage

// Insert data into the database
$sql = "INSERT INTO percentage (maths, science, arts, commerce) 
        VALUES ('$mathsPercentage', '$sciencePercentage', '$artsPercentage', '$commercePercentage')";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart with Percentages</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Datalabels Plugin -->
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        canvas {
            max-width: 500px;
            margin: 20px auto;
            background: white;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <h2>Subject Score Distribution (with Percentages)</h2>
    <canvas id="pieChart"></canvas>

    <script>
        const ctx = document.getElementById('pieChart').getContext('2d');
        Chart.register(ChartDataLabels); // Register the plugin

        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    'Maths (<?php echo $mathsPercentage; ?>%)',
                    'Science (<?php echo $sciencePercentage; ?>%)',
                    'Arts (<?php echo $artsPercentage; ?>%)',
                    'Commerce (<?php echo $commercePercentage; ?>%)'
                ],
                datasets: [{
                    data: [<?php echo "$maths, $science, $arts, $commerce"; ?>], // Inject PHP data
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value, ctx) => {
                            let total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            let percentage = ((value / total) * 100).toFixed(2) + "%";
                            return percentage;
                        }
                    }
                }
            }
        });
    </script>
    <br><br>
    <button style="background:lightpurple"><?php
    if($maxSubject=='Science'){
        echo '<a href="html.html">view top 5 Science fields after 12th</a>';
    }elseif($maxSubject=='maths'){
        echo '<a href="html2.html">view top 5 Maths fields after 12th</a>';
    }elseif($maxSubject=='commerce'){
        echo '<a href="html3.html">view top 5 Commerce fields after 12th</a>';
    }else{
        echo '<a href="html4.html">view top 5 Arts fields after 12th</a>';
    }
    ?></button>
</body>
</html>*/
$maths=0;
$science=0;
$arts=0;
$commerce=0;
$first=$_POST['q1'];
$second=$_POST['q2'];
$third=$_POST['q3'];
$forth=$_POST['q4'];
$fifth=$_POST['q5'];
$sixth=$_POST['q6'];
$seventh=$_POST['q7'];
$eighth=$_POST['q8'];
$ninth=$_POST['q9'];
$tenth=$_POST['q10']; 

// First MCQ
if (isset($first) && is_array($first)) {
    foreach ($first as $selection) {
        if ($selection == '1a') {
            $maths++;
        } elseif ($selection == '1b') {
            $arts++;
            $science++;
        } elseif ($selection == '1c') {
            $arts++;
            $commerce++;
        } elseif ($selection == '1d' || $selection == '1e') {
            $commerce++;
        } elseif ($selection == '1f') {
            $arts++;
        } elseif ($selection == '1g' || $selection == '1h') {
            $science++;
            $maths++;
        }
    }
}

// Second MCQ
if (isset($second) && is_array($second)) {
    foreach ($second as $selection) {
        if ($selection == '2d'){
            $maths++;
        } elseif ($selection == '2h'){
            $arts++;
            $science++;
        } elseif ($selection == '2c'){
            $arts++;
            $commerce++;
        } elseif ($selection == '2b' || $selection == '2g'){
            $commerce++;
        } elseif ($selection == '2f'){
            $arts++;
        } elseif ($selection == '2e' || $selection == '2a'){
            $science++;
            $maths++;
        }        
    }
}

// Third MCQ
if (isset($third) && is_array($third)) {
    foreach ($third as $selection) {
        if ($selection == '3d'){
            $maths++;
        } elseif ($selection == '3h'){
            $arts++;
            $science++;
        } elseif ($selection == '3c'){
            $arts++;
            $commerce++;
        } elseif ($selection == '3g' || $selection == '3e'){
            $commerce++;
        } elseif ($selection == '3f'){
            $arts++;
        } elseif ($selection == '3a' || $selection == '3b'){
            $science++;
            $maths++;
        }
    }
}

// Fourth MCQ
if (isset($forth) && is_array($forth)) {
    foreach ($forth as $selection) {
        if ($selection == '4d'){
            $maths++;
        } elseif ($selection == '4h'){
            $arts++;
            $science++;
        } elseif ($selection == '4c'){
            $arts++;
            $commerce++;
        } elseif ($selection == '4b' || $selection == '4g'){
            $commerce++;
        } elseif ($selection == '4f'){
            $arts++;
        } elseif ($selection == '4e' || $selection == '4a'){
            $science++;
            $maths++;
        }
    }
}

// Fifth MCQ
if (isset($fifth) && is_array($fifth)) {
    foreach ($fifth as $selection) {
        if ($selection == '5c'){
            $maths++;
        } elseif ($selection == '5f'){
            $arts++;
            $science++;
        } elseif ($selection == '5g'){
            $arts++;
            $commerce++;
        } elseif ($selection == '5b' || $selection == '5d'){
            $commerce++;
        } elseif ($selection == '5a'){
            $arts++;
        } elseif ($selection == '5e' || $selection == '5h'){
            $science++;
            $maths++;
        }
    }
}

// Sixth MCQ
if (isset($sixth) && is_array($sixth)) {
    foreach ($sixth as $selection) {
        if ($selection == '6a'){
            $maths++;
        } elseif ($selection == '6g'){
            $arts++;
            $science++;
        } elseif ($selection == '6b'){
            $arts++;
            $commerce++;
        } elseif ($selection == '6h' || $selection == '6c'){
            $commerce++;
        } elseif ($selection == '6d'){
            $arts++;
        } elseif ($selection == '6f' || $selection == '6e'){
            $science++;
            $maths++;
        }
    }
}

// Seventh MCQ
if (isset($seventh) && is_array($seventh)) {
    foreach ($seventh as $selection) {
        if ($selection == '7a'){
            $maths++;
        } elseif ($selection == '7d'){
            $arts++;
            $science++;
        } elseif ($selection == '7b'){
            $arts++;
            $commerce++;
        } elseif ($selection == '7f' || $selection == '7c'){
            $commerce++;
        } elseif ($selection == '7e'){
            $arts++;
        } elseif ($selection == '7g' || $selection == '7h'){
            $science++;
            $maths++;
        }
    }
}

// Eighth MCQ
if (isset($eighth) && is_array($eighth)) {
    foreach ($eighth as $selection) {
        if ($selection == '8f'){
            $maths++;
        } elseif ($selection == '8e'){
            $arts++;
            $science++;
        } elseif ($selection == '8c'){
            $arts++;
            $commerce++;
        } elseif ($selection == '8d' || $selection == '8h'){
            $commerce++;
        } elseif ($selection == '8a'){
            $arts++;
        } elseif ($selection == '8g' || $selection == '8b'){
            $science++;
            $maths++;
        }
    }
}

// Ninth MCQ
if (isset($ninth) && is_array($ninth)) {
    foreach ($ninth as $selection) {
        if ($selection == '9a'){
            $maths++;
        } elseif ($selection == '9h'){
            $arts++;
            $science++;
        } elseif ($selection == '9c'){
            $arts++;
            $commerce++;
        } elseif ($selection == '9f' || $selection == '9e'){
            $commerce++;
        } elseif ($selection == '9d'){
            $arts++;
        } elseif ($selection == '9g' || $selection == '9b'){
            $science++;
            $maths++;
        }
    }
}

// Tenth MCQ
if (isset($tenth) && is_array($tenth)) {
    foreach ($tenth as $selection) {
        if ($selection == '10b'){
            $maths++;
        } elseif ($selection == '10e'){
            $arts++;
            $science++;
        } elseif ($selection == '10c'){
            $arts++;
            $commerce++;
        } elseif ($selection == '10d' || $selection == '10a'){
            $commerce++;
        } elseif ($selection == '10g'){
            $arts++;
        } elseif ($selection == '10h' || $selection == '10f'){
            $science++;
            $maths++;
        }
    }
}

// Calculate total responses
$total = $maths + $science + $arts + $commerce;
$total = $total == 0 ? 1 : $total; // Avoid division by zero

// Calculate percentages
$mathsPercentage = round(($maths / $total) * 100, 2);
$sciencePercentage = round(($science / $total) * 100, 2);
$artsPercentage = round(($arts / $total) * 100, 2);
$commercePercentage = round(($commerce / $total) * 100, 2);

// Find the maximum percentage and corresponding subject
$percentages = [
    'Maths' => $mathsPercentage,
    'Science' => $sciencePercentage,
    'Arts' => $artsPercentage,
    'Commerce' => $commercePercentage
];

$maxSubject = array_keys($percentages, max($percentages))[0]; // Get subject with max percentage

// Insert data into the database
$sql = "INSERT INTO percentage (maths, science, arts, commerce) 
        VALUES ('$mathsPercentage', '$sciencePercentage', '$artsPercentage', '$commercePercentage')";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart with Percentages</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Datalabels Plugin -->
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        canvas {
            max-width: 500px;
            margin: 20px auto;
            background: white;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <h2>Subject Score Distribution (with Percentages)</h2>
    <canvas id="pieChart"></canvas>

    <script>
        const ctx = document.getElementById('pieChart').getContext('2d');
        Chart.register(ChartDataLabels); // Register the plugin

        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    'Maths (<?php echo $mathsPercentage; ?>%)',
                    'Science (<?php echo $sciencePercentage; ?>%)',
                    'Arts (<?php echo $artsPercentage; ?>%)',
                    'Commerce (<?php echo $commercePercentage; ?>%)'
                ],
                datasets: [{
                    data: [<?php echo "$maths, $science, $arts, $commerce"; ?>], // Inject PHP data
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value, ctx) => {
                            let total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            let percentage = ((value / total) * 100).toFixed(2) + "%";
                            return percentage;
                        }
                    }
                }
            }
        });
    </script>
    <br><br>
    <button style="background-color:rgb(152, 114, 190); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
    <?php
    if ($maxSubject == 'Science') {
        echo '<a href="html.html" style="text-decoration: none; color: white;">View top 5 Science fields after 12th</a>';
    } elseif ($maxSubject == 'Maths') {
        echo '<a href="html2.html" style="text-decoration: none; color: white;">View top 5 Maths fields after 12th</a>';
    } elseif ($maxSubject == 'Commerce') {
        echo '<a href="html3.html" style="text-decoration: none; color: white;">View top 5 Commerce fields after 12th</a>';
    } elseif ($maxSubject == 'Arts') {
        echo '<a href="html4.html" style="text-decoration: none; color: white;">View top 5 Arts fields after 12th</a>';
    }
    ?>
</button>
</body>
</html>

