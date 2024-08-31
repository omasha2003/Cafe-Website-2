<?php
include("../Components/db.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reservation_id']) && isset($_POST['reservation_status'])) {
    $reservation_id = mysqli_real_escape_string($con, $_POST['reservation_id']);
    $new_status = mysqli_real_escape_string($con, $_POST['reservation_status']);

    // Update the reservation status in the database
    $update_query = "UPDATE reservations SET reservation_status = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $update_query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $new_status, $reservation_id);
        if (mysqli_stmt_execute($stmt)) {
            // Status updated successfully
        } else {
            error_log("Error updating reservation status: " . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);
    } else {
        error_log("Error preparing update statement: " . mysqli_error($con));
    }
}

// Fetch reservations based on filter or all
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

switch ($filter) {
    case 'upcoming':
        $query = "SELECT * FROM reservations WHERE reservation_status = 'requested' OR reservation_status = 'confirmed'";
        break;
    case 'finished':
        $query = "SELECT * FROM reservations WHERE reservation_status = 'finished'";
        break;
    case 'cancelled':
        $query = "SELECT * FROM reservations WHERE reservation_status = 'cancelled'";
        break;
    default:
        $query = "SELECT * FROM reservations";
        break;
}

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../css/admin_style.css">
    <style>
        /* Additional CSS for this specific page */
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 95%;
            margin: 0 auto;
            margin-top: 30px;
        }

        .filter-search-bar {
            display: flex;
            justify-content: end;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 250px;
        }

        .search-bar img {
            position: absolute;
            color: #4CAF50;
            left: 1100px;
            top: 240px;
            width: 20px;
            height: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #0e0d0d;
            color: white;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #0e0d0d;
            border: none;
            margin-top: 7px;
            margin-right: -50px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn.manage {
            font-size: 16px;
            background-color: #bba586;
        }

        .btn.delete {
            background-color: #f44336;
        }

        .btn.manage:hover {
            opacity: 70%;
        }

        .btn.delete:hover {
            opacity: 70%;
        }

        .container select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
            height: 40px;
            max-width: 100%;
            margin-bottom: 15px;
            margin-right: 15px;
            box-sizing: border-box;
        }

        .container select option {
            padding: 10px;
            font-size: 16px;
        }

        .container select option:hover {
            background-color: #f0f0f0;
        }

        .container select option:checked {
            font-weight: bold;
            color: #405c45;
        }
    </style>
</head>

<body>
    <?php include("../Components/staffnavbar.php"); ?>

    <div class="container">
        <div class="filter-search-bar">
            <form method="GET" action="">
                <select name="filter" onchange="this.form.submit()">
                    <option value="all" <?php echo $filter == 'all' ? 'selected' : ''; ?>>All</option>
                    <option value="upcoming" <?php echo $filter == 'upcoming' ? 'selected' : ''; ?>>Upcoming</option>
                    <option value="finished" <?php echo $filter == 'finished' ? 'selected' : ''; ?>>Finished</option>
                    <option value="cancelled" <?php echo $filter == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </form>

            <div class="search-bar">
                <input type="text" id="search-input" onkeyup="searchTable()" placeholder="Search reservations...">
            </div>
        </div>

        <table id="reservation-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Timestamp</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Date</th>
                    <th>Meal</th>
                    <th>Table</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['TimeStamp']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phonenumber']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['meal']); ?></td>
                    <td><?php echo htmlspecialchars($row['table_choice']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <select name="reservation_status">
                                <option value="requested" <?php echo $row['reservation_status'] == 'requested' ? 'selected' : ''; ?>>Requested</option>
                                <option value="confirmed" <?php echo $row['reservation_status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                <option value="cancelled" <?php echo $row['reservation_status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                <option value="finished" <?php echo $row['reservation_status'] == 'finished' ? 'selected' : ''; ?>>Finished</option>
                            </select>
                            <button type="submit" class="btn manage">Update</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Custom JS file link -->
    <script src="../js/script.js"></script>
    <script>
    function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search-input");
        filter = input.value.toLowerCase();
        table = document.getElementById("reservation-table");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = "none";
            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    }
                }
            }
        }
    }
    </script>
</body>

</html>
