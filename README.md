ACHIEVER
by Valentin Madzharov


This is a self-sustainable time-management web application for university students in particular that will allow them to schedule timetables containing academic and non-academic activities that they take part in their daily lives alongside keeping track of their grades.

The application:
Front-end:HTML, CSS, PHP, vanilaJS, jQuery
Back-end:MySQL MariaDB


Login Details:
email:user@gmail.com
password:User12345*
*feel free to create other accounts too*

Project tree structure:

Achiever
    ├── README.md
    ├── backend
    │   └── Achiever.sql
    └── pages
        ├── forgotPassword.php
        ├── getter.php
        ├── grades.php
        ├── home.php
        ├── images
        │   ├── activity.png
        │   ├── calculator.png
        │   ├── check_icon.png
        │   ├── class-notes.png
        │   ├── delete_icon.png
        │   ├── grades.png
        │   ├── gradessc.png
        │   ├── icon.png
        │   ├── profile1.png
        │   ├── profile2.png
        │   ├── statistics1.png
        │   ├── statistics2.png
        │   ├── statistics3.png
        │   ├── stats.png
        │   ├── time.png
        │   ├── timetable.png
        │   ├── timetablesc.png
        │   ├── to-do-list.png
        │   ├── user.png
        │   ├── userhome1.png
        │   └── userhome2.png
        ├── includes
        │   └── config.php
        ├── jquery.js
        ├── login.php
        ├── newPassword.php
        ├── profile.php
        ├── script.js
        ├── signup.php
        ├── statistics.php
        ├── stylesheets
        │   └── stylesheets.css
        └── userhome.php

Prerequisites
In order for you to run this application download the following applications and follow the setup steps:


Download XAMPP from:
https://www.apachefriends.org/


Download Visual Studio code from:
https://code.visualstudio.com/download


INSTALLING AND SETUP


XAMPP (installation and setup)
1. When you open the XAMPP link provided above select the system you will be running the application on and click download.
2. Select the download folder as the folder to which the XAMPP download file will be downloaded to.


MAC users:
3. Once downloaded if using Mac click on the file downloaded which then would show you the icon of the XAMPP software which you should double-click.
4. You will be asked if you would like to open the file to which you should click the open button.
5. Then you will be asked to enter your credentials.
6. Then the installation process will begin.
7. Click next to begin the installation process until you are asked to select the location where you would like XAMPP to be installed and the you should click next again until the installation progress bar appears and installation begins.
8. Once the process finishes tick the launch now box and then click the finish button.
9. The control panel will then appear where you will need to click on manage servers
10. click on the start all button and wait until the status of all servers is running or at least the Apache server and MySQL database servers are running.


Windows and other users:
3. Once downloaded double click on the file downloaded which will result in a message for access appearing.
4. Then you will be asked to enter your credentials or to confirm to give access for the application's use on the device.
5. Then the installation process will begin.
6. Click "next" to begin the installation process on the pop-up window and tick all boxes where asked to in order to install all of the features of XAMPP and select where you would like XAMPP to be installed. Proceed to click next until the installation progress bar appears and installation begins.
7. Once the process finishes tick the launch now box and then click the finish button.
8. The control panel will then appear and you should click start on the Apache server as well as the MySQL server.

------------------------------------------------------------------------------------------------

Visual Studio Code (Setup and installation)
1. Visit the link above and select the system you would like to set up Visual Studio on.
2. click the download button and choose the downloads folder as the location where you would like to save the downloaded file to.


MAC Users:
1. Double-click the downloaded file which will result in the vs code icon appearing.
2. Move the launch icon to your desktop for easy access or where appropriate.


Windows Users:
1. Double-click the downloaded file
2. The setup window will appear where you will have to agree with the terms and conditions of VS code and then you should select the folder where you would like vs code to be setup in.
3. Follow the steps provided by either pressing next or finish in order to complete the installation process.
4. Create a shortcut to the desktop of your computer for easy access.

---------------------------------------------------------------------------------------------------
Project Initialisation and Launch
1. Downloaded the Product code package and unzip it, a folder called "Acheiver" will be output.
2. Navigate to the location on your computer where your XAMPP folder is and go inside the htdocs folder located in the XAMPP. The path name of the folder should be similar to this: "..../XAMPP/htdocs/".
3. There create a folder called "mac" and paste the project folder you downloaded and unzipped earlier called "Achiever" into the "mac" folder.


Check if the Apache server is running and check if the MySQL server is running too. If they both are running you should now set up the database.


Database setup and Project launch
1. Go to the following link: in your browser http://localhost/phpmyadmin/index.php?route=/
2. On the left side of the website there is a nav bar and you should press the new button to create a new database and name it Achiever then click the create button.
3. Then click on the SQL button in the top navigation bar and copy all of the content from Ahiever.sql by using VS code to open the file which is located in the project folder in the backend folder and paste them into the SQL text section and then press the import button located at the bottom of the page.
4. If successful you should receive a lot of successful query alerts.
5. Now the database is set up you can go to the web applications home page by going to the following link:
http://localhost/mac/Achiever/pages/home.php



