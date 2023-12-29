<?php
    session_start();
    include 'database.php';
    $payment = $_POST['payment'];
    $event = $_POST['event'];
    $price = $_POST['price'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include 'links.php';
    ?>
    <link rel="stylesheet" href="checkout.css">
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
            <form action="transaction.php" method="post">
                <div class="container">
                    <h1>Confirm your payment</h1>
                    <div class="first-row">
                        <div class="owner">
                            <h3>Owner</h3>
                            <div class="input-field">
                                <input type="text" required>
                            </div>
                        </div>
                        <div class="cvv">
                            <h3>CVV</h3>
                            <div class="input-field">
                                <input type="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="second-row">
                        <div class="card-number">
                            <h3>Card Number</h3>
                            <div class="input-field">
                                <input type="text">
                            </div>
                        </div>
                    </div>
                    <div class="third-row">
                        <h3>Date</h3>
                        <div class="selection">
                            <div class="date">
                                <select name="months" id="months">
                                    <option value="Jan">Jan</option>
                                    <option value="Feb">Feb</option>
                                    <option value="Mar">Mar</option>
                                    <option value="Apr">Apr</option>
                                    <option value="May">May</option>
                                    <option value="Jun">Jun</option>
                                    <option value="Jul">Jul</option>
                                    <option value="Aug">Aug</option>
                                    <option value="Sep">Sep</option>
                                    <option value="Oct">Oct</option>
                                    <option value="Nov">Nov</option>
                                    <option value="Dec">Dec</option>
                                </select>
                                <select name="years" id="years">
                                </select>
                            </div>
                            <h1>You are using <span><?php echo $payment ?></span></h1>
                        </div>
                    </div>
                    
                    <input type="hidden" name="event" value="<?php echo $event ?>">
                    <input type="hidden" name="price" value="<?php echo $price ?>"> 
                    <input type="hidden" name="payment" value="<?php echo $payment ?>">
                    <!--
                    <h1><?php echo $event ?></h1>
                    <h1><?php echo $price ?></h1>
                    <h1><?php echo $payment ?></h1>
                    --> 
                    <button type="submit">Confirm</button>
                    <a href="home.php">
                    <button type="button">Exit</button>
                    </a>
                </div>
            </form>
        </div>
    </section>
    <script src="script.js"></script>
    <script>
        var currentYear = new Date().getFullYear();
        for (var i = currentYear; i >= currentYear - 100; i--) {
            var option = document.createElement("option");
            option.value = i;
            option.text = i;
            document.getElementById("years").appendChild(option);
        }
    </script>
</body>
</html>