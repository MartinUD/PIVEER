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
        <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>    </head>
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
            display: flex;
            flex-direction: row;
            align-items: start;
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
        .closeMenu{
            top: 0;
            left: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .closeMenuFG{
            border-radius: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 50%;
            height: 70%;
            z-index: 5;
            background-color: #243248;
        }
        .bottomButtons{
            margin-top: auto;
            margin-bottom: 2rem;
        }
        .bottomButton{
            cursor: pointer;
            font-size: 2rem;
            margin: 0.5rem;
        }
        .closeMenuInfo{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin-top: 1rem;
        }
    </style>
    <body style="width: 100wh; height:100vh; overflow:hidden; margin: 0; background-color: #1e293b; color:white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div style="display:flex; flex-direction: row;">
            <aside style="width: 13rem; display:flex; flex-direction: column; height: 100vh; background-color: #243248; display: flex;">
                <a class="navrow">
                    <i class="fa-solid fa-clipboard-list navRowIcon"></i>
                    <h1 class="navRowText">Ärenden</h1>
                </a>
                <a class="navrow" href="createIssue.php">
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
                                        $issue_conversation = ($row['issue_conversation']);
                                        $required_role = $row['required_role'];
                                        $issuer = $row['issuer'];
                                        $assinged_to = $row['assinged_to'];
                                        $ticket_id = $row['id'];
                                        $date = $row['date'];
                                        
                                        $data = json_decode($issue_conversation, true);
                                        $firstmsg = $data['conversation']['msg1']['text'];


                                        echo "
                                        <div class='ticket'>
                                            <div class='ticketTitleAndIss'>
                                                <h1 id='title' class='ticketStyle'>Title: {$title}</h1>
                                                <h1 id='issue' class='ticketStyle'>Från: {$issuer}</h1>
                                                <h1 id='id' class='ticketStyle'>Id: {$ticket_id}</h1>
                                            </div>
                                            <div class='ticketDescription'>
                                                <span id='description'>{$firstmsg}</span>
                                            </div>
                                            <div class='ticketButtonsAndDate'>
                                                <a id='open' class='ticketStyle bottomButtons' href='arende.php?id=${ticket_id}'>Öppna</a>
                                                <button class='ticketStyle bottomButtons' onclick='addCloseMenu(${ticket_id}, `${title}`)'>Stäng</button>
                                                <h1 id='date' class='ticketStyle' style='margin-left:auto;'>Date: {$date}</h1>
                                            </div>
                                        </div> 
                                        ";                
                                }
                            }
                            }
                    ?>
                </div>
                
                <?php
                    $sql = "SELECT id, title, issue_conversation, date, issuer, assinged_to, required_role FROM issues";
                    $result = mysqli_query($conn, $sql);
                    function parseShitToJS($arguments) {
                        $functionName = 'myJsFunction';
                        echo ("<script type='text/javascript'> $functionName($arguments); </script>");
                    }
                ?>
            </div>
        </div>
</body>
</html>
<script>
    function addCloseMenu(ticketId, title) {
    
    // Create a div element for the close menu
    const closeMenu = document.createElement('div');
    closeMenu.className = 'closeMenu';
    closeMenu.id = 'closeMenu';

    // Create a nested div element for the close menu foreground
    const closeMenuFG = document.createElement('div');
    closeMenuFG.className = 'closeMenuFG';

    // Create an h1 element with the specified styles and text
    const heading = document.createElement('h1');
    heading.style.textAlign = 'center';
    heading.style.paddingTop = '3rem';
    heading.textContent = 'Är du säker på att du vill avsluta detta ärende?';

    // Create the info div
    const closeMenuInfo = document.createElement('div');
    closeMenuInfo.className = 'closeMenuInfo';

    // Create the ticket ID and title elements
    const ticketIdElement = document.createElement('h1');
    ticketIdElement.className = 'ticketStyle';
    ticketIdElement.textContent = `Ärende ID: ${ticketId}`;

    const titleElement = document.createElement('h1');
    titleElement.className = 'ticketStyle';
    titleElement.textContent = `Titel: ${title}`;

    // Append the ticket ID and title to the info div
    closeMenuInfo.appendChild(ticketIdElement);
    closeMenuInfo.appendChild(titleElement);

    // Create the bottom buttons div
    const bottomButtons = document.createElement('div');
    bottomButtons.className = 'bottomButtons';

    // Create the "Ja" button
    const yesButton = document.createElement('button');
    yesButton.className = 'ticketStyle bottomButton';
    yesButton.textContent = 'Ja';

    // Add click event to post to deleteIssue.php
    yesButton.addEventListener('click', () => {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'deleteIssue.php';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id';
        input.value = ticketId;

        form.appendChild(input);
        document.body.appendChild(form);

        form.submit();
    });

    // Create the "Nej" button with an onclick event
    const noButton = document.createElement('button');
    noButton.className = 'ticketStyle bottomButton';
    noButton.textContent = 'Nej';
    noButton.onclick = function() {
        removeMenu();
    };

    // Append the buttons to the bottom buttons div
    bottomButtons.appendChild(yesButton);
    bottomButtons.appendChild(noButton);

    // Append all elements to the close menu foreground div
    closeMenuFG.appendChild(heading);
    closeMenuFG.appendChild(closeMenuInfo);
    closeMenuFG.appendChild(bottomButtons);

    // Append the close menu foreground div to the close menu div
    closeMenu.appendChild(closeMenuFG);

    // Append the close menu div to the body (or another desired parent element)
    document.body.appendChild(closeMenu);
}

// Function to remove the close menu from the DOM
function removeMenu() {
    const closeMenu = document.getElementById('closeMenu');
    if (closeMenu) {
        closeMenu.remove();
    }
}
</script>
<?php      
}
else{
    header("Location: index.php");
    exit();
    }
?>