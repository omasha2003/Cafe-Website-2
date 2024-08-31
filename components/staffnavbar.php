<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: "Lato", sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .navbar {
            display: flex;
            flex-direction: column;
            background-color: #0e0d0d;
            color: #fffcda;
            height: 120px;
            width: 100%;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            height: 100%;
        }

        .logo {
            height: 80px;
            width: auto;
        }

        .admin-portal {
            flex: 1; 
            text-align: center; 
            font-size: 24px;
            font-weight: 700;
            color: #fffcda;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .username {
            font-size: 16px;
            margin-right: 20px;
        }

        .secondary-navbar {
            background-color: #2a0906;
            height: 50px;
            display: flex;
            align-items: center;
            padding: 0 30px;
        }

        .secondary-nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }

        .secondary-nav-links li {
            display: inline;
        }

        .secondary-nav-links a {
            color: #fffcda;
            text-decoration: none;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .secondary-nav-links a:hover {
            background-color: #d8d8d4;
            color: #fffcda;
        }

        .logout {
            margin-left: auto;
            padding: 10px;
        }

        .logout a {
            color: #fffcda;
            text-decoration: none;
            font-size: 14px;
        }

        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="../Components/staffhome.php" class="logo">
                <!-- Logo Image or Text -->
            </a>
            <div class="admin-portal">STAFF PORTAL</div>

            </div>
        </div>
        <div class="secondary-navbar">
            <ul class="secondary-nav-links">
                <li><a href="staffreservations.php">Staff Reservations</a></li>
                <li><a href="staffhome.php">Orders</a></li>
            </ul>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

</body>
</html>
