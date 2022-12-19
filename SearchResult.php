<!doctype html>
<html lang="en">

<head>
<meta charset= "utf-8">
	<title> Hemsida </title> 
	<link rel="stylesheet" href="BrickBase.css">
</head>
<body>
<title>BrickBase</title>
</head>
<body>
    <div class="navbar">
        <div class="image_placeholder"><h3>logo_placeholder</h3></div>
        <a class="NavButton" href="Home.php">Home</a>
        <a class="NavButton" href="HowToSearch.php">How to search</a>
        <a class="NavButton" href="AboutUs.php">About us</a>
        <input type="checkbox" id="darkmode_toggle">
        <label for="darkmode_toggle"><p id="NightMode">Night Mode</p></label>
    </div>
    <h1>BrickBase</h1>
    <h2>Din bit ingår i: </h2>
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
	 echo "Name: " . $SelectedName;
	 echo "Color: " . $SelectedColor;
	 echo '<img src= '.$SelectedImage.' />';
	 echo "ID: " . $SelectedPartID;
	

	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
	
	/* Gammal query
		$query = "SELECT
    inventory.ColorID,
    colors.Colorname,
    parts.Partname,
    inventory.ItemID,
    inventory.ItemTypeID,
    images.has_gif,
    images.has_jpg,
	sets.SetID,
	sets.Setname
FROM
    inventory,
    colors,
    parts,
    images,
	sets
WHERE 
    parts.Partname = '$SelectedName'
AND
    inventory.ColorID = colors.ColorID
AND
    inventory.ItemID = parts.PartID
AND
    inventory.ItemID = sets.SetID
AND
    inventory.ItemTypeID = 'S'
AND
    inventory.ItemID = images.ItemID
AND 
	inventory.ColorID = images.ColorID
AND 
    colors.Colorname = '$SelectedColor'
	
AND parts.PartID = '$SelectedPartID'

AND inventory.ItemID = sets.SetID";
*/		
	


	//Ny query
	$query	= "SELECT
inventory.SetID,
    inventory.ColorID,
    inventory.ItemID,
    inventory.ItemTypeID,
sets.Setname

FROM
    inventory,
	sets
WHERE 
    inventory.ItemID = '$SelectedPartID'
AND
inventory.ColorID = '$SelectedColorID'
AND
inventory.SetID = sets.SetID";

//<img src='$prefix/SL/$setID.jpg'>
		
		echo '<h3>Hej</h3>'; 
	
	
		//	Till setten																
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
				 
					$SetImageUrl = "http://www.itn.liu.se/~stegu76/img.bricklink.com/SL/";
					$SetImageUrl .= $url; 
					
					
					
					
					
					$Setname=$row['Setname']; 
					$SetID=$row['SetID'];
					
					echo '<h3>'.$SetID.'</h3>'; 
					echo '<h3>'.$Setname.'</h3>'; 
					echo '<img src='.$setimageUrl.' />';
						
		}
		 mysqli_close($connection);
		 
		 
		 
	
?>
		
</body> 
</html>	
