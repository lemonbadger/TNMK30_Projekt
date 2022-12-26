<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="BrickBase.css">
        <script src="DarkMode.js"></script>
        <script src="BrickBase.lang.js"></script>
        <title>BrickBase</title>
    </head>
    <body>
        <div class="navbar container">
            <div class="langChange"> 
                <a href="#" language='english' class="active">EN</a>
                <a href="#" language='swedish'>SV</a>
                <a href="#" language='german'>DE</a>
            </div>
        
            <div class="image_placeholder"><h3>logo_placeholder</h3></div>
            <a class="NavButton" href="BrickBase-home.php">Home</a>
            <a class="NavButton" href="HowToSearch.php">How to search</a>
            <a class="NavButton" href="AboutUs.php">About us</a>
            <input type="checkbox" id="darkmode_toggle" class="darkmode" onclick="DarkMode()">
            <label for="darkmode_toggle">Night Mode</label>
        </div> 
        <div class="content">
            <h1 class="title">BrickBase</h1>
                <p class="ShortIntro">SEARCH FOR A PIECE!</p>

            <form class="SearchBox" action="FilterSearch.php">
                <input name="filter" type="text" id="SearchBar">
                <input type="submit" id="SubmitButton" value="SEARCH">
            </form>
        </div>
        <script> //Detta ska fungera som språk bytare men får inte riktigt till det. 
            const langEl= document.querySelector('.langChange');
            const link= document.querySelectorAll('a');
            const titleEl= document.querySelector('.title');
            const ShortInEl= document.querySelector('.ShortIntro');

            link.forEach(el => {
                el.addEventListener('click', () => {
                    langEl.querySelector('.active').classList.remove('active');
                    el.classlist.ass('active');

                    cosnt attr = el.getAttribute('language');

                    titleEl.textContent= data[attr].title;
                    ShortInEl.textContent= data[attr].Shortintro;
                });
            });

            var data = {
                "english":
                {
                    "title": "BrickBase" ,
                    "ShortIntro": "Search for a piece!"
                },
                "swedish":
                {
                    "title": "BrickBase" ,
                    "ShortIntro": "Sök efter en bit!"
                },
                "german":
                {
                    "title": "BrickBase" ,
                    "ShortIntro": "Suche ein stück!"
                }
}
        </script>
    </body>
</html>
