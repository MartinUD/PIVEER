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
            max-width: 5.5rem;
            cursor:pointer;
        }
    </style>
    <body style="width: 100wh; height:100vh; overflow:hidden; margin: 0; background-color: #1e293b; color:white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
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
                <br>
                <h1>Skapa Ärende</h1>
                <br>
                <?php
                $sql = "SELECT full_name FROM users WHERE role='support'";
                $result = mysqli_query($conn, $sql);
                echo "<label for='support' style='margin-bottom: 0.5rem;'>Support</label>" . "<br>";
                if(mysqli_num_rows($result) > 0){
                    echo "<select name='support' class='ticketStyle' style='width: 30%; margin-bottom: 0.5rem; outline: none;'>";
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='{$row['full_name']}'>{$row['full_name']}</option>";
                    }
                    echo "</select>";
                }
                
                if(isset($_POST['description'])){
                    $title = $_POST['title'];
                    $userId = $_SESSION['id'];
                    $date = date('Y-m-d', time());
                    $user = $_SESSION['username'];
                    $newIssue = array(
                        "conversation" => array(
                            "msg1" => array(
                                "text" => "{$_POST['description']}",
                                "timestamp" => "{$date}",
                                "user" => "{$user}"
                            )
                        )
                    );
                    $encodedNewIssue = json_encode($newIssue);
                    $sql = "INSERT INTO issues (title, required_role, date, issuer, assinged_to, issue_conversation) VALUES ('$title', 'user', '$date', '$user', 'Abdul Twopac', '$encodedNewIssue')";     
                    mysqli_query($conn, $sql);               
                }
                ?>
                <form action="createIssue.php" style="display:flex; flex-direction: column;" method="post">
                    <label for="title" style="margin-bottom: 0.5rem;">Titel</label>
                    <input type="text" name="title" class="ticketStyle" style="width: 30%; margin-bottom: 0.5rem; outline: none;" required>
                    <label for="description">Beskrivning</label>
                    <textarea name="description" class="ticketDescription" style="width: 100%;" required></textarea>
                    <button type="submit" class="ticketStyle sendButton" style="width: 100%;">Skapa</button>
                </form>
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