<?php 
session_start();
?>

<head><style>
    .profile-image {
    margin-top: 30px;
    text-align: center;
    }

    .profile-image img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    border: 2px solid #3498db;
    object-fit: cover;
    }
    
</style></head>
<body>
 <?php
    include 'user_page.php'
    ?>
</body>
<?php


include'../mysql/connectMysql.php';


if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sqlUserID = "SELECT id FROM users WHERE username = '$username'";
    $userResult = $conn->query($sqlUserID);
    $userRow = $userResult->fetch_assoc();
    $user_id = $userRow['id'];
    $sql = "SELECT subscription.sub_type AS type_sub, subscription.date_sub, profile.nom, profile.prenom, profile.date_naissance ,profile.image
            FROM subscription 
            INNER JOIN profile ON subscription.id = profile.user_id 
            WHERE subscription.id = '$user_id'
            ";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $type_sub = $row['type_sub'];
        $date_sub = $row['date_sub'];
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $date_naissance = $row['date_naissance'];
        $image_path = $row['image'];

        $currentDate = new DateTime(); // Current date
        $endDate = new DateTime($date_sub); // Subscription end date from the database

        // Calculate the difference between dates
        $interval = $currentDate->diff($endDate);
        $remainingDays = $interval->format('%r%a'); // Get remaining days as a string

        


        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>User Subscription Information</title>";
        echo "<style>
        background: rgb(103,115,213);
        background: radial-gradient(circle, rgba(103,115,213,1) 1%, rgba(29,135,253,1) 50%, rgba(45,57,219,1) 100%);
            .profile-image {
            margin-top: 30px;
            text-align: center;
            }
        
            .profile-image img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 2px solid #3498db;
            object-fit: cover;
            }

            .container1 {
                max-width: 900px;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 50px auto;
            }

            .card-wrapper {
                width: 400px;
                height: 500px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-evenly;
            }

            

            .card-image img {
                width: 100%;
                height: 475px;
                object-fit: cover;
            }

            .details {
                padding: 20px;
                text-align: center;
            }





            
              
              
              
              .card {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 750px;
                height: 450px;
                transform: translate(-50%, -50%);
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 5px 18px rgba(0, 0, 0, 0.6);
                background-color: #8FF9CD;

                cursor: pointer;
                transition: 0.5s;
                
                .card-image {
                  position: absolute;
                  top: 0px;
                  left: 0px;
                  width: 100%;
                  height: 100%;
                  z-index: 2;
                  background-color: #8FF9CD;
                  transition: .5s;
                }
                
                &:hover img {
                  opacity: 0.4;
                  transition: .5s;
                }
              }
              
              .card:hover .card-image {
                transform: translateY(-200px);
                transition: all .9s;
              }
              
              /**** Social Icons *****/
              
              .social-icons {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 3;
                display: flex;
                position: absolute;
                top: 40px;
                left: 100px;
                
                li {
                  list-style: none;
                  
                  a {
                    position: relative;
                    display: block;
                    width: 50px;
                    height: 50px;
                    line-height: 50px;
                    text-align: center;
                    background: #fff;
                    font-size: 23px;
                    color: #333;
                    font-weight: bold;
                    margin: 0 6px;
                    transition: .4s;
                    transform: translateY(200px);
                    opacity: 0;
                  } 
                }
              }
              
              .card:hover .social-icons li a {
                transform: translateY(0px);
                opacity: 1; 
              }
              
              .social-icons li a:hover {
                background: #000; 
                transition: .2s;
                .fab {
                  color: #fff;
                } 
              }
              
              .social-icons li a .fab {
                transition: .8s;
                  
                &:hover {
                    transform: rotateY(360deg);
                    color: #fff;
                } 
              }
              
              .card:hover li:nth-child(1) a {
                  transition-delay: 0.1s;
              }
              .card:hover li:nth-child(2) a {
                transition-delay: 0.2s;
              }
              .card:hover li:nth-child(3) a {
                transition-delay: 0.3s;
              }
              .card:hover li:nth-child(4) a {
                transition-delay: 0.4s;
              }
              
              /**** Personal Details ****/
              
              .details {
                position: absolute;
                bottom: 20%;
                left: 0;
                background: #fff;
                width: 100%;
                height: 120px;
                z-index: 1;
                padding: 10px;
              
                h2 p {
                  margin: 30px 0;
                  padding: 0;
                  text-align: center;
                   
                  .job-title {
                      font-size: 1rem;
                      line-height: 2.5rem;
                      color: #333;
                      font-weight: 300;
                  }
                }
              }
            </style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container1'>";
        echo "<div class='card-wrapper'>";
        echo "<div class='card'>";
        echo "<div class='card-image'><img src='$image_path' alt='Profile Image' width='200' height='200'></div>";
        echo "<div class='details'>";
        echo "<h2>$nom $prenom</h2>";
        echo "<p class='job-title'>Date of Birth: $date_naissance</p>";
        echo "<p>Subscription Type: $type_sub</p>";
        echo "<p>Subscription End Date: $date_sub</p>";
        echo "<p>Days Remaining: $remainingDays days</p>";
        echo "<ul class='social-icons'>
                    <!-- Social icons here -->
                </ul>";
        echo "</div>"; // End of details div
        echo "</div>"; // End of card div
        echo "</div>"; // End of card-wrapper div
        echo "</div>"; // End of container1 div

        echo "</body>";
        echo "</html>";
    } else {
        echo "No data found for this user.";
    }
} else {
    echo "Error: User not logged in.";
}

$conn->close();
?>
