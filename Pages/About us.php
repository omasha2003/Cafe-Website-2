<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/style1.css">
    <title>About Us</title>
</head>

<body>
    <?php include("../components/navbar.php"); ?>
    <!-- About Us Section -->
    <section class="about" id="about">
        <div class="about-content">
            <div class="about-image">
                <img src="../Images/homeimage.jpg" alt="Chef Image">
            </div>
            <div class="about-text">
                <h2>Our Story</h2>
                <p>Welcome to The Gallery Café, where every visit is a celebration of art, culture, and exceptional cuisine.
                   Our journey began with a vision to create a haven that intertwines the rich tradition of fine dining with the inspiring ambiance of an art gallery. 
                   Nestled in the heart of the city, our café invites you to savor gourmet dishes crafted with the freshest ingredients, paired with a curated selection of beverages.</p>
                <p>Join us in celebrating the art of great food and the joy of communal gatherings, as we continue to serve our community with passion and dedication.
                   At The Gallery Café, every meal tells a story, and we are delighted to share it with you.</p>   
            </div>
        </div>
    </section>
    <?php include("../components/footer.php"); ?>
</body>

<style>
body {
    margin: 0;
    font-family: 'Lato', sans-serif;
    background-color: #f0f0f0;
}

.about {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 80px 20px;
    background: #ffffff;
    color: #333;
    border-bottom: 1px solid #ddd;
}

.about-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    overflow: hidden;
    background: #fff;
}

.about-image {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.about-image img {
    border-radius: 15px;
    max-width: 100%;
    height: auto;
    transition: transform 0.3s ease-in-out;
}

.about-image img:hover {
    transform: scale(1.05);
}

.about-text {
    flex: 1;
    padding: 40px;
    max-width: 600px;
}

.about-text h2 {
    font-size: 2.5rem;
    color: #2a0906;
    margin-bottom: 20px;
    font-family: 'Lato', sans-serif;
    font-weight: 600;
    border-bottom: 2px solid #2a0906;
    padding-bottom: 10px;
}

.about-text p {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #333;
    margin-bottom: 20px;
    text-align: justify;
}

@media (max-width: 768px) {
    .about-content {
        flex-direction: column;
        text-align: center;
    }

    .about-image {
        margin-bottom: 20px;
    }

    .about-text h2 {
        font-size: 2.5rem;
        border-bottom: 1px solid #2a0906;
        padding-bottom: 5px;
    }

    .about-text p {
        font-size: 1rem;
        line-height: 1.6;
    }
}
</style>

</html>
