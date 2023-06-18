<?php
//Include file containing db functionalities and other functions 
include 'includes/config.php';

//Check if the user has logged in and if they havent they are redirected to the home page.
if (isset($_SESSION["loggedin"]) === false) {
    header("location: home.php");
    exit;
}
//If the user has pressed the "logout" button they will be redirected to the home page and the user session is destroyed.
if (isset($_POST['logout'])) {

    session_destroy();
    header('Location: home.php');
    exit;
}

//Email Assignment
$email = $_SESSION['loggedin'];
// Check if the accountDeleteButton form has been submitted.
if (isset($_POST['accountDeleteButton'])) {

    //Delete all data associated to the account. 
    $sql1 = "DELETE  FROM UserData WHERE email='$email'";
    $sql2 = "DELETE  FROM grades WHERE email='$email'";
    $sql3 = "DELETE  FROM notes WHERE email='$email'";
    $sql4 = "DELETE  FROM tasks WHERE email='$email'";
    $sql5 = "DELETE  FROM Events WHERE email='$email'";
    if ($db->query($sql1) === true and $db->query($sql2) === true and $db->query($sql3) === true and $db->query($sql4) === true and $db->query($sql5) === true) {
        //Redirect the user to the website home page if all queries are successfull.
        header('location:home.php');
        session_destroy();
    } else {
        echo "Failed deletion";
    }
}
// Check if the passwordUpdateButton form has been submitted.
if (isset($_POST['passwordUpdateButton'])) {
    //Hash password 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //Update the password in the datbase in the row that has the same email as the user that is logged in.
    $sql = "UPDATE UserData SET password='$password' WHERE email='$email'";
    if ($db->query($sql) === true) {
        //display a Password Updated alert
        echo '<script>alert("Password Updated");</script>';
    } else {
        echo '<script>alert("Update failed try again.");</script>';
    }
}
//Select the users current course from the db.  
$courseSelect = "SELECT course FROM UserData WHERE email='$email'";
$courseResults = mysqli_query($db, $courseSelect);
if (mysqli_num_rows($courseResults) == 1) {
    //Store the results in the following var.
    $rowCourse = mysqli_fetch_assoc($courseResults);
}
//Select the users current course from the db.  
$animalSelect = "SELECT favAnimal FROM UserData WHERE email='$email'";
$animalResults = mysqli_query($db, $animalSelect);
if (mysqli_num_rows($animalResults) == 1) {
    //Store the results in the following var.
    $rowanimal = mysqli_fetch_assoc($animalResults);
}
$colorSelect = "SELECT favColor FROM UserData WHERE email='$email'";
$colorResults = mysqli_query($db, $colorSelect);
if (mysqli_num_rows($colorResults) == 1) {
    //Store the results in the following var.
    $rowcolor = mysqli_fetch_assoc($colorResults);
}
//Select the users first name from the db.
$FnameSelect = "SELECT firstname FROM UserData WHERE email='$email'";
$FnameResults = mysqli_query($db, $FnameSelect);
if (mysqli_num_rows($FnameResults) == 1) {
    //Store the results in the following var.
    $rowFname = mysqli_fetch_assoc($FnameResults);

}
//Select the users last name from the db.
$LnameSelect = "SELECT lastname FROM UserData WHERE email='$email'";
$LnameResults = mysqli_query($db, $LnameSelect);
if (mysqli_num_rows($LnameResults) == 1) {
    //Store the results in the following var.
    $rowLname = mysqli_fetch_assoc($LnameResults);
}
// Check if the courseUpdate form has been submitted.
if (isset($_POST['courseUpdate'])) {
    // Sanitize input data and declare variables.
    $newCourse = mysqli_real_escape_string($db, $_POST['newCourse']);
    //Update the course in the database with the course inputted by the user and stored in the variable.
    $sql = "UPDATE UserData SET course='$newCourse' WHERE email='$email'";
    if ($db->query($sql) === true) {
        //Display alert.
        echo '<script>alert("Course Updated");</script>';
        //Refresh the page. 
        echo '<script> window.location.href = "profile.php";</script>';
    } else {
        echo '<script>alert("Update failed try again.");</script>';
    }
}
// Check if the firstNameUpdate form has been submitted.
if (isset($_POST['firstNameUpdate'])) {
    // Sanitize input data and declare variables.
    $newFirstName = mysqli_real_escape_string($db, $_POST['newFirstName']);
    // Update the first name in the database with the first name inputted by the user and stored in the variable.
    $sql = "UPDATE UserData SET firstname='$newFirstName' WHERE email='$email'";
    if ($db->query($sql) === true) {
        //Display alert.
        echo '<script>alert("First name Updated");</script>';
        //Refresh the page. 
        echo '<script> window.location.href = "profile.php";</script>';
    } else {
        //Display alert.
        echo '<script>alert("Update failed try again.");</script>';
    }
}
// Check if the lastNameUpdate form has been submitted.
if (isset($_POST['lastNameUpdate'])) {
    // Sanitize input data and declare variables.
    $newLastName = mysqli_real_escape_string($db, $_POST['newLastName']);
    //Update the last name in the database with the last name inputted by the user and stored in the variable.
    $sql = "UPDATE UserData SET lastname='$newLastName' WHERE email='$email'";
    if ($db->query($sql) === true) {
        //Display alert.
        echo '<script>alert("Last name Updated");</script>';
        //Refresh the page. 
        echo '<script> window.location.href = "profile.php";</script>';
    } else {
        //Display alert.
        echo '<script>alert("Update failed try again.");</script>';
    }
}
if (isset($_POST['favouriteAnimal'])) {
    // Sanitize input data and declare variables.
    $favAnimal = mysqli_real_escape_string($db, $_POST['favouriteAnimal']);
    //Update the last name in the database with the last name inputted by the user and stored in the variable.
    $sql = "UPDATE UserData SET favAnimal='$favAnimal' WHERE email='$email'";
    if ($db->query($sql) === true) {
        //Display alert.
        echo '<script>alert("Favourite Animal Updated");</script>';
        //Refresh the page. 
        echo '<script> window.location.href = "profile.php";</script>';
    } else {
        //Display alert.
        echo '<script>alert("Update failed try again.");</script>';
    }
}
if (isset($_POST['favouriteColorbtn'])) {
    // Sanitize input data and declare variables.
    $favColor = mysqli_real_escape_string($db, $_POST['favouriteColor']);
    //Update the last name in the database with the last name inputted by the user and stored in the variable.
    $sql = "UPDATE UserData SET favColor='$favColor' WHERE email='$email'";
    if ($db->query($sql) === true) {
        //Display alert.
        echo '<script>alert("Favourite Color Updated");</script>';
        //Refresh the page. 
        echo '<script> window.location.href = "profile.php";</script>';
    } else {
        //Display alert.
        echo '<script>alert("Update failed try again.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <?php getHeadTag(); ?>



</head>

<body>

    <div class="profilePageContainer">
        <nav class="sidenav">
            <div>
                <div class="profileImgName">
                    <div>
                        <p>Welcome back,</p>
                        <h3><img style="width:20px; height:20px;" src="images/user.png" height=20px>
                            <?php echo $rowFname['firstname']; ?>
                            <hr>
                    </div>
                </div>
                <div class="sidenavElements"><a class="navBtnsHome" href="userhome.php"> Home</a> </div>
                <div class="sidenavElements"><a class="navBtnsGrades" href="grades.php"> Grades</a> </div>
                <div class="sidenavElements"><a class="navBtnsStatistics" href="statistics.php"> Statistics</a> </div>


            </div>
            <div class="sidenavElements">
                <form method="POST" action="userhome.php">
                    <button class="navBtnsLogout" type="submit" name="logout" action="userhome.php" value="Logout">
                        Logout</button>
                    <div class="translateContainer">
                        <?php translate(); ?></div>
                </form>
            </div>
        </nav>
        <div class="rightGradePage">

            <div class="accountContainer">
                <h1 class="profileHeader"> Your Profile</h1>
                <div class="accountDetailsContainerFull">
                    <div class="SettingContainer">
                        <h1>Account Details</h1><br>
                        <hr>
                        <h2>Personal Information</h2>
                    </div>

                    <div class="NameChangeContainerPersonnal">
                        <div class="AlongsideContainer">
                            <div style="width:235px" class="SettingContainerName">
                                <form method="POST" class="accountDetailsContainer" action="profile.php">

                                    <h3> Your First Name:
                                        <b><?php echo $rowFname['firstname']; ?></b>
                                    </h3>
                                    <label>First Name</label>
                                    <input class="formComponents" type="text" placeholder="New First Name"
                                        name="newFirstName">
                                    </input> <button class="profileSubmitButton" type="submit"
                                        name="firstNameUpdate">Change</button>

                                </form>
                            </div>




                            <div style="width:235px" class="SettingContainerName">
                                <form method="POST" class="accountDetailsContainer" action="profile.php">
                                    <h3> Your Surname:
                                        <b><?php echo $rowLname['lastname']; ?></b>
                                    </h3>
                                    <label>Last Name</label>
                                    <input type="text" placeholder="New Last Name" name="newLastName">
                                    </input>
                                    <button class="profileSubmitButton" type="submit" name="lastNameUpdate">Change
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="NameChangeContainer">
                        <div class="SettingContainerName">
                            <hr>
                        </div>


                        <div class="SettingContainerName">
                            <form method="POST" class="accountDetailsContainer" action="profile.php">
                                <h2>Course Information</h2>
                                <h3> Your Course:
                                    <b><?php echo $rowCourse['course']; ?></b>
                                </h3>
                                <label>Your Course</label>
                                <input type="text" placeholder="New Course" name="newCourse"></input>
                                <button class="profileSubmitButton" type="submit" name="courseUpdate"
                                    action="profile.php">Change</button>
                                <hr>
                            </form>
                        </div>
                    </div>
                    <div class="SettingContainerName">
                        <h1>Privacy and Security</h1>

                    </div>
                    <div class="SettingContainer">
                        <hr>
                    </div>
                    <div class="NameChangeContainer">
                        <div class="SettingContainerName">
                            <form method="POST" class="accountDetailsContainer" action="profile.php">
                                <h2>Reset Your Password</h2>
                                <label>New Password</label>
                                <input type="password" placeholder="Password" name="password" required
                                    title="Your password must have more than 8 characters, lowercase letter, upper case letter and a special symbol."
                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$"
                                    id="password">
                                </input>
                                <button class="profileSubmitButton" type="submit" name="passwordUpdateButton"
                                    action="profile.php">
                                    Reset Password</button>
                                <hr>
                            </form>
                        </div>


                        <div class="SettingContainerName">
                            <h2>Security Answers</h2>
                            <form method="POST" class="accountDetailsContainer" action="profile.php">
                                <h3>Favourite Animal:<b><?php echo $rowanimal['favAnimal']; ?></b></h3>
                                <label>Animal</label>
                                <input class="formComponents" type="text" placeholder="Favourite Animal"
                                    name="favouriteAnimal">
                                </input>
                                <button class="profileSubmitButton" type="submit"
                                    name="favouriteAnimalbtn">Change</button>
                                <hr>
                            </form>
                        </div>




                        <div class="SettingContainerName">
                            <form method="POST" class="accountDetailsContainer" action="profile.php">
                                <h3> Favourite Color:
                                    <b><?php echo $rowcolor['favColor']; ?></b>
                                </h3>
                                <label>Color</label>
                                <input class="formComponents" type="text" placeholder="Favourite Color"
                                    name="favouriteColor">
                                </input>
                                <button class="profileSubmitButton" type="submit"
                                    name="favouriteColorbtn">Change</button>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="SettingContainer">
                    <h2><b>Delete account</b></h2><br>

                    <form method="POST" action="profile.php">

                        <p>
                            <b>Important!</b><br>Only click the button below if you are sure you want to delete your
                            account.
                            <br>
                            If you press the button your account will be deleted permanently alongside all your
                            data!
                        </p> <button class="accountDeleteButton" type="submit" name="accountDeleteButton"
                            action="profile.php" value="Delete Account">
                            Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>