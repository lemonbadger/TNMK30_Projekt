<!doctype html>
<html lang="en">
<head>
<meta charset= "utf-8">
	<title>BrickBase</title> 
	<link rel="stylesheet" href="BrickBase.css">
	<script src="DarkMode.js"></script>
<title>BrickBase</title>
</head>
<body>
    <div class="navbar">
        <div class="image_placeholder"><h3>logo_placeholder</h3></div>
        <a class="NavButton" href="BrickBase-home.php">Home</a>
        <a class="NavButton" href="HowToSearch.php">How to search</a>
        <a class="NavButton" href="AboutUs.php">About us</a>
        <input type="checkbox" id="darkmode_toggle">
        <label for="darkmode_toggle">Night Mode</label>
    </div>
    <h1>BrickBase</h1>
<?php
	//Laddar man om sidan "load more" hämta samma variabel med det man sökte på 
	if(isset($_GET["search"]))
    {
	$FirstSearch = $_GET["search"];
    }
	else{
	$FirstSearch = $_GET['filter']; 
	}
	print("<h3>Your Search: $FirstSearch </h3>");
	
	//Rad till Query för färg, hämta colorname och jämföra
	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
	$queryc = "SELECT colors.Colorname FROM colors"; //query för color= queryc
	$resultc = mysqli_query($connection, $queryc); //result för color
	while($row = mysqli_fetch_array($resultc)){
		
		$colorsearch=$row['Colorname']; //variabel med colorname från databasen 
		
		if (stripos($FirstSearch, $colorsearch) !== false) { //jämfär string mellan det man sökta och databasen
		   $colormatch = $colorsearch; //returnar det som matchade, aka exakta colornamet för matchning	
		}
		else {
			$querylinec = null; //om det inte matchade,aka ingen färg i sökningen
		}
	} //while loop färg slut
	
	if($querylinec !== false){ //om det finns något ord som matchar exakt 
		 $querylinec = "AND colors.Colorname LIKE '%$colormatch%'"; //detta skrivs in i stora queryn 
		 echo "$querylinec <br>"; //detta ska bort men just nu hjälp för oss för att se
	}
	

	//Rad till Query hämta partname och jämföra
	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
	$queryp = "SELECT parts.Partname FROM parts";//query för partname= queryp
	$resultp = mysqli_query($connection, $queryp); //result för partname
 
	$common_words_string = null; 
	while($row = mysqli_fetch_array($resultp)){
		
		$partsearch=$row['Partname'];

        /*till else if utanför while loopen MEN DETTA FUNKAR KANSKE INTE
     	$search_words = explode(" ", $FirstSearch); //firstsearch ord blir en array
        $database_words = explode(" ", $partsearch);
		$common_words = array_intersect($search_words, $databse_words); //gör en array av alla common words
		$common_words_string = implode(" ", $common_words); //Gör en string av vår common_words array*/
	
		if (stripos($FirstSearch, $partsearch) !== false) {
			   $partmatch = $partsearch; 
		    }
		else{
				$querylinep = null; 
			}
	} //while loop partname slut
//Utanför while loop för att den ska ta sista värdet/längsta/$partmatch
	
		if ($querylinep !== false){ //om den inte är null gör detta
		$querylinep = "parts.Partname LIKE '%$partmatch%'";	
		}
		/* MEN DETTA FUNKAR INTE ISÅFALL MÅSTE VARA EXAKTA SÖKNINGAR
		else if(isset($common_words_string)){	//om det över ej funkar testa matchande ord, det som kom från arrayen 
			$querylinep = "parts.partname LIKE '%$common_words_string%'";
		}*/
		else{
				$querylinep = null; //om sökningen blir null, tom för partname
			}
		echo "$querylinep <br>"; //ska bort senare men kan underlätta 
		echo "$partsearch<br>"; //ska oxå bort senare
//error message detta funkar ej men något liknande  
 /*if($querylinep == null AND $querylinec == null{
	 echo "Opps something went wrong, try again!";
 }
 else{ //gör fortsätt med queryn, testa något sätt kanske detta funkar }*/
				//Load more, limit
				$limitnumber = 50; //konstant 
				
				if(isset($_GET["update"])) //hämta från url
				{$update = $_GET["update"];
				 
				 $limitnumberupdate = $limitnumber + $update; //update är värdet på limitupdate innan load more
				}
				else{
				$limitnumberupdate = $limitnumber; //innan man tryckt load more
				}
			echo "$limitnumberupdate"; //ska bort men visar limiten för sidan
				//vid mån av tid, se till att load more knappen försvinner när det inte finns mer att visa
			   //stora queryn 
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
				
			ORDER BY CHAR_LENGTH(Partname) ASC, CHAR_LENGTH(Colorname) ASC

			LIMIT $limitnumberupdate";		
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
								//rutan/biten man klickar på skickar sin info till SearchResult med variabler
								echo '<a class="PieceButton" href="SearchResult.php?data1='.$partname.'&data2='.$color.'&data3='.$imageUrl.'&data4='.$partid.'&data5='.$colorid.'" >
								<div>
									<tr>
									<td><img src='.$imageUrl.' /></td>
									<td><h3>'.$color.'</h3></td>
									<td><h3>'.$partname.'</h3></td>
									</tr>
								</div></a>';
					} //while loop för stora queryn slut
					echo '</div>';
					
					//load more knappen, länk
					echo '<a href="FilterSearch.php?update='.$limitnumberupdate.'&search='.$FirstSearch.'" ><div> <h3>Load more </h3> </div></a>'; 
				
			 mysqli_close($connection);
	/*Att göra låda: 
	-kolla sökningar ex brick. fixa så att mellanrum och ej mellanrum inte stör
	-städa kod
	-börja med css
	-fixa att om både querylinep och querylinec är blit tom skriv ut felmedelande ex opps ngt gick fel och hänvisa till how to search
	
	
	/*Frågelåda:
	-Kolla query i SearchResult
	-Bara en css fil eller flera
	-varför laddar filtersearch så länge???
	*/	
?>
</body> 
</html>	
