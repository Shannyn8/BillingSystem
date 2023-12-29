<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="Loogo.png" alt="">
        </div>
        <span class="logo_name">Billing System</span>
    </div>
    <div class="menu-items">
        <ul class="nav-links">
            <li>
                <a href="home.php">
                    <i class="fa-solid fa-house"></i>
                    <span class="link-name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="transactionHistory.php">
                    <i class="fa-solid fa-book"></i>
                    <span class="link-name">Transaction</span>
                </a>
            </li>
            <?php
                if($_SESSION['level'] === "Admin"){
                ?>
                    <li>
                        <a href="users.php">
                            <i class="fa-solid fa-users"></i>
                            <span class="link-name">Users</span>
                        </a>
                    </li>
                <?php
                }
            ?>
        </ul>
        <ul class="logout-mode">
            <li>
                <a href="logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="link-name">Logout</span>
                </a>
            </li>
            <li class="mode">
                <a href="">
                    <i class="fa-solid fa-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>
                <div class="mode-toggle">
                    <span class="switch"></span>
                </div>   
            </li>
        </ul>
    </div>
</nav>