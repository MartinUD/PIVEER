<?php
session_start();
include 'db.php';

if(isset($_SESSION['id']) && isset($_SESSION['username'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://kit.fontawesome.com/e46c856f03.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="arande.css">
    </head>
    <body style="width: 100wh; height:100vh; overflow:hidden; margin: 0; background-color: #1e293b; color:white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div style="display:flex; flex-direction: row;">
            <aside class="asideNav">
                <a class="navrow" href="home.php">
                    <i class="fa-solid fa-clipboard-list navRowIcon"></i>
                    <h1 class="navRowText showNone">Ärenden</h1>
                </a>
                <a class="navrow">
                    <i class="fa-solid fa-plus navRowIcon"></i>
                    <h1 class="navRowText showNone">Skapa Ärende</h1>
                </a>
                <a href="logout.php" style="margin-top:auto; border-top: 2px solid #2A3A54;" class="navrow"> 
                    <i class="fa-solid fa-right-from-bracket navRowIcon"></i>
                    <h1 class="navRowText showNone">Logga Ut</h1>
                </a>
                
            </aside>
            <div class="issues_dashboard" style="width: 100%; height: 100vh; padding-left:2rem; padding-right: 5rem; overflow-y: scroll;">
            <?php

                // Check if id is present in the query string and sanitize
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
                    
                    $sql = "SELECT id, title, issue_conversation, date, issuer, assinged_to, required_role FROM issues WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                        
                    
                    if ($result) {
                        // Fetch the data from the database
                        while($row = mysqli_fetch_assoc($result)) {
                            $data = json_decode($row['issue_conversation'], true);
                            $issue_conversation = $row['issue_conversation'];

                            echo "<br>";
                            echo "<h1 class='ticketStyle'>ID: {$row['id']}</h1>";
                            echo "<h1 class='ticketStyle'>" . 'Title: ' . $row['title'] . "</h1>";
                            echo "<h1 class='ticketStyle'>" . 'Datum: ' . $row['date'] . "</h1>";
                            echo "<h1 class='ticketStyle'>" . 'Ifrån: ' . $row['issuer'] . "</h1>";
                            echo "<h1 class='ticketStyle'>" . 'Till: ' . $row['assinged_to'] . "</h1>";
                            echo "<br>";
                            echo "<br>";
                            foreach ($data['conversation'] as $message) {
                                echo "
                                        <div class='message'>
                                            <p class='ticketStyle ticketDescription'>" . htmlspecialchars($message['text']) . "</p>
                                            <p class='ticketStyle '>" . 'Skickad av: ' . htmlspecialchars($message['user']) . "</p>
                                            <p class='ticketStyle'>" . 'Datum: ' . htmlspecialchars($message['timestamp']) . "</p>                                   
                                        </div>  
                                    ";
                            }
                            echo '
                            <h1>Skicka meddelande:</h1>
                            <form method="post">
                                    <textarea class="messageBox" name="meddelande" value="meddelande"></textarea> 
                                    <input type="submit" name="Skicka" class="ticketStyle sendButton" value="Skicka" /> 
                            </form>';
                            // send new message
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                if (isset($_POST['meddelande']) && !empty($_POST['meddelande'])) {
                                    echo "<br>";
                                    echo "<br>";
                                    $data = json_decode($issue_conversation, true);
                                    $lastMsgKey = array_key_last($data['conversation']);

                                    $numberPart = preg_replace('/[^0-9]/', '', $lastMsgKey);
                                    $newNumber = 'msg' . $numberPart + 1;
                                        
                                    $date = date('Y-m-d', time());
                                    $user = $_SESSION['full_name'];
                                    $newMessage = array(
                                        "text" => "{$_POST['meddelande']}",
                                        "timestamp" => "{$date}",
                                        "user" => "{$user}"
                                    );

                                    $data['conversation']["{$newNumber}"] = $newMessage;
                                    echo "<br>";
                                    echo "<br>";
                                    $encodedData = json_encode($data, JSON_UNESCAPED_UNICODE);
                                    $id = $row['id'];


                                    $sql = "UPDATE issues SET issue_conversation='$encodedData' WHERE id = $id";
                                    mysqli_query($conn, $sql);
                                    echo "<script>location.href='medelandeSkickat.php?id=$id'</script>";
                                    
                                } else {
                                    echo "Meddelande is empty";
                                }
                            }
                            $id = $row['id'];
                        echo "<h1>Ärende avslutat?</h1>";
                        echo "<form method='post' action='deleteIssue.php'>";
                        echo "<button type='submit' name='id' class='ticketStyle sendButton' value='{$id}'>Stäng</button>";
                        }
                        mysqli_free_result($result);
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    echo "No ID provided!";
                }
            ?>
            
        </div>
        </div>
</body>
</html>
<?php      
}
else{
    header("Location: index.php");
    exit();
    }
?>