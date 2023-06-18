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
}

//Query that Selects a random quote from the database.
$sql = "SELECT quote FROM quotes ORDER BY RAND() LIMIT 1";
$result = mysqli_query($db, $sql);
//Email Assignment
$email = $_SESSION['loggedin'];

//Check if theres 1 result fromm the query.
if (mysqli_num_rows($result) == 1) {
    // Load the qoute in a row in order to display it.
    $row = mysqli_fetch_assoc($result);
}


//Query which selects the first name of the logged in user from the database.
$sqlName = "SELECT firstname FROM UserData WHERE email='$email'";
$resultName = mysqli_query($db, $sqlName);

if (mysqli_num_rows($resultName) == 1) {
    // Load the first name in a row in order to display it. 
    $rowNAME = mysqli_fetch_assoc($resultName);
}

// Check if the taskSubmit form has been submitted.
if (isset($_POST['taskSubmit'])) {
    // Sanitize input data and declare variables.
    $task = mysqli_real_escape_string($db, $_POST['task']);
    //When creating all tasks, beforeinserting them into the db, create them as incompleted.
    $status = "incomplete";
    // Execute INSERT query for inserting tasks into the database. 
    $sql = "INSERT INTO tasks (task, email, status) VALUES ('" . $task . "', '" . $email . "', '" . $status . "')";

    //If the query is successful reload the page.
    if ($db->query($sql) === true) {
        echo '<script> window.location.href = "userhome.php";</script>';
    } else
    // Display the follwoing alert if the query was unsuccessful.
    {
        echo '<script>alert("Task has not been added please try again later");</script>';
    }
}
// Check if the addnote form has been submitted.
if (isset($_POST['addnote'])) {
    // Sanitize input data and declare variables.
    $notetitle = mysqli_real_escape_string($db, $_POST['notetitle']);
    $notedescription = mysqli_real_escape_string($db, $_POST['notedescription']);
    // Execute INSERT query for inserting notes into the database. 
    $sql = "INSERT INTO notes (noteTitle, noteDescription ,email) VALUES ('" . $notetitle . "','" . $notedescription . "', '" . $email . "')";
    //If the query is successful reload the page.
    if ($db->query($sql) === true) {
        echo '<script> window.location.href = "userhome.php";</script>';
    } else
    // Display the follwoing alert if the query was unsuccessful.
    {
        echo '<script>alert("Note has not been added please try again later");</script>';
    }
}
// Check if the saveEvent form has been submitted
if (isset($_POST['saveEvent'])) {
    // Sanitize input data and declare variables.
    $activityType = mysqli_real_escape_string($db, $_POST['activityType']);
    $activity = mysqli_real_escape_string($db, $_POST['activity']);
    $activityTitle = mysqli_real_escape_string($db, $_POST['eventTitle']);
    $eventDescription = mysqli_real_escape_string($db, $_POST['eventDescription']);
    $eventDate = mysqli_real_escape_string($db, $_POST['date']);
    $eventTime = mysqli_real_escape_string($db, $_POST['eventTime']);
    // Execute INSERT query for inserting events into the database. 
    $sql = "INSERT INTO Events (eventDate, activityType, activity, activityTitle, activityDuration,eventDescription,email) VALUES ('" . $eventDate . "', '" . $activityType . "', '" . $activity . "', '" . $activityTitle . "', '" . $eventTime . "', '" . $eventDescription . "', '" . $email . "')";
    if ($db->query($sql) === true) {
        //Reload the page by setting the header to the page location.
        header('location:userhome.php');
    }
}
// Select statement which selects all of the notes of the user that is logged in. 
$sqlNote = "SELECT id, noteTitle, noteDescription FROM notes WHERE email='$email'";
$resultNote = mysqli_query($db, $sqlNote);
//If the query is successfull reload the page. 
if ($db->query($sqlNote) === true) {
    header('location:userhome.php');
}
// Select statement which selects all of the to-do tasks of the user that is logged in. 
$sqlTask = "SELECT id, task FROM tasks WHERE email='$email' AND status='incomplete'";
$resultTask = mysqli_query($db, $sqlTask);
//If the query is successfull reload the page. 
if ($db->query($sqlTask) === true) {
    header('location:userhome.php');
}
//Select statement that selects all of the tasks the user has completed.
$sqlTodoComplete = "SELECT * FROM tasks WHERE status = 'complete' AND email='$email'";
$resultTodoComplete = mysqli_query($db, $sqlTodoComplete);
//Finds the number of rows selected from the query above.
$num_rows = mysqli_num_rows($resultTodoComplete);
if ($db->query($sqlTodoComplete) === true) {
    header('location:userhome.php');
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php getHeadTag(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class=" userHomeFullPageContainer">
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
                <div class="sidenavElements"><a class="navBtnsGrades" href="grades.php"> Grades</a> </div>
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
        <div class="UserHomecontainer">
            <div class="greetingContainer">
                <div class="username">
                    <h2 class="emoji">Home 🏡</h2>
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
            <div class="applicationsContainer">
                <div class="upperContainer">
                    <div class="notesContainer">
                        <div>
                            <h1 class="notesTitleStyle"><img class="imgSize" src="images/class-notes.png" height=10px>
                                Notes</h1>
                            <form action="userhome.php" enctype="multipart/form-data" method="POST">
                                <div class="todoInnerContainer">
                                    <label for="title"> Title</label>
                                    <input class="titleNoteInput" type="text" id="notetitle" name="notetitle"
                                        placeholder="Note Title" maxlength="20"
                                        title="The title should be less than 20 characters" required>
                                </div>
                                <div class="todoInnerContainer">
                                    <label for="desc" class="form-label">Description</label>
                                    <textarea class="notedescription" name="notedescription" id="notedescription"
                                        maxlength="200" required></textarea>
                                </div>
                                <div>
                                    <button class="userNoteSubButton" type="submit" name="addnote">Add Note</button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <table class="notesTable">

                                <tr>
                                    <th style="display:none">ID</th>
                                    <th>Title</th>
                                    <th>Note</th>
                                    <th>Delete</th>
                                </tr>
                                <?php //Display the results of the note select statement in a table format.
                                while ($row = mysqli_fetch_assoc($resultNote)) {
                                    echo "<tr>";
                                    echo "<td style='display:none'>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["noteTitle"] . "</td>";
                                    echo "<td>" . $row["noteDescription"] . "</td>";
                                    // Form containing a delete button which has the value of the "Id" of the note displayed on the respective row.
                                    echo '<td><form method="POST" action="userhome.php">
                                    <button class="buttonDelete" onclick="location.reload()" type="submit" name="deleteNote" action="userhome.php" value="' . $row["id"] . '">
                                        <img  src="images/delete_icon.png" height= 20px></button>
                                </form></td>';
                                    echo '</tr>';
                                   //If statement which is triggered when the delete button is pressed.
                                    if (isset($_POST["deleteNote"])) {
                                        //The value of the button is the id of the row which the note is stored in which is delcated to the id variable.
                                        $id = $_POST["deleteNote"];
                                        //Delete the record in the database that has the same id as the id stored in the delete button .
                                        $queryDel = ("DELETE FROM notes WHERE id = '$id'");
                                        if ($query_exec = mysqli_query($db, $queryDel) == true) {
                                            //If the query is successfull reload the page.
                                            echo "<script> window.location.href = 'userhome.php';
                                            </script>";
                                            exit();
                                        }else{
                                            echo "<script> window.location.href = 'userhome.php';
                                            </script>";
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="todolistcontainer">
                        <div>
                            <h1 class="todoTitleStyle"><img class="imgSize" src="images/to-do-list.png" height=10px>
                                To-do</h1>
                            <form action="userhome.php" enctype="multipart/form-data" method="POST" class="taskForm">
                                <p>Enter a task</p>
                                <input class="inputTaskContainer" type="text" placeholder="Task" name="task" required
                                    id="task" maxlength="90"></input>
                                <div class="todobuttonAllignment"><input class="userTodoSubButton" type="submit"
                                        name="taskSubmit" value="Add Task">
                                    </input></div>
                                <div style="margin-top:1em;"></div>Number of tasks completed: <?php //Display the number of tasks the user has completed. 
                            echo $num_rows; ?>
                        </div>


                        </form>

                    </div>
                    <div class="TableFullContainer">
                        <table class="todoTable">
                            <tr>
                                <th style="display:none">ID</th>
                                <th>Task</th>
                                <th>Complete</th>
                            </tr>
                            <?php
                                //Display the results of the to-do task select statement in a table format. 
                                while ($row = mysqli_fetch_assoc($resultTask)) {
                                    echo "<tr>";
                                    echo "<td style='display:none'>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["task"] . "</td>";
                                // Form containing a Complete button which has the value of the "Id" of the note displayed on the respective row.
                                    echo '<td><form class="completeButtonContainer" method="POST" action="userhome.php" >
                                    <button  class="buttonComplete" type="submit" name="completeTask" action="userhome.php" value="' . $row["id"] . '">
                                    <img class="checkIcon"src="images/check_icon.png" height= 20px></button></button>
                                </form></td>';
                                    echo '</tr>';
                                //If statement which is triggered when the complete button is pressed.
                                    if (isset($_POST["completeTask"])) {
                                //The value of the button is the id of the row which the task is stored in which is delcated to the id variable.
                                        $id = $_POST["completeTask"];
                                         //Change the status of row to complete in the database that has the same id as the id stored in the complete button .
                                        $queryCom = ("UPDATE tasks SET status='complete' WHERE id = '$id'");
                                        if ($query_exec = mysqli_query($db, $queryCom) == true) {
                                             //If the query is successfull reload the page.
                                            echo "<script> window.location.href = 'userhome.php';</script>";
                                            exit();
                                        }else{echo "<script> window.location.href = 'userhome.php';
                                            </script>";}
                                    }
                                } ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="calendarContainer">
                <div class="container">
                    <div class="left">
                        <h1 style="color:black;"><img class="imgSize" src="images/timetable.png" height=25px>
                            Timetable
                        </h1>
                        <div class="calendar">
                            <div class="month">
                                <i class="fas fa-angle-left prev">
                                </i>
                                <div class="date"></div>
                                <i class="fas fa-angle-right next"></i>
                            </div>
                            <div class="weekdays">
                                <div>Sun</div>
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                            </div>
                            <div class="days"></div>
                            <div class="goto-today">
                                <div class="goto">
                                    <input type="text" placeholder="mm/yyyy" class="date-input" />
                                    <button class="goto-btn">Go</button>
                                </div>
                                <button class="today-btn">Today</button>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="today-date">
                            <div class="event-day"></div>
                            <div class="event-date"></div>
                        </div>
                        <div class="events"></div>
                        <form action="userhome.php" method="POST">
                            <div class="add-event-wrapper">
                                <div class="add-event-header">
                                    <div class="title">Add Event</div>
                                </div>
                                <div class="add-event-body">
                                    <div class="add-event-input">
                                        <select id="eventTitleInput" name="activityType" class="eventActivity"
                                            placeholder="Event Title" onchange="changeDropdown()" required>
                                            <option value="none">Select an Activity</option>
                                            <option value="Educational">Educational</option>
                                            <option value="Physical">Physical</option>
                                            <option value="Personal">Personal</option>
                                            <option value="Hobby">Hobby</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="add-event-input">
                                        <select name="activity" class="eventActivity" id="activitySelect" required>
                                            <option value=" none">Select an Activity</option>
                                        </select>
                                    </div>
                                    <div class="add-event-input">
                                        <input type="text" placeholder="Event Name" class="event-name" maxlength="20"
                                            required name="eventTitle" />
                                    </div>

                                    <div class="add-event-input">
                                        <input type="text" name="eventTime" placeholder="10:00AM-11:00AM"
                                            pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]-([01]?[0-9]|2[0-3]):[0-5][0-9]"
                                            class="timeDuration"
                                            title="Enter the time duration in the follwoing format HH:MM-HH:MM" />
                                    </div>
                                    <div class="add-event-input">
                                        <input type="text" placeholder="Event Description" name="eventDescription"
                                            class="eventActivityDescription" maxlength="60" required />
                                    </div>
                                    <div>
                                        <input style="display:none" value="1" name="date" />
                                    </div>
                                </div>
                                <div class="add-event-footer">
                                    <button type="submit" name="saveEvent" class="add-event-btn">Add
                                        Event</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button class="add-event">
                        <i>+</i>
                    </button>
                </div>
                <script src="script.js"></script>
                <p class=Notif>To delete your events visit the statistics page.</p>
            </div>
        </div>
    </div>
</body>
<script>
//Fucntion which changes the secondary dropdown box that is activity depending on the type of activity is selected.
function changeDropdown(e) {

    const eventTitleInput = document.getElementById("eventTitleInput");
    const activitySelect = document.getElementById("activitySelect");

    if (eventTitleInput.value === "Educational") {
        activitySelect.innerHTML = `
    
    <option name=" activity" value="Lecture">Lecture</option>
    <option name=" activity" value="Study Session">Study Session</option>
    <option name=" activity" value="Meeting">Meeting</option>
    <option name=" activity" value="Lab/Tutorial">Lab/Tutorial</option>
    <option name=" activity" value="Other">Other</option>
      `;
        activitySelect.style.display = "block";
    } else if (eventTitleInput.value === "Physical") {
        activitySelect.innerHTML = `
    <option  name=" activity" value="Gym">Gym</option>
    <option name=" activity" value="Run">Run</option>
    <option name=" activity" value="Walk">Walk</option>
    <option name=" activity" value="Cycling">Cycling</option>
    <option name=" activity" value="Swimming">Swimming</option>
    <option name=" activity" value="Dancing">Dancing</option>
    <option name=" activity" value="Yoga">Yoga</option>
    <option name=" activity" value="Other">Other</option>
      `;
        activitySelect.style.display = "block";
    } else if (eventTitleInput.value === "Hobby") {

        activitySelect.innerHTML = `
    <option name=" activity" value="Football">Football</option>
    <option name=" activity" value="Cricket">Cricket</option>
    <option name=" activity" value="Basketball">Basketball</option>
    <option name=" activity" value="Voleyball">Voleyball</option>
    <option name=" activity" value="Tennis">Tennis</option>
    <option name=" activity"  value="Table Tennis">Table Tennis</option>
    <option name=" activity"  value="Read a book">Read a book</option>
    <option name=" activity" value="Gaming">Gaming</option>
    <option name=" activity" value="Chess">Chess</option>
    <option name=" activity" value="Other">Other</option>
      `;
        activitySelect.style.display = "block";
    } else if (eventTitleInput.value === "Personal") {
        activitySelect.innerHTML = `
                        <option value="Relaxing">Relaxing</option>
    <option value="Time With Family">Time With Family</option>
    <option value="Time with Friends">Time with Friends</option>
    <option  value="Time with Partner">Time with Partner</option>
    <option  value="Time with Partner">Meditation</option>
    <option name=" activity" value="Other">Other</option>
      `;
        activitySelect.style.display = "block";
    } else if (eventTitleInput.value === "Other") {
        activitySelect.style.display = "none";
    } else if (eventTitleInput.value === "Other") {
        activitySelect.style.display = "Select an Activity";
    } else if (eventTitleInput.value === "") {
        activitySelect.style.display = "none";
    }
}
</script>


</html>