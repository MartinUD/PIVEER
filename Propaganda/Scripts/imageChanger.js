function contentChange(myList, Index) {
    console.log("This is the contentChange function")
    var interval;
    var randomBild;
    var linearBild;
    fetch('/PIVEER/Propaganda/settings.json')
        .then(response => response.json())
        .then(data => {
            interval = parseInt(data.interval);
            randomBild = data.randomBild;
            linearBild = data.linearBild;

            console.log(interval, randomBild, linearBild)

            listLen = myList.length;
            console.log(myList)

            function pickRandomNumber() {
                const randomNumber = Math.floor(Math.random() * myList.length);
                changeCurrentItem(mylist[randomNumber]);
                document.body.style.backgroundImage = `url('${'assets/' + myList[randomNumber]}')`;
            }

            function pickLinearNumber() {
                if (Index >= listLen) {
                    Index = 0;
                }
                changeCurrentItem(myList[Index]);
                document.body.style.backgroundImage = `url('${'assets/' + myList[Index]}')`;
                Index += 1;
                setTimeout(pickLinearNumber, interval);
                
            }

            function changeCurrentItem(currentItem) {
                function getFileName(fname) {
                    return fname.slice((fname.lastIndexOf(".") - 1 >>> 0) + 2);
                }
                if (getFileName(currentItem) === "") {
                    console.log("This is a dirctory")
                    window.location.href = `assets/${currentItem}/index.php`;
                } else {
                    console.log("This is a file")
                    document.body.style.backgroundImage = `url('${'assets/' + myList[Index]}')`;
                }

            }
            if (randomBild) {
                pickRandomNumber();
                setInterval(pickRandomNumber, interval);
            } else {
                pickLinearNumber();
            }
        });
}
