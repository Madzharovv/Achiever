<?php
//Include file containing db functionalities and other functions.
include 'includes/config.php';
//Check if the user has logged in and if they havent they are redirected to the home page.
if (isset($_SESSION["loggedin"]) === false) {
  header("location: home.php");
  exit;
}
//If the user has pressed the "logout" button they will be redirected to the home page and the user session is destroyed.
if (isset($_POST['logout'])) {
  //destroying the session
  session_destroy();
  header('Location: home.php');
  exit;
}//Function Trigger from the script.js file
if (isset($_POST["functionName"]) && function_exists($_POST["functionName"])) {
  header('Content-Type: text/html');
  $result = call_user_func($_POST["functionName"], $_POST["date"]);
  echo $result;
}
function myPhpFunction($date)
{ //Establishing connection to database 
  $connection = mysqli_connect("localhost", "root", "", "Achiever");
  if (mysqli_connect_errno()) {
    return json_encode(array("error" => "Failed to connect to database"));
  }
  $email = $_SESSION['loggedin']; //Email Clarification
  //Select all events that are created for the date clicked.
  $query = "SELECT * FROM Events WHERE eventDate='$date' AND email='$email'" ;
  $result = mysqli_query($connection, $query);
  if (!$result) {
    return json_encode(array("error" => "Failed to retrieve events from database"));
  }
 //Display all data in the following html format after it has been fetched
  $events = array();
  $html ='';
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $html .='<div class="event">
        
              <div>
              <img class="deleteIcon" src="images/activity.png" height=15px> <span class="event-time">'.$row['activityType'].' 
              <i style="font-size:12px;" class="fa-solid fa-arrow-right"></i>'.$row['activity'].'</span>
              </div>
              <div class="title">
                <i class="fas fa-circle"></i>
                <h3 class="event-title">'.$row['activityTitle'].'</h3>
              </div>
              <div style="padding-left:1em;overflow-wrap: anywhere;"class="title">
                <span class="event-time">'.$row['eventDescription'].'</span>
              </div>
              <div class="title">
              <img class="deleteIcon" src="images/time.png" height=15px><span class="event-time">'.$row['activityDuration'].'</span>
              </div>
         </div>';
    }
    //If no data was fetched display the following no events html. 
  }else{
    $html.='<div class="no-event">
      <h3>No Events</h3>
    </div>';
  }
  mysqli_close($connection);
  header('Content-Type: text/html');
  return $html;
}
?>