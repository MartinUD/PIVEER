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
        .tickerHolder{
            display: flex;
            flex-direction: column;
            padding-top: 2rem;
            padding-right: 5rem;
            width: 100%;
            height: 27rem;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        .ticket{
            margin-bottom: 2rem;
            padding-right: 2rem;
            width: 100%;
            height: 100%;
        }
        .ticketStyle{
            background-color: transparent;
            color: white;
            border-radius: 1rem;
            border: 2px solid #2A3A54;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.5rem 1rem 0.5rem 1rem;
        }
        .ticketTitleAndIss{
            width: 100%;
            height: 20%;
            display: flex;
            flex-direction: row;
            align-items: end;
        }
        .ticketTitleAndIss > *{
            margin-right: 0.5rem;
        }
        .ticketDescription{
            margin-top: 0.5rem;
            background-color: transparent;
            border-radius: 1rem;
            outline: none;
            font-size: 1rem;
            color: white;
            border: 2px solid #2A3A54;
            height: 3.5rem;
            text-overflow: ellipsis;
            white-space: none;
            padding: 1rem;
            position: relative;
            line-height: 18px;
        }
        .spanDescription{
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        .ticketButtonsAndDate{
            margin-top: 0.5rem;
            width: 100%;   
            display: flex;
            flex-direction: row;
            align-items: end;
        }
        .bottomButtons{
            margin-right: 0.5rem;
            cursor: pointer;
        }
    </style>
    <body style="width: 100wh; height:100vh; overflow:hidden; margin: 0; background-color: #1e293b; color:white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div>
            <div style="display:flex; flex-direction: row;">
                <aside style="width: 13rem; display:flex; flex-direction: column; height: 100vh; background-color: #243248; display: flex;">
                    <a class="navrow">
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
                <div class="issues_dashboard" style="width: 100%; padding-left:2rem; padding-right: 5rem;">
                    <h1 style="margin-top: 2rem; margin-bottom: 1rem;">Hej, <?php echo $_SESSION['username']; ?></h1>
                    <div class="tickerHolder">
                        <?php
                             $sql = "SELECT id, title, issue_conversation, date, issuer, assinged_to, required_role FROM issues";
                             $result = mysqli_query($conn, $sql);

                             if($result){
                                    while($row = $result->fetch_assoc()){
                                        if($_SESSION['role'] === $row['required_role'] && $_SESSION['full_name'] === $row['assinged_to']){
                                            $title = $row['title'];
                                            $issue_conversation = $row['issue_conversation'];
                                            $required_role = $row['required_role'];
                                            $issuer = $row['issuer'];
                                            $assinged_to = $row['assinged_to'];
                                            $ticket_id = $row['id'];
                                            $date = $row['date'];

                                            echo "
                                            <div class='ticket'>
                                                <div class='ticketTitleAndIs'>
                                                    <h1 id='title' class='ticketStyle'>Ticket: {$title}</h1>
                                                    <h1 id='issue' class='ticketStyle'>Från: {$issuer}</h1>
                                                    <h1 id='id' class='ticketStyle'>Id: {$id}</h1>
                                                </div>
                                                <div class='ticketDescription'>
                                                    <span id='description'></span>
                                                </div>
                                                <div class='ticketButtonsAndDate'>
                                                    <a id='open' class='ticketStyle bottomButtons'>Öppna</a>
                                                    <a class='ticketStyle bottomButtons'>Stäng</a>
                                                    <h1 id='date' class='ticketStyle' style='margin-left:auto;'>Date</h1>
                                                </div>
                                            </div> 
                                            ";                
                                    }
                             }
                             }
                        ?>
                        <div class="ticket">
                            <div class="ticketTitleAndIss">
                                <h1 id="title" class="ticketStyle">Title</h1>
                                <h1 id="issue" class="ticketStyle">Issue</h1>
                                <h1 id="id" class="ticketStyle">Id</h1>
                            </div>
                            <div class="ticketDescription">
                                <span id="description"></span>
                            </div>
                            <div class="ticketButtonsAndDate">
                                <a id="open" class="ticketStyle bottomButtons">Öppna</a>
                                <a class="ticketStyle bottomButtons">Stäng</a>
                                <h1 id="date" class="ticketStyle" style="margin-left:auto;">Date</h1>
                            </div>
                        </div>
        
                    </div>
                    <script type="text/javascript">
                            function myJsFunction(parsedArray) {
                                let title = parsedArray[0];
                                let issue_conversation = parsedArray[1];
                                let required_role = parsedArray[2];
                                let issuer = parsedArray[3];
                                let assinged_to = parsedArray[4];
                                let ticket_id = parsedArray[5];
                                let date = parsedArray[6];

                                document.getElementById('title').innerHTML = title;
                                document.getElementById('issue').innerHTML = 'Från: ' + issuer;
                                document.getElementById('description').innerHTML = issue_conversation.conversation.text;
                                document.getElementById('id').innerHTML = 'ID: ' + ticket_id;
                                document.getElementById('open').setAttribute('href', `arende.php?id=${ticket_id}`);
                                document.getElementById('date').innerHTML = date;
                            }
                    </script>
                    <?php
                        $sql = "SELECT id, title, issue_conversation, date, issuer, assinged_to, required_role FROM issues";
                        $result = mysqli_query($conn, $sql);
                        function parseShitToJS($arguments) {
                            $functionName = 'myJsFunction';
                            echo ("<script type='text/javascript'> $functionName($arguments); </script>");
                        }
                    ?>
                    <?php



                        if ($result->num_rows > 0)  {
                            while ($row = $result->fetch_assoc()) {
                                if ($_SESSION['role'] === $row['required_role'] && $_SESSION['full_name'] === $row['assinged_to']) {
                                    $title = $row['title'];
                                    $issue_conversation = $row['issue_conversation'];
                                    $required_role = $row['required_role'];
                                    $issuer = $row['issuer'];
                                    $assinged_to = $row['assinged_to'];
                                    $ticket_id = $row['id'];
                                    $date = $row['date'];

                                    $decoded_conversation = json_decode($issue_conversation, true);
                                    $arguments = json_encode([$title, $decoded_conversation, $required_role, $issuer, $assinged_to, $ticket_id, $date]);
                                    parseShitToJS($arguments);
                                }
                            }
                            echo "</ul>";
                            } else {
                                echo "No issues found.";
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