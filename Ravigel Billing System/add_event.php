<?php
    session_start();
    include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <?php
        include 'links.php';
    ?>
    <link rel="stylesheet" href="redirect.css">
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
        <form action="process_event.php" method="post" enctype="multipart/form-data">
                <h2>Add Event</h2>
                <label for="eventName">Event Name:</label>
                <input type="text" id="eventName" name="eventName" required>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
                <label for="picture">Picture:</label>
                <input type="file" id="picture" name="uploadfile" accept="image/*" required>
                <input type="submit" name="upload" value="Add Event">
                <a href="home.php" class="exit-btn">
                    <button type="button">Exit</button>    
                </a>
            </form>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>