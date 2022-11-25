<!doctype html>
<html lang="sv">

<head>
<meta charset= "utf-8">
	<title> Hemsida </title> 
	<link rel="stylesheet" href="NavigationMenu.css">
</head>

<body>



<title>BrickBase</title>
</head>
<body>
    <div class="navbar">
        <div class="image_placeholder"><h3>logo_placeholder</h3></div>
        <a href="Home.php">Home</a>
        <a href="HowToSearch.php">How to search</a>
        <a href="AboutUs.php">About us</a>
        <input type="checkbox" id="darkmode_toggle">
        <label for="darkmode_toggle"><p id="NightMode">Night Mode</p></label>
    </div>
  
    <h1>BrickBase</h1>
    <p>Hej sök efter din bit!</p>


<?php
 $FirstSearch = $_GET['filter'];
 
 	print("<h2>$FirstSearch</h2>\n");
?>

	

	
</body> 
</html>	