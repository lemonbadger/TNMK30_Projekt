
<!doctype html>
<html lang="sv">

<head>
<meta charset= "utf-8">
	<title> Hemsida </title> 
	<link rel="stylesheet" href="NavigationMenu.css">
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
	
	echo '<h2>Din bit ingår i: </h2>';

	$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego"); 
	
	$query	= "SELECT
    inventory.SetID,
    inventory.ColorID,
    inventory.ItemID,
    inventory.ItemTypeID,
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
inventory.ColorID = '$SelectedColorID'
AND
inventory.SetID = sets.SetID
AND
images.ItemID = sets.SetID";


	
		//	Till setten																
		$result = mysqli_query($connection, $query);	
		
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
					echo '<div>
						<tr>
						<td><h3>'.$Setname.'</h3></td>
						<td><img src='.$SetImageUrl.' /></td>
						
						<td><h3>'.$SetID.'</h3></td>
						</tr>
					</div>';
						
		}
		 mysqli_close($connection);
		 
		 
		 
	
?>
		
</body> 
</html>	
