
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Css/style1.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">


  <title> Gallery Cafe </title>
<style>
    body {
  margin: 0;
  font-family: "Museo Sans Rounded", sans-serif;
  
}
#home-page {
      background: #0e0d0d;
    }

    body:not(#home-page) {
      background: #ffffff; /* Or any other background color for other pages */
    }

.navbar {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #0e0d0d;
  height: 150px;
  width: 100%;
}

.nav-links {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 20px;
}

.nav-links li {
  display: inline;
}

.nav-links a {
  color: #9f7070;
  text-decoration: none;
  font-size: 14px;
  padding: 5px 10px;
  font-family: "Museo Sans Rounded", sans-serif;
  font-weight: 400;
  letter-spacing: 1px;
}

.nav-links a:hover {
  color: #9f7070;
}


.nav-links .logo-item {
  margin-right: 22pc; /* Pushes the logo to the left */
}


.logo {
  margin: 0;
  padding: 0;
  height: 100px; /* Adjust the logo size as needed */
}

/* Ensure that the links are styled properly */
.nav-links a {
  text-decoration: none;
  color: #e0c8c8; /* Adjust text color */
  font-weight: bold; /* Adjust text weight */
}

.home-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 500px; /* Adjust as needed */
  object-fit: cover;
  z-index: -1;
}

.home-content {
  position: relative;
  top: 200px; /* Adjust based on the height of the home-image */
  text-align: center;
  z-index: 1;
  padding: 20px;
  color: #fff;
}

.content-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  max-width: 1000px;
  margin: 20px auto;
  padding: 20px;
  background: rgba(255, 255, 255, 0.9); /* Slightly transparent background for better readability */
  border-radius: 10px;
}

.main-content {
  flex: 1;
  font-weight: 300;
  font-size: medium;
  letter-spacing: 1px;
  margin-right: 40px;
  color: #888c8d;
}

.main-content h2 {
  font-family: "Museo Sans Rounded", sans-serif;
  font-weight: 500;
  color: black;
}

.sidebar {
  width: 30%;
  padding-left: 10px;
}

.sidebar h2 {
  font-family: "Museo Sans Rounded", sans-serif;
  font-weight: 400;
}

.sidebar p {
  font-weight: 300;
  line-height: 1.6;
  margin: 1em 0;
  color: #888c8d;
}

.sidebar p span {
  font-weight: 400;
}

.button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #0e0d0d;
  color: #fff;
  text-decoration: none;
  margin-top: 10px;
  border: 2px solid transparent;
  border-radius: 5px;
  position: relative;
  overflow: hidden;
  font-size: 14px; /* Reduced text size */
  font-weight: 700;
  text-transform: uppercase;
  transition: all 0.3s ease;
}

.button::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to right, #2c2c2b, #0e0d0d);
  transition: transform 0.3s ease;
  transform: scaleX(0);
  transform-origin: left;
  z-index: 1;
}

.button:hover::before {
  transform: scaleX(1);
}

.button:hover {
  color: #fff;
  background-color: #2c2c2b;
  border-color: #2c2c2b;
}

.button:active {
  background-color: #1d1d1b;
  border-color: #1d1d1b;
  box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.1);
}


@media (max-width: 768px) {
  .content-wrapper {
    flex-direction: column;
    align-items: center;
  }

  .sidebar {
    width: 100%;
    margin-top: 20px;
    border-left: none;
  }
}

.section-heading {
  margin-top: 60px;
  color: #d8d8d4;
  font-size: 17px;
  font-weight: 200;
  text-align: center;
  margin-bottom: 30px;
  letter-spacing: 1px;
}



.cafe-image {
  display: block;
  width: 250px;
  height: 300px;
}



.btn{
  padding: 2px 80px;
  border-radius: 3px;
  background: transparent;
  color: #2c2c2b;
  font-weight: 200;
  font-size: 1.4rem;
}

