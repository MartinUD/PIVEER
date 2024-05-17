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
    </head>
    <style>
        *{
            margin: 0;
        }
        h1{
            font-size: 1.5rem;
        }
        .navrow{
            transition: 0.25s;
            display: flex;
            justify-content: left;
            align-items: center;
            width: 100%;
            height: 3rem;
            border-bottom: 2px solid #2A3A54;
        }
        .navrow:hover{
            background-color: #2A3A54;
        }
        .navRowText{
            margin-left: 0.5rem;
            font-size: large;
            color: white;
            font-weight: 600;
        }
        .navRowIcon{
            margin-left: 0.5rem;
            color: white;
        }
        .ticketStyle{
            background-color: transparent;
            color: white;
            border-radius: 1rem;
            border: 2px solid #2A3A54;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.5rem 1rem 0.5rem 1rem;
            display:flex;
            justify-content: center;
            display: inline-block;
            margin-right: 0.5rem;
        }
        .ticketDescription{
            margin-top: 0.5rem;
            background-color: transparent;
            border-radius: 1rem;
            outline: none;
            font-size: 1rem;
            width: 100%;
            color: white;
            border: 2px solid #2A3A54;
            min-height: 3.5rem;
            text-overflow: ellipsis;
            white-space: none;
            padding: 1rem;
            position: relative;
            line-height: 18px;
            margin-bottom: 0.5rem;
        }
        .message{
            margin-bottom: 1rem;
        }
        .ellipsis{
            margin: auto;
            color: #2A3A54;
            font-size: 2.5rem;
        }
        .elipsis-container{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2.5rem;
        }
        .messageBox{
            width: 100%;
            margin-top: 0.5rem;
            background-color: transparent;
            border-radius: 1rem;
            outline: none;
            font-size: 1rem;
            color: white;
            border: 2px solid #2A3A54;
            min-height: 5rem;
            text-overflow: ellipsis;
            white-space: none;
            padding: 1rem;
            position: relative;
            line-height: 18px;
            margin-bottom: 0.5rem;
            min-width: 100%;
            max-width: 100%;
        }
        .sendButton{
            margin-bottom: 10rem;
            cursor:pointer;
        }
    </style>
    <body style="width: 100wh; height:100vh; overflow:hidden; margin: 0; background-color: #1e293b; color:white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div>
            <div style="display:flex; flex-direction: row;">
                <aside style="width: 13rem; display:flex; flex-direction: column; height: 100vh; background-color: #243248; display: flex;">
                    <a class="navrow" href="home.php">
                        <i class="fa-solid fa-clipboard-list navRowIcon"></i>
                        <h1 class="navRowText">Ärenden</h1>
                    </a>
                    <a class="navrow">
                        <i class="fa-solid fa-plus navRowIcon"></i>
                        <h1 class="navRowText">Skapa Ärende</h1>
                    </a>
                    <a href="logout.php" style="margin-top:auto; border-top: 2px solid #2A3A54;" class="navrow"> 
                        <i class="fa-solid fa-right-from-bracket navRowIcon"></i>
                        <h1 class="navRowText">Logga Ut</h1>
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
                            while($row = mysqli_fetch_assoc($result)) {
                                $data = json_decode($row['issue_conversation'], true);
                                $issue_conversation = $row['issue_conversation'];

                                echo "<br>";
                                echo "<h1 class='ticketStyle'>ID: {$row['id']}</h1>";
                                echo "<h1 class='ticketStyle'>" . 'Title: ' . $row['title'] . "</h1>";
                                echo "<h1 class='ticketStyle'>" . 'Datum: ' . $row['date'] . "</h1>";
                                echo "<h1 class='ticketStyle'>" . 'Ifrån: ' . $row['issuer'] . "</h1>";
                                echo "<h1 class='ticketStyle'>" . 'Till: ' . $row['assinged_to'] . "</h1>";
                                echo "<h1 class='ticketStyle'>" . 'Roll som krävs: ' . $row['required_role'] . "</h1>";
                                echo "<br>";
                                echo "<br>";
                                foreach ($data['conversation'] as $message) {
                                    // Create a paragraph with the message details
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

                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    if (isset($_POST['meddelande']) && !empty($_POST['meddelande'])) {
                                        echo "<br>";
                                        echo "<br>";
                                        $data = json_decode($issue_conversation, true);
                                        $lastMsgKey = array_key_last($data['conversation']);

                                        $numberPart = preg_replace('/[^0-9]/', '', $lastMsgKey);
                                        $newNumber = 'msg' . $numberPart + 1;
                                            
                                        $date = date('Y-m-d', time());
                                        $user = $_SESSION['username'];
                                        $newMessage = array(
                                            "text" => "{$_POST['meddelande']}",
                                            "timestamp" => "{$date}",
                                            "user" => "{$user}"
                                        );

                                        $data['conversation']["{$newNumber}"] = $newMessage;
                                        echo "<br>";
                                        echo "<br>";
                                        $encodedData = json_encode($data, JSON_PRETTY_PRINT);
                                        $id = $row['id'];

                                        $sql = "UPDATE issues SET issue_conversation='$encodedData' WHERE id = $id";
                                        if (mysqli_query($conn, $sql)) {
                                        echo "Record updated successfully";
                                            } 
                                        else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                        }
                                    } else {
                                        echo "Meddelande is empty";
                                    }
                                }
                            }
                            // Free result set
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