<?php
//Include file containing db functionalities and other functions.
include 'includes/config.php';
//Email Assignment
$email = $_SESSION['loggedin']; 
// Check if the submit form has been submitted.
if (isset($_POST['submit'])) {
   // Hash the inputed password.
     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
     //Update the password in the datbase in the row that has the same email as the user that is logged in.
     $sql = "UPDATE UserData SET password='$password' WHERE email='$email'";
     if ($db->query($sql) === true) {
         //Display a Password Updated alert.
         echo '<script>alert("Password Updated");</script>'; 
         //Destroy session.
         session_destroy();
         //Redirecct the user to the login page.
         echo "<script> window.location.href = 'login.php';</script>";
     } else {
         echo '<script>alert("Update failed try again.");</script>';
     }
    }
?>
<!DOCTYPE html>


<head>
    <?php getHeadTag(); ?> </head>
</head>
<div>
    <?php getNav();?>
</div>
<div class="LoginPageContainer">
    <div class="LogoLogin">
        <img class="logoImg"
            src="https://raw.githubusercontent.com/Madzharovv/Year-1-Web-Development/main/Resources/achiever-high-resolution-logo-black-on-transparent-background.png"
            alt="Lamp" width="600" height="350"></img>
    </div>
    <div>
        <form class="LoginContainer" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h1 class="LoginTitle">Reset Password</h1>
            <label class=" formStyles" for="password">
                <b>Enter your new password</b>
            </label>
            <input class=" formStyles" type="password" placeholder="Password" name="password" required
                title="Your password must have more than 8 characters, lowercase letter, upper case letter and a special symbol."
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$"></input>
            <div class="SignUpLoginbuttonAlignment">
                <button type="submit" name="submit" id="submit" class="SignUpLoginbutton">Submit</button>
            </div>
        </form>
    </div>
</div>

</html>