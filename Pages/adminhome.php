<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Portal</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../css/admin_style.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column; /* Ensure body grows vertically */
            min-height: 100vh; /* Make sure body takes full viewport height */
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
            margin-left: 205px; /* Match the sidebar width */
            padding: 20px;
            flex: 1;
            background-color: #f2f2f2;
        }

        .dashboard-section {
            background-color: #f2f2f2;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Center items horizontally */
        }

        .dashboard-section h2 {
            font-size: 24px;
            font-weight: 600;
            color: #0e0d0d;
            margin-bottom: 15px;
        }

        .dashboard-cards {
            display: flex;
            gap: 30px; /* Adjust gap between cards */
            justify-content: center; /* Center cards horizontally */
            flex-wrap: wrap; /* Allow cards to wrap on smaller screens */
            max-width: 1000px; /* Set a max-width for the card container */
            margin-bottom: 30px; /* Space below the cards */
        }

        .dashboard-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
            max-width: 300px; /* Limit card width */
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
        }

        .dashboard-card i {
            color: #0e0d0d;
            font-size: 48px;
        }

        .card-info {
            margin-top: 15px;
        }

        .card-info h3 {
            font-size: 20px;
            font-weight: 600;
            color: #35424a;
        }

        .card-info p {
            font-size: 36px;
            font-weight: 600;
            color: #35424a;
        }

        .welcome-message {
            font-size: 20px;
            font-weight: 400;
            color: #0e0d0d;
            text-align: center;
            margin-top: 30px;
        }

        .footer {
            background-color: #1a1a1a;
            color: #e0e0e0;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            width: 100%;
            position: relative;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-brand {
            color: #FFC107;
            font-weight: bold;
        }

        .footer p {
            margin: 0;
            font-size: 1rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 10px 0 0;
        }

        .footer-links li {
            display: inline;
            margin: 0 15px;
        }

        .footer-links a {
            color: #e0e0e0;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #FFC107;
        }

        @media (max-width: 768px) {
            .footer-links {
                margin-top: 10px;
            }

            .footer-links li {
                display: block;
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="admin-portal">ADMIN DASHBOARD</div>
        <ul class="nav-links">
            <li><a href="adminhome.php"><i class="fas fa-home"></i> Admin Home</a></li>
            <li><a href="users.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="adminorders.php"><i class="fas fa-box"></i> Orders</a></li>
            <li><a href="admin_reservation.php"><i class="fas fa-calendar-check"></i> Reservations</a></li>
            <li><a href="adminfoodmenu.php"><i class="fas fa-utensils"></i> Menu</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </aside>

    <div class="content">
        <?php include("../Components/adminnavbar.php"); ?>

        <div class="dashboard-section">
            <h2>Dashboard</h2>
            <div class="dashboard-cards">
                <!-- Total Orders Card -->
                <div class="dashboard-card">
                    <i class="fas fa-shopping-cart fa-3x"></i>
                    <div class="card-info">
                        <h3>Total Orders</h3>
                        <?php
                        // Fetch total orders from database
                        $query = "SELECT COUNT(*) AS total_orders FROM order_details";
                        $result = mysqli_query($con, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $total_orders = $row['total_orders'];
                            echo "<p>$total_orders</p>";
                        } else {
                            echo "<p>Unable to fetch data</p>";
                        }
                        ?>
                    </div>
                </div>

                <!-- Total Reservations Card -->
                <div class="dashboard-card">
                    <i class="fas fa-calendar-alt fa-3x"></i>
                    <div class="card-info">
                        <h3>Total Reservations</h3>
                        <?php
                        // Example: Fetch total reservations from database
                        $query = "SELECT COUNT(*) AS total_reservations FROM reservations";
                        $result = mysqli_query($con, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $total_reservations = $row['total_reservations'];
                            echo "<p>$total_reservations</p>";
                        } else {
                            echo "<p>Unable to fetch data</p>";
                        }
                        ?>
                    </div>
                </div>

                <!-- Total Foods Card -->
                <div class="dashboard-card">
                    <i class="fas fa-utensils fa-3x"></i>
                    <div class="card-info">
                        <h3>Total Foods</h3>
                        <?php
                        // Example: Fetch total foods from database
                        $query = "SELECT COUNT(*) AS total_foods FROM menu";
                        $result = mysqli_query($con, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $total_foods = $row['total_foods'];
                            echo "<p>$total_foods</p>";
                        } else {
                            echo "<p>Unable to fetch data</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Welcome Message -->
            <div class="welcome-message">
                <p>Welcome to the Admin Dashboard!</p>
            </div>
        </div>
    </div>

    <?php mysqli_close($con); ?>

    <!-- Custom JS file link -->
    <script src="../js/script.js"></script>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; <span class="footer-brand">Niman</span> 2024. All Rights Reserved.</p>
            <ul class="footer-links">
                <li><a href="#privacy-policy">Privacy Policy</a></li>
                <li><a href="#terms-of-service">Terms of Service</a></li>
                <li><a href="#contact-us">Contact Us</a></li>
            </ul>
        </div>
    </footer>
</body>

</html>
