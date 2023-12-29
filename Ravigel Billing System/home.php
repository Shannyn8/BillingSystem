<?php
    session_start();
    include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php
        include 'links.php';
        function getRecentTransactions($limit = 5) {
            global $db_connect; 
            $query = "SELECT t.*, u.firstname, u.lastname 
                      FROM transaction t
                      JOIN users u ON t.user = u.id
                      ORDER BY t.id DESC
                      LIMIT $limit";
            $result = mysqli_query($db_connect, $query);
            $transactions = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $transactions[] = $row;
            }
            return $transactions;
        }
        $recentTransactions = getRecentTransactions();
    ?>
    <link rel="stylesheet" href="payment.css">
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
            <div class="colors">
                <div class="title">
                    <i class="fa-solid fa-calendar"></i>
                    <span class="text">Events</span>
                </div>
                <div class="boxes">
                    <?php
                        $db_query = "SELECT * FROM events";
                        $db_result = mysqli_query($db_connect, $db_query);
                        while ($data = mysqli_fetch_assoc($db_result)) {
                            ?>
                                <div class="eventbox">
                                    <img src="./images/<?php echo $data['picture']; ?>">
                                    <div class="details">
                                        <h3><?php echo $data['name']; ?></h3>
                                        <p>Price: ₱<?php echo $data['price']; ?></p>
                                        <?php
                                            if($_SESSION['level'] === "Admin"){
                                            ?>
                                                <div class="admin-btn">
                                                    <a href="delete_event.php?id=<?php echo $data['id']; ?>">
                                                        <button><i class="fa-solid fa-trash"></i></button>
                                                    </a>
                                                    <a href="edit_event.php?id=<?php echo $data['id']; ?>">
                                                        <button><i class="fa-solid fa-pen-to-square"></i></button>
                                                    </a>
                                                </div>
                                            <?php
                                            }
                                        ?>
                                        <!--
                                        <a href="transaction.php?event=<?php echo $data['name']; ?>&price=<?php echo $data['price']; ?>&user=<?php echo $_SESSION['id']; ?>">
                                            <button>Buy</button>
                                        </a>
                                        -->
                                        <?php
                                            if($_SESSION['level'] === "Guest"){
                                            ?>
                                                <!--
                                                <button 
                                                    data-open-modal 
                                                    data-event-name="<?php echo $data['name']; ?>"
                                                    data-event-price="<?php echo $data['price']; ?>" 
                                                    data-event-picture="<?php echo $data['picture']; ?>"
                                                    >
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </button>
                                                <button data-open-modal>
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </button>
                                                 <button data-open-modal onclick="<?php $name = $data['name']; ?>">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </button>
                                                -->


                                                <button 
                                                    data-open-modal 
                                                    data-event-name="<?php echo $data['name']; ?>"
                                                    data-event-price="<?php echo $data['price']; ?>" 
                                                    >
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </button>

                                            <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                    <?php
                        if($_SESSION['level'] === "Admin"){
                        ?>
                            <div class="box addbox">
                                <a href="add_event.php">
                                    <button>
                                    <i class="fa-solid fa-plus"></i>
                                    </button>
                                </a>
                            </div>
                        <?php
                        }
                    ?>
                </div>
            </div>
            <dialog data-modal>
                <div class="container" id="buyModal">
                    <div class="title">
                        <h4>Select a <span style="color: 6064b6">Payment</span> Method</h4>
                    </div>
                    <form action="payment.php" method="post">
                        <input type="radio" name="payment" id="visa" value="Visa" required>
                        <input type="radio" name="payment" id="mastercard" value="Mastercard" required>
                        <input type="radio" name="payment" id="paypal" value="Paypal" required>
                        <input type="radio" name="payment" id="gcash" value="GCash" required>
                        <div class="category">
                            <label for="visa" class="visa">
                                <div class="imgName">
                                    <div class="imgContainer">
                                        <img src="./assets/visa.png" alt="">
                                    </div>
                                </div>
                                <span class="check"><i class="fa-solid fa-circle-check"></i></span>
                            </label>
                            <label for="mastercard" class="mastercard">
                                <div class="imgName">
                                    <div class="imgContainer">
                                        <img src="./assets/mastercard.png" alt="">
                                    </div>
                                </div>
                                <span class="check"><i class="fa-solid fa-circle-check"></i></span>
                            </label>
                            <label for="paypal" class="paypal">
                                <div class="imgName">
                                    <div class="imgContainer">
                                        <img src="./assets/paypal.png" alt="">
                                    </div>
                                </div>
                                <span class="check"><i class="fa-solid fa-circle-check"></i></span>
                            </label>
                            <label for="gcash" class="gcash">
                                <div class="imgName">
                                    <div class="imgContainer">
                                        <img src="./assets/gcash.png" alt="">
                                    </div>
                                </div>
                                <span class="check"><i class="fa-solid fa-circle-check"></i></span>
                            </label>
                        </div>
                        <input type="hidden" class="event" name="event" readonly>
                        <input type="hidden" class="price" name="price" readonly>
                        <button type="submit">Confirm</button>
                    </form>
                </div>
            </dialog>

            <dialog data-modal2>
                <div class="buyModal">
                    <form action="transaction.php" method="POST">
                        <div class="modal-content">
                            <img class="eventPicture" src="" alt="Event Picture">
                            <input type="hidden" class="picture" readonly>
                            <input type="hidden" class="eventName" name="eventName" readonly>
                            <input type="hidden" class="price" name="price" readonly>
                            <div class="buy-info">
                                <span id="itemNameSpan">Your buying </span>
                                <span id="amountSpan">Amount is </span>
                            </div>
                            <label for="phoneNumber">Enter Phone Number:</label>
                            <input type="number">
                            <div class="modal-buttons">
                                <button type="submit" formmethod="dialog">Cancel</button>
                                <button type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </dialog>
            <!--
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
                            <span class="data-list">$<?php echo $transaction['price']; ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            -->
        </div>
    </section>
    <script src="modal.js"></script> 
    <script src="script.js"></script>
</body>
</html>