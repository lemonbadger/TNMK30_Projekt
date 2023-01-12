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
  //Hämta variabler från URL med get
  		if(isset($_GET["data1"]) && isset($_GET["data2"])&& isset($_GET["data3"])&& isset($_GET["data4"])&& isset($_GET["data5"]))
    {
        $SelectedName = $_GET["data1"];
        $SelectedColor = $_GET["data2"];
		$SelectedImage = $_GET["data3"];
		$SelectedPartID = $_GET["data4"];
		$SelectedColorID = $_GET["data5"];
    }
	
	echo '<div class="container"><a class="PieceButton"><div class ="TXT">Your piece</div><img src= '.$SelectedImage.' /><div class="TXT"> is in the following sets: </div><a/></div>';

	//Load more, uppdatera limit
	$limitnumber = 50; //konstant 
	
	if(isset($_GET["update"])) //hämta från url
	{$update = $_GET["update"];
		
	$limitnumberupdate = $limitnumber + $update; //update är värdet på limitupdate innan load more
	}
	else{
	$limitnumberupdate = $limitnumber; //innan man tryckt load more
	}

	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
	$query	= "SELECT
    inventory.SetID,
    sets.Setname,
	images.has_gif,
	images.has_jpg
FROM
    inventory,
    sets,
	images
WHERE 
    inventory.ItemID = '$SelectedPartID'
AND
	inventory.SetID = sets.SetID
AND
	images.ItemID = sets.SetID
ORDER BY Setname
LIMIT $limitnumberupdate";

		//Skriv ut alla set															
		$result = mysqli_query($connection, $query);	
        
		$counter = 0;
		echo '<div class="container">';
		while($row = mysqli_fetch_array($result)){
				$url = null; 
				$url .= $row['SetID'];
				$hasimage = true; 
				if($row['has_gif']){
				$url .= ".gif";} 
				else if($row['has_jpg']){
				$url .= ".jpg"; }
				else{
					$hasimage = false; 
				}
				 
					$SetImageUrl = "http://www.itn.liu.se/~stegu76/img.bricklink.com/S/";
				
					$SetImageUrl .= $url; 
					
					$Setname=$row['Setname']; 
					$SetID=$row['SetID'];
					echo '<a class="ResultSet">
					<div class="TextOverflow">
						<tr>
						<td><div class="TXT">'.$Setname.'</div></td>
						<td><img src='.$SetImageUrl.' alt="Missing Photo of Set"/></td>
						<td><div class="TXT">'.$SetID.'</div></td>
						</tr>
					</div><a/>';
					$counter++;
				}
		echo '</div>';
		//load more knapp
		if($counter % 50 == 0 && $counter != 0 ){
			echo '<div class="LoadMoreButton">';
			echo '<a href="SearchResult.php?update='.$limitnumberupdate.'&data1='.$SelectedName.'&data2='.$SelectedColor.'&data3='.$SelectedImage.'&data4='.$SelectedPartID.'&data5='.$SelectedColorID.'" >Load more</a>';
			echo '</div>'; 
		}
		mysqli_close($connection);
?>
</body> 
</html>	
