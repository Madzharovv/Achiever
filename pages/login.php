<?php
//include file containing db functionalities and other functions 
include 'includes/config.php';
//Checks if the user has already logged in and if they have they are redirected to the user home page. 
if (isset($_SESSION["loggedin"]) === true) {
    header("location: userhome.php");
    exit;
}
// Check if the submit form has been submitted.
if (isset($_POST['submit'])) {
//Asign input to variables and sanitize the data
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
//Check if the email matches any emails in the database 
    $queryCheck = "SELECT email FROM UserData WHERE email='" . $email . "'";
    $useremail = mysqli_query($db, $queryCheck) or die (mysqli_error($db));
// If the email matches retrieve the continue if not display the invalid email alert. 
    if (mysqli_num_rows($useremail) == 1) {
        // Select statement that retrieves the hashed password from the database that matches the users email.
        $sql = "SELECT * FROM UserData WHERE email='$email'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $hash = $row['password'];

//Varifying the password using the "password verify function".
        if (password_verify($password, $hash)) {
// If the password is correct the query is successfull, assign the email as a session token and redirect the user to the user home page.
            $_SESSION['loggedin'] = $email;
            header("Location: userhome.php");
        } else {
            //Wrong password alert if the user password fails the verifying stage.
echo "<script>alert('The password entered is invalid, please try again. ');</script>";

        }
    }else
    //Wrong password alert if the user password fails the verifying stage.
    {
        echo "<script>alert('The email entered is invalid, please try again ');</script>";
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
            <h1 class="LoginTitle">Login</h1>
            <label class=" formStyles">
                <b>Email</b>
            </label>
            <input class=" formStyles" type="text" placeholder="Email" name="email" id="email" required></input>
            <label class=" formStyles" for="password">
                <b>Password</b>
            </label>
            <input class=" formStyles" type="password" placeholder="Password" name="password" id="password"
                required></input>

            <div class="SignUpLoginbuttonAlignment">
                <button type="submit" name="submit" id="submit" class="SignUpLoginbutton">Login</button>
            </div>
            <div class="registerTagContainer">
                <label class="registerTag">Don't have an account?</label>
                <a href="signup.php" class="registerTag">Signup now!</a>
            </div>
            <div class="registerTagContainer">
                    <label class="registerTag">Forgot Password?</label>
                    <a href="forgotPassword.php" class="registerTag">Click here</a>
            </div>
        </form>
    </div>
</div>
</div>

</html>