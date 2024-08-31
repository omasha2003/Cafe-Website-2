<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("../Components/db.php");

$errors = []; // Initialize errors array
$message = ''; // Initialize message variable

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['name']); // Assuming 'name' is used as username
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($con, $_POST['phone']);
    $meal = mysqli_real_escape_string($con, $_POST['meal']);
    $table = mysqli_real_escape_string($con, $_POST['table']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $messageContent = mysqli_real_escape_string($con, $_POST['message']);
    
    // Check if the reservation already exists
    $query = "SELECT * FROM reservations WHERE table_choice = ? AND date = ? AND meal = ?";
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $table, $date, $meal);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($result && mysqli_num_rows($result) > 0) {
                $message = "A reservation already exists for the selected table, date, and meal.";
            } else {
                // Insert reservation data into database
                $query = "INSERT INTO reservations (username, email, phonenumber, meal, table_choice, date, message, reservation_status) VALUES (?, ?, ?, ?, ?, ?, ?, 'requested')";
                $stmt = mysqli_prepare($con, $query);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sssssss", $username, $email, $phonenumber, $meal, $table, $date, $messageContent);
                    if (mysqli_stmt_execute($stmt)) {
                        $message = "Reservation request added successfully!";
                        error_log("Reservation successful: " . $message); // Debugging line
                    } else {
                        $errors[] = "Error executing statement: " . mysqli_stmt_error($stmt);
                        error_log("Execution error: " . mysqli_stmt_error($stmt)); // Debugging line
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    $errors[] = "Error preparing statement: " . mysqli_error($con);
                    error_log("Preparation error: " . mysqli_error($con)); // Debugging line
                }
            }
        } else {
            $errors[] = "Error executing statement: " . mysqli_stmt_error($stmt);
            error_log("Execution error: " . mysqli_stmt_error($stmt)); // Debugging line
        }
    } else {
        $errors[] = "Error preparing statement: " . mysqli_error($con);
        error_log("Preparation error: " . mysqli_error($con)); // Debugging line
    }
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table Reservation</title>
  <link rel="stylesheet" href="../css/style1.css"> 
  <style>
    body {
      margin: 0;
      font-family: 'Lato', sans-serif;
      background-color: #f4f4f4;
    }

    .banner {
      background: #2a0906;
      color: #fffcda;
      text-align: center;
      padding: 20px 0;
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 30px;
    }

    #form {
      background: rgba(255, 255, 255, 0.9);
      width: 50%;
      margin: 50px auto;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border: 1px solid #ddd;
    }

    #form h1 {
      color: #2a0906;
      font-family: 'Lato', sans-serif;
      text-align: center;
      font-size: 28px;
      margin-bottom: 30px;
      font-weight: 700;
    }

    #form label {
      display: block;
      font-size: 16px;
      color: #333;
      margin-bottom: 5px;
    }

    #form input[type="text"],
    #form input[type="tel"],
    #form input[type="email"],
    #form select,
    #form input[type="date"],
    #form textarea {
      width: calc(100% - 20px);
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      box-sizing: border-box;
      background-color: #fff;
      color: #333;
      font-size: 16px;
    }

    #form input[type="submit"] {
      width: 100%;
      padding: 15px;
      background-color: #2a0906;
      color: #fffcda;
      font-size: 18px;
      border: none;
      cursor: pointer;
      border-radius: 6px;
      transition: background-color 0.3s ease;
      font-weight: 700;
    }

    #form input[type="submit"]:hover {
      background-color: #1e0704;
    }

    .content-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
    }

    .sidebar {
      flex: 1;
      padding: 20px;
    }

    .main-content {
      flex: 2;
      padding: 20px;
    }

    .sidebar img {
      max-width: 100%;
      border-radius: 10px;
    }

    .main-content h2 {
      font-size: 1.5rem;
      color: #2a0906;
    }

    .main-content p {
      font-size: 1.1rem;
      color: #333;
    }

    .message {
      padding: 15px;
      margin: 15px 0;
      border-radius: 6px;
      font-size: 16px;
      text-align: center;
    }

    .message.success {
      background-color: #d4edda;
      color: #155724;
    }

    .message.error {
      background-color: #f8d7da;
      color: #721c24;
    }

    @media (max-width: 768px) {
      #form {
        width: 90%;
      }
    }
  </style>
</head>
<body>
  <?php include("../components/navbar.php"); ?>

  <section class="banner">
    PRIVATE DINING & EVENTS - We are here to make your special day a truly memorable one
  </section>

  <div class="content-wrapper">
    <div class="sidebar">
      <img src="../Images/reserve.jpg" alt="Cafe image" class="cafe-image">
    </div>
    <div class="main-content">
      <h2>It's Time to Enjoy</h2>
      <p>We take reservations for lunch and dinner. To make a reservation, please call us between 10am-6pm, Monday to Friday.</p>
      <p>We do not book the bar area – we leave this for walk-in guests to ensure that we always offer some tables for those who have not booked.</p>
      <p>(001) 123456789 – 234567891</p>
    </div>
  </div>

  <div id="form">
    <?php if (!empty($message)): ?>
      <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
        <?php echo htmlspecialchars($message); ?>
      </div>
    <?php endif; ?>
    <h1>Book a Table</h1>
    <form name="reservationForm" method="POST" action="">
      <div class="reservation-info">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="reservation-info">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="reservation-info">
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>
      </div>
      <div class="reservation-info">
        <label for="meal">Meal:</label>
        <select id="meal" name="meal" required>
          <option value="">Select a meal...</option>
          <option value="breakfast">Breakfast</option>
          <option value="lunch">Lunch</option>
          <option value="dinner">Dinner</option>
        </select>
      </div>
      <div class="reservation-info">
        <label for="table">Choose a Table:</label>
        <select id="table" name="table" required>
          <option value="">Select a table...</option>
          <option value="table1">Table 1</option>
          <option value="table2">Table 2</option>
          <option value="table3">Table 3</option>
        </select>
      </div>
      <div class="reservation-info">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="reservation-info">
        <label for="message">Special Requests:</label>
        <textarea id="message" name="message"></textarea>
      </div>
      <input type="submit" value="Book Now">
    </form>
  </div>

  <?php include("../components/footer.php"); ?>
</body>
</html>
