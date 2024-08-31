<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Foods</title>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../css/admin_styles.css">
    <style>
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
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter-container select {
            padding: 10px;
            margin-left: 13px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .search-bar {
            position: relative;
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
            top: 10px;
            left: -30px;
            width: 20px;
            height: 20px;
        }

        .add-food-button {
            margin-left: 20px;
        }

        .add-food-button .add-food-icon {
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

        .add-food-button .add-food-icon i {
            margin-right: 5px;
        }

        .add-food-button .add-food-icon:hover {
            background-color: #858585;
            transform: scale(1.1);
        }

        img {
            height: 100px;
            width: auto;
        }

        .admin-food-menu-container h2 {
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
            color: #0e0d0d;
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
            background-color: #0e0d0d;
            color: white;
        }

        .admin-food-menu-container a {
            color: #0e0d0d;
            text-decoration: none;
        }

        .admin-food-menu-container a:hover {
            text-decoration: underline;
        }

        .admin-food-menu-container .button {
            background-color: #0e0d0d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
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

        .admin-food-menu-container .action-buttons {
            display: flex;
            gap: 10px; /* Adjust the gap as needed */
        }

        .admin-food-menu-container p {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include("../Components/adminnavbar.php"); ?>

    <div class="container">
        <div class="filter-search-bar">
            <div class="filter-container">
                <label for="cousin-filter">Filter by Cuisine Type: </label>
                <select id="cousin-filter" onchange="filterTable()">
                    <option value="">All Cuisine Types</option>
                    <option value="Sri Lankan">Sri Lankan</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Italian">Italian</option>
                </select>
            </div>

            <div class="filter-container">
                <label for="category-filter">Filter by Category: </label>
                <select id="category-filter" onchange="filterTable()">
                    <option value="">All Categories</option>
                    <option value="Main Dishes">Main Dishes</option>
                    <option value="Desserts">Desserts</option>
                    <option value="Beverages">Beverages</option>
                </select>
            </div>

            <div class="search-bar">
                <input type="text" id="search-input" onkeyup="searchTable()" placeholder="Search Food...">
            </div>

            <div class="add-food-button">
                <a href="admin_addfoodsform.php" class="add-food-icon btn btn-primary btn-lg">
                    <i class="fas fa-hamburger"></i>
                    <p>New Food</p>
                </a>
            </div>

        </div>

        <div class="admin-food-menu-container">
            <h2>Food Menu</h2>
            <table id="food-table">
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
                    include("../Components/db.php");

                    $query = "SELECT * FROM menu";
                    $result = mysqli_query($con, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['category']}</td>
                                <td>{$row['cousin_type']}</td>
                                <td><img src='../uploads/{$row['image']}' alt='Image'></td>
                                <td>
                                    <div class='action-buttons'>
                                        <a href='update_foodmenu.php?id={$row['id']}' class='button'>Edit</a>
                                        <a href='admin_foodmenu.php?delete_id={$row['id']}' class='button delete' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</a>
                                    </div>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No food items found</td></tr>";
                    }

                    mysqli_close($con);
                    ?>
                </tbody>
            </table>
        </div>

        <script>
            function filterTable() {
                const cousinFilter = document.getElementById('cousin-filter').value.toLowerCase();
                const categoryFilter = document.getElementById('category-filter').value.toLowerCase();
                const rows = document.querySelectorAll('#food-table tbody tr');

                rows.forEach(row => {
                    const cousinType = row.children[5].textContent.toLowerCase();
                    const category = row.children[4].textContent.toLowerCase(); // Update index to match Category column

                    if ((cousinFilter === "" || cousinType.includes(cousinFilter)) &&
                        (categoryFilter === "" || category.includes(categoryFilter))) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            }

            function searchTable() {
                const input = document.getElementById('search-input').value.toLowerCase();
                const rows = document.querySelectorAll('#food-table tbody tr');

                rows.forEach(row => {
                    const name = row.children[1].textContent.toLowerCase();
                    const description = row.children[2].textContent.toLowerCase();
                    const cousinType = row.children[5].textContent.toLowerCase();
                    const category = row.children[4].textContent.toLowerCase(); // Update index to match Category column

                    if (name.includes(input) || description.includes(input) || cousinType.includes(input) || category.includes(input)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            }
        </script>

        <!-- Custom JS file link -->
        <script src="../js/script.js"></script>
    </body>

</html>
