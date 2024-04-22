<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Formception</h1>
    <?php
    session_start();
    if (isset($_GET['submit']) && isset($_SESSION['PostData'])) {
        echo "GET: " . htmlspecialchars($_SESSION['PostData']); 
    }
    ?>
    <form action="formception.php" method="POST">
        POST: <input type="text" name="name">
        <input type="submit" value="Submit"><br>
    </form> 
    <br>
    <?php
        if(isset($_POST['name'])){
            $_SESSION['PostData'] = $_POST['name'];
            echo '<form method="GET" action="formception.php">
                GET: <input type="submit" name="submit" value="Submit">
            </form>';
        }
    ?>
</body>
</html>