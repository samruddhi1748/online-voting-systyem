<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("location:login.html");
    exit();
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];




$status = isset($userdata['STATUS']) ? ($_SESSION['userdata']['STATUS'] == 0 ? '<b style="color:red;">Not voted</b>' : '<b style="color:green;">Voted</b>') : '<b style="color:gray;">Status unavailable</b>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #backbtn{
            padding: 5px;
            border-radius: 5px;
            background-color: #48dbfb;
            color:white;
            float:left;
            margin:10px;
        }
        #logoutbtn{
            padding: 5px;
           border-radius: 5px;
           background-color: #48dbfb;
           color:white;
           float:right;
           margin:10px;
        }
        #profile{
            background-color:white;
            width:30%;
            padding:20px;
            float:left;
        }
        #group{
            background-color:white;
            width:60%;
            padding:20px;
            float:right;
             margin-top: 0;
            
            
        }
        #votebtn{
            padding: 5px;
            border-radius: 5px;
            background-color: #48dbfb;
            color:white;
            
            
        }
        #main{
            float:left;
        }
        #mainsection{
            padding:10px;
        }
        #mainpanel{
            padding:10px;
        }
        #resultbtn {
    padding: 10px 20px; /* Adjust padding as needed */
    border-radius: 5px;
    background-color: #4CAF50; /* Green */
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
    border: none;
}

#resultbtn:hover {
    background-color: #45a049; /* Darker green */
}

#resultbtn a {
    color: white;
    text-decoration: none;
}

       
        </style>
</head>
<body>
    <div id="mainsection">
        <center>
        <div id="headersection">
            <button id="backbtn"><a href="login.html">Back</a></button>
            <button id="logoutbtn"><a href="logout.php">Logout</a></button>
            <h1>ONLINE VOTING SYSTEM</h1>
        </div>
    </center>
        <hr>
        <div id="mainpanel">
            <div id="profile">
                <?php
                if (isset($userdata['PHOTO']) && !empty($userdata['PHOTO'])) {
                    $imagePath = "upload/" . $userdata['PHOTO'];
                    if (file_exists($imagePath)) {
                        echo '<center><img src="' . $imagePath . '" alt="Profile Picture" height="100" width="100"><br></center>';
                    } else {
                        echo '<p>Profile picture not found</p>';
                    }
                } else {
                    echo '<p>No profile picture available</p>';
                }
                ?>
                <b>Name:</b> <?php echo isset($userdata['NAME']) ? $userdata['NAME'] : "N/A"; ?><br><br>
                <b>Mobile:</b> <?php echo isset($userdata['MOBILE']) ? $userdata['MOBILE'] : "N/A"; ?><br><br>
                <b>Address:</b> <?php echo isset($userdata['ADDRESS']) ? $userdata['ADDRESS'] : "N/A"; ?><br><br>
                <b>Status:</b> <?php echo $status; ?><br><br>
                <button id="resultbtn"><a href="result.php">View Results</a></button>
            </div>
            
            <div id="group">
    <?php
    if ($groupsdata) {
        foreach ($groupsdata as $group) {
            echo '<div class="group-container">';
           
            if (isset($group['PHOTO']) && !empty($group['PHOTO'])) {
                $imagePath = "upload/" . $group['PHOTO'];
                if (file_exists($imagePath)) {
                    echo '<img src="' . $imagePath . '" alt="Group Picture" height="100" width="100" style="float:right;"><br>';
                } else {
                    echo '<p>Profile picture not found</p>';
                }
            }
            
            echo '<b >Group name:</b> ' . $group['NAME'] . '<br>';
            
            echo '<b >Votes:</b> ' . $group['VOTE'] . '<br>';
            
            echo '<form action="vote.php" method="post">';
            echo '<input type="hidden" name="gvotes" value="' . $group['VOTE'] . '">';
            echo '<input type="hidden" name="gid" value="' . $group['ID'] . '">';
            echo '<input type="submit" name="votebtn" value="Vote" id="votebtn">';
            echo '</form>';
           
            echo '<hr>';
            echo '</div>'; 
        }
    } else {
        echo "No groups available.";
    }
    ?>
</div>


            
        </div>
    </div>
</body>
</html>