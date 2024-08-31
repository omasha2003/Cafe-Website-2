<?php
session_start();
include("../components/db.php");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $phonenumber = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $account_type = mysqli_real_escape_string($con, $_POST['category']); 

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // Check if email already exists
    $check_email_query = "SELECT * FROM userdetails WHERE email = ?";
    $stmt = mysqli_prepare($con, $check_email_query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $check_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($check_result) > 0) {
        $errors[] = "Email already exists";
    }

    // If no errors, hash password and insert data into database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user details into database using prepared statement
        $insert_query = "INSERT INTO userdetails (username, phone, email, password, acc_type) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($stmt, "sssss", $username, $phonenumber, $email, $hashed_password, $account_type);

        if (mysqli_stmt_execute($stmt)) {
            // Registration successful, set a session variable and redirect smoothly
            $_SESSION['username'] = $username;
            echo "<script>alert('Registration successful!'); window.location.href='../Pages/login2.php';</script>";
            exit();
        } else {
            $errors[] = "Error: " . mysqli_error($con);
        }
    }

    // Display errors
    foreach ($errors as $error) {
        echo "<p>Error: $error</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <title>Register - Gallery Café</title>

    <style>
        body {
            background-color: #d8cfc6;
        }
        .reg-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: whitesmoke;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .reg-container h2 {
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
            color: #2a0906;
        }

        .reg-container form {
            display: flex;
            flex-direction: column;
        }

        .reg-container label {
            margin-bottom: 10px;
        }

        .reg-container input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        .reg-container select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            width: 100%;
        }

        .reg-container button {
            background-color: #2a0906;
            color: #d8cfc6;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 16px;
            margin-top: 15px;
        }

        .reg-container button:hover {
            background-color: #555;
        }

        .reg-container p {
            text-align: center;
            margin-top: 10px;
        }

        .reg-container p a {
            color: #405c45;
            text-decoration: none;
        }

        .reg-container p a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    
    <div class="reg-container">
        <h2>Admin Register Form</h2>
        <?php if (!empty($errors)) : ?>
        <?php foreach ($errors as $error) : ?>
            <p>Error: <?php echo $error; ?></p>
        <?php endforeach; ?>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phonenumber">Phone Number:</label>
            <input type="text" id="phonenumber" name="phonenumber" required>

            <label for="category">Account Type:</label>
            <select id="category" name="category" required>
                <option value="">Select a category...</option>
                <option value="Admin">Admin</option>
                <option value="Staff">Staff</option>
                <option value="Customer">Customer</option>
            </select>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Register</button>
        </form>
    </div>

    <?php include("../components/footer.php"); ?>
</body>

</html>
