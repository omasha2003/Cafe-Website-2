<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <title>Contact</title>
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .content-wrapper {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            font-size: 1.2rem;
            color: #333;
        }

        .main-content h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #2a0906;
            margin-bottom: 20px;
            font-family: 'Lato', sans-serif;
        }

        .main-content p {
            margin: 10px 0;
            line-height: 1.6;
        }

        .sidebar {
            width: 30%;
            padding: 20px;
            background: #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .sidebar h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2a0906;
            margin-bottom: 20px;
            font-family: 'Lato', sans-serif;
        }

        .sidebar p {
            font-size: 1rem;
            color: #555;
            margin: 10px 0;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2a0906;
            color: #fffcda;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            transition: background-color 0.3s, transform 0.3s;
        }

        .button::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to left, #fffcda, #405c45);
            transition: transform 0.3s ease-out;
            z-index: -1;
            transform: scaleX(0);
            transform-origin: left;
        }

        .button:hover::before {
            transform: scaleX(1);
        }

        .button:hover {
            background-color: #fffcda;
            color: #2a0906;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
                align-items: center;
            }

            .sidebar {
                width: 100%;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
<?php include("../components/navbar.php"); ?>
    <div class="content-wrapper">
        <div class="main-content">
            <h2><b>Gallery Café</b></h2>
            <p><b>Address:</b><br>
                2 Alfred House Rd,<br>
                Colombo 00300, Sri Lanka
            </p>
            <p><b>Opening Hours:</b><br>
                9am–12am, Mon-Sun<br>
                Closed on Poya days
            </p>
        </div>
        <div class="sidebar">
            <h2><b>Contact Us</b></h2>
            <p>Feel free to reach out with any questions, feedback, or reservation inquiries. We're here to assist you!</p>
            <p>Whether you're planning a visit, seeking more information about our menu, or simply want to connect, we'd love to hear from you.</p>
            <a href="tel:+94112223344" class="button">Call Us</a>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="sidebar">
            <img src="../Images/map.png" alt="Map" style="width: 100%; height: auto; border-radius: 10px;">
        </div>
    </div>
    <?php include("../components/footer.php"); ?>
</body>

</html>
