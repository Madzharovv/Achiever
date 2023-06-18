<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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
//Getting the first name of the user from the database so it can
$sqlName = "SELECT firstname FROM UserData WHERE email='$email'";
$resultName = mysqli_query($db, $sqlName);
if (mysqli_num_rows($resultName) == 1) {

    $rowNAME = mysqli_fetch_assoc($resultName);

}
// Select a random quote from the database
$sql = "SELECT quote FROM quotes ORDER BY RAND() LIMIT 1";
$result = mysqli_query($db, $sql);


//If 1 result is found display 1
if (mysqli_num_rows($result) == 1) {
    // Display the quote
    $row = mysqli_fetch_assoc($result);

}
//Selects the users email from the database
$sqlEvents = "SELECT * FROM Events WHERE email='$email'";
$resultEvents = mysqli_query($db, $sqlEvents);

//Selects all of the users tasks which have been completed
$sqlTask = "SELECT * FROM tasks WHERE email='$email' AND status='complete'";
$resultTask = mysqli_query($db, $sqlTask);

//Selects all of the user events that are Educational
$sqlEuctaionalEvents = "SELECT * FROM Events WHERE activityType = 'Educational' AND email='$email'";
$resultEuctaionalEvents = mysqli_query($db, $sqlEuctaionalEvents);
//Gets the  rows selected from the db
$num_rowsEuctaional = mysqli_num_rows($resultEuctaionalEvents);

//Selects all of the user events that are Physical
$sqlPhysicalEvents = "SELECT * FROM Events WHERE activityType = 'Physical' AND email='$email'";
$resultPhysicalEvents = mysqli_query($db, $sqlPhysicalEvents);
//Gets the  rows selected from the db
$num_rowsPhysical = mysqli_num_rows($resultPhysicalEvents);

//Selects all of the user events that are Personal
$sqlPersonalEvents = "SELECT * FROM Events WHERE activityType = 'Personal' AND email='$email'";
$resultPersonalEvents = mysqli_query($db, $sqlPersonalEvents);
//Gets the  rows selected from the db 
$num_rowsPersonal = mysqli_num_rows($resultPersonalEvents);

//Selects all of the user events that are Other
$sqlOtherEvents = "SELECT * FROM Events WHERE activityType = 'Other' AND email='$email'";
$resultOtherEvents = mysqli_query($db, $sqlOtherEvents);
//Gets the  rows selected from the db 
$num_rowsOther = mysqli_num_rows($resultOtherEvents);


//Selects all of the user events that are Hobby
$sqlHobbyEvents = "SELECT * FROM Events WHERE activityType = 'Hobby' AND email='$email'";
$resultHobbyEvents = mysqli_query($db, $sqlHobbyEvents);
//Gets the  rows selected from the db
$num_rowsHobby = mysqli_num_rows($resultHobbyEvents);

//Selecting the current week
$current_week_number = date('W');

//Selects all of the user events that are educational for the current week
$sqlEducationalWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activityType='Educational'";
$stmEducationalWeek = $db->query($sqlEducationalWeek);
//Gets the  rows selected from the db
$countstmEducationalWeek = $stmEducationalWeek->fetch_row()[0];

//Selects all of the user events that are Physical for the current week
$sqlPhysicalWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activityType='Physical'";
$stmPhysicalWeek = $db->query($sqlPhysicalWeek);
//Gets the  rows selected from the db
$countstmPhysicalWeek = $stmPhysicalWeek->fetch_row()[0];


//Selects all of the user events that are Personal for the current week
$sqlPersonalWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activityType='Personal'";
$stmPersonalWeek = $db->query($sqlPersonalWeek);
//Gets the  rows selected from the db
$countstmPersonalWeek = $stmPersonalWeek->fetch_row()[0];

//Selects all of the user events that are Hobby for the current week
$sqlHobbyWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activityType='Hobby'";
$stmHobbyWeek = $db->query($sqlHobbyWeek);
//Gets the  rows selected from the db
$countstmHobbyWeek = $stmHobbyWeek->fetch_row()[0];

//Selects all of the user events that are Other for the current week
$sqlOtherWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activityType='Other'";
$stmOtherWeek = $db->query($sqlOtherWeek);
//Gets the  rows selected from the db
$countstmOtherWeek = $stmOtherWeek->fetch_row()[0];

//Selects all of the user events that are lectures for the current week
$sqladvancedLectureWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activity='Lecture'";
$stmadvancedLectureWeek = $db->query($sqladvancedLectureWeek);
//Gets the  rows selected from the db
$countstmadvancedLectureWeek = $stmadvancedLectureWeek->fetch_row()[0];

//Selects all of the user events that are Study Sessions for the current week
$sqladvancedStudyWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activity='Study Session'";
$stmadvancedStudyWeek = $db->query($sqladvancedStudyWeek);
//Gets the  rows selected from the db
$countstmadvancedStudyWeek = $stmadvancedStudyWeek->fetch_row()[0];

//Selects all of the user events that are labs and or tutorials for the current week
$sqladvancedLabWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activity='Lab/Tutorial'";
$stmadvancedLabWeek = $db->query($sqladvancedLabWeek);
//Gets the  rows selected from the db
$countstmadvancedLabWeek = $stmadvancedLabWeek->fetch_row()[0];

