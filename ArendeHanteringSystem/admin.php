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
        <link rel="stylesheet" href="admin.css">
    </head>
    <body style="width: 100wh; height:100vh; overflow:hidden; margin: 0; background-color: #1e293b; color:white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div style="display:flex; flex-direction: row;">
            <aside class="asideNav">
                <a class="navrow" href="admin.php">
                    <i class="fa-solid fa-plus navRowIcon"></i>
                    <h1 class="navRowText showNone">Skapa Användare</h1>
                </a>
                <a href="logout.php" style="margin-top:auto; border-top: 2px solid #2A3A54;" class="navrow"> 
                    <i class="fa-solid fa-right-from-bracket navRowIcon"></i>
                    <h1 class="navRowText showNone">Logga Ut</h1>
                </a>
                
            </aside>
            <div class="issues_dashboard" style="width: 100%; height: 100vh; padding-left:2rem; padding-right: 5rem; overflow-y: scroll;">
                <br>
                <h1>Skapa Användare</h1>
                <form action="admin.php" method="post">
                    <input type="text" name="username" placeholder="Användarnamn" class="ticketStyle">
                    <input type="text" name="password" placeholder="Lösenord" class="ticketStyle">
                    <input type="text" name="full_name" placeholder="Namn och Efternamn" class="ticketStyle">
                    <select name="role" placeholder="role" class="ticketStyle">Skapa
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="support">Support</option>
                    </select>
                    <button type="submit" class="ticketStyle">Skapa</button>
                </form>
                <?php
                if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])){
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $hashedPassword = hash('sha256', $password);
                    $full_name = $_POST['full_name'];
                    $role = $_POST['role'];
                    $sql = "INSERT INTO users (user_name, password, role, full_name) VALUES ('$username', '$hashedPassword', '$role', '$full_name')";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        echo "<p class='message'>Användare skapad</p>";
                    }
                    else{
                        echo "<p class='message'>Användare kunde inte skapas</p>";
                    }
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