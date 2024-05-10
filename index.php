<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
    /* Style for displaying JSON data */
    #jsonData {
        white-space: pre-wrap;
        /* Preserve formatting, including line breaks */

        background-color: #f4f4f4;
        padding: 10px;
        border-radius: 5px;
        display: none;
        /* Initially hide the JSON data div */
    }

    * {
        margin: 0;
        padding: 0;
        font-family: "Times New Roman", Times, serif;

    }

    .main {
        background-color: #ADD8E6;
        text-align: center;
        padding: 40px;
    }

    h1 {
        color: #FFD700;
        font-size: 40px;
    }

    img {
        width: 200px;
        height: 100px;
        float: right;
        margin-top: -80px;
    }

    form {
        text-align: center;
        font-size: 40px;
        margin-top: 50px;
    }

    .word {

        width: 70%;
        height: 50px;
        border: 2px solid black;
        border-radius: 10px;
   
    }

    .container {

    
        height: 150px;
        border: 2px solid black;
        border-radius: 10px;

    }

    .out {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        margin-bottom: 170px;
    }

    .footer {
        position:fixed;
        bottom:0;
        left:0;
        width: 100%;
        text-align: center;
        font-size: 15px;
        padding: 18px;
        background-color: #FFD700;

    }

    .aud {
        width: 100%;
        display: flex;
        justify-content: space-between;
        text-align: center;

    }

    .center {

        display: flex;
        justify-content: center;
    }

    h2 {
        margin-top: 40px;
        text-align: bottom;

    }

    #playButton {
        background-color: #fff;
        border: none;
        cursor: pointer;
        display: inline-block;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        padding: 5px;
        transition: background-color 0.3s ease;
    }

    #playButton:hover {
        background-color: #f0f0f0;
    }

    #playButton svg {
        width: 100%;
        height: 100%;
        fill: #333;
    }

    #insertword {
        display: none;
    }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>

    <div class="main">
        <h1>ਪੰਜਾਬੀ ਸ਼ਬਦਕੋਸ਼</h1>
        <img src="pup_logo.png" alt="PUP Patiala Logo">

    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form id="searchForm" >
                <label class="text" for="searchWord">Enter word to find meaning</label> <br>

                <input type="text" id="searchWord" name="word" class="word" required> <br>
                <button type="submit" id="searchBtn" class="btn" style="background:#ADD8E6; border-radius:6px margin-top:6px">Search</button>
            </form>

            <div id="findword">
                <div class="center">
                    <div class="aud">
                        <h3>Meaning</h3>
                        <audio id="audioPlayer"
                            >
                        </audio>
                        <button id="playButton" title="Play/Pause">

                            Play
                        </button>
                    </div>
                </div>

                <div class="out">
                    <div class="container">
                        <div id="jsonData"></div>
                    </div>
                </div>

            </div>
            <div id="insertword">
                <form id="newfill" method="GET">
                    <label class="text" for="newword">Contribute us by adding details of the word</label> <br>

                    <input type="text" id="newword" name="word" class="word" required> <br>
                    <button type="submit" id="searchBtn" class="btn" style="background:#ADD8E6; border-radius:6px margin-top:6px">Submit</button>
                </form>
            </div>

        </div>
        <div class="col-md-3"></div>
                <div>

                    <div class="footer">
                      
                        &copy; 2024 Punjabi University Patiala
                    </div>







                    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js">
                    </script>
                    <script>
                 

                    var playButton = document.getElementById('playButton');

                    // if ('speechSynthesis' in window) {
                    //     // Create a new SpeechSynthesisUtterance object with the text to be spoken
                    //     var speech = new SpeechSynthesisUtterance();
                    //     speech.lang = 'en-US'; // Set the language to English (United States)
                    //     speech.text = 'how are you'; // Set the text to be spoken

                    //     // Use the SpeechSynthesis API to speak the text
                    //     window.speechSynthesis.speak(speech);
                    //     console.log("yes");
                    // } else {
                    //     console.error('SpeechSynthesis API not supported');
                    // }
                

                    // Now you can use the audioPlayer element as before
                    // Add event listeners, play/pause functionality, etc.

                    // Add event listener to play button
                    playButton.addEventListener('click', function() {

                        var audioPlayer = document.getElementById('audioPlayer');
                    // Assume word is the word you want to fetch audio for
                    var word = document.getElementById('searchWord').value;
                    var word = document.getElementById('searchWord').value;
                        var ttsUrl =
                            'https://translate.google.com.vn/translate_tts?ie=UTF-8&client=tw-ob&q=' +
                           word + '&tl=pa';
                    // Fetch the audio data and create a blob
                    fetch(ttsUrl)
                        .then(response => response.blob())
                        .then(blob => {
                            // Create a URL object from the blob
                            const blobUrl = URL.createObjectURL(blob);

                            // Set the audio source to the blob URL
                            audioPlayer.src = blobUrl;
                        })
                        .catch(error => console.error('Error fetching audio:', error));
                        // Check if audio is paused
                        if (audioPlayer.paused) {
                            audioPlayer.play(); // Play audio
                            playButton.textContent = 'Pause'; // Change button text to Pause
                            console.log("playing");
                        } else {
                            audioPlayer.pause(); // Pause audio
                            playButton.textContent = 'Play'; // Change button text to Play
                            console.log("paused");
                        }
                    });

                    // Optional: Add event listener to reset play button when audio ends
                    audioPlayer.addEventListener('ended', function() {
                        playButton.textContent = 'Play'; // Change button text to Play
                    });

                    
                    // JavaScript code for handling form submission and AJAX request
                    document.getElementById('searchForm').addEventListener('submit', function(e) {
                        e.preventDefault(); // Prevent form submission
                        var word = document.getElementById('searchWord').value;
                        var ttsUrl =
                            'https://translate.google.com.vn/translate_tts?ie=UTF-8&client=tw-ob&q=' +
                           word + '&tl=pa';
                        fetch('search.php?word=' + encodeURIComponent(word))
                            .then(response => response.blob()) // Get the audio as a blob
                            .then(blob => {
                                // Create a URL object from the blob
                                var audioUrl = URL.createObjectURL(blob);

                                // Set the audio player source to the created URL
                                var audioPlayer = document.getElementById('audioPlayer');
                                audioPlayer.src = audioUrl;
                                audioPlayer.style.display = 'block'; // Show the audio player

                                // Autoplay the audio when the player is loaded
                                audioPlayer.oncanplaythrough = function() {
                                    audioPlayer.play();
                                };
                            })
                            .catch(error => {
                                console.error('Error fetching audio:', error);
                            });


                        // Autoplay the audio when the player is loaded
                        ;
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'http://localhost/pupdictionary/getword.php?word=' +
                            encodeURIComponent(word), true);
                        xhr.onload = function() {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                document.getElementById('jsonData').innerHTML =
                                    '<h2>Search Results for \'' + word + '\':</h2>' + xhr
                                    .responseText;
                                document.getElementById('insertword').style.display =
                                    'none'; // Show the JSON data div
                                document.getElementById('findword').style.display =
                                    'block'; // Show the JSON data div

                                document.getElementById('jsonData').style.display =
                                    'block'; // Show the JSON data div

                                displayData(xhr.responseText);
                            } else {
                                console.error(xhr.statusText);
                            }
                        };
                        xhr.onerror = function() {
                            console.error('Request failed');
                        };
                        xhr.send();
                    });

                    function base64Decode(encodedData) {
                        return atob(encodedData);
                    }

                    // AES-256-CBC decryption function

                    function displayData(jsonString) {
                        console.error(jsonString);

                        var jsonDataDiv = document.getElementById('jsonData');
                        jsonDataDiv.innerHTML = ''; // Clear existing content
                        jsonDataDiv.style.display = 'block'; // Show the JSON data div
                        var jsonData = JSON.parse(jsonString);
                        if (Array.isArray(jsonData) && jsonData.length > 0) {
                            var data = jsonData[0]; // Extract the first object from the array



                            jsonDataDiv.innerHTML =

                                '<span class="label">Pronunciation:</span> <span>' + data.pro + '</span><br>' +
                                ' <span>' + data.mean1 + ',</span><br>';
                            if (data.mean2 !== "nul") {
                                jsonDataDiv.innerHTML += ', <span>' + data.mean2 + '</span><br>';
                            }

                            // Check if data.mean3 is not "nul" before including it

                            if (data.mean3 !== "nul") {
                                jsonDataDiv.innerHTML += ',<span>' + data.mean3 + '</span><br>';
                            }

                            // Check if data.mean4 is not "nul" before including it
                            if (data.mean4 !== "nul") {
                                jsonDataDiv.innerHTML += ', <span>' + data.mean4 + '</span><br>';
                            }
                            // Append the row to the document body or another container
                        } else {
                            jsonDataDiv.innerHTML = 'No data found';
                            console.log("helllllllllooooo");

                            document.getElementById('insertword').style.display =
                                'block'; // Show the JSON data div
                            document.getElementById('findword').style.display =
                                'none'; // Show the JSON data div
                            document.getElementById('jsonData').style.display = 'none';


                        }

                    }
                    </script>
</body>

</html>