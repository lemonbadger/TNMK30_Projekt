
<!doctype html>
<html lang="sv">

<head>
<meta charset= "utf-8">
	<title> Hemsida </title> 
	<link rel="stylesheet" href="NavigationMenu.css">
	<script src="javascriptbrick.js" defer></script>
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
	$FirstSearch = $_GET['filter']; 
	print("<h3> $FirstSearch </h3>");
	echo strlen("$FirstSearch");
	
	//Rad till Query hämta colorname och jämföra
	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
	$queryc = "SELECT colors.Colorname FROM colors";
	$resultc = mysqli_query($connection, $queryc);
	while($row = mysqli_fetch_array($resultc)){
		
		$colorsearch=$row['Colorname']; 
		
		if (stripos($FirstSearch, $colorsearch) !== false) {
		   $colormatch = $colorsearch;
		   $querylinec = "AND colors.Colorname LIKE '%$colormatch%'";
		    echo "$colormatch <br>"; 
			echo "$querylinec <br>"; 
			break;
		}
		else {
			$querylinec = null; 
		}
	}
	
	//Rad till Query hämta partname och jämföra
	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
	$queryp = "SELECT parts.Partname FROM parts";
	$resultp = mysqli_query($connection, $queryp);
	//$querylinep = null; 
	while($row = mysqli_fetch_array($resultp)){
		
		$partsearch=$row['Partname']; 
		
		if (stripos($FirstSearch, $partsearch) !== false) {
		   $partmatch = $partsearch;
		 
		   //$querylinep = "parts.Partname LIKE '%$partmatch%'";
		   echo "$partmatch <br>"; 
		   echo "$partsearch <br>";
		   echo "$querylinep <br>"; 
		}
		else {
			$querylinep = null; 
		}
	} //while loop slut
	
	
	//Utanför while loop för att den ska ta sista värdet/längsta/$partmatch
	if ($querylinep !== false){
	$querylinep = "parts.Partname LIKE '%$partmatch%'";	
	}
	
	
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
$querylinep	
$querylinec	

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
ORDER BY CHAR_LENGTH(Partname) ASC
LIMIT 50";

     //AND ORDER BY CHAR_LENGTH(Partname)
					
	//	Nu	har	vi	en	fråga	i	$query	som	vi	kan	skicka	till	MySQL!															
		$result = mysqli_query($connection, $query);	
		
		$Iteminfo = array();
		$i = 0; 
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
					
					echo '<a href="SearchResult.php?data1='.$partname.'&data2='.$color.'&data3='.$imageUrl.'&data4='.$partid.'&data5='.$colorid.'" ><div>
						<tr>
						<td><img src='.$imageUrl.' /></td>
						<td><h3>'.$color.'</h3></td>
						<td><h3>'.$partname.'</h3></td>
						</tr>
					</div></a>';
		
		
		
		//Försök med array i array för att sortera efter length/antal characters detta ska troligen bort!!!!
		$length = strlen("$partname");
		
		$Iteminfo[] = array(
        "$i" => array(
		"length" => "$length",
        "partname" => "$partname",
		"colorname" => "$color",
        "image" => "$imageUrl"
        )
      );
	  
	  $i++;
		
		} //while loop slut
		
		ksort($Iteminfo);
		
		foreach ($Iteminfo as $name => $info) {
		 $length = $info["length"];
         $partname = $info["partname"];
         $color = $info["colorname"];
	     $image = $info["image"];
		 
		 echo '<div> '.$partname.' </div>';
        }
		
	  
		
		
		
		
		//$Item_length = $Iteminfo["Item"]["length"];
        //$Item_partname = $Iteminfo["Item"]["partname"];

 mysqli_close($connection);
	
	/*Att göra låda: 
	-kolla sökningar ex brick. fixa så att mellanrum och ej mellanrum inte stör
	-städa kod
	-kommentera saker
	-börja med css
	
	
	/*Frågelåda:
	-Kolla query i SearchResult
	-Ska vi ha div på printen eller något annat
	-Bara en css fil eller flera
	-varför laddar filtersearch så länge???
	*/

	
	
?>



	
</body> 
</html>	
