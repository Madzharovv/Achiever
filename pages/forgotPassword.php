<?php
//Include file containing db functionalities and other functions.
include 'includes/config.php';

// Check if the submit form has been submitted.
if (isset($_POST['submit'])) {
    // Sanitize input data and declare variables.

    $email = mysqli_real_escape_string($db, $_POST['email']);
    $fav_animal = mysqli_real_escape_string($db, $_POST['favAnimal']);
    $fav_color = mysqli_real_escape_string($db, $_POST['favColor']);

//Select the favourite animal of the user from the database.
    $queryCheck = "SELECT favAnimal FROM UserData WHERE email='$email'";
    $animalCheck = mysqli_query($db, $queryCheck) or die (mysqli_error($db));
//If there is a match between the users input and the result proceed to select the users favourite color if not alert the user.
    if (mysqli_num_rows($animalCheck) == 1) {
//Select the favourite color of the user from the database.
        $sql = "SELECT favColor FROM UserData WHERE email='$email'";
        $result = mysqli_query($db, $sql);
        //If there is a match between the users input and the result proceed.
        if (mysqli_num_rows($result) == 1) {
            //If the query is successfull  assign the email as a session token.
            $_SESSION['loggedin'] = $email;
            //Redirect the User to new Password page
            header("location: newPassword.php");

        }else{
            //Display alert if the result doesnt match the users input 
echo "<script>alert('The Color Entered is Wrong ');</script>";
        }
    }else{ 
        //Display alert if the result doesnt match the users input 
        echo "<script>alert('The Animal Entered is Wrong ');</script>";
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
            <h1>Reset Password</h1>
            <p>Fill in the following fields with the correct information in order to reset your password.</p>
            <label class=" formStyles"><b>Email</b></label>
            <input class=" formStyles" type="text" placeholder="Email" name="email" id="email" required></input>
            <label class=" formStyles"><b>Favourite Animal</b></label>
            <input class=" formStyles" type="text" placeholder=" Favourite Animal" name="favAnimal" required></input>
            <label class=" formStyles"><b>Favourite Color</b></label>
            <input class=" formStyles" type="text" placeholder=" Favourite Color" name="favColor" required></input>
            <div class="SignUpLoginbuttonAlignment">
                <button type="submit" name="submit" id="submit" class="SignUpLoginbutton">Submit</button>
            </div>
        </form>
    </div>
</div>

</html>