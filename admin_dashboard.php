<?php
session_start();
include 'db_connect.php';

$today = date('Y-m-d');

$total_shipments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM tbl_shipments"))['c'];
$in_transit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM tbl_shipments WHERE current_status='In Transit'"))['c'];
$delivered = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM tbl_shipments WHERE current_status='Delivered'"))['c'];
$otd_rate = ($total_shipments > 0) ? round(($delivered / $total_shipments) * 100) : 0;

$rev_query = mysqli_query($conn, "SELECT SUM(q.Quoted_price) as total FROM tbl_shipments s JOIN tbl_QuoteForm q ON s.quote_id = q.Id WHERE s.payment_status = 'Paid'");
$rev_data = mysqli_fetch_assoc($rev_query);
$exact_total_revenue = $rev_data['total'] ?? 0;

$days_in_month = date('t');
$month_labels = []; 
$monthly_amounts = [];
for ($i = 1; $i <= $days_in_month; $i++) {
    $date = date('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT);
    $month_labels[] = $i;
    $res = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(q.Quoted_price) as daily_total FROM tbl_shipments s JOIN tbl_QuoteForm q ON s.quote_id = q.Id WHERE DATE(s.updated_at) = '$date' AND s.payment_status = 'Paid'"));
    $monthly_amounts[] = $res['daily_total'] ?? 0;
}

$transit_count = $in_transit;
$delivered_count = $delivered;
$out_delivery_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM tbl_shipments WHERE current_status='Out for Delivery'"))['c'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SHADOWWS | dashbard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/new.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; font-family: 'Inter', sans-serif; }
        .card-pro { border: none; border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); transition: 0.3s; }
        .ongoing-card { border-radius: 15px; border: 1px solid #eee; background: #fff; margin-bottom: 15px; transition: 0.3s; }
        .ongoing-card.active {  border-left: 6px solid #fcdc04; ; }
        .text-gold { color: #fcdc04 !important; }
        .bg-dark-pro { background: #1a1a1a; color: white; }
        .shipment-icon-small { width: 40px; opacity: 0.8; }
    </style>
</head>
<body>
    <?php include "admin_header.php" ?>

    <div class="admin-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: #262223; font-weight: bold;">Dashboard</h2>
            <div class="d-flex align-items-center bg-white p-2 rounded-pill shadow-sm">
                <span class="px-3 small font-weight-bold text-muted"><?php echo date('d M, Y'); ?></span>
                <button class="btn btn-dark btn-round btn-sm">Refresh</button>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card card-pro p-4 bg-white">
                    <div class="d-flex justify-content-between"><span class="small font-weight-bold text-muted">TOTAL FLEET</span><i class="fa fa-boxes text-gold"></i></div>
                    <h2 class="font-weight-bold mt-2"><?php echo $total_shipments; ?></h2>
                    <small class="text-success">+4.2% increased</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-pro p-4 bg-white">
                    <div class="d-flex justify-content-between"><span class="small font-weight-bold text-muted">IN TRANSIT</span><i class="fa fa-truck text-gold"></i></div>
                    <h2 class="font-weight-bold mt-2"><?php echo $in_transit; ?></h2>
                    <small class="text-muted">Currently active</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-pro p-4 bg-white">
                    <div class="d-flex justify-content-between"><span class="small font-weight-bold text-muted">COMPLETED</span><i class="fa fa-check-circle text-success"></i></div>
                    <h2 class="font-weight-bold mt-2"><?php echo $delivered; ?></h2>
                    <small class="text-success">Successful</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-pro p-4 bg-dark-pro">
                    <div class="d-flex justify-content-between"><span class="small font-weight-bold text-muted">REVENUE</span><i class="fa fa-wallet text-gold"></i></div>
                    <h4 class="font-weight-bold mt-2 text-gold">Rs. <?php echo number_format($exact_total_revenue, 2); ?></h4>
                    <small class="text-white-50">Total Earnings</small>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <h5 class="font-weight-bold mb-3">Ongoing Delivery</h5>
                <?php 
                $ongoing = mysqli_query($conn, "SELECT s.*, q.Name, q.Origin, q.Destination FROM tbl_shipments s JOIN tbl_QuoteForm q ON s.quote_id = q.Id WHERE s.current_status != 'Delivered' LIMIT 3");
                while($row = mysqli_fetch_assoc($ongoing)) { ?>
                <div class="ongoing-card p-3 shadow-sm <?php echo ($row['current_status'] == 'Out for Delivery') ? 'active' : ''; ?>">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted font-weight-bold">#<?php echo $row['tracking_id']; ?></small>
                            <h6 class="font-weight-bold mb-1"><?php echo $row['Name']; ?></h6>
                            <p class="small text-muted mb-0"><?php echo $row['Origin']; ?> &rarr; <?php echo $row['Destination']; ?></p>
                        </div>
                        <i class="fa fa-truck-side fa-2x text-muted"></i>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="col-md-8">
                <div class="card card-pro p-4 bg-white mb-4">
                    <h6 class="font-weight-bold">Monthly Revenue Analysis</h6>
                    <div style="height: 250px;"><canvas id="monthlyBarChart"></canvas></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-pro p-4 bg-white h-100">
                            <h6 class="font-weight-bold text-center">Status Breakdown</h6>
                            <div style="height: 180px;"><canvas id="statusPieChart"></canvas></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-pro p-4 bg-white text-center h-100">
                            <h6 class="font-weight-bold">Efficiency</h6>
                            <h1 class="display-4 font-weight-bold mt-3 text-dark"><?php echo $otd_rate; ?>%</h1>
                            <p class="text-muted small">Delivery Success Rate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="bg-white p-4 shadow-sm rounded h-100 card-pro">
                    <h5 class="font-weight-bold mb-4 text-dark"><i class="fa fa-truck-moving mr-2 text-warning"></i> Fleet Activity Slicer</h5>
                    <table class="table table-hover">
                        <thead class="bg-light small text-uppercase">
                            <tr><th>Tracking ID</th><th>Current Location</th><th>Status</th><th>Last Update</th></tr>
                        </thead>
                        <tbody>
                            <?php 
                            $recent = mysqli_query($conn, "SELECT * FROM tbl_shipments ORDER BY updated_at DESC LIMIT 6");
                            while($r = mysqli_fetch_assoc($recent)) { ?>
                                <tr>
                                    <td><strong>#<?php echo $r['tracking_id']; ?></strong></td>
                                    <td><?php echo $r['location']; ?></td>
                                    <td>
                                        <span class="badge badge-pill <?php echo ($r['current_status']=='Delivered')?'badge-success':'badge-warning'; ?>">
                                            <?php echo strtoupper($r['current_status']); ?>
                                        </span>
                                    </td>
                                    <td class="small text-muted"><?php echo date('d M, H:i', strtotime($r['updated_at'])); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('monthlyBarChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($month_labels); ?>,
                datasets: [{
                    label: 'Revenue',
                    data: <?php echo json_encode($monthly_amounts); ?>,
                    backgroundColor: '#fcdc04',
                    borderRadius: 5
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });

        new Chart(document.getElementById('statusPieChart'), {
            type: 'pie',
            data: {
                labels: ['In Transit', 'Out for Delivery', 'Delivered'],
                datasets: [{
                    data: [<?php echo $transit_count; ?>, <?php echo $out_delivery_count; ?>, <?php echo $delivered_count; ?>],
                    backgroundColor: ['#1a1a1a', '#fcdc04', '#28a745'],
                    borderWidth: 0
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });
    </script>
</body>
</html>