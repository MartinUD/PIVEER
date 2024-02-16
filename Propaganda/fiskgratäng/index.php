<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
    <title>Document</title>
    <link rel="stylesheet" href="">
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
    
    <?php
    $currentDir = __DIR__;

    $directoryPath = $currentDir . '/assets';
    
    $files = scandir($directoryPath);

    $files = array_diff($files, array('.', '..'));

    $filesArray = array_values($files);

    

    $filesJSON = json_encode($filesArray);
    ?>
    
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var interval;
            var randomBild;
            var linearBild;
            fetch('/PIVEER/Propaganda/fiskgratäng/settings.json')
            .then(response => response.json())
            .then(data => {
                interval = parseInt(data.interval);
                randomBild = data.randomBild;
                linearBild = data.linearBild;
            
            console.log(interval, randomBild, linearBild)


            myList = []
            myList = <?php echo $filesJSON; ?>;

            function pickRandomNumber() {
                
                const randomNumber = Math.floor(Math.random() * myList.length);
                document.body.style.backgroundImage = `url('${'assets/' + myList[randomNumber]}')`;
            }
            function pickLinarNumber() {
                listLen = myList.length;
                for (let i = 0; i < listLen; i++) {
                    document.body.style.backgroundImage = `url('${'assets/' + myList[i]}')`;
                    sleep(interval);
                }


                const randomNumber = Math.floor(Math.random() * myList.length);
                document.body.style.backgroundImage = `url('${'assets/' + myList[randomNumber]}')`;
            }

            if (randomBild) {
                pickRandomNumber();
                setInterval(pickRandomNumber, interval);
            } else {
                pickLinarNumber();
            }
        });
    })

    </script>
</body>
</html>