<?php
$apiKey = "3ad6906cbcab6b97e30dbb52012a1bd9"; // Replace with your actual API key
$location = isset($_GET['location']) && !empty($_GET['location']) ? $_GET['location'] : "Delhi";

// Fetch current weather
$currentUrl = "https://api.openweathermap.org/data/2.5/weather?q=$location&appid=$apiKey&units=metric";
$currentResponse = file_get_contents($currentUrl);
$currentData = json_decode($currentResponse, true);

// Fetch forecast data
$forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?q=$location&appid=$apiKey&units=metric";
$forecastResponse = file_get_contents($forecastUrl);
$forecastData = json_decode($forecastResponse, true);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Forecast</title>

    <!-- Embed your CSS here -->
    <style>
      /* General Reset */
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    height: 100%;
    overflow-x: hidden; /* Prevents horizontal scrolling */
    background: transparent; /* Ensures no other background color overrides the image */
}
/* General Reset */
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    transition: background-color 0.5s ease, color 0.5s ease; /* Smooth transition */
}

/* Default Light Theme */
body {
    background: linear-gradient(to bottom, #DFF6FF, #C3DFFA); /* Light gradient background */
    color: #333; /* Dark text for readability */
}

/* Dark Mode Applied When Checkbox is Checked */
#theme-toggle-checkbox:checked ~ body {
    background: linear-gradient(to bottom, #1E2022, #3A3D42); /* Dark gradient background */
    color: #ECEFF4; /* Light text for readability */
}

/* Theme Toggle Styling */
.theme-toggle {
    position: fixed;
    top: 20px; /* Positioning the toggle on the page */
    right: 20px;
    z-index: 100;
}

.toggle-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px; /* Space between checkbox and label */
}

.toggle-container input[type="checkbox"] {
    appearance: none;
    width: 40px;
    height: 20px;
    background: #ccc;
    border-radius: 20px;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.toggle-container input[type="checkbox"]:checked {
    background: #000000; /* Background color for dark mode */
}

.toggle-container input[type="checkbox"]::after {
    content: '';
    width: 18px;
    height: 18px;
    background: white;
    border-radius: 50%;
    position: absolute;
    top: 1px;
    left: 1px;
    transition: all 0.3s ease;
}

.toggle-container input[type="checkbox"]:checked::after {
    transform: translateX(20px); /* Moves toggle ball to the right */
}

.toggle-label {
    font-size: 1rem;
    color: #333;
    cursor: pointer;
    transition: color 0.3s ease;
}

#theme-toggle-checkbox:checked ~ .toggle-label {
    color: #ECEFF4; /* Label changes color for dark mode */
}

/* Content Styling */
.content {
    text-align: center;
    padding: 50px;
    transition: background-color 0.5s ease, color 0.5s ease;
}

.content h1 {
    font-size: 2.5rem;
}

.content p {
    font-size: 1.2rem;
}


/* LOGO */
.logo {
    display: flex; /* Enables flexbox layout */
    align-items: center; /* Vertically aligns items */
    justify-content: start; /* Keeps logo and heading parallel */
}

/* BACKGROUND IMAGE STYLING */
.fullscreen-bg {
    position: absolute;
    top: 50px; /* Moves the background slightly downward */
    left: 0;
    width: 100%;
    height: calc(100% + 50px); /* Ensures full coverage */
    background-image: url("images"); /* Replace with your image path */
    background-size: cover;
    background-attachment: fixed; /* Parallax effect keeps image fixed */
    background-position: center;
    background-repeat: no-repeat;
    z-index: -1; /* Places the background behind content */
}
/* Apply the background image to the entire page */
body {
    background-image: url('images/papers.co-sg93-sky-cloud-blue-blur-3840x2400.png');  /* Replace with the actual path to your image */
    background-size: cover;  /* Ensure the image covers the entire page */
    background-position: center;  /* Center the image on the page */
    background-repeat: no-repeat;  /* Prevent the image from repeating */
    background-attachment: fixed;  /* Keep the image fixed during scrolling */
    height: 100vh;  /* Ensure the body covers the full viewport height */
    margin: 0;  /* Remove default margin */
}

/* Other styling for content on the page can go here */


/* HEADER STYLING */
.header {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: #5c5c5c;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.header .logo img {
    margin-right: 10px;
    width: 50px;
    height: 50px;
}

