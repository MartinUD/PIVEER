<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html, body{
            width: 100vw;
            height: 100vh;
            background-color: rgb(36, 41, 46);
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <form action="phpjavascr.php" method="POST">
        <input type="text" name="name" id="textfelt">
        <select name="tri-colour"> 
            <option value="RED">RED</option> 
            <option value="WHITE">WHITE</option> 
            <option value="BLUE">BLUE</option> 
        </select>
        <input type="submit" value="Submit" onclick="albert()"><br>
    </form> 
</body>
<script>
    function albert(){
        elem = document.createElement("h1");
        elem.id = 'text';
        elem.innerHTML = document.getElementById('textfelt').value;
    }
</script>
</html>