<?php 
    
    include_once 'functions/general.php';
    $db = new MyDatabase();
    $auth = new Authentication($db);

    //refresh the page when adding a new friend
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            if (isset($_POST['add']) && $_POST['add'] != '') {
                header("Location: friendadd.php?");
            }
        }
    
?>

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
 <title>Assignment 2 | Friend Add</title>
</head>
<body>

    <style>
        <?php include 'style.css'; ?>
    </style>

    <!-- Header & Navigation Bar -->
    <?php include 'functions/header.php'; ?>
    
    <?php
        
        //If user has already logged in one account -> isAuth() = True
        if ($auth->isAuth()) {

            $session = $auth->authSessionSetup();
            $myUser = new User($db, $session['ID']);
            $friends = new MyFriend($db);

            //* MANAGE PAGE NUMBER
            $page = 0;  //initial page = 0

            if (isset($_GET['page'])) {
                $page = $_GET['page'];  //update Page = current page
            }   

            
            $allUser = $friends->getAllAccounts($myUser->getUserAccountID());   //get all account except $myUser
            $friendList = $friends->getFriendsOfAccount($myUser->getUserAccountID());   //get all friends of $myUser
            $subUserList = array_diff($allUser, $friendList);   //get all people who are not friends of $myUser
            $allPages = array_chunk($subUserList, 5, true); //divide all people who are not friends of using account into 5-element sublists
           
            $pageOrder = array();

            //assign a Page Order to each 5-element sublist
            if (array_key_exists(($page), $allPages)) {
                $pageOrder = $allPages[$page];
            }


            //* WHEN ADD BUTTON CLICKED 
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
                if (isset($_POST['add']) && $_POST['add'] != '') {
                    $friendid = filter_var($_POST['add'], FILTER_SANITIZE_STRING);
                    $friendUser = new User($db, $friendid);
                    $friends->addNewFriends($myUser, $friendUser);
                    header("Location: friendadd.php?");
                }
            }
    ?>

    <!-- Body: Friend List -->
    <?php 

        //*INTRODUCTION TITLE
        echo "<p class=\"heading\">{$myUser->getUserProfile()}'s Add Friend Page</p>";
        $numOfUser = count($subUserList);
        if ($numOfUser > 1) {
            if ($numOfUser == 1) {
                echo "<p class=\"smallHeading\">You have {$myUser->getFriendsNum()} friends.<br>$numOfUser person is waiting for you!</p>";
            }
            else {
                echo "<p class=\"smallHeading\">You have {$myUser->getFriendsNum()} friends.<br>$numOfUser people are waiting for you!</p>";
            }
        }


        //DISPLAY THE LIST OF ALL PEOPLE YOU CAN ADD AS A FRIEND
        if (!empty($pageOrder)) {
            foreach ($pageOrder as $p) {
                $user_check = new User($db, $p);    //a person you are looking at in the list
                $numOfMutual = $friends->countMutual($myUser->getUserAccountID(), $user_check->getUserAccountID());
                $message = $numOfMutual == 1 ? "$numOfMutual mutual friend" : "$numOfMutual mutual friends";

                echo "<div class=\"box\">";
                    echo "<div class=\"left\">";
                        echo "{$user_check->getUserProfile()} <br> <small>$message</small>";
                        
                    echo "</div>";
                    echo "
                        <div class=\"right\">
                        <form action=\"\" method=\"POST\">
                            <button class=\"friendButton\" name=\"add\" value=\"{$user_check->getUserAccountID()}\" type=\"submit\">Add as friend</button>
                        </form>
                        </div>
                    ";
                echo "</div>";
                
            }
        }
        else {
                echo "<p class=\"smallHeading\">Everyone is your friends already.</p>";
        }
    

        //* DISPLAY PAGE MANAGEMENT BUTTONS: Previous and Next
        $allPages;
        $page;
        
        include_once 'functions/pagination.php';
        }

        // if isAuth() = False -> You need to Log in before seeing your Add Friend List
        else {
            echo "<div id=\"messageSection\">";
            echo "<p id=\"message\">Please Log In or Create An Account</p>";
            echo "<div class=\"bottomLink\">
                <a href=\"signup.php\">SIGN UP</a>
                <a href=\"login.php\">LOG IN</a>
                </div>
                </div>
            ";
            exit();
        }
    ?>
    
    <!-- Bottom Link -->
    <div class="bottomLink">
        <a href="friendlist.php">FRIEND LISTS</a>
        <a href="logout.php">LOG OUT</a>
    </div>
    
</body>
</html>