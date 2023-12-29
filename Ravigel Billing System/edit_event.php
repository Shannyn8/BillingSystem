<?php
session_start();
include 'database.php';

if ($_SESSION['level'] === "Admin" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM events WHERE id = $id";
    $result = mysqli_query($db_connect, $query);
    $event = mysqli_fetch_assoc($result);

    if (!$event) {
        header("Location: test.php");
        exit();
    }

   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newName = $_POST['new_name'];
        $newPrice = $_POST['new_price'];

        if ($_FILES['new_picture']['error'] == 0) {
            $targetDir = "./images/";
            $targetFile = $targetDir . basename($_FILES['new_picture']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES['new_picture']['tmp_name']);
            if ($check !== false) {
                move_uploaded_file($_FILES['new_picture']['tmp_name'], $targetFile);
                $newPicture = basename($_FILES['new_picture']['name']);

                $updateQuery = "UPDATE events SET name = '$newName', price = '$newPrice', picture = '$newPicture' WHERE id = $id";
                mysqli_query($db_connect, $updateQuery);
            } else {
                echo "File is not an image.";
            }
        } else {
            $updateQuery = "UPDATE events SET name = '$newName', price = '$newPrice' WHERE id = $id";
            mysqli_query($db_connect, $updateQuery);
        }

        header("Location: home.php");
        exit();
    }
} else {
    header("Location: test.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        form {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #007bb5;
        }
    </style>
</head>
<body>
    <h1>Edit Event</h1>
    <form action="edit_event.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="new_name">New Event Name:</label>
        <input type="text" id="new_name" name="new_name" value="<?php echo $event['name']; ?>" required>
        <label for="new_price">New Price:</label>
        <input type="number" id="new_price" name="new_price" value="<?php echo $event['price']; ?>" required>
        <label for="new_picture">New Picture:</label>
        <input type="file" id="new_picture" name="new_picture">
        <button type="submit">Update Event</button>
        <a href="home.php">
            <button type="button">Exit</button>
        </a>

    </form>
</body>
</html>
