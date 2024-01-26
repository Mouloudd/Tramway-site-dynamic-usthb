<!DOCTYPE html>
<html>
<head>
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: linear-gradient( 109.6deg,  rgba(96,221,142,1) 11.2%, rgba(24,138,141,1) 91.1% );
            background-attachment: fixed;
        }
        .content {
            margin-left: 270px; /* Adjusted to accommodate the sidebar width and space */
            padding: 20px;
            flex : 1 ;
        }
        .hidden {
            display: none;
        }
        .sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.sidebar a:hover {
  color: #f1f1f1;
}

/* Position and style the close button (top right corner) */
.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

/* The button used to open the sidebar */
.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s; /* If you want a transition effect */
  padding: 20px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
.main_box{
  position: relative;
  background: url('side.jpeg') right no-repeat;
  background-size: cover;
 
  width: 100%;
  display: flex;
}
.main_box .sidebar_menu{
  position: fixed;
  height: 100vh;
  width: 280px;
  left: -280px;
  background: rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.5);
  overflow: hidden;
  transition: all 0.3s linear;
}
.sidebar_menu .logo{
  position: absolute;
  width: 100%;
  height: 60px;
  box-shadow: 0px 2px 4px rgba(255, 255, 255, 0.5);
}
.sidebar_menu .logo a{
  color: #fff;
  font-size: 25px;
  font-weight: 500;
  position: absolute;
  left: 50px;
  line-height: 60px;
  text-decoration: none;
}
.sidebar_menu .menu{
  position: absolute;
  top: 80px;
  width:100%;
}
.sidebar_menu .menu li{
  margin-top: 6px;
  padding: 14px 20px;
}
.sidebar_menu .menu i{
  color: #fff;
  font-size: 20px;
  padding-right: 8px;
}
.sidebar_menu .menu a{
  color: #fff;
  font-size: 20px;
  text-decoration: none;
}
.sidebar_menu .menu li:hover{
  border-left: 1px solid #fff;
  box-shadow: 0 0 4px rgba(255, 255, 255, 0.5);
}
.sidebar_menu .social_media{
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  bottom: 20px;
  list-style: none;
  cursor: pointer;
}
.sidebar_menu .social_media i{
  text-decoration: none;
  padding: 0 5px;
  color: #fff;
  opacity: 0.6;
  font-size: 20px;
}
.sidebar_menu .social_media i:hover{
  opacity: 1;
  transition: all 0.2s linear;
  transform: scale(1.01);
}
#check{
  display: none;
}
.main_box .btn_one i{
  color: #fff;
  font-size: 30px;
  font-weight: 700;
  position: absolute;
  left: 16px;
  line-height: 60px;
  cursor: pointer;
  opacity: 1;
  transition: all 0.3s linear;  
}
 .sidebar_menu .btn_two i{
  font-size: 25px;
  line-height: 60px;
  position: absolute;
  left: 240px;
  cursor: pointer;
  opacity: 0;
  transition: all 0.3s linear;
}
.btn_one i:hover{
  font-size: 29px;
}
.btn_two i:hover{
  font-size: 24px;
}
#check:checked ~ .sidebar_menu{
  left: 0;
}
#check:checked ~ .btn_one i{
  opacity: 0;
}
#check:checked ~ .sidebar_menu .btn_two i{
  opacity: 1;
}
        
    </style>
</head>
<body>
<div class="main_box">
        <input type="checkbox" id="check">
        <div class="btn_one">
          <label for="check">
            <i class="fas fa-bars"></i>
          </label>
        </div>
        
        <div class="sidebar_menu">
          <div class="logo">
    
            <a href="#">User Page</a>
              </div>
            <div class="btn_two">
              <label for="check">
                <i class="fas fa-times" Style="color:#fff"></i>
              </label>
            </div>
          <div class="menu">
            <ul>
              <li><i class="fas fa-user"></i>
                <a href="profile.php" onclick="showContent('about')">Profile</a>
              </li>
              <li>
                <i class="fas fa-money-check-alt"></i>
                <a href="subscription.php" onclick="showContent('services')">Subscription</a>
              </li>
              <li>
              <i class="fas fa-address-card"></i>
                <a href="my_subscription.php" onclick="showContent('contact')">My subscription</a>
              </li>
          
              <li><i class="fas fa-sign-out-alt"></i>
                <a href="../index.php" onclick="showContent('contact')">Logout</a>
              </li>

            </ul>
          </div>
        </div>
    </div>
     

    <div class="content" id="mainContent">
        <!-- The loaded content will appear here -->
    </div>

    <script>
        function loadContent(page) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("mainContent").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", page, true);
            xhttp.send();
        }
    </script>
</body>
</html>
