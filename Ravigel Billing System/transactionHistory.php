<?php
    session_start();
    include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include 'links.php';
        function getRecentTransactions($limit = 100) {
            global $db_connect; 
            $userId = $_SESSION['id'];
            if($_SESSION['level'] == "Guest"){
                $query = "SELECT t.*, u.firstname, u.lastname 
                FROM transaction t
                JOIN users u ON t.user = u.id
                WHERE t.user = $userId
                ORDER BY t.id DESC
                LIMIT $limit";
            }else{
                $query = "SELECT t.*, u.firstname, u.lastname 
                FROM transaction t
                JOIN users u ON t.user = u.id
                ORDER BY t.id DESC
                LIMIT $limit"; 
            }
            $result = mysqli_query($db_connect, $query);
            if (!$result) {
                die(mysqli_error($db_connect));  // Print the error message for debugging purposes
            }
            $transactions = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $transactions[] = $row;
            }
            return $transactions;
        }
        $recentTransactions = getRecentTransactions();
    ?>
</head>
<body>
    <?php
        include 'sidebar.php';
    ?>
    <section class="dashboard">
        <?php
            include 'navbar.php';
        ?>
        <div class="dash-content">
            <div class="activity">
                <div class="title">
                    <i class="fa-solid fa-clock"></i>
                    <span class="text">Recent Activity</span>
                </div>
                <div class="activity-data">
                    <div class="data">
                        <span class="data-title">First</span>
                        <?php foreach ($recentTransactions as $transaction): ?>
                            <span class="data-list"><?php echo $transaction['firstname']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Last</span>
                        <?php foreach ($recentTransactions as $transaction): ?>
                            <span class="data-list"><?php echo $transaction['lastname']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Event Name</span>
                        <?php foreach ($recentTransactions as $transaction): ?>
                            <span class="data-list"><?php echo $transaction['event']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Price</span>
                        <?php foreach ($recentTransactions as $transaction): ?>
                            <span class="data-list">₱<?php echo $transaction['price']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Payment</span>
                        <?php foreach ($recentTransactions as $transaction): ?>
                            <span class="data-list"><?php echo $transaction['payment']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Date</span>
                        <?php foreach ($recentTransactions as $transaction): ?>
                            <span class="data-list"><?php echo $transaction['date']; ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>         
            </div>
        </div>
    </section>
    <script src="modal.js"></script> 
    <script src="script.js"></script>
</body>
</html>