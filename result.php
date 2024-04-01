<?php
session_start();
@include('connect.php'); 


$groups = mysqli_query($connect, "SELECT NAME, VOTE FROM owner WHERE ROLE = 2");
$groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);


$max_votes = 0;
$winner = '';
foreach ($groupsdata as $group) {
    if ($group['VOTE'] > $max_votes) {
        $max_votes = $group['VOTE'];
        $winner = $group['NAME'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
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
        table {
            border-collapse: collapse;
            width: 50%;
            margin: auto;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .winner {
            font-weight: bold;
            color: green;
            background-color:gold;
            text-align:center;
            font-family:cursive;
        }
        #tb{
            border:2px black solid;
        }

    </style>
</head>
<body>

<center>
        <div id="headersection">
        <button id="backbtn"><a href="dashboard.php">Back</a></button>
            <button id="logoutbtn"><a href="logout.php">Logout</a></button>
        <h1>ONLINE VOTING SYSTEM</h1>
        </div>
    </center>
    <hr>
    <h2>Results:</h2>
    <table id="tb">
        <tr>
            <th>Group Name</th>
            <th>Votes</th>
        </tr>
        <?php
        foreach ($groupsdata as $group) {
            echo "<tr>";
            echo "<td>{$group['NAME']}</td>";
            echo "<td>{$group['VOTE']}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h3 id="winner">Winner:</h3>
<marquee>
    <h2 class="winner">
        <?php 
        $equal_winners = array(); 
        
        foreach ($groupsdata as $group) {
            if ($group['VOTE'] == $max_votes) {
                $equal_winners[] = $group['NAME']; 
            }
        }
        
        if (count($equal_winners) == 1) {
            echo $equal_winners[0] . " is winner with " . $max_votes . " votes";
        } else {
            echo "!! Both ";
            echo implode(" and ", $equal_winners) . " have equal votes !!";
        }
        ?>
    </h2>
</marquee>

</body>
</html>
