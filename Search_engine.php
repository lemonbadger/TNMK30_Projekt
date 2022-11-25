<?php 
$connect = mysqli_connect("mysql.itn.liu.se","lego","","lego");


$query = "SELECT parts.Partname, inventory.ItemID FROM inventory, parts WHERE parts.Partname = LIKE %2 X 2% AND inventory.ItemID = parts.PartID";
    ?>