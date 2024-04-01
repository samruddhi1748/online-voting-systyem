<?php
session_start();
include('connect.php');


if(isset($_SESSION['userdata']) && $_SESSION['userdata']['STATUS'] == 1) {
    
    echo '
    <script>
    alert("You have already voted!");
    window.location="dashboard.php";
    </script>
    ';
    exit(); 
}


if(isset($_POST['gvotes'], $_POST['gid'], $_SESSION['userdata']['ID'])) {
    
    $votes = mysqli_real_escape_string($connect, $_POST['gvotes']);
    $gid = mysqli_real_escape_string($connect, $_POST['gid']);
    $uid = mysqli_real_escape_string($connect, $_SESSION['userdata']['ID']);
    
   
    $total_votes = $votes + 1;

    
    $update_votes = mysqli_query($connect, "UPDATE owner SET VOTE='$total_votes' WHERE ID='$gid'");

    
    $update_user_status = mysqli_query($connect, "UPDATE owner SET STATUS=1 WHERE ID=$uid");

   
    if ($update_votes && $update_user_status) {
        
        $groups = mysqli_query($connect, "SELECT ID, NAME, VOTE, PHOTO FROM owner WHERE ROLE=2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        
        $_SESSION['userdata']['STATUS'] = 1;
        $_SESSION['groupsdata'] = $groupsdata;


        echo '
        <script>
        alert("Voting successful!");
        window.location="dashboard.php";
        </script>
        ';
        exit(); 
    } else {
        
        echo '
        <script>
        alert("Some error occurred!");
        window.location="dashboard.php";
        </script>
        ';
        exit(); 
    }
} else {
    
    echo '
    <script>
    alert("Required data missing!");
    window.location="dashboard.php";
    </script>
    ';
    exit(); 
}
?>
