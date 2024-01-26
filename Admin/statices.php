<?php
include'../mysql/connectMysql.php';

// Fetch subscription data
$sql = "SELECT date_now, COUNT(*) as num_subscribers FROM subscription GROUP BY date_now ORDER BY date_now";
$result = $conn->query($sql);

// Prepare data for the graph
$dates = [];
$subscribers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dates[] = $row['date_now']; // Assuming date_sub is in a date format
        $subscribers[] = $row['num_subscribers'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subscription Graph</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php
    include 'index.php'
    ?>
        <div style="width: 70%; margin: 0 auto;">
        <canvas id="subscriptionChart" height="150"></canvas>
        </div>

    <script>
        // Chart.js code to create the graph
        var ctx = document.getElementById('subscriptionChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                    label: 'Number of Subscribers',
                    data: <?php echo json_encode($subscribers); ?>,
                    backgroundColor: 'rgba(205, 74, 148, 0.3)',
                    borderColor: 'rgba(205, 74, 148, 1)',
					
					
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
    </script>
</body>
</html>