//Selects all of the user events that are Relaxing for the current week
$sqladvancedRelaxingWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activity='Relaxing'";
$stmadvancedRelaxingWeek = $db->query($sqladvancedRelaxingWeek);
//Gets the  rows selected from the db
$countstmadvancedRelaxingWeek = $stmadvancedRelaxingWeek->fetch_row()[0];
//Selects all of the user events that are Runs for the current week
$sqladvancedRunWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activity='Run'";
$stmadvancedRunWeek = $db->query($sqladvancedRunWeek);
//Gets the  rows selected from the db
$countstmadvancedRunWeek = $stmadvancedRunWeek->fetch_row()[0];
//Selects all of the user events that are Gym sessions for the current week
$sqladvancedGymWeek = "SELECT COUNT(*) FROM Events WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTR(eventDate, 5, 15), '%b %d %Y')) = $current_week_number AND email='$email' AND activity='Gym'";
$stmadvancedGymWeek = $db->query($sqladvancedGymWeek);
//Gets the  rows selected from the db
$countstmadvancedGymWeek = $stmadvancedGymWeek->fetch_row()[0];

//Selects all of the user events that are Gyms sessions
$sqlGYMEvents = "SELECT * FROM Events WHERE activity='Gym' AND email='$email'";
$resultGYMEvents = mysqli_query($db, $sqlGYMEvents);
//Gets the  rows selected from the db
$num_rowsGYM = mysqli_num_rows($resultGYMEvents);

//Selects all of the user events that are Runs
$sqlRUNEvents = "SELECT * FROM Events WHERE activity = 'Run' AND email='$email'";
$resultRUNEvents = mysqli_query($db, $sqlRUNEvents);
//Gets the  rows selected from the db
$num_rowsRUN = mysqli_num_rows($resultRUNEvents);

//Selects all of the user events that are Relaxing sessions
$sqlRELAXEvents = "SELECT * FROM Events WHERE activity = 'Relaxing' AND email='$email'";
$resultRELAXEvents = mysqli_query($db, $sqlRELAXEvents);
//Gets the  rows selected from the db 
$num_rowsRelax = mysqli_num_rows($resultRELAXEvents);

//Selects all of the user events that are Labs and or Tutorials
$sqlLABEvents = "SELECT * FROM Events WHERE activity='Lab/Tutorial' AND email='$email'";
$resultLABEvents = mysqli_query($db, $sqlLABEvents);
//Gets the  rows selected from the db 
$num_rowsLAB = mysqli_num_rows($resultLABEvents);


//Selects all of the user events that are study sessions
$sqlSTUDYEvents = "SELECT * FROM Events WHERE activity='Study Session' AND email='$email'";
$resultSTUDYEvents = mysqli_query($db, $sqlSTUDYEvents);
//Gets the  rows selected from the db
$num_rowsSTUDY = mysqli_num_rows($resultSTUDYEvents);


//Selects all of the user events that are Hobby
$sqlLECTUREvents = "SELECT * FROM Events WHERE activity='Lecture' AND email='$email'";
$resultLECTUREEvents = mysqli_query($db, $sqlLECTUREvents);
//Gets the  rows selected from the db
$num_rowsLECTURE = mysqli_num_rows($resultLECTUREEvents);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <?php getHeadTag(); ?>



</head>

