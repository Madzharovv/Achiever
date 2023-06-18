<?php
//Include file containing db functionalities and other functions
include 'includes/config.php'
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php getHeadTag(); ?>
</head>

<body>
    <div> <?php getNav();?>
        <div class="note">
            <div class="Logo"><img class="logoImg"
                    src="https://raw.githubusercontent.com/Madzharovv/Year-1-Web-Development/main/Resources/achiever-high-resolution-logo-black-on-transparent-background.png"
                    alt="Lamp" width="700" height="400"></img></div>
            <div class="firstP">
                <h1 class="headingOne">A student's best friend.</h1>
            </div>
            <div class="SecondP">
                <h2 class="headingTwo">
                    An application that will allow you to orgainse your time in<br>
                    order to be productive.
                </h2>
            </div>
            <div class="ThirdP">

                <h3 class="headingThree">
                    A way to balance a happy life with academic success.
                </h3>
            </div>
            <div class="fourthP">
                <h1 class="headingFour">Begin your journey</h1>
            </div>
            <div>
                <div class="joinBtnContainer">
                    <a class="joinBtn" href="signup.php">Join now</a>
                </div>
            </div>
            <footer>
                <p>Copyright ⓒ 2023</p>
            </footer>
        </div>
    </div>
</body>

</html>