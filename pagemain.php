<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <img src="images/logo.svg" alt="">
        </div>
        <div class="links">
            <ul>
                <li><a href="pagemain.php">Home</a></li>
                <li><a href="#our-services">Services</a></li>
                <li><a href="#about">About</a></li>

            </ul>
        </div>
    </nav>

    <div class="small-container" style="background-color: rgba(255,255,255,0.5)">
        <div class="row">
            <div class="col-2">
                <h1>SETRAM <span>For an easier Travel</span></h1>
                <p>SETRAM is Algeria's premier travel company, delivering top-notch experiences at unbeatable prices. Our commitment to excellence ensures affordable yet exceptional travel, making us the preferred choice for quality and value.</p>
                <button class="button" id="joinButton">Join us!</button>
            </div>
            <script>
  // Get the button element
                var joinButton = document.getElementById('joinButton');

                // Add a click event listener
                joinButton.addEventListener('click', function() {
                    // Redirect to another page when the button is clicked
                    window.location.href = 'index.php';
                });
                </script>
            <div class="col-2">
                <img src="image-removebg-preview.png" alt="">
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
    <div class="small-container">
        <div class="row">
            <div class="col-2">
                <h3 class="h3" id="our-services"><center>Our services</center></h3>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <div class="small-container">
        <div class="row">
            <div class="col-3" style="background-color: #38607e ">
                <img src="normal.png">
                <h3><center>Standard</center></h3>
            </div>
            <div class="col-3" style="background-color: #38607e  ">
                <img src="Premium.png">
                <h3><center>Premium</center></h3>
            </div>
            <div class="col-3" style="background-color: #38607e  ">
                <img src="vip.png">
                <h3><center>VIP</center></h3>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
    
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <h3 class="h3" id="about"><center>Want to learn more about us ?</center></h3>
                </div>
            </div>
        </div>
 
        <div class="offer">
    <div class="small-container">
        <div class="row">
            <div class="col-2">
                <h3 class="h3"><center>SETRAM Algeria: Revolutionizing Urban Transport</center></h3><br><br>
                <h3>SETRAM Algeria leads the transportation sector by enhancing commuter experiences through modernized infrastructure, innovative technologies, and a comprehensive network of routes. Our dedication to sustainability and service quality positions us as the preferred choice for fulfilling the diverse transportation needs of Algeria's urban population.</h3>
            </div>
       
    </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="footer">
            <div class="footer-content">
                <div class="footer-col-1">

                </div>
                <div class="footer-col-2">
                    <h3>Contact us :</h3>
                    <ul>
                        <li>num : +213.(0).560.03.03.40</li>
                        <li>Facebook : https://web.facebook.com/Setram.dz/?locale=fr_FR&_rdc=1&_rdr</li>
                        <li>X : https://twitter.com/SETRAM?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor</li>
                    </ul>
                </div>
            </div>
        </div>
        
</body>
</html>