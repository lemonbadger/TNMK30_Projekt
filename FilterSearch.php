<!doctype html>
<html lang="en">
<head>
<meta charset= "utf-8">
	<title>BrickBase</title> 
	<link rel="stylesheet" href="BrickBase.css">
	<script src="Scripts.js"></script>
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
    <h1>BrickBase</h1>
<?php
	//Laddar man om sidan "load more" hämta variabel med det man sökte på 
	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
	if(isset($_GET["search"]))
    {
	$FirstSearch = mysqli_real_escape_string($connection, $_GET["search"]);// mysqli_real_escape_string() För att skydda mot "injektion attack"
    }
	else{
	$FirstSearch = $_GET['filter']; //hämta från formulär/sökfält
	}
	print("<h3>Your Search: $FirstSearch </h3>");
	
	//Load more, uppdatera limit
	$limitnumber = 50; //konstant 
	if(isset($_GET["update"])) //hämta från url
	{$update = $_GET["update"];
	$limitnumberupdate = $limitnumber + $update; //update är värdet på limitupdate innan load more
	}
	else{
	$limitnumberupdate = $limitnumber; //innan man tryckt load more
	}
	$pieces = explode(",", 	$FirstSearch); //Dela upp det som står mellan "," i sökningen så de kan jämföras för sig själva
	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
		$query = "SELECT DISTINCT
	MAX(images.ColorID) AS 'ColorID',
	colors.Colorname,
	parts.Partname,
	images.ItemID,
	images.ItemTypeID,
	images.has_gif,
	images.has_jpg
FROM
	colors,
	parts,
	images
WHERE 
	((parts.Partname LIKE '%$pieces[0]%' /*Optimerad fråga till databasen beroende på hur användaren söker*/ 
AND 									 /*Då sökningen kan skrivas med antingen färg eller Partname/PartID först*/
	colors.Colorname LIKE '%$pieces[1]%') 
OR 
	(parts.Partname LIKE '%$pieces[1]%'
AND 
	colors.Colorname LIKE '%$pieces[0]%')
OR
	(parts.PartID LIKE '%$pieces[0]%'
AND 
	colors.Colorname LIKE '%$pieces[1]%')
OR
	(parts.PartID LIKE '%$pieces[1]%'
AND
	colors.Colorname LIKE '%$pieces[0]%'))
AND
	images.ItemID = parts.PartID
AND
	images.ItemTypeID = 'P'
AND
	images.ColorID = colors.ColorID
GROUP BY
	colors.Colorname,
	parts.Partname,
	images.ItemID,
	images.ItemTypeID,
	images.has_gif,
	images.has_jpg
ORDER BY CHAR_LENGTH(Partname) ASC, CHAR_LENGTH(Colorname) ASC

LIMIT $limitnumberupdate";	


	
		$result = mysqli_query($connection, $query);	
		echo '<div class="container">';
		$counter = 0;
		while($row = mysqli_fetch_array($result)){
			$url = null; 
			$url .= $row['ItemTypeID'];
			$url .= "/";
			$url .= $row['ColorID'];
			$url .= "/";
			$url .= $row['ItemID'];
			$hasimage = true; 
			if($row['has_gif'])
				$url .= ".gif"; 
			else if($row['has_jpg'])
				$url .= ".jpg"; 
			else{
				$hasimage = false; 
			}
				$imageUrl = "http://www.itn.liu.se/~stegu76/img.bricklink.com/";
				$imageUrl .= $url; 
				$color=$row['Colorname']; 
				$partname=$row['Partname']; 
				$itemid=$row['ItemID'];
				$colorid=$row['ColorID'];
				
				
	    //biten man klickar på skickar variabler till SearchResult (nästa sida) via URL:en
		echo '<a class="PieceButton" href="SearchResult.php?data1='.$partname.'&data2='.$color.'&data3='.$imageUrl.'&data4='.$itemid.'&data5='.$colorid.'" >
		<div class="TextOverflow">
			<tr>
			<td><img src='.$imageUrl.' alt="Missing Image of Piece"/></td>
			<td><div class="TXT">'.$color.'</div></td>
			<td><div class="TXT">'.$partname.'</div></td>
			</tr>
		</div></a>';
		$counter++;
		}
		
	    //felmeddelande
		if($counter == 0){
			echo'<p class="ShortIntro"> No result for "'.$FirstSearch.'". Please look at "how to search"! </p>'; 	
		}
		echo '</div>';	
		//load more knapp
		if($counter % 50 == 0 && $counter != 0 ){
			echo '<div class="LoadMoreButton">';
			echo '<a href="FilterSearch.php?update='.$limitnumberupdate.'&search='.$FirstSearch.'" >Load more</a>'; 
			echo '</div>';
		}
	mysqli_close($connection);

?>
</body> 
</html>	
