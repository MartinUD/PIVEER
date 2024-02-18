<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="Scripts/imageChanger.js"></script>
    <script> 
        <?php
        $currentDir = __DIR__;

        $directoryPath = $currentDir . '/assets';
    
        $files = scandir($directoryPath);

        $files = array_diff($files, array('.', '..'));

        $filesArray = array_values($files);

        $filesJSON = json_encode($filesArray);
        ?>
        mylist = [];
        myList = <?php echo $filesJSON; ?>;
        contentChange(myList);
    </script>
</head>
<body>
    <h1>test</h1>
</body>
</html>