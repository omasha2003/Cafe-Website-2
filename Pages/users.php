<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <style>
    body {
        font-family: 'Lato', sans-serif;
        background-color: #d8cfc6;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 95%;
        margin: 30px auto 0;
        padding: 0 15px; /* Add horizontal padding to container */
    }

    .filter-search-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-bar {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: space-between;
    }

    .search-bar input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        width: 250px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-right: 20px; /* Add margin to create space on the right side */
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
        margin: 5px;
        color: #fff;
        background-color: #405c45;
        border: none;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn.manage {
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

    .add-user-button {
        margin-left: 20px;
    }

    .add-user-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        background-color: #0e0d0d;
        color: #fff;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s, transform 0.2s ease-in-out;
        box-shadow: 2px 3px 4px rgba(0, 0, 0, 0.3), 4px 7px 15px rgba(0, 0, 0, 0.3), 9px 15px 25px rgba(0, 0, 0, 0.2);
    }

    .add-user-icon i {
        margin-right: 5px;
    }

    .add-user-icon:hover {
        background-color: #858585;
        transform: scale(1.1);
    }
    </style>
</head>

<body>
    <?php include("../components/adminnavbar.php"); ?>

    <div class="container">
        <div class="filter-search-bar">
            <div class="search-bar">
                <input type="text" id="search-input" onkeyup="searchTable()" placeholder="Search users...">
                <div class="add-user-button">
                    <a href="../Pages/adminregistrationform.php" class="add-user-icon btn btn-primary btn-lg">
                        <i class="fas fa-user-plus"></i>
                        <p>New User</p>
                    </a>
                </div>
            </div>
        </div>

        <table id="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Account Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../components/db.php");

                    // Ensure column names match your database schema
                    $query = "SELECT id, username, email, phone, acc_type FROM userdetails";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['acc_type'] . "</td>";
                            echo "<td>";
                            echo "<a href='update_user.php?id=" . $row['id'] . "' class='btn manage'>Manage</a>";
                            echo "<a href='#' class='btn delete' onclick='confirmDelete(" . $row['id'] . ")'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Error fetching users: " . mysqli_error($con) . "</td></tr>";
                    }

                    mysqli_close($con);
                ?>
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
        table = document.getElementById("user-table");
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

    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            window.location.href = `deleteuser.php?id=${id}`;
        }
    }
    </script>
</body>

</html>
