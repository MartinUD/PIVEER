<!DOCTYPE html>
<html lang="en" style="width: 100vw; height: 100vh; overflow:hidden;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="indexcss.css">
</head>
<body>
    <form action="login.php" method="post" style="display:flex; flex-direction:column; gap: 0.5rem; align-items: center; font-size: 1.5rem; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <label class="labelStyle">Användernamn</label>
        <div style="color:white;">
            <i class="fa-solid fa-user" style="position:absolute; transform: translate(1.2rem, 1.2rem); opacity:0.6; scale:0.75;"></i>
            <input type="text" name="username" placeholder="Användarnamn" class="loginField">
        </div>
        <label class="labelStyle">Lösenord</label>
        <div style="color:white;">
        <i class="fa-solid fa-key" style="position:absolute; transform: translate(1.2rem, 1.2rem); opacity:0.6; scale:0.75;"></i>
            <input type="password" name="password" placeholder="Lösenord" class="loginField">
        </div>        
        <div style="margin-top:1rem;">
            <button class="buttonStyle" type="submit">Logga in</button>
            <a class="buttonStyle" style="padding:0.75rem; text-decoration:none;" href="jagglom.html">Glömt lösenordet</a>
        </div>
    </form>
</body>
<script src="https://kit.fontawesome.com/e46c856f03.js" crossorigin="anonymous"></script>
</html>

