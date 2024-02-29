function contentChange(myList) {
    let interval;
    let randomBild;
    let linearBild;
    let Index = 0;




    fetch('/PIVEER/Propaganda/settings.json')
        .then(response => response.json())
        .then(data => {
            interval = parseInt(data.interval);
            randomBild = data.randomBild;
            linearBild = data.linearBild;

            listLen = myList.length;

            function pickRandomNumber() {
                const randomNumber = Math.floor(Math.random() * myList.length);
                changeCurrentItem(mylist[randomNumber]);
                document.body.style.backgroundImage = `url('${'assets/' + myList[randomNumber]}')`;
            }

            function pickLinearNumber() {
                if (Index >= listLen) {
                    console.log("Reset the index")
                    Index = 0;
                }           
                changeCurrentItem(myList[Index]);
                Index += 1;
                setTimeout(pickLinearNumber, interval);
                }   

                function changeCurrentItem(currentItem) {
                    function getFileName(fname) {
                        console.log("fname", fname)
                        return fname.slice((fname.lastIndexOf(".") - 1 >>> 0) + 2);
                    }
                    if (getFileName(currentItem) === "") { // If the file is a HTML directory
                        fetchAndReplace('assets/' + currentItem)

                    } else {
                        document.body.style = "";
                        document.body.innerHTML = "";  
                        document.body.style.backgroundImage = `url('${'assets/' + myList[Index]}')`;
                        
                    }

            }
            if (randomBild) {
                pickRandomNumber();
                setInterval(pickRandomNumber, interval);
            } else {
                pickLinearNumber();
            }
            
            function fetchAndReplace(filepath) {
                fetch(filepath) 
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const newDocument = parser.parseFromString(html, 'text/html');
                        
                        // Replace style contents
                        document.body.style = ""
                        
                        // Replace body content
                        document.body.innerHTML = newDocument.body.innerHTML;
                    })
                    .catch(error => console.error('Error fetching and replacing HTML:', error));
            }
        });
}
