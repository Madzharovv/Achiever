<?php
session_start();

$db = new mysqli('127.0.0.1', 'root', '', 'Achiever');
if ($db->connect_error) {
    printf("Connection failed" . $db->connect_error);
    exit();
} else {
    echo "<script>
    console.log('success');
    </script>";
    date_default_timezone_set("Europe/London");
}


//get html head
function getHeadTag()
{
    $output = '<meta charset="utf-8">
        <title>Achiever</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="stylesheets/stylesheets.css">
        <link rel="icon" href="images/icon.png" type="image/x-icon">
        <script src="jquery.js"></script>';
    echo $output;
}
//get nav for home login signup and reset password pages
function getNav()
{
    $output = '<nav class="nav">
      <div class="navContainer">
              <a class="logoAchiever" href="home.php">Achiever</a>
          <div class="buttonContainer">
              <a class="button"  href="login.php">Login</a>
              <a class="button" href="signup.php">Signup</a>
          </div>
      </div>
  </nav>';
    echo $output;
}
//get current date
function display_current_date()
{
    $date = date("Y-m-d");
    echo "<p> " . $date . "</p>";
}
//get translate container
function translate()
{
    $output ='<div id="google_element"></div>
    <script>
    function loadGoogleTranslate() {
        new google.translate.TranslateElement("google_element");
    }
    </script>
    <script src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate">
    </script>';
    
    echo $output;

}
?>