<?php
session_start();
include("../Components/db.php");

$user_data = []; // Initialize user data array
$errors = []; // Initialize errors array

// Check if user ID is provided and valid
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Check if user ID is valid
    if ($user_id > 0) {
        // Retrieve user details from the database
        $query = "SELECT * FROM userdetails WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch user data
            $user_data = mysqli_fetch_assoc($result);
        } else {
            // No user found with the provided ID
            echo "No user found with ID $user_id";
            exit();
        }
    } else {
        // Invalid user ID (ID is 0 or not provided)
        echo "Invalid user ID $user_id";
        exit();
    }
} else {
    // No user ID provided in the URL
    echo "User ID not specified.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($con, $_POST['phone']);
    $acc_type = mysqli_real_escape_string($con, $_POST['acc_type']);
    $image_path = '';

 
    // If no errors, update user details in the database
    if (empty($errors)) {
        // Prepare update query based on whether image is uploaded or not
        if (!empty($image_path)) {
            $update_query = "UPDATE userdetails SET username = ?, email = ?, phone = ?,  acc_type = ? WHERE id = ?";
            $stmt = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($stmt, "ssssssi", $username, $email, $phonenumber, $acc_type, $user_id);
        } else {
            $update_query = "UPDATE userdetails SET username = ?, email = ?, phonenumber = ?,  acc_type = ? WHERE id = ?";
            $stmt = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($stmt, "sssssi", $username, $email, $phonenumber, $acc_type, $user_id);
        }
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success_message'] = "User updated successfully!";
            header("Location: ../Pages/users.php");
            exit();
        } else {
            $errors[] = "Error updating user: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
    .register-container {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .register-container h2 {
        font-weight: 600;
        margin-bottom: 20px;
        text-align: center;
    }

    .register-container form {
        display: flex;
        flex-direction: column;
    }

    .register-container label {
        margin-bottom: 10px;
    }

    .register-container input,
    .register-container select {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 16px;
    }

    .register-container button {
        background-color: #0e0d0d;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 3px;
        font-size: 16px;
        margin-top: 15px;
    }

    .register-container button:hover {
        background-color: #555;
    }

    .register-container p {
        text-align: center;
        margin-top: 10px;
    }

    .register-container p a {
        color: #405c45;
        text-decoration: none;
    }

    .register-container p a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <div class="register-container">
        <h2>UPDATE USER</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $user_data['id']; ?>" method="post"
            enctype="multipart/form-data">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username"
                value="<?php echo htmlspecialchars($user_data['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>"
                required>    

            <label for="phonenumber">Phone Number:</label>
            <input type="text" id="phonenumber" name="phonenumber"
                value="<?php echo htmlspecialchars($user_data['phone']); ?>" required>

            <label for="acc_type">Account Type:</label>
            <select id="acc_type" name="acc_type" required>
                <option value="">Select an Account Type...</option>
                <option value="Admin" <?php if ($user_data['acc_type'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="Staff" <?php if ($user_data['acc_type'] == 'staff') echo 'selected'; ?>>Staff</option>
                <option value="Customer" <?php if ($user_data['acc_type'] == 'customer') echo 'selected'; ?>>Customer
                </option>
            </select>

            <button type="submit" id="updateBtn">Update User</button>
        </form>

        <?php
        // Display errors, if any
        if (!empty($errors)) {
            echo "<div class='error'>";
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";
        }
        ?>
    </div>

</body>

</html>