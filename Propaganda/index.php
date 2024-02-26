<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
    <title>Document</title>
    <script src="Scripts/imageChanger.js"></script>
    <script> 
        <?php    
        $files = scandir(__DIR__ . '/assets');

        $files = array_diff($files, array('.', '..'));

        $filesJSON = json_encode(array_values($files));
        ?>
        mylist = [];
        myList = <?php echo $filesJSON; ?>;
        contentChange(myList);
    </script>
</head>
<style>
    body{
        width: 100vw;
        height: 100vh;
        background-size: contain;
        overflow: hidden;
        cursor: none;
    }
</style>

<body>
    

</body>
</html>

