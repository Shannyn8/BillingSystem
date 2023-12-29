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
    <link rel="stylesheet" href="users.css">
    <?php
        include 'links.php';
        function getRecentTransactions($limit = 5) {
            global $db_connect;
            $query = "SELECT * 
                      FROM users
                      ORDER BY id ASC
                      LIMIT $limit";
            $result = mysqli_query($db_connect, $query);
            $users = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
            return $users;
        }        
        $allUsers = getRecentTransactions();
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
                    <span class="text">Users</span>
                </div>
                <div class="activity-data">
                    <div class="data">
                        <span class="data-title">ID</span>
                        <?php foreach ($allUsers as $users): ?>
                            <span class="data-list"><?php echo $users['id']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Username</span>
                        <?php foreach ($allUsers as $users): ?>
                            <span class="data-list"><?php echo $users['username']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">User Level</span>
                        <?php foreach ($allUsers as $users): ?>
                            <span class="data-list"><?php echo $users['level']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Full</span>
                        <?php foreach ($allUsers as $users): ?>
                            <span class="data-list"><?php echo $users['firstname']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Name</span>
                        <?php foreach ($allUsers as $users): ?>
                            <span class="data-list"><?php echo $users['lastname']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Gender</span>
                        <?php foreach ($allUsers as $users): ?>
                            <span class="data-list"><?php echo $users['gender']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Phone Number</span>
                        <?php foreach ($allUsers as $users): ?>
                            <span class="data-list"><?php echo $users['phone']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                        <span class="data-title">Email</span>
                        <?php foreach ($allUsers as $users): ?>
                            <span class="data-list"><?php echo $users['email']; ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="data">
                   <span class="data-title">Action</span>
                   <?php foreach ($allUsers as $user): ?>
                          <span class="data-list">
                          <a href="edit_user.php?user_id=<?php echo $user['id']; ?>">
                              <button><i class="fa-solid fa-pen-to-square"></i></button>
                          </a>
                         <a href="delete_user.php?user_id=<?php echo $user['id']; ?>">
                         <button><i class="fa-solid fa-trash"></i></button>
                         </a> 
                          <?php if ($user['is_disabled'] == 0): ?>
                           <a href="disable_user.php?user_id=<?php echo $user['id']; ?>">
                              <button><i class="fa-solid fa-ban"></i></button>
                            </a>
                    <?php else: ?>
                         <a href="enable_user.php?user_id=<?php echo $user['id']; ?>">
                             <button><i class="fa-solid fa-check"></i></button>
                         </a>
                    <?php endif; ?>
                    </span>
                    <?php endforeach; ?>
                </div>
                </div>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>