/* SEARCH BAR (if needed) */
.header .search-bar {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 30px;
    padding: 10px 20px;
    width: 40%;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
}
.header .search-bar input {
    padding: 10px;
    flex-grow: 1;
    border: none;
    border-radius: 25px;
    outline: none;
    font-size: 1rem;
}
.header .search-bar button {
    padding: 10px 20px;
    background-color: #005A9E;
    color: white;
    border: none;
    border-radius: 25px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.header .search-bar button:hover {
    background-color: #8b8b8b;
}

/* MAIN CONTENT STYLING */
main {
    margin-top: 100px; /* Space for the fixed header */
    margin-bottom: 60px; /* Space above the footer area */
    text-align: center;
 
}
/* Section Layout */
.overview {
    margin: 20px auto; /* Centers the entire section */
    width: 95%; /* Content width */
}

/* Section Title Styling */
.section-title {
    text-align: center;
    background: rgba(255, 255, 255, 0.85); /* Semi-transparent background */
    color: black;
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Depth effect */
    margin-bottom: 20px; /* Adds spacing between title and content */
    height: 100px; /* Equal dimensions with cards/map */
}

/* Overview Section */
/* Overview Container with Background Image */
.overview-container {
    display: grid; /* Creates a grid layout */
    grid-template-columns: 1fr 1fr; /* Two equal columns */
    grid-template-rows: auto; /* Automatically adjusts row heights */
    gap: 20px; /* Adds spacing between columns */
    align-items: start; /* Aligns items at the top */
    margin: 20px auto; /* Centers the container */
    width: 95%; /* Content width */
    background-image: url('images/papers.co-sg93-sky-cloud-blue-blur-3840x2400.png'); /* Add your background image here */
    background-size: cover; /* Scales image proportionally to fill the container */
    background-position: center; /* Centers the background image */
    border-radius: 15px; /* Rounded corners for the entire container */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Adds depth effect */
    padding: 20px; /* Adds padding inside the container */
}


/* Today's Weather Title */
.overview-title {
    grid-column: 1 / span 2; /* Spans across both columns */
    text-align: left; /* Aligns text to the left */
    font-size: 1.5rem;
    color: black;
    margin-bottom: 20px; /* Adds space between the title and the content */
}

/* Overview Card */
.overview-card {
    background: rgba(255, 255, 255, 0.85);
    border-radius: 15px; /* Rounded edges */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    padding: 20px;
    height: 400px; /* Matches the height of the map */
    text-align: center;
}

/* Location Map */
.map-container {
    height: 400px; /* Matches the height of the overview card */
    border-radius: 15px; /* Rounded edges */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    overflow: hidden; /* Prevents map overflow */
}
/* HOURLY FORECAST */
.hourly {
    margin: 20px auto;
    width: 95%;
}
.hourly-title {
    position: sticky; /* Keeps the title fixed during horizontal scroll */
    top: 10px;
    text-align: center;
    font-size: 2rem;
    color: #333;
    background: rgba(255, 255, 255, 0.85); /* Semi-transparent so background stays visible */
    z-index: 101;
    padding: 10px;
}
.hourly-scroll {
    display: flex;
    gap: 15px;
    padding: 10px;
    overflow-x: scroll; /* Enables horizontal scrolling for the weather cards */
    scroll-behavior: smooth;
}
.hour-card {
    background: rgba(255, 255, 255, 0.85);
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    padding: 15px;
    min-width: 120px;
    text-align: center;
}

/* 5-DAY FORECAST */
.forecast {
    margin: 20px auto;
    width: 95%;
}
.forecast-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Ensures square forecast boxes */
    gap: 20px;
}
.day-card {
    background: rgba(172, 172, 172, 0.85); /* Semi-transparent square card */
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    width: 200px;
    height: 200px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.day-card:hover {
    transform: scale(1.05);
    box-shadow: 0 7px 20px rgba(0, 0, 0, 0.2);
}


/* FOOTER STYLING */
.footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #121212; /* Dark background for footer */
    color: #f1f1f1; /* Light text color */
    padding: 20px;
    text-align: center;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
}
.footer .footer-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap; /* Allows items to wrap on smaller screens */
    max-width: 1200px; /* Limits the width of the footer content */
    margin: 0 auto; /* Centers the footer content */
}
.footer .footer-logo {
    flex: 1; /* Takes up equal space */
    text-align: center;
}
.footer .footer-logo h2 {
    font-size: 1.5rem;
    margin-top: 10px; /* Space above the logo text */
}
.footer .footer-links {
    flex: 1; /* Takes up equal space */
    text-align: left;
}
.footer .footer-links h3 {
    font-size: 1.2rem;
    margin-bottom: 10px; /* Space below the heading */
}
.footer .footer-links ul {
    list-style-type: none; /* Removes bullet points */
    padding: 0; /* Removes default padding */
}
.footer .footer-links ul li {
    margin-bottom: 5px; /* Space between list items */
}
.footer .footer-links ul li a {
    color: #f1f1f1; /* Light text color */
    text-decoration: none; /* Removes underline */
    font-size: 0.9rem; /* Smaller font size */
    transition: color 0.3s ease; /* Smooth color transition on hover */
}
.footer .footer-links ul li a:hover {
    color: #00b4d8; /* Changes color on hover */
}
.footer .footer-social {
    flex: 1; /* Takes up equal space */
    text-align: left;
}
.footer .footer-social h3 {
    font-size: 1.2rem;
    margin-bottom: 10px; /* Space below the heading */
}
.footer .footer-social .social-icons {
    display: flex; /* Enables flexbox layout for social icons */
    gap: 10px; /* Space between icons */
}
.footer .footer-social .social-icons a {
    display: inline-block; /* Ensures icons are inline */
    margin: 0 10px; /* Space around icons */
    transition: transform 0.3s ease; /* Smooth scaling effect on hover */
}
.footer .footer-social .social-icons a img {
    width: 30px; /* Icon size */
    height: 30px; /* Icon size */
}
.footer .footer-social .social-icons a:hover {
    transform: scale(1.2); /* Scales icon on hover */
}
.footer .footer-bottom {
    margin-top: 20px; /* Space above the bottom text */
    font-size: 0.9rem; /* Smaller font size */
    color: #f1f1f1; /* Light text color */
}
.footer .footer-bottom p {
    margin: 0; /* Removes default margin */
}
.footer .footer-bottom p a {
    color: #00b4d8; /* Link color */
    text-decoration: none; /* Removes underline */
    transition: color 0.3s ease; /* Smooth color transition on hover */
}
.footer .footer-bottom p a:hover {
    color: #00b4d8; /* Changes color on hover */
}
/* Responsive Design */
@media (max-width: 768px) {
    .header {
        flex-direction: column; /* Stacks header items vertically */
        align-items: center; /* Centers items */
    }
    .header .logo {
        margin-bottom: 10px; /* Space below the logo */
    }
    .header .search-bar {
        width: 100%; /* Full width on smaller screens */
        margin-bottom: 10px; /* Space below the search bar */
    }
    .footer-container {
        flex-direction: column; /* Stacks footer items vertically */
        align-items: center; /* Centers items */
    }
}
/* THEME SWITCHING */
/* Default Light Theme */
body.light {
    background: linear-gradient(to bottom, #000000, #000000);
    color: #333;
}
/* Dark Theme */
body.dark {
    background: linear-gradient(to bottom, #1E2022, #3A3D42);
    color: #2f4365;
}
footer {
    background-color: #121212;
    color: #f1f1f1;
    padding: 20px;
    text-align: center;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
}

.footer-logo h2 {
    font-size: 1.5rem;
    margin-top: 10px;
}

.footer-links {
    text-align: left;
}

.footer-links ul {
    list-style-type: none;
    padding: 0;
}

.footer-links ul li a {
    color: #f1f1f1;
    text-decoration: none;
    font-size: 0.9rem;
}

.footer-links ul li a:hover {
    color: #00b4d8;
}

.footer-social {
    text-align: left;
}

.social-icons a {
    display: inline-block;
    margin: 0 10px;
    transition: transform 0.3s ease;
}

.social-icons a img {
    width: 30px;
    height: 30px;
}

.social-icons a:hover {
    transform: scale(1.2);
}

.footer-bottom {
    margin-top: 20px;
    font-size: 0.9rem;

}
    </style>
</head>

  <meta charset="UTF-8">
  <title>Global Weather Forecast</title>
</head>
<body>
  <div class="fullscreen-bg"></div>

  <!-- Header -->
  <header class="header">
    <div class="logo">
      <img src="images/akash.png" width="50" height="50" alt="Logo">
      <h1>akash Weather</h1>
    </div>
    <div class="search-bar">
      <form method="GET">
        <input type="text" name="location" placeholder="Enter location..." id="location-input">
        <button type="submit">Search</button>
      </form>
    </div>
    <div class="theme-toggle">
      <label class="toggle-container">
        <input type="checkbox" id="theme-toggle-checkbox">
        <span class="toggle-label">🌙</span>
      </label>
    </div>
  </header>

  <!-- Weather Content -->
  <div class="weather-container">
    <h2>Global Weather Forecast</h2>
    <p class="location">Location: <span id="location-placeholder"><?= htmlspecialchars($location) ?></span></p>
    <main>
      <section class="overview">
        <div class="overview-container">
          <div class="overview-title"><h2>Today's Weather</h2></div>
          <div class="overview-card">
            <h3>Location: <?= $currentData['name'] ?? 'Not Found' ?></h3>
            <p>Temperature: <span><?= $currentData['main']['temp'] ?? '--' ?></span>°C</p>
            <p>Condition: <span><?= $currentData['weather'][0]['description'] ?? '--' ?></span></p>
            <p>Humidity: <span><?= $currentData['main']['humidity'] ?? '--' ?></span>%</p>
            <p>Wind Speed: <span><?= $currentData['wind']['speed'] ?? '--' ?></span> km/h</p>
          </div>
          <div class="map-container">
            <iframe 
              src="https://www.google.com/maps/embed/v1/place?key=your_google_maps_api_key&q=<?= urlencode($location) ?>" 
              style="border: none; border-radius: 15px;" 
              allowfullscreen 
              loading="lazy">
            </iframe>
          </div>
        </div>
      </section>

      <!-- Hourly Forecast -->
      <section class="hourly">
        <h2 class="hourly-title">Hourly Forecast</h2>
        <div class="hourly-scroll">
          <?php
          if (isset($forecastData['list'])) {
            for ($i = 0; $i < 8; $i++) {
              $hourData = $forecastData['list'][$i];
              echo "<div class='hour-card'>
                <p>Time: <span>" . date('H:i', strtotime($hourData['dt_txt'])) . "</span></p>
                <p>Temp: <span>" . $hourData['main']['temp'] . "</span>°C</p>
                <p>Condition: <span>" . $hourData['weather'][0]['description'] . "</span></p>
              </div>";


            }
            echo "<div class='hour-card'>
              <p>Time: <span>" . date('H:i', strtotime($forecastData['list'][0]['dt_txt'])) . "</span></p>
              <p>Temp: <span>" . $forecastData['list'][0]['main']['temp'] . "</span>°C</p>
              <p>Condition: <span>" . $forecastData['list'][0]['weather'][0]['description'] . "</span></p>
            </div>";
            echo "<div class='hour-card'>
              <p>Time: <span>" . date('H:i', strtotime($forecastData['list'][1]['dt_txt'])) . "</span></p>
              <p>Temp: <span>" . $forecastData['list'][1]['main']['temp'] . "</span>°C</p>
              <p>Condition: <span>" . $forecastData['list'][1]['weather'][0]['description'] . "</span></p>
            </div>";
           
            echo "<p>Hourly data unavailable.</p>";
          }
          ?>
        </div>
      </section>

      <!-- 5-Day Forecast -->
      <section class="forecast">
        <h2>5-Day Forecast</h2>
        <div class="forecast-grid">
          <?php
          if (isset($forecastData['list'])) {
            for ($i = 0; $i < 5; $i++) {
              $dayIndex = $i * 8; // every 8th index ~24 hrs
              $dayData = $forecastData['list'][$dayIndex];
              echo "<div class='day-card'>
                <h3>Day " . ($i + 1) . "</h3>
                <p>Temp: <span>" . $dayData['main']['temp'] . "</span>°C</p>
                <p>Condition: <span>" . $dayData['weather'][0]['description'] . "</span></p>
              </div>";
            }
          } else {
            echo "<p>Forecast data unavailable.</p>";
          }
          ?>
        </div>
      </section>
    </main>
  </div>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <div class="footer-logo"><h2>akash Weather Forecast</h2></div>
      <div class="footer-links">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="#quick-view">Weather Overview</a></li>
          <li><a href="#weather-details">Detailed Forecast</a></li>
          <li><a href="#charts">Analysis & Charts</a></li>
          <li><a href="#map-section">Location Map</a></li>
        </ul>
      </div>
      <div class="footer-social">
        <h3>Connect with Us</h3>
        <div class="social-icons">
          <a href="#"><img src="images/Screenshot 2025-04-21 150530.png" alt="Facebook"></a>
          <a href="#"><img src="images/twt.png" alt="Twitter"></a>
          <a href="#"><img src="images/download.png" alt="Instagram"></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">                                 
      <p>© 2025 AKASH Weather Forecast | Designed with ❤ by Sourav</p>
    </div>

  </footer>  

</body>

</html>

     