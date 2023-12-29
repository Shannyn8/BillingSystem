<?php
    session_start();
    include 'database.php';
    include 'links.php';
    include 'sidebar.php'; 
    if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | Inventory System</title>
</head>
<body>
    <section class="dashboard">
        <?php
            include 'navbar.php';         
        ?>
        <div class="dash-content">
            <div class="container" id="table-container">
                <div class="wrapper">
                    <table class="table table-dark js-basic-example dataTable table-custom spacing5 pt-3">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Password </th>
                                <th>Level</th>
                                <th>Name</th>
                                <?php
                                    if($_SESSION['level'] === "Admin"){
                                ?>
                                <th>Action</th>
                                <?php
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $db_query = "select * from users";
                                $db_result = mysqli_query($db_connect, $db_query);
                                while ($row = mysqli_fetch_assoc($db_result)) {
                                    $id = $row['id'];
                                    $username = $row['username'];
                                    $password = $row['password'];
                                    $level = $row['level'];
                                    $firstname = $row['firstname'];
                                    $lastname = $row['lastname'];
                                ?>
                            <tr>
                                <td><?php echo $username ?></td>
                                <td><span><?php echo $password; ?></span></td>
                                <td><?php echo $level ?></td>
                                <td><?php echo $firstname ?></td>
                                <td><?php echo $lastname ?></td>
                                <?php
                                    if($_SESSION['level'] === "Admin"){
                                ?>
                                <td>
                                    <a href="upd_user_page.php?UserID=<?php echo ($row['id']); ?>" class="btn btn-success"
                                        id="btn-update1"><i class="fa-solid fa-pen"></i></a>
                                    <a href="del_user_page.php?UserID=<?php echo ($row['id']); ?>" class="btn btn-danger"
                                        id="btn-delete1"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                <?php
                                      }
                                ?>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="sidebar.js"></script>
</body>
</html>
<?php
} else {
    header("Location: index.php");
}
?>