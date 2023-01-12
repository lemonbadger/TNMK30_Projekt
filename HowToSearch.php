<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="BrickBase.css">
    <script src="Scripts.js"></script>
    <title>BrickBase</title>
</head>
<body>
    <div class="navbar">
    <div id="google_translate_element"></div>
        <script type="text/javascript">
            function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <a class="NavButton" href="BrickBase-home.php">Home</a>
        <a class="NavButton" href="HowToSearch.php">How to search</a>
        <a class="NavButton" href="AboutUs.php">About us</a>
        <input type="checkbox" id="darkmode_toggle" class="darkmode" onclick="DarkMode()">
        <label for="darkmode_toggle">Night Mode</label>
    </div>
    <h1>How To Search</h1>
    <p class="ShortIntro">In order to get the most relevant search result<br> please follow the following instructions</p>
    <div id="HowToSearchCONTAINER">
        <div id="HowToSearchIMG">
            <img id="Pic1" src="./Images/bild1.png" alt="Instructional Image">
            <img id="Pic2"src="./Images/bild2.png" alt="Instructional Image">
        </div>
        <div id="HowToSearchTEXT">
            <p class="ShortIntro">
                1. Use the searchbar to search for either the <br>name of a piece or it's specific ID number.<br><br>
                Here are some tips on how to optimize your search result
            </p>
                <div class="ListStyle">
                    <ul>
                        <li>Make sure to spell the piece name correctly</li>
                        <li>Add a " , " symbol if you want to add a color to your search</li>
                        <li>Make sure you correctly use spaces in the partname</li>
                    </ul>
                </div>
            <p class="ShortIntro">
                2. In this picture you can see a example of a optimal search for a certain piece by using the piece name and a color.
            </p>
                                    
            
        </div>
    </div>
