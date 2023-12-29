<?php
    session_start();
    include 'database.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_GET['id'];
        $newUsername = $_POST['username'];
        $newPassword = $_POST['password'];
        $newLevel = $_POST['level'];
        $newFirstname = $_POST['firstname'];
        $newLastname = $_POST['lastname'];
        $newGender = $_POST['gender'];
        $newPhone = $_POST['phone'];
        $newEmail = $_POST['email'];
        $query = "UPDATE users 
                  SET username = '$newUsername', 
                      password = '$newPassword', 
                      level = '$newLevel', 
                      firstname = '$newFirstname', 
                      lastname = '$newLastname', 
                      gender = '$newGender', 
                      phone = '$newPhone', 
                      email = '$newEmail' 
                  WHERE id = $userId";
        $result = mysqli_query($db_connect, $query);
        if ($result) {
        //echo '<script>alert("Item Bought Successfully!");</script>';
        //header("Location: home.php");
         echo '<script>';
         echo 'alert("Updated Succesfully");';
         echo 'setTimeout(function() {';
         echo '    window.location.href = "home.php";';
         echo '}, 3000);';  // 3000 milliseconds (3 seconds) delay
         echo '</script>';
        } else {
            die("Error updating user data: " . mysqli_error($db_connect));
        }
    } else {
        echo 'Invalid request method';
    }
    function getUserData($userId) {
        global $db_connect;
        $query = "SELECT * FROM users WHERE id = $userId";
        $result = mysqli_query($db_connect, $query);
        if ($result) {
            return mysqli_fetch_assoc($result);
        } else {
            die("Error fetching user data: " . mysqli_error($db_connect));
        }
    }
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
    }
    $userData = getUserData($userId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Area</title>
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
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
            width: 100%;
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
            background-color: black;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #007bb5;
        }
        .row{
            display: flex;
            width: 100%
        }
        .column{
            display: flex;
            flex-direction: column;
            width: 50%;
            margin-right: 15px;
        }
    </style>
    <?php
        include 'links.php';
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
        <form action="edit_user.php?id=<?php echo $userData['id']; ?>" method="post">
                <div class="row">
                    <div class="column">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>" required>
                    </div>
                    <div class="column">
                        <label for="password">Password:</label>
                        <input type="text" id="password" name="password" value="<?php echo $userData['password']; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="level">Level:</label>
                        <input type="text" id="level" name="level" value="<?php echo $userData['level']; ?>" required>
                    </div>
                    <div class="column">
                        <label for="first">First Name:</label>
                        <input type="text" id="firstname" name="firstname" value="<?php echo $userData['firstname']; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="lastname">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" value="<?php echo $userData['lastname']; ?>" required>
                    </div>
                    <div class="column">
                        <label for="gender">Gender:</label>
                        <input type="text" id="gender" name="gender" value="<?php echo $userData['gender']; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="phone">Phone Number:</label>
                        <input type="text" id="phone" name="phone" value="<?php echo $userData['phone']; ?>" required>
                    </div>
                    <div class="column">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" value="<?php echo $userData['email']; ?>" required>
                    </div>
                </div>
                <button type="submit">Update</button>
            </form>  
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>