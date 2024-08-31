<?php
include("../components/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: "Lato", sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 205px;
            background-color: #0e0d0d;
            color: #fffcda;
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar .logo {
            height: 80px;
            width: auto;
            margin: 0 auto;
            display: block;
        }

        .sidebar .nav-links {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .sidebar .nav-links li {
            margin-bottom: 20px;
        }

        .sidebar .nav-links a {
            color: #fffcda;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar .nav-links a:hover {
            background-color: #2a0906;
            color: #fffcda;
        }

        .sidebar .nav-links a i {
            margin-right: 10px;
        }

        .content {
            margin-left: 110px;
            padding: 20px;
            flex: 1;
        }

  

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 0 30px;
        }

        .admin-portal {
            font-size: 15px;
            font-weight: 400;
            color: whitesmoke;
            flex: 1;
            text-align: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .username {
            font-size: 18px;
            color: whitesmoke;
        }

        .logout a {
            color: #bba586;
            font-size: 14px;
        }

        .logout a:hover {
            color: #fffcda;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    
    include("../Components/db.php");
    ?>
    <aside class="sidebar">
        <div class="admin-portal">ADMIN DASHBOARD</div>
        
        <ul class="nav-links">
            <li><a href="adminhome.php"><i class="fas fa-home"></i> Admin Home</a></li>
            <li><a href="users.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="adminorders.php"><i class="fas fa-box"></i> Orders</a></li>
            <li><a href="admin_reservation.php"><i class="fas fa-calendar-check"></i> Reservations</a></li>
            <li><a href="adminfoodmenu.php"><i class="fas fa-utensils"></i> Menu</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo "<li class='user-info'>";
                    echo "<span class='username'>Welcome, $username</span>";
                    echo "<span class='logout'><a href='../Components/logout.php'>Logout</a></span>";
                    echo "</li>";
                } else 

                ?>

        </ul>
    </aside>
    <div class="content">
        <nav class="navbar">
            <div class="navbar-content">
                <a href="../Components/adminhome.php">
                    <!-- Logo or Home Link Here -->
                </a>
 

            </div>
        </nav>
        <!-- Page Content Here -->
    </div>
</body>

</html>
