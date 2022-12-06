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
    <h2>Din sökning: </h2>
	
<?php
	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
		$query = "SELECT DISTINCT
    inventory.ColorID,
    colors.Colorname,
    parts.Partname,
    inventory.ItemID,
    inventory.ItemTypeID,
    images.has_gif,
    images.has_jpg,
	sets.SetID
FROM
    inventory,
    colors,
    parts,
    images,
	sets
WHERE 
    parts.Partname = 'Brick 2 x 3 without Cross Supports'
AND
    inventory.ColorID = colors.ColorID
AND
    inventory.ItemID = parts.PartID
AND
    sets.SetID = inventory.ItemID
AND
    inventory.ItemTypeID = 'S'
AND
    inventory.ItemID = images.ItemID
AND 
	inventory.ColorID = images.ColorID
AND 
    colors.Colorname = 'Yellow'";	
		
	
	//	Nu	har	vi	en	fråga	i	$query	som	vi	kan	skicka	till	MySQL!															
		$result = mysqli_query($connection, $query);	
		
		while($row = mysqli_fetch_array($result)){
		
			
			$url = null; 
			$url .= $row['SetID'];
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
				
				$set=$row['SetID'];
					print "<h3>$set</h3>"; 
		}
		 mysqli_close($connection);
	
?>
		
</body> 
</html>	