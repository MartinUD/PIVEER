<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function addTal($tal1, $tal2){
        if (!is_numeric($tal1) || !is_numeric($tal2)){
            echo "FALSE!";
            return;
        }
        echo "Summan är: " . ($tal1 + $tal2) . "<br>";
    }
        addTal(5, 10);
        addTal(5, "boll");
    
    ?>
</body>
</html>