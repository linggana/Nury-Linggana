<?php
include 'config/db.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM TransaksiLaundry WHERE id_transaksi LIKE '%$search%' OR status LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Transactions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Search Transactions</h2>
        <form action="search.php" method="GET">
            <input type="text" name="search" class="form-control" placeholder="Search" required>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        
        <?php if (isset($result)) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id_transaksi']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</body>
</html>
