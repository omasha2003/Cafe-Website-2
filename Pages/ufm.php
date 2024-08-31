<?php
session_start();
include("../Components/db.php");

$errors = [];
$success_message = '';

// Handle delete request
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    if ($delete_id > 0) {
        $delete_query = "DELETE FROM menu WHERE id = ?";
        $stmt = mysqli_prepare($con, $delete_query);
        mysqli_stmt_bind_param($stmt, "i", $delete_id);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success_message'] = "Food item deleted successfully!";
            header("Location: adminfoodmenu.php");
            exit();
        } else {
            $errors[] = "Error deleting food item: " . mysqli_error($con);
        }
    } else {
        $errors[] = "Invalid food ID.";
    }
}

// Retrieve food items from the database
$query = "SELECT * FROM menu";
$result = mysqli_query($con, $query);

if (!$result) {
    $errors[] = "Error retrieving food items: " . mysqli_error($con);
}

// Display success message if available
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Food Menu</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap">
    <style>
    body {
        font-family: 'Lato', sans-serif;
        background-color: #f0f0f0;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0;
    }

    .admin-food-menu-container {
        width: 80%;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }

    .admin-food-menu-container h2 {
        font-weight: 600;
        margin-bottom: 20px;
        text-align: center;
        color: #405c45;
    }

    .admin-food-menu-container table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .admin-food-menu-container table,
    .admin-food-menu-container th,
    .admin-food-menu-container td {
        border: 1px solid #ddd;
    }

    .admin-food-menu-container th,
    .admin-food-menu-container td {
        padding: 10px;
        text-align: left;
    }

    .admin-food-menu-container th {
        background-color: #405c45;
        color: white;
    }

    .admin-food-menu-container a {
        color: #405c45;
        text-decoration: none;
    }

    .admin-food-menu-container a:hover {
        text-decoration: underline;
    }

    .admin-food-menu-container .button {
        background-color: #405c45;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        text-decoration: none;
    }

    .admin-food-menu-container .button:hover {
        background-color: #333;
    }

    .admin-food-menu-container .button.delete {
        background-color: #d9534f;
    }

    .admin-food-menu-container .button.delete:hover {
        background-color: #c9302c;
    }

    .admin-food-menu-container p {
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="admin-food-menu-container">
        <h2>Food Menu</h2>

        <?php
        if (!empty($success_message)) {
            echo "<p style='color: green;'>$success_message</p>";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p style='color: red;'>Error: $error</p>";
            }
        }
        ?>

        <p><a href="admin_addfoodsform.php" class="button">Add New Food Item</a></p>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price (LKR)</th>
                    <th>Category</th>
                    <th>Cuisine Type</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['category']}</td>
                            <td>{$row['cousin_type']}</td>
                            <td><img src='../uploads/{$row['image']}' alt='Image' width='100'></td>
                            <td>
                                <a href='editfood.php?id={$row['id']}' class='button'>Edit</a>
                                <a href='adminfoodmenu.php?delete_id={$row['id']}' class='button delete' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No food items found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
