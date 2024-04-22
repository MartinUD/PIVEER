<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
    function vardeGroj($first, $second){
        for ($i = 0; $i < $first; $i++){
            echo $first + $second*$i . "<br>";
        }


    }
    if(isset($_POST['first']) && isset($_POST['second'])){
        $first = $_POST['first'];
        $second = $_POST['second'];
        vardeGroj($first, $second);
    }
?>
<body>
    <form action="bhp.php" method="POST">
        <input type="text" name="first">
        <input type="text" name="second">
        <input type="submit" value="Submit"><br>
    </form> 
</body>
</html>