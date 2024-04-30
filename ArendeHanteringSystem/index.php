<!DOCTYPE html>
<html lang="en" style="width: 100vw; height: 100vh; overflow:hidden;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color:#1e293b; width: 100vw; height: 100vh; display: flex; flex-direction:row; justify-content: center; align-items: center;">
    <form action="login.php" method="post" style="display:flex; flex-direction:column; gap: 0.5rem; align-items: center; font-size: 1.5rem; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <label style="color:white; margin-left: 0.5rem; margin-right: auto;">Användernamn</label>
        <div style="color:white;">
            <i class="fa-solid fa-user" style="position:absolute; transform: translate(1.2rem, 1.2rem); opacity:0.6; scale:0.75;"></i>
            <input type="text" name="username" placeholder="Användarnamn" style="color:white; border-radius: 3rem; text-indent: 2.5rem; outline: none; font-size: 1rem; background-color:transparent; border-width: 2px; border-style:solid; border-color:#334155; width: 25rem; height: 3rem;">
        </div>
        <label style="margin-left: 0.5rem; margin-right: auto; color:white;">Lösenord</label>
        <div style="color:white;">
        <i class="fa-solid fa-key" style="position:absolute; transform: translate(1.2rem, 1.2rem); opacity:0.6; scale:0.75;"></i>
            <input type="password" name="password" placeholder="Lösenord" style="color:white; border-radius: 3rem; text-indent: 2.5rem; outline: none; font-size: 1rem; background-color:transparent; border-width: 2px; border-style:solid; border-color:#334155; width: 25rem; height: 3rem;">
        </div>        <div style="margin-top:1rem;">
            <button style="color:white; width: 10rem; height: 3rem; outline: none; cursor:pointer; font-size: 1rem; border-radius: 3rem; background-color:transparent; border-width: 2px; border-style:solid; border-color:#334155;" type="submit">Logga in</button>
            <a style="color:white; text-decoration:none; width: 10rem; padding:0.75rem; outline: none; font-size: 1rem; border-radius: 3rem; background-color:transparent; border-width: 2px; border-style:solid; border-color:#334155;" href="jagglom.html">Glömt lösenordet</a>
        </div>
    </form>
</body>
<script src="https://kit.fontawesome.com/e46c856f03.js" crossorigin="anonymous"></script>
</html>

