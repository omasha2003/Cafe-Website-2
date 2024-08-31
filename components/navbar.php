<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/style1.css">
    <title>Customer Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Museo+Sans+Rounded:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <style>
  body {
  margin: 0;
  font-family: "Museo Sans Rounded", sans-serif;
  background: #f4f4f4;
}

.navbar {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #0e0d0d;
  height: 150px;
  width: 100%;
}

.nav-links {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 20px;
}

.nav-links li {
  display: inline;
}

.nav-links a {
  color: #e0c8c8; /* Adjust text color */
  text-decoration: none;
  font-size: 13px;
  padding: 5px 10px;
  font-family: "Museo Sans Rounded", sans-serif;
  font-weight: bold; /* Adjust text weight */
  letter-spacing: 1px;
}

.nav-links a:hover {
  color: #9f7070;
}

.nav-links .logo-item {
  margin-right: 22pc; /* Pushes the logo to the left */
}

.logo {
  margin: 0;
  padding: 0;
  height: 100px; /* Adjust the logo size as needed */
}

.user-info {
  display: flex;
  align-items: center;
  margin-left: auto; /* Pushes the user-info to the right */
}

.username {
  color: #e0c8c8; /* Matches the text color of the links */
  font-size: 14px; /* Matches the font size of the links */
  margin-right: 10px;
}

.logout a {
  color: #e0c8c8; /* Matches the text color of the links */
  font-size: 14px; /* Matches the font size of the links */
}

.logout a:hover {
  color: #9f7070;
  text-decoration: underline;
}

    </style>
</head>

<body>
    <?php
    
    include("../Components/db.php");
    ?>

    <section>
        <nav class="navbar">
            <ul class="nav-links">
                <li class="logo-item"><img src="../Images/612cba400ea67597d9daf52501760c5a.png" alt="Logo" class="logo"></li>
                <li><a href="../pages/Home.php">HOME</a></li>
                <li><a href="../Pages/About us.php">ABOUT US</a></li>
                <li><a href="../Pages/menu.php">MENU</a></li>
                <li><a href="../pages/Contacts.php">CONTACTS</a></li>
                <li><a href="../pages/reservation.php">RESERVATION</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo "<li class='user-info'>";
                    echo "<span class='username'>Welcome, $username</span>";
                    echo "<span class='logout'><a href='../Components/logout.php'>Logout</a></span>";
                    echo "</li>";
                } else {
                    echo "<li class='login-item'><a href='../Pages/login2.php'>LOGIN</a></li>";
                }
                ?>
            </ul>
        </nav>
    </section>
</body>

</html>
