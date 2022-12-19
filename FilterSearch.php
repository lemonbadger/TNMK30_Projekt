<!doctype html>
<html lang="en">
<head>
<meta charset= "utf-8">
	<title>Hemsida</title> 
	<link rel="stylesheet" href="BrickBase.css">
	<script src="javascriptbrick.js" defer></script>
</head>
<body>
<title>BrickBase</title>
</head>
<body class="darkmode">
    <div class="navbar">
        <div class="image_placeholder"><h3>logo_placeholder</h3></div>
        <a class="NavButton" href="Home.php">Home</a>
        <a class="NavButton" href="HowToSearch.php">How to search</a>
        <a class="NavButton" href="AboutUs.php">About us</a>
        <input type="checkbox" id="darkmode_toggle">
        <label for="darkmode_toggle"><p id="NightMode">Night Mode</p></label>
    </div>
  
    <h1>BrickBase</h1>
    <h2>Din sökning: </h2>
	


<?php
	$FirstSearch = $_GET['filter']; 
	print("<h3> $FirstSearch </h3>");
	
	//Allmän sökning från lab 5
	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
	$query = "SELECT DISTINCT
    inventory.ColorID,
    colors.Colorname,
    parts.Partname,
	parts.PartID,
    inventory.ItemID,
    inventory.ItemTypeID,
    images.has_gif,
    images.has_jpg
FROM
    inventory,
    colors,
    parts,
    images
WHERE 
    parts.Partname LIKE '%$FirstSearch%'
AND
    inventory.ColorID = colors.ColorID
AND
    inventory.ItemID = parts.PartID
AND
    inventory.ItemTypeID = 'P'
AND
    inventory.ItemID = images.ItemID
AND 
	inventory.ColorID = images.ColorID
	
LIMIT 5";	

	
					
	//	Nu	har	vi	en	fråga	i	$query	som	vi	kan	skicka	till	MySQL!															
		$result = mysqli_query($connection, $query);	
		
		echo '<div class="container">';
		
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
				$partid=$row['PartID'];
				$colorid=$row['ColorID'];
	
	  
		
		
					print "</tr>\n"; 
					
					echo '<a class="PieceButton" href="SearchResult.php?data1='.$partname.'&data2='.$color.'&data3='.$imageUrl.'&data4='.$partid.'&data5='.$colorid.'" ><div>
						<tr>
						<td><img src='.$imageUrl.' /></td>
						<td><h3>'.$color.'</h3></td>
						<td><h3>'.$partname.'</h3></td>
						</tr>
					</div></a>';
	
	
	
		
	}
	echo' </div>';

  
 mysqli_close($connection);
	
	
	/*Frågelåda:
	-Kolla query i SearchResult
	-Ska vi ha div på printen eller något annat
	-Bara en css fil eller flera
	-varför laddar filtersearch så länge???
	-kan man connecta utan post oh form?
	*/

	
	
?>



	
</body> 
</html>	
