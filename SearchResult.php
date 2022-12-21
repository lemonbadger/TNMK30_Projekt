<!doctype html>
<html lang="en">
<head>
<meta charset= "utf-8">
	<title>BrickBase</title> 
	<link rel="stylesheet" href="BrickBase.css">
	<script src="DarkMode.js"></script>
</head>
<body>
    <div class="navbar">
        <div class="image_placeholder"><h3>logo_placeholder</h3></div>
        <a class="NavButton" href="BrickBase-home.php">Home</a>
        <a class="NavButton" href="HowToSearch.php">How to search</a>
        <a class="NavButton" href="AboutUs.php">About us</a>
        <input type="checkbox" id="darkmode_toggle" class="darkmode" onclick="DarkMode()">
        <label for="darkmode_toggle">Night Mode</label>
    </div>
    <h1>BrickBase</h1>
<?php
  //Hämta från get
  		if(isset($_GET["data1"]) && isset($_GET["data2"])&& isset($_GET["data3"])&& isset($_GET["data4"])&& isset($_GET["data5"]))
    {
        $SelectedName = $_GET["data1"];
        $SelectedColor = $_GET["data2"];
		$SelectedImage = $_GET["data3"];
		$SelectedPartID = $_GET["data4"];
		$SelectedColorID = $_GET["data5"];
    }
	
	echo '<h3>Your piece is in the following sets: </h3>';
	echo "Name: " . $SelectedName;
	echo "Color: " . $SelectedColor;
	echo '<img src= '.$SelectedImage.' />';
	echo "ID: " . $SelectedPartID;
	

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
LIMIT 50";

		//	Till setten																
		$result = mysqli_query($connection, $query);	

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
					echo '<a class="PieceButton">
					<div class="TextOverflow">
						<tr>
						<td><h3>'.$Setname.'</h3></td>
						<td><img src='.$SetImageUrl.' /></td>
						<td><h3>'.$SetID.'</h3></td>
						</tr>
					</div><a/>';
				}
			echo '</div>';
		 mysqli_close($connection);
?>
</body> 
</html>	
