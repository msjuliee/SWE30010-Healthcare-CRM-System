<?php 

    include_once 'functions/general.php';

    $db = new MyDatabase();
    $auth = new Authentication($db);
    
    //refresh the page when deleting a friend
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
        if (isset($_POST['delete']) && $_POST['delete'] != '') {
            header("Location:friendlist.php");
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
 <title>Assignment 2 | Friend List</title>
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
            $user = new User($db, $session['ID']);
            $friends = new MyFriend($db);


            //* MANAGE PAGE NUMBER
            $page = 0;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }

            $allFriends = $friends->getFriendsOfAccount($user->getUserAccountID());     //get all friends of $user
            $allFriends = sortNameAtoZ($db, $allFriends);   //sort the displaying list

            $allPages = array_chunk($allFriends, 5, true);  //divide all people who are not friends of using account into 5-element sublists
            $pageOrder = array();

            //assign a Page Order to each 5-element sublist
            if (array_key_exists(($page), $allPages)) {
                $pageOrder = $allPages[$page];
            }

            //* WHEN DELETE BUTTON CLICKED 
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
                if (isset($_POST['delete']) && $_POST['delete'] != '') {
                    $friendid = filter_var($_POST['delete'], FILTER_SANITIZE_STRING);
                    $friendUser = new User($db, $friendid);
                    $friends->deleteFriends($user, $friendUser);
                    header("Location:friendlist.php");
                }
            }
    ?>

        <!-- Body: Friend List -->
        <?php 

            //*INTRODUCTION TITLE
            echo "<p class=\"heading\">{$user->getUserProfile()}'s Friend List Page</p>";
            echo "<p class=\"smallHeading\">Total number of friends is {$user->getFriendsNum()}.</p>"; 

            //DISPLAY THE LIST OF YOUR FRIENDS
            //getUserProfile(): Show Profile name
            //getFriendsNum(): Show number of friends

            if (!empty($pageOrder)) {
                foreach ($pageOrder as $friend) {
                    $user = new User($db, $friend);
                    echo "<div class=\"box\">";
                    echo "<div class=\"left\">
                            {$user->getUserProfile()}<br>   
                            <small>He/She has {$user->getFriendsNum()} friends</small>
                          </div>";
                    echo "
                        <div class=\"right\">
                        <form action=\"\" method=\"POST\">
                            <button class=\"friendButton\" name=\"delete\" value=\"{$user->getUserAccountID()}\" type=\"submit\">Unfriend</button>
                        </form>
                        </div>
                    ";
                    echo "</div>";
                }

            }
            else {
                echo "<p class=\"smallHeading\">You have no friend.</p>";
            }

            //* DISPLAY PAGE MANAGEMENT BUTTONS: Previous and Next
            $allPages;
            $page;
        
            include_once 'functions/pagination.php';
        }
        // if isAuth() = False -> You need to Log in before seeing your Friend List
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
        <a href="friendadd.php">ADD FRIENDS</a>
        <a href="logout.php">LOG OUT</a>
    </div>
    
</body>
</html>