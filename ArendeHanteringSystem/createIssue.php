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
        <link rel="stylesheet" href="createIssue.css">
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
                <br>
                <h1>Skapa Ärende</h1>
                <br>
                <?php
                
                
                if(isset($_POST['description'])){
                    $title = $_POST['title'];
                    $userId = $_SESSION['id'];
                    $date = date('Y-m-d', time());
                    $user = $_SESSION['full_name'];
                    $support = $_POST['support'];
                    $newIssue = array(
                        "conversation" => array(
                            "msg1" => array(
                                "text" => "{$_POST['description']}",
                                "timestamp" => "{$date}",
                                "user" => "{$user}"
                            )
                        )
                    );
                    $encodedNewIssue = json_encode($newIssue, JSON_UNESCAPED_UNICODE);
                    $sql = "INSERT INTO issues (title, required_role, date, issuer, assinged_to, issue_conversation) VALUES ('$title', 'support', '$date', '$user', '$support', '$encodedNewIssue')";     
                    mysqli_query($conn, $sql);               
                }
                ?>
                <form action="createIssue.php" style="display:flex; flex-direction: column;" method="post">
                    <?php
                    $sql = "SELECT full_name FROM users WHERE role='support'";
                    $result = mysqli_query($conn, $sql);
                    echo "<label for='support' style='margin-bottom: 0.5rem;'>Support</label>" . "<br>";
                    if(mysqli_num_rows($result) > 0){
                        echo "<select name='support' class='ticketStyle supportInput' style='width: 30%; margin-bottom: 0.5rem; outline: none;'>";
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='{$row['full_name']}'>{$row['full_name']}</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                    <label for="title" style="margin-bottom: 0.5rem;">Titel</label>
                    <input type="text" name="title" class="ticketStyle titleInput" required>
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