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
        <link rel="stylesheet" href="home.css">
    <body style="width: 100wh; height:100vh; overflow:hidden; margin: 0; background-color: #1e293b; color:white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div style="display:flex; flex-direction: row;">
            <aside class="asideNav">
                <a class="navrow">
                    <i class="fa-solid fa-clipboard-list navRowIcon"></i>
                    <h1 class="navRowText showNone">Ärenden</h1>
                </a>
                <a class="navrow" href="createIssue.php">
                    <i class="fa-solid fa-plus navRowIcon"></i>
                    <h1 class="navRowText showNone">Skapa Ärende</h1>
                </a>
                <a href="logout.php" style="margin-top:auto; border-top: 2px solid #2A3A54;" class="navrow"> 
                    <i class="fa-solid fa-right-from-bracket navRowIcon"></i>
                    <h1 class="navRowText showNone">Logga Ut</h1>
                </a>
            </aside>
            <div class="issues_dashboard" style="width: 100%; padding-left:2rem; padding-right: 5rem;">
                <h1 style="margin-top: 2rem; margin-bottom: 1rem;">Hej, <?php echo $_SESSION['full_name']; ?></h1>
                <div class="tickerHolder">
                    <?php
                            // Fetch all tickets from the database
                            $sql = "SELECT id, title, issue_conversation, date, issuer, assinged_to, required_role FROM issues";
                            $result = mysqli_query($conn, $sql);

                            if($result){
                                while($row = $result->fetch_assoc()){
                                    if($_SESSION['full_name'] === $row['issuer'] or $_SESSION['full_name'] === $row['assinged_to']){
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
                                                <h1 id='issue' class='ticketStyle'>Till: {$assinged_to}</h1>
                                                <h1 id='id' class='ticketStyle'>Id: {$ticket_id}</h1>
                                            </div>
                                            <div class='ticketDescription'>
                                                <span id='description'>{$firstmsg}</span>
                                            </div>
                                            <div class='ticketButtonsAndDate'>
                                                <a id='open' class='ticketStyle bottomButtons' href='arende.php?id=${ticket_id}'>Öppna</a>
                                                <button class='ticketStyle bottomButtons' onclick='addCloseMenu(${ticket_id}, `${title}`)'>Stäng</button>
                                                <h1 id='date' class='ticketStyle date'>Date: {$date}</h1>
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
    // Function to add a close menu
    function addCloseMenu(ticketId, title) {
    
    const closeMenu = document.createElement('div');
    closeMenu.className = 'closeMenu';
    closeMenu.id = 'closeMenu';

    const closeMenuFG = document.createElement('div');
    closeMenuFG.className = 'closeMenuFG';

    const heading = document.createElement('h1');
    heading.style.textAlign = 'center';
    heading.style.paddingTop = '3rem';
    heading.textContent = 'Är du säker på att du vill avsluta detta ärende?';

    const closeMenuInfo = document.createElement('div');
    closeMenuInfo.className = 'closeMenuInfo';

    const ticketIdElement = document.createElement('h1');
    ticketIdElement.className = 'ticketStyle';
    ticketIdElement.textContent = `Ärende ID: ${ticketId}`;

    const titleElement = document.createElement('h1');
    titleElement.className = 'ticketStyle';
    titleElement.textContent = `Titel: ${title}`;

    closeMenuInfo.appendChild(ticketIdElement);
    closeMenuInfo.appendChild(titleElement);

    const bottomButtons = document.createElement('div');
    bottomButtons.className = 'bottomButtons';

    const yesButton = document.createElement('button');
    yesButton.className = 'ticketStyle bottomButton';
    yesButton.textContent = 'Ja';

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

    const noButton = document.createElement('button');
    noButton.className = 'ticketStyle bottomButton';
    noButton.textContent = 'Nej';
    noButton.onclick = function() {
        removeMenu();
    };

    bottomButtons.appendChild(yesButton);
    bottomButtons.appendChild(noButton);

    closeMenuFG.appendChild(heading);
    closeMenuFG.appendChild(closeMenuInfo);
    closeMenuFG.appendChild(bottomButtons);

    closeMenu.appendChild(closeMenuFG);

    document.body.appendChild(closeMenu);
}

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