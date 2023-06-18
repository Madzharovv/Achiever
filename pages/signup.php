<?php
//Include file containing db functionalities and other functions 
include 'includes/config.php';

//Check if the user has logged in and if they havent they are redirected to the home page.
if (isset($_SESSION["loggedin"]) === true) {
    header("location: userhome.php");
    exit;
}

// Check if the submit form has been submitted.
if (isset($_POST['submit'])) {
    // Sanitize input data and declare variables.
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $first_name = mysqli_real_escape_string($db, $_POST['firstname']);
    $last_name = mysqli_real_escape_string($db, $_POST['lastname']);
    $fav_animal = mysqli_real_escape_string($db, $_POST['favAnimal']);
    $fav_color = mysqli_real_escape_string($db, $_POST['favColor']);
    $course = mysqli_real_escape_string($db, $_POST['Course']);


//Check if the email already exists in the database.
    $sql = "SELECT * FROM userdata WHERE email = '$email'";
    $result = $db->query($sql);
//If there is a email like the of inseretd the "Email is already taken" alert occurs.
    if ($result->num_rows > 0) {
        echo '<script>alert("Email is already taken");</script>';
    } else {
        // Hash the password that has been submitted. 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert query. 
        $sql = "INSERT INTO userdata (email, password, firstname, lastname, favAnimal, favColor, course)
    VALUES ('$email', '$hashed_password', '$first_name', '$last_name',' $fav_animal',' $fav_color', '$course')";
        if ($db->query($sql) === true) {
            //If the query is successfull  assign the email as a session token and redirect the user to the user home page.
            $_SESSION['loggedin'] = $email;
            echo "<script> window.location.href = 'userhome.php';
        </script>";
        } else {
            echo "<script>alert('Ooops something went wrong ');</script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php getHeadTag(); ?> </head>
</head>

<body>
    <div> <?php getNav(); ?></div>
    <div>
        <div class="SignupPageContainer">
            <form action="signup.php" method="POST" class="SignupContainer">
                <h1 class="SignupTitle">Signup</h1>
                <label class=" formStyles"><b>Email</b></label>
                <input class=" formStyles" type="Email" placeholder="Email" name="email" required></input>
                <label class=" formStyles"><b>Password</b></label>
                <input class=" formStyles" type="password" placeholder="Password" name="password" required
                    title="Your password must have more than 8 characters, lowercase letter, upper case letter and a special symbol."
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,30}$"></input>
                <label class=" formStyles"><b>First Name</b></label>
                <input class=" formStyles" type="text" placeholder="First Name" name="firstname" required></input>
                <label class=" formStyles"><b>Last Name</b></label>
                <input class=" formStyles" type="text" placeholder="Last Name" name="lastname" required></input>

                <h3>Security Answers</h3>
                <p>Remember these!</p>
                <hr>
                <label class=" formStyles"><b>Favourite Animal</b></label>
                <input class="formStyles" type="text" placeholder="Favourite Animal" name="favAnimal" required></input>
                <label class=" formStyles"><b>Favourite Color</b></label>
                <input class=" formStyles" type="text" placeholder="Favourite Color" name="favColor" required></input>
                <label class=" formStyles"><b>Your Course</b></label>
                <input class=" formStyles" type="text" placeholder="Course" name="Course" required></input>
                <div class="SignUpLoginbuttonAlignment"><input class="SignUpLoginbutton" type="submit" name="submit"
                        value="Signup"></input></div>
                <div class="registerTagContainer">
                    <label class="registerTag">Have an account?</label>
                    <a href="login.php" class="registerTag">Login here</a>
                </div>

            </form>
        </div>
    </div>
</body>

</html>