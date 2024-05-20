<?php
    session_start();
    
    include 'db.php';
    $ticketId = $_POST['id'] ?? null;

    $sql = "DELETE FROM issues WHERE id = $ticketId";
    $result = mysqli_query($conn, $sql);
    mysqli_query($conn, $sql);
    header("Location: home.php")
?>