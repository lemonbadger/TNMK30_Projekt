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
 /* Användning av sökningen in i variabel $firstsearch
 
 $FirstSearch = $_GET['filter'];        //$firstsearch = $filter 
 
 	print("<h2>$FirstSearch</h2>\n");
	
	$connection	= mysqli_connect("mysql.itn.liu.se","lego","","lego");
	$query = "SELECT * 
	
	FROM
    inventory,
    colors,
    parts,
    images
    WHERE 
    inventory.partID = %'$FirstSearch'%
AND
    inventory.ColorID = colors.ColorID
AND
    inventory.ItemID = parts.PartID
AND
    inventory.ItemTypeID = 'P'
AND
    inventory.ItemID = images.ItemID
AND 
	inventory.ColorID = images.ColorID";	

	*/
	
	
	//Allmän sökning från lab 5
	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
		$query = "SELECT
    inventory.Quantity,
    inventory.ColorID,
    colors.Colorname,
    parts.Partname,
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
    inventory.SetID ='375-2'
AND
    inventory.ColorID = colors.ColorID
AND
    inventory.ItemID = parts.PartID
AND
    inventory.ItemTypeID = 'P'
AND
    inventory.ItemID = images.ItemID
AND 
	inventory.ColorID = images.ColorID";	
		
	
	//	Nu	har	vi	en	fråga	i	$query	som	vi	kan	skicka	till	MySQL!															
		$result = mysqli_query($connection, $query);	
		
		while ($row = mysqli_fetch_array($result)){
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
		
			print("<tr>"); 
			print("<td><h3>$url</h3></td>");
			print("<td><img src=$imageUrl /></td>");
			print("<td><h3>$color</h3></td>");
			print("<td><h3>$partname</h3></td>");
			
		print "</tr>\n";
	}

  
 mysqli_close($connection);
	
	
	
	
	
?>

	

	
</body> 
</html>	