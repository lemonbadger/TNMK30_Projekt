<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="BrickBase.css">
    <script src="DarkMode.js"></script>
    <title>BrickBase</title>
</head>
<body class="darkmode">
    <div class="navbar">
        <div class="image_placeholder"><h3>logo_placeholder</h3></div>
        <a class="NavButton" href="BrickBase-home.php">Home</a>
        <a class="NavButton" href="HowToSearch.php">How to search</a>
        <a class="NavButton" href="AboutUs.php">About us</a>
        <input type="checkbox" id="darkmode_toggle" class="darkmode" onclick="DarkMode()">
        <label for="darkmode_toggle" id="NightMode">Night Mode</label>
    </div>
   <h1>BrickBase</h1>
    <p class="ShortIntro">Search for a Lego piece!</p>

<form class="SearchBox" action="FilterSearch.php">
	<input name="filter" type="text" id="SearchBar">
	<input type="submit" id="SubmitButton" value="SEARCH">
</form>

</body>
</html>