<body>

    <div class=" profilePageContainer">
        <div class="userHomeFullPageContainer">
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
                    <div class="sidenavElements"><a class="navBtnsGrades" href="grades.php"> Grades</a> </div>
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
            <div class="StatiscticPagecontainer">
                <div class="greetingContainer">
                    <div class="username">
                        <h2 class="emoji">Statistics 📊</h2>
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
                <div class="statisticTablesContainer">
                    <div class="EventsStatistics">
                        <div class="AllEventsTable">
                            <table class="EventsTable">
                                <h1><img class="imgSize" src="images/timetable.png" height=25px> All Events</h1>
                                <tr>
                                    <th>Delete </th>
                                    <th style="display:none">ID</th>
                                    <th>Date</th>
                                    <th>Activity Type</th>
                                    <th>Activity</th>
                                    <th>Activity Title</th>
                                    <th>Time</th>
                                    <th>Description</th>
                                </tr>
                                <?php while ($row = mysqli_fetch_assoc($resultEvents)) {

                                    echo "<tr>";
                                    echo '<td><form method="POST" action="statistics.php"><button class="buttonDelete" onclick="location.reload()" type="submit" name="deleteEvent" action="userhome.php" value="' . $row["id"] . '"><img  src="images/delete_icon.png" height= 20px></button></form></td>';
                                    echo "<td style='display:none'>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["eventDate"] . "</td>";
                                    echo "<td>" . $row["activityType"] . "</td>";
                                    echo "<td>" . $row["activity"] . "</td>";
                                    echo "<td>" . $row["activityTitle"] . "</td>";
                                    echo "<td>" . $row["activityDuration"] . "</td>";
                                    echo "<td>" . $row["eventDescription"] . "</td>";
                                    echo '</tr>';


                                    if (isset($_POST["deleteEvent"])) {
                                        $id = $_POST["deleteEvent"];
                                        $queryDel = ("DELETE FROM Events WHERE id = '$id'");
                                        if ($query_exec = mysqli_query($db, $queryDel) == true) {
                                            echo "<script> window.location.href = 'statistics.php';
                                                </script>";
                                            exit();

                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <hr>
                        <div class="statisticsContainerCombo">
                            <h1><img src="images/stats.png" height=30px>Your statistics</h1>
                            <div class="StatisticsSenteceContainer">
                                <div>
                                    <h2 class="statsTitle"> <img src="images/stats.png" height=25px> Summary Weekly
                                        Stats
                                    </h2>
                                    <div class="StatsContainers" style="margin-top:1em;">
                                        <p> Educational Activities scheduled and/or completed:
                                            <?php echo $countstmEducationalWeek; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Physical Activities scheduled and/or completed:
                                            <?php echo $countstmPhysicalWeek; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Personal Activities scheduled and/or completed:
                                            <?php echo $countstmPersonalWeek; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Hobby Activities scheduled and/or completed:
                                            <?php echo $countstmHobbyWeek; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> "Other" Activities scheduled and/or completed:
                                            <?php echo $countstmOtherWeek; ?>
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="statsTitle"> <img src="images/stats.png" height=25px> Summary
                                        Stats
                                    </h2>
                                    <div class="StatsContainers" style="margin-top:1em;">
                                        <p> Educational Activities scheduled and/or completed:
                                            <?php echo $num_rowsEuctaional; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Physical Activities scheduled and/or completed:
                                            <?php echo $num_rowsPhysical; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Personal Activities scheduled and/or completed:
                                            <?php echo $num_rowsPersonal; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Hobby Activities scheduled and/or completed:
                                            <?php echo $num_rowsHobby; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> "Other" Activities scheduled and/or completed:
                                            <?php echo $num_rowsOther; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="StatisticsSenteceContainer">
                                <div>
                                    <h2 class="statsTitle"> <img src="images/stats.png" height=25px> Advanced Weekly
                                        Stats
                                    </h2>
                                    <div class="StatsContainers" style="margin-top:1em;">
                                        <p> Lecture Activities scheduled and/or completed:
                                            <?php echo $countstmadvancedLectureWeek; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Study Sessions scheduled and/or completed:
                                            <?php echo $countstmadvancedStudyWeek; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Labs/tutorials scheduled and/or completed:
                                            <?php echo $countstmadvancedLabWeek; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Relaxing Activities scheduled and/or completed:
                                            <?php echo $countstmadvancedRelaxingWeek; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p>Gym sessions scheduled and/or completed:
                                            <?php echo $countstmadvancedGymWeek; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Runs scheduled and/or completed:
                                            <?php echo $countstmadvancedRunWeek; ?>
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="statsTitle"> <img src="images/stats.png" height=25px>Advanced Summary
                                        Stats
                                    </h2>
                                    <div class="StatsContainers" style="margin-top:1em;">
                                        <p> Lecture scheduled and/or completed:
                                            <?php echo $num_rowsLECTURE; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Study sessions scheduled and/or completed:
                                            <?php echo $num_rowsSTUDY; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Labs/Tutorials scheduled and/or completed:
                                            <?php echo $num_rowsLAB; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Relaxing sessions scheduled and/or completed:
                                            <?php echo $num_rowsRelax; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Gym sessions scheduled and/or completed:
                                            <?php echo $num_rowsGYM; ?>
                                        </p>
                                    </div>
                                    <div class="StatsContainers">
                                        <p> Runs scheduled and/or completed:
                                            <?php echo $num_rowsRUN; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="AllEventsTable">
                            <table class="tasksTable">
                                <div style="align-items:Left; width:100%;">
                                    <h1><img class="imgSize" src="images/to-do-list.png" height=25px>Completed Tasks
                                    </h1>
                                </div>
                                <tr>
                                    <th>Delete </th>
                                    <th style="display:none">ID</th>
                                    <th>Task</th>
                                    <th>Status</th>
                                </tr>
                                <?php while ($row = mysqli_fetch_assoc($resultTask)) {

                                    echo "<tr>";
                                    echo '<td><form method="POST" action="statistics.php"><button class="buttonDelete" onclick="location.reload()" type="submit" name="deleteCompleteTask" action="userhome.php" value="' . $row["id"] . '"><img  src="images/delete_icon.png" height= 20px></button></form></td>';
                                    echo "<td style='display:none'>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["task"] . "</td>";
                                    echo "<td>" . $row["status"] . "</td>";
                                    echo '</tr>';


                                    if (isset($_POST["deleteCompleteTask"])) {
                                        $id = $_POST["deleteCompleteTask"];
                                        $queryDel = ("DELETE FROM tasks WHERE id = '$id'");
                                        if ($query_exec = mysqli_query($db, $queryDel) == true) {
                                            echo "<script> window.location.href = 'statistics.php';
                                                </script>";
                                            exit();

                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>