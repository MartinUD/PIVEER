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
                $sql = "SELECT id, title, description, required_role FROM issues";
                $result = mysqli_query($conn, $sql);

                // Check if the query returned any rows
                if ($result->num_rows > 0) {
                    echo "<h1>issues List</h1>";
                    echo "<ul>";

                    // Iterate over each row and display ticket information
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>";
                        echo "<strong>Title:</strong> " . htmlspecialchars($row['title']) . "<br>";
                        echo "<strong>Description:</strong> " . htmlspecialchars($row['description']) . "<br>";
                        echo "<strong>Required Role:</strong> " . htmlspecialchars($row['required_role']) . "<br>";
                        echo "<strong>Ticket ID:</strong> " . htmlspecialchars($row['id']) . "<br>";
                        echo "</li>";
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