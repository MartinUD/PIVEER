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
        </head>
        <body>
            <h1>Hej, <?php echo $_SESSION['username']; ?> som har rollen <?php echo $_SESSION['role']; ?> som heter i namn <?php echo $_SESSION['full_name']?> </h1>
            <a href="logout.php">Logout</a> 
            <?php
                $sql = "SELECT id, title, issue_conversation, date, issuer, assinged_to, required_role FROM issues";
                $result = mysqli_query($conn, $sql);
            
                function parseShitToJS($title, $issue_conversation, $required_role, $issuer, $assigned_to, $ticket_id, $date) {
                    $functionName = 'myJsFunction';
                    //echo $issue_conversation;
                    $arguments = json_encode([$title, $issue_conversation, $required_role, $issuer, $assigned_to, $ticket_id, $date, true]);
                    echo ("<script type='text/javascript'> $functionName($arguments); </script>");
                }
                ?>
                <script type="text/javascript">
                    function myJsFunction(title) {
                        console.log(title);
                    }
                </script>
                <?php
                // Check if the query returned any rows
                if ($result->num_rows > 0)  {
                    echo "<h1>issues List</h1>";
                    echo "<ul>";

                    // Iterate over each row and display ticket information
                    while ($row = $result->fetch_assoc()) {
                        if ($_SESSION['role'] === $row['required_role'] && $_SESSION['full_name'] === $row['assinged_to']) {
                            $title = $row['title'];
                            $issue_conversation = $row['issue_conversation'];
                            $required_role = $row['required_role'];
                            $issuer = $row['issuer'];
                            $assinged_to = $row['assinged_to'];
                            $ticket_id = $row['id'];
                            $date = $row['date'];

                            parseShitToJS($title, $issue_conversation, $required_role, $issuer, $assinged_to, $ticket_id, $date);
                        }
                    }

                        echo "</ul>";
                    } else {
                        echo "No issues found.";
                    }
                    ?>
        </body>
        </html>
        <?php
        
    }
    else{
        header("Location: index.php");
        exit();
    }
    ?>