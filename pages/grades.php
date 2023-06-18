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

    session_destroy();
    header('Location: home.php');
    exit;
}

//Query that Selects a random quote from the database.
$sql = "SELECT quote FROM quotes ORDER BY RAND() LIMIT 1";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) == 1) {
    // Display the quote
    $row = mysqli_fetch_assoc($result);

}
//Email Clarification
$email = $_SESSION['loggedin'];
//Selects all grades that are associated with the users email in the database.
$gradesSelection = "SELECT * FROM grades WHERE email='$email'";
$resultGrades = mysqli_query($db, $gradesSelection);


//Query which selects the first name of the logged in user from the database.
$sqlName = "SELECT firstname FROM UserData WHERE email='$email'";
$resultName = mysqli_query($db, $sqlName);

if (mysqli_num_rows($resultName) == 1) {
    // Load the first name in a row in order to display it. 
    $rowNAME = mysqli_fetch_assoc($resultName);

}

// Check if the calcGradeAndStore form has been submitted.
if (isset($_POST['calcGradeAndStore'])) {
    $Subject = mysqli_real_escape_string($db, $_POST['Subject']);
    $weight1 = mysqli_real_escape_string($db, $_POST['weight1']);
    $weight2 = mysqli_real_escape_string($db, $_POST['weight2']);
    $weight3 = mysqli_real_escape_string($db, $_POST['weight3']);
    $weight4 = mysqli_real_escape_string($db, $_POST['weight4']);
    $weight5 = mysqli_real_escape_string($db, $_POST['weight5']);
    $results1 = mysqli_real_escape_string($db, $_POST['results1']);
    $results2 = mysqli_real_escape_string($db, $_POST['results2']);
    $results3 = mysqli_real_escape_string($db, $_POST['results3']);
    $results4 = mysqli_real_escape_string($db, $_POST['results4']);
    $results5 = mysqli_real_escape_string($db, $_POST['results5']);
    $assessment1 = mysqli_real_escape_string($db, $_POST['Assessment1']);
    $assessment2 = mysqli_real_escape_string($db, $_POST['Assessment2']);
    $assessment3 = mysqli_real_escape_string($db, $_POST['Assessment3']);
    $assessment4 = mysqli_real_escape_string($db, $_POST['Assessment4']);
    $assessment5 = mysqli_real_escape_string($db, $_POST['Assessment5']);
    $total_weight = $weight1 + $weight2 + $weight3 + $weight4 + $weight5;
    //If the weight of all of the users garde for the module doesnt add up to 100 alert the user 
    if ($total_weight != 100) {
        echo "<script>alert('The weight of your grades doesnt add up to 100 please make the according changes');</script>";
    } else {
        //Calculate the grade for each assessment by multiplying the weight of the grade by the result of the assesment.
        $weight_results1 = ($weight1 * $results1) / 100;
        $weight_results2 = ($weight2 * $results2) / 100;
        $weight_results3 = ($weight3 * $results3) / 100;
        $weight_results4 = ($weight4 * $results4) / 100;
        $weight_results5 = ($weight5 * $results5) / 100;
        //Calculate the final grade by adding all of the weights and the results and then dividing them by each other and multiplying them by 100. 
        $total_weight = $weight1 + $weight2 + $weight3 + $weight4 + $weight5;
        $total_weight_results = $weight_results1 + $weight_results2 + $weight_results3 + $weight_score4 + $weight_results5;
        $final_grade = $total_weight_results / $total_weight * 100;
        // Execute INSERT query for inserting the grades of the user into the database. 
        $gradeInsert = "INSERT INTO grades (email, subject , assessment1 , assessment2 , assessment3 , assessment4 , assessment5 , weight1 , weight2 , weight3 , weight4 , weight5 , results1 , results2 , results3 , results4 , results5 , finalGrade) VALUES ('" . $email . "' , '" . $Subject . "' , '" . $assessment1 . "' , '" . $assessment2 . "' , '" . $assessment3 . "' , '" . $assessment4 . "' , '" . $assessment5 . "' , '" . $weight1 . "' , '" . $weight2 . "' , '" . $weight3 . "' , '" . $weight4 . "' , '" . $weight5 . "' , '" . $results1 . "' , '" . $results2 . "' , '" . $results3 . "' , '" . $results4 . "' , '" . $results5 . "' , '" . $final_grade . "')";
        if ($db->query($gradeInsert) === true) {
            header('location:grades.php');
        } else {
            echo '<script>alert("Something went wrong  please try again later");</script>';
        }
    }
}

