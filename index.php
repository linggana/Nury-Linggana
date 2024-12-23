<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$level = $_SESSION['level'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laundry System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Level: <?php echo $level; ?></p>

        <?php if ($level == 'admin') { ?>
            <a href="admin/dashboard.php" class="btn btn-primary">Go to Admin Dashboard</a>
        <?php } elseif ($level == 'staff') { ?>
            <a href="staff/transaction.php" class="btn btn-primary">Manage Transactions</a>
        <?php } elseif ($level == 'operator') { ?>
            <a href="operator/report.php" class="btn btn-primary">View Reports</a>
        <?php } ?>
    </div>
</body>
</html>
