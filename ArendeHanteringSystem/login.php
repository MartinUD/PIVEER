<?php

session_start();
include 'db.php';

if(isset($_POST['username']) && isset($_POST['password'])){
    function validateData($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validateData($_POST['username']);
    $password = validateData($_POST['password']);

    if (empty($username)) {
        header("Location: index.php?error=User Name is required");
        exit();
    }else if(empty($password)){
        header("Location: index.php?error=Password is required");
        exit();
    }
    $sql = "SELECT * FROM users WHERE user_name = '$username' AND password = '$password'";
    
    $result = mysqli_query($conn, $sql);
   
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if($row['user_name'] === $username && $row['password'] === $password){
            $_SESSION['username'] = $row['user_name'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['id'] = $row['id'];
            header("Location: home.php");
            exit();
        }
        else{
            header("Location: index.php?error=Incorect User name or password");
            exit();
        }
    }
    else{
        header("Location: index.php");
        exit();
    }
}
else{
    header("Location: index.php");
    exit();
}

