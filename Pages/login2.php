<?php
session_start();
include("../Components/db.php");

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Login Logic
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = $_POST['password'];

        $query = "SELECT * FROM userdetails WHERE username = ?";
        $stmt = mysqli_prepare($con, $query);

        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($con));
        }

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;

                switch ($user['acc_type']) {
                    case 'admin':
                        header("Location: ../Pages/adminhome.php");
                        exit();
                    case 'staff':
                        header("Location: ../Pages/staffhome.php");
                        exit();
                    case 'customer':
                        header("Location: ../Pages/Home.php");
                        exit();
                    default:
                        $error = "Invalid account type.";
                        break;
                }
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "User not found.";
        }
    } elseif (isset($_POST['register'])) {
        // Registration Logic
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phoneNumber = mysqli_real_escape_string($con, $_POST['phone']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $accType = 'customer'; // Default account type for registration

        $query = "INSERT INTO userdetails (username, email, phone, password, acc_type) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);

        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($con));
        }

        mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $phoneNumber, $password, $accType);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Registration successful. You can now log in.";
        } else {
            $error = "Registration failed: " . mysqli_stmt_error($stmt);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe | Colombo | Sri Lanka</title>
    <script src="https://kit.fontawesome.com/fbed54dd78.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Css/login.css">
    <style>
        main {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: url(main.jpg);
            width: 100%;
            height: 100vh;
            background-size: cover;
        }
        .container {
            position: relative;
            width: 80vw; /* Updated to wider size */
            height: 70vh;
            background: #2a0906;
            border-radius: 15px;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: -50%;
            width: 100%;
            height: 100%;
            background: bisque;
            z-index: 6;
            transform: translateX(100%);
            transition: 1s ease-in-out;
        }
        .signin-signup {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            z-index: 5;
        }
        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 40%;
            min-width: 238px;
            padding: 0 10px;
        }
        form.sign-in-form {
            opacity: 1;
            transition: 0.5s ease-in-out;
            transition-delay: 1s;
        }
        form.sign-up-form {
            opacity: 0;
            transition: 0.5s ease-in-out;
            transition-delay: 1s;
        }
        .title {
            font-size: 35px;
            color: orange;
            margin-bottom: 10px;
        }
        .input-field {
            width: 100%;
            height: 50px;
            background: #2a0906;
            margin: 10px 0;
            border: 2px solid orange;
            border-radius: 50px;
            display: flex;
            align-items: center;
        }
        .input-field i {
            flex: 1;
            text-align: center;
            color: #666;
            font-size: 18px;
        }
        .input-field input {
            flex: 5;
            background: none;
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            font-weight: 400;
            color: bisque;
        }
        .btn {
            width: 150px;
            height: 50px;
            border: none;
            border-radius: 50px;
            background: black;
            color: #fff;
            font-weight: 600;
            margin: 10px 0;
            text-transform: uppercase;
            cursor: pointer;
        }
        .btn-2 {
            width: 150px;
            height: 50px;
            border: none;
            border-radius: 50px;
            background: #2a0906;
            color: #fff;
            font-weight: 600;
            margin: 10px 0;
            text-transform: uppercase;
            cursor: pointer;
        }
        .btn:hover {
            background: rgb(234, 125, 0);
        }
        .panels-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            width: 35%;
            min-width: 238px;
            padding: 0 10px;
            z-index: 6;
            text-align: center;
        }
        .left-panel {
            pointer-events: none;
        }
        .content {
            color: #fff;
            transition: 1.1s ease-in-out;
            transition-delay: 0.5s;
        }
        .panel h3 {
            font-size: 23px;
            font-weight: 500;
            color: #2a0906;
        }
        .image {
            width: 100%;
            transition: 1.1s ease-in-out;
            transition-delay: 0.4s;
        }
        .left-panel .image {
            transform: translateX(-200%);
        }
        .left-panel .content {
            transform: translateX(-200%);
        }
        .right-panel .image {
            transform: translateX(0);
        }
        .right-panel .content {
            transform: translateX(0);
        }

        /**animation*/
        .container.sign-up-mode::before {
            transform: translateX(0);
        }
        .container.container.sign-up-mode .right-panel .image {
            transform: translateX(200%);
        }
        .container.container.sign-up-mode .right-panel .content {
            transform: translateX(200%);
        }
        .container.container.sign-up-mode .left-panel .image {
            transform: translateX(0);
        }
        .container.container.sign-up-mode .left-panel .content {
            transform: translateX(0);
        }
        .container.sign-up-mode form.sign-in-form {
            opacity: 0;
        }
        .container.sign-up-mode form.sign-up-form {
            opacity: 1;
        }
        .container.sign-up-mode .right-panel {
            pointer-events: none;
        }
        .container.sign-up-mode .left-panel {
            pointer-events: all;
        }
    </style>
</head>
<body>

<main>
    <div class="container">
        <div class="signin-signup">
            <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
            <?php endif; ?>

            <!-- Sign In Form -->
            <form action="" method="POST" class="sign-in-form">
                <h2 class="title">Sign In</h2>
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-user-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <input type="submit" name="login" value="Sign In" class="btn">
            </form>

            <!-- Sign Up Form -->
            <form action="" method="POST" class="sign-up-form">
                <h2 class="title">Sign Up</h2>
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-phone"></i>
                    <input type="tel" name="phone" placeholder="Mobile Number" required>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-user-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <input type="submit" name="register" value="Sign Up" class="btn">
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Already have an account?</h3>
                    <button class="btn" id="sign-in-btn">Sign In</button>
                </div>
                <img src="login.svg" alt="" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Don't Have an account?</h3>
                    <button class="btn" id="sign-up-btn">Sign Up</button>
                </div>
                <img src="signup.svg" alt="" class="image">
            </div>
        </div>
    </div>
</main>
<script src="../Css/login.js"></script>
</body>
</html>