.footer {
  background-color: #1a1a1a;
  color: #e0e0e0;
  text-align: center;
  padding: 20px;
  font-size: 14px;
  width: 100%;
  position: relative;
  bottom: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.footer-content {
  max-width: 1200px;
  margin: 0 auto;
}

.footer-brand {
  color: #FFC107;
  font-weight: bold;
}

.footer p {
  margin: 0;
  font-size: 1rem;
}

.footer-links {
  list-style: none;
  padding: 0;
  margin: 10px 0 0;
}

.footer-links li {
  display: inline;
  margin: 0 15px;
}

.footer-links a {
  color: #e0e0e0;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.footer-links a:hover {
  color: #FFC107;
}

@media (max-width: 768px) {
  .footer-links {
      margin-top: 10px;
  }

  .footer-links li {
      display: block;
      margin: 5px 0;
  }
}

</style>

</head>

<body id="home-page">
    <?php include("../components/navbar.php"); ?>

    <img src="../Images/homeimage.jpg" alt="Home Image" class="home-image">
   
    <h2 class="section-heading">THE GALLERY CAFE</h2>
    <h2 class="section-heading"></h2>

   

<div class="content-wrapper">
    <div class="main-content">
        <h2>Welcome to The Gallery Café
        </h2>
        <p>Located in the lively city of Colombo, The Gallery Café is a retreat that blends healthy living with artistic charm. Our stunning entrance invites you into a space where gourmet dishes and fine beverages await.</p>
        <p>Our café is a celebration of gourmet excellence, where each dish is crafted with care and each beverage is a testament to quality.
           Step inside to discover a cozy yet refined setting, perfect for enjoying everything from our chef’s innovative creations to a perfectly brewed coffee.
            The serene surroundings enhance your dining experience, creating a peaceful retreat from the bustle of city life.</p>
        <p>Every visit is more than just a meal—it’s a journey through flavor and style. Join us and immerse yourself in a space where every detail is designed to make you feel at home, and every moment is a delightful experience.</p>    
    </div>
    <div class="sidebar">
    <img src="../Images/home3.jpg" alt="Cafe image" class="cafe-image">

    </div>
</div>
<img src="../images/homeimage3.png" alt="Home Image" class="home-image">


<div class="content-wrapper">
    <div class="sidebar">
        <img src="../Images/homeimage.jpg" alt="Cafe image" class="cafe-image">
    </div>
    <div class="main-content">
        <h2>Meet Our Dine-In Experience
        </h2>
        <p>Step into our welcoming dine-in area, where comfort meets elegance. 
          Our thoughtfully designed space offers a relaxed atmosphere, perfect for enjoying delicious meals with friends and family.</p>
        <p>Whether you're here for a casual lunch or a special dinner,
           you'll find a cozy setting that enhances your dining experience. </p>
        <p> Come in, take a seat, and let us make your meal memorable..</p>         
    </div>
 
</div>

<div class="content-wrapper">
    <div class="main-content">
        <h2>Know Our Promotions
        </h2>
        <p>Special Promotions for Couples</p>
        <p>Treat yourself and your special someone to an unforgettable experience at The Gallery Café. 
          Enjoy our exclusive couples’ promotions, including romantic dinner specials, complimentary desserts, and specially curated menu options designed for two.</p>
        <p>Whether it's a cozy date night or a celebration of love, we offer a delightful setting and thoughtful touches to make your time together extra special. Come in and create lasting memories with our tailored promotions just for couples!</p>
        <p>Visit to see more promotions.</p> 
        <a href="promotions.php" class="button">View more Promotions</a>   
    </div>
    <div class="sidebar">
    <img src="../Images/coupleimg.jpg" alt="Cafe image" class="cafe-image">

    </div>
</div>
<div class="content-wrapper">
    <div class="sidebar">
        <img src="../Images/parking.jpg" alt="Cafe image" class="cafe-image">
    </div>
    <div class="main-content">
        <h2>Parking Availability
        </h2>
        <p>At The Gallery Café, we want your visit to be as convenient and enjoyable as possible. We offer ample parking space for our guests, including dedicated spots close to the entrance for easy access.</p>
        <p>Whether you're stopping by for a quick coffee or a leisurely meal, you'll find parking just a step away. Our goal is to ensure that your dining experience starts smoothly from the moment you arrive.</p>        
        <a href="promotions.php" class="button">View more</a>  
    </div>
 
</div>

   
  <?php include("../components/footer.php"); ?>
</body>

</html>