if (isset($_POST['calcGrade'])) {
    $Subject = mysqli_real_escape_string($db, $_POST['Subject']);
    $weight1 = mysqli_real_escape_string($db, $_POST['weight1']);
    $weight2 = mysqli_real_escape_string($db, $_POST['weight2']);
    $weight3 = mysqli_real_escape_string($db, $_POST['weight3']);
    $weight4 = mysqli_real_escape_string($db, $_POST['weight4']);
    $weight5 = mysqli_real_escape_string($db, $_POST['weight5']);
    $results1 = mysqli_real_escape_string($db, $_POST['results1']);
    $results2 = mysqli_real_escape_string($db, $_POST['results2']);
    $results3 = mysqli_real_escape_string($db, $_POST['results3']);
    $results4 = mysqli_real_escape_string($db, $_POST['results4']);
    $results5 = mysqli_real_escape_string($db, $_POST['results5']);
    $assessment1 = mysqli_real_escape_string($db, $_POST['Assessment1']);
    $assessment2 = mysqli_real_escape_string($db, $_POST['Assessment2']);
    $assessment3 = mysqli_real_escape_string($db, $_POST['Assessment3']);
    $assessment4 = mysqli_real_escape_string($db, $_POST['Assessment4']);
    $assessment5 = mysqli_real_escape_string($db, $_POST['Assessment5']);
    $total_weight = $weight1 + $weight2 + $weight3 + $weight4 + $weight5;
    //If the weight of all of the users garde for the module doesnt add up to 100 alert the user 
    if ($total_weight != 100) {
        echo "<script>alert('the weight of your grades doesnt add up to 100 please make the according changes');</script>";
    } else {
        //Calculate the grade for each assessment by multiplying the weight of the grade by the result of the assesment.
        $weight_results1 = ($weight1 * $results1) / 100;
        $weight_results2 = ($weight2 * $results2) / 100;
        $weight_results3 = ($weight3 * $results3) / 100;
        $weight_results4 = ($weight4 * $results4) / 100;
        $weight_results5 = ($weight5 * $results5) / 100;
        //Calculate the final grade by adding all of the weights and the results and then dividing them by each other and multiplying them by 100. 
        $total_weight = $weight1 + $weight2 + $weight3 + $weight4 + $weight5;
        $total_weight_results = $weight_results1 + $weight_results2 + $weight_results3 + $weight_score4 + $weight_results5;
        $final_grade = $total_weight_results / $total_weight * 100;

    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <?php getHeadTag(); ?>
    <link rel="stylesheet" href="style.css" />
</head>


<body>

    <div class="gradesPageContainer">
        <nav class="sidenav">
            <div>
                <div class="profileImgName">
                    <div>
                        <p>Welcome back,</p>
                        <h3><img style="width:20px; height:20px;" src="images/user.png" height=20px>
                            <?php //Display the users first name. 
                            echo $rowNAME['firstname']; ?>
                            <hr>
                        </h3>
                    </div>
                </div>
                <div class="sidenavElements"><a class="navBtnsHome" href="userhome.php"> Home</a> </div>
                <div class="sidenavElements"><a class="navBtnsStatistics" href="statistics.php"> Statistics</a> </div>
                <div class="sidenavElements"><a class="navBtnsProfile" href="profile.php"> Profile</a></div>
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

            <div class="greetingContainer">
                <div class="username">
                    <h2 class="emoji"> Grades 📘</h2>
                </div>
                <div class="dailyquote">
                    <div>
                        <h1 class="dailytag">Your daily motivation:</h1>
                        <div class="quote" id="quote"><?php
                        //Display the quote selected.
                        echo $row['quote']; ?></div>
                    </div>
                </div>
                <h2 class="dateContainer">
                    <?php
                    //Display todays date.
                    display_current_date(); ?>
                </h2>
            </div>
            <div class="gradesApplicationContainer">
                <div class="calculatorContainer">

                    <form method="post" action="grades.php">
                        <h1><img class="imgSize" src="images/calculator.png" height=20px> Calculator</h1>
                        <div class="calcWrapper">
                            <table class="calcTable">
                                <h2>Module</h2>
                                <tr class="calcGridStyle">
                                    <td class="calcGridStyle">
                                        <input class="calcInput" placeholder="Enter Module" type="text" name="Subject"
                                            required>
                                    </td>
                                </tr>
                                <tr class="calcGridStyle">
                                    <th class="calcGridStyle">Assessment</th>
                                    <th class="calcGridStyle">Weight (%)</th>
                                    <th class="calcGridStyle">Your results (%)</th>
                                </tr>
                                <tr class="calcGridStyle">
                                    <td class="calcGridStyle"><input class=" calcInput" type="text"
                                            placeholder="Assessment 1" name="Assessment1" maxlength="30"
                                            title="Assesment name must be less than 30 characters" required>
                                    </td>
                                    <td class="calcGridStyle">
                                        <input class="calcInput" type="number" value="0" name="weight1" min="0"
                                            max="100" required>
                                    </td>
                                    <td class="calcGridStyle"> <input class="calcInput" type="number" value="0"
                                            name="results1" min="0" max="100" required></td>
                                </tr>
                                <tr class="calcGridStyle">
                                    <td class="calcGridStyle"><input class="calcInput" type="text" value="empty"
                                            placeholder="Assessment 2" name="Assessment2" min="0" max="100"
                                            maxlength="30" title="Assesment name must be less than 30 characters"
                                            required>
                                    </td>
                                    <td class="calcGridStyle"><input class="calcInput" type="number" value="0"
                                            name="weight2" min="0" max="100" reqclass="calcInput" uired></td>
                                    <td class="calcGridStyle"><input class="calcInput" type="number" value="0"
                                            name="results2" min="0" max="100" required></td>
                                </tr>
                                <tr class="calcGridStyle">
                                    <td class="calcGridStyle"><input class="calcInput" type="text" value="empty"
                                            placeholder="Assessment 3" name="Assessment3" min="0" max="100"
                                            maxlength="30" title="Assesment name must be less than 30 characters"
                                            required>
                                    </td>
                                    <td class="calcGridStyle"><input class="calcInput" type="number" value="0"
                                            name="weight3" min="0" max="100" required>
                                    </td>
                                    <td class="calcGridStyle"><input class="calcInput" type="number" value="0"
                                            name="results3" min="0" max="100" required>
                                    </td>
                                </tr>
                                <tr class="calcGridStyle">
                                    <td class="calcGridStyle"><input class="calcInput" type="text" value="empty"
                                            placeholder="Assessment 4" name="Assessment4" min="0" max="100"
                                            maxlength="30" title="Assesment name must be less than 30 characters"
                                            required>
                                    </td>
                                    <td class="calcGridStyle"><input class="calcInput" type="number" value="0"
                                            name="weight4" min="0" max="100" required></td>
                                    <td class="calcGridStyle"><input class="calcInput" type="number" value="0"
                                            name="results4" min="0" max="100" required></td>
                                </tr>
                                <tr class="calcGridStyle">
                                    <td class="calcGridStyle"><input class="calcInput" type="text" value="empty"
                                            placeholder="Assessment 5" name="Assessment5" min="0" max="100"
                                            maxlength="30" title="Assesment name must be less than 30 characters"
                                            required>
                                    </td>
                                    <td class="calcGridStyle"><input class="calcInput" type="number" value="0"
                                            name="weight5" min="0" max="100" required></td>
                                    <td class="calcGridStyle"><input class="calcInput" type="number" value="0"
                                            name="results5" min="0" max="100" required></td>
                                </tr>
                            </table>
                            <br>
                            <button class="calculateButton" id="calculateButton" type="submit" name="calcGradeAndStore"
                                value="Calculate Grade">Calculate
                                and Store to Grades Portfolio</button>
                            <button class="calculateButton" id="calculateButton" type="submit" name="calcGrade"
                                value="Calculate Grade">Calculate
                                Grade</button>
                            <?php echo "<h2  class='finalGradeContainer' id='resultsContainer'>Your Final Grade for " . $Subject . " is " . round($final_grade, 2) . "%</h2>";


                            ?>
                        </div>
                    </form>
                </div>
                <div class="rightGradesContainer">
                    <table class="gradesTable">
                        <h1><img class="imgSize" src="images/grades.png" height=20px> Grades</h1>
                        <tr>
                            <th>Delete </th>
                            <th style="display:none">ID</th>
                            <th>Subject</th>
                            <th>Final Grade</th>
                            <th>Assessment 1</th>
                            <th>Assessment 2</th>
                            <th>Assessment 3</th>
                            <th>Assessment 4</th>
                            <th>Assessment 5</th>
                            <th>Weight 1</th>
                            <th>Weight 2</th>
                            <th>Weight 3</th>
                            <th>Weight 4</th>
                            <th>Weight 5</th>
                            <th>Result 1</th>
                            <th>Result 2</th>
                            <th>Result 3</th>
                            <th>Result 4</th>
                            <th>Result 5</th>


                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($resultGrades)) {
//display a table with theresults from the selected user grades and all of their details 
                            echo "<tr>";
                            echo '<td><form method="POST" action="grades.php"><button class="buttonDelete" onclick="location.reload()" type="submit" name="deleteGrade" action="userhome.php" value="' . $row["id"] . '"><img  src="images/delete_icon.png" height= 20px></button></form></td>';
                            echo "<td style='display:none'>" . $row["id"] . "</td>";
                            echo "<td>" . $row["subject"] . "</td>";
                            echo "<td>" . $row["finalGrade"] . "</td>";
                            echo "<td>" . $row["assessment1"] . "</td>";
                            echo "<td>" . $row["assessment2"] . "</td>";
                            echo "<td>" . $row["assessment3"] . "</td>";
                            echo "<td>" . $row["assessment4"] . "</td>";
                            echo "<td>" . $row["assessment5"] . "</td>";
                            echo "<td>" . $row["weight1"] . "</td>";
                            echo "<td>" . $row["weight2"] . "</td>";
                            echo "<td>" . $row["weight3"] . "</td>";
                            echo "<td>" . $row["weight4"] . "</td>";
                            echo "<td>" . $row["weight5"] . "</td>";
                            echo "<td>" . $row["results1"] . "</td>";
                            echo "<td>" . $row["results2"] . "</td>";
                            echo "<td>" . $row["results3"] . "</td>";
                            echo "<td>" . $row["results4"] . "</td>";
                            echo "<td>" . $row["results5"] . "</td>";


                            echo '</tr>';

//delete function that deletes the record from the datatbase with the same id as the one stored in the button on the same row
                            if (isset($_POST["deleteGrade"])) {
                                $id = $_POST["deleteGrade"];
                                $queryDel = ("DELETE FROM grades WHERE id = '$id'");
                                if ($query_exec = mysqli_query($db, $queryDel) == true) {
                                    echo "<script> window.location.href = 'grades.php';
        </script>";
                                    exit();

                                }
                            }
                        }
                        ?>
                    </table>
                    <div class="yearlyAvarage"> <?php
                    //displays the users yearly avarage
                    $sqlFinalGradesAvarage = "SELECT COUNT(*) AS num_rows, SUM(finalGrade) AS total_grade
        FROM grades
        WHERE email='$email'";
                    $resultGradesAvarage = $db->query($sqlFinalGradesAvarage);

                    // Check if there are any results
                    if ($resultGradesAvarage->num_rows > 0) {
                        // Get number of rows and total grade
                        $finalGradesRow = $resultGradesAvarage->fetch_assoc();
                        $num_rows = $finalGradesRow["num_rows"];
                        $total_FinalGrade = $finalGradesRow["total_grade"];

                        // Calculate average grade
                        $average_grade = round($total_FinalGrade / $num_rows, 2);

                        echo "For the current academic year you are avaraging $average_grade %";
                        // Output result
                    
                    } else {
                        echo "Insert grades to your portfolio to find out what you are avaraging for the year";
                    }
                    ?>
                    </div>
                </div>
            </div>

        </div>

    </div>

</body>

</html>