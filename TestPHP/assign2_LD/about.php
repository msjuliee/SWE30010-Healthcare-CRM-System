<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <meta name="description" content="Web application development" />
 <meta name="keywords" content="PHP" />
 <meta name="author" content="Linh Dan Nguyen" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="style.css">
 <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
 <title>Assignment 1 About Me</title>
</head>
<body>
    <h1>
        <?php
           echo "PHP Version is: ". phpversion();
        ?>
    </h1>


    <style>
        <?php include 'style.css'; ?>
    </style>
    
    <!-- Header & Navigation Bar -->
    <?php include 'functions/header.php'; ?>

    
    <!-- Body: About Me Page-->
    
    <!-- Part 1: About Me -->
    <h1 class="heading">ABOUT ME</h1>
    <div class="aboutmeBox">
        <div class="aboutmeInfo">
            <p><b>Name :</b> Nguyen Linh Dan</p>
            <p><b>Student ID :</b> 103488557</p>
            <p><b>Email:</b> <a id="email">103488557@student.swin.edu.au</a></p>
        </div>
        <img src="style/sidePic.jpg" alt="info" class="sidePic">
    </div>
    
    
    
    <!-- The star icon -->
    <p id="icon">🌙🌙🌙</p>
    
    <!-- Part 2: About this assignment -->
    <h1 class="heading">ABOUT THIS ASSIGNMENT</h1>
    <h2 class="smallHeading">Questions</h2>
    
    <div class="questionSection"> <!-- 4 questions, each question has its box -->
        <div class="subSection">
            <div class="question">
                <p><b>Q1: What tasks you have not attempted or not completed?
                <br>Answer<br></b>
                I completed all tasks of Assignment 2
                </p>
            </div>
            <br>
            <div class="question">
                <p><b>Q2: What special features have you done<br>Answer<br></b>
                <ul>
                    <li>Encrypt users' passwords to enhance the security level</li>
                    <li>Users must Log In before seeing their Friend List or Add Friends</li>
                    <li>Users cannot see the Log In or Sign Up box when they have already signed in another account.</li>
                    <li>Friendly User Interface</li>
                </ul>
            </div>
        </div>

        <div class="subSection">
            <div class="question">
                <p><b>Q3: Which parts did you have trouble with?<br>Answer<br></b>
                I spent a lot of time thinking about different ways the attackers can use to exploit my website's vulnerabilities and steal users' information.<br>
                I tried to prevent being attacked as much as possible.
            </div>
            <br>
            <div class="question">
                <p><b>Q4: What would you like to do better next time?<br>Answer<br></b></p>
                <ul>
                    <li>Better color palette</li>
                    <li>Allow users uploading their profile photos</li>
                    <li>Allow users editing their information</li>
                </ul>
            </div>
        </div>
    </div>
    
    <br><br>
    
    <!-- Part 3: Discussion board -->
    <h2 class="smallHeading">Discussion Board</h2>
    <div class="discussionBoard">
        <p><b>A screenshot of my response that answered my lecture's question in the unit’s discussion board for Weekly content</b><br><br>
        I contributed to a Discussion about <b>The use of destructor and magic methods</b><br></p>
        <img src="style/response.jpg" id="response" alt="response">
    </div>
    
    <br><br>
    
    <!-- Part 3: Assignment Details (bonus) -->
    <h2 class="smallHeading">Assignment Details</h2>
    <div class="assignmentDetails">
        <div class="detailText">
            <h3>Assignment 2: My Friend System</h3>
            <ul>
                <li>Aim of this assignment: <div class="smallText">Create a simple network application. Users can create an account, log in to their accounts and perform actions on their friend lists (add, delete friends).</div></li>
                <br>
                <li>Website structure</li>
                
                <ul>
                    <li><div class="smallText">Homepage</div></li>
                    <li><div class="smallText">About Page</div></li>
                    <li><div class="smallText">Sign Up & Log In</div></li>
                    <li><div class="smallText">Friend List & Add Friends</div></li>
                </ul>
            </ul>
            
            
            <div class="languageList">
                <button id="language1">PHP</button>
                <button id="language2">HTML</button>
                <button id="language3">CSS</button>
                <button id="language4">MySQL</button>
            </div>
        </div>
        <img src="style/rabbit.jpg" alt="detail" class="sidePic">
    </div>
    
    <br><br>
    
    <!-- Bottom Link -->
    <div class="bottomLink">
        <a href="friendlist.php">FRIEND LISTS</a>
        <a href="index.php" id="middle_button">HOME</a>
        <a href="friendadd.php">ADD FRIENDS</a>
    </div>
    
    <br><br>
    
    <!--Footer-->
    <?php include 'functions/footer.php'; ?>
    
</body>
</html>