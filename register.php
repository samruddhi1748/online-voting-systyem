<?php
include("connect.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];


if ($password != $cpassword) {
    echo '<script>alert("Password and confirm password do not match!"); window.location="register.html";</script>';
    exit();
}


$uploadDirectory = "upload/";
$targetFile = $uploadDirectory . basename($image);

if (!move_uploaded_file($tmp_name, $targetFile)) {
    echo '<script>alert("Error uploading file!"); window.location="register.html";</script>';
    exit();
}


$insertQuery = "INSERT INTO hello.owner (name, mobile, password, address, photo, role, status, vote) VALUES ('$name', '$mobile', '$password', '$address', '$image', '$role', 0, 0)";

if (mysqli_query($connect, $insertQuery)) {
    echo '<script>alert("Registration Successful!"); window.location="dashboard.php";</script>';
    exit();
} else {
    echo '<script>alert("Error: ' . mysqli_error($connect) . '"); window.location="register.html";</script>';
    exit();
}
?>
