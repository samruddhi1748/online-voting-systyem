<?php
session_start();
include("connect.php");


if(isset($_POST['mobile'], $_POST['password'], $_POST['role'])) {
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    
    $check = mysqli_query($connect, "SELECT * FROM owner WHERE mobile='$mobile' AND password='$password' AND role='$role'");
    
    
    if($check) {
        
        if(mysqli_num_rows($check) > 0) {
            $userdata = mysqli_fetch_array($check);

           
            $groups = mysqli_query($connect, "SELECT * FROM owner WHERE role=2");
            $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

            
            $_SESSION['userdata'] = $userdata;
            $_SESSION['groupsdata'] = $groupsdata;

            
            header("Location: dashboard.php");
            exit(); 
        } else {
           
            echo '<script>alert("User not found!"); window.location="login.html";</script>';
            exit();
        }
    } else {
        
        echo "Error: " . mysqli_error($connect);
    }
} else {
    
    echo "Error: Missing POST data";
}
?>
