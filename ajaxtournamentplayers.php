<?php
include("dbconnection.php");
?>
Select captain:
     &nbsp; <select name="players[]">
    <option value="">Select</option>
	<?php
    $sqlcaptain = "SELECT * FROM players where teamid='$_GET[playerid]'";
	$querycaptain = mysqli_query($cnn,$sqlcaptain);
	while($rscamptain = mysqli_fetch_array($querycaptain))
    {
		echo "<option value='$rscamptain[playerid]'>$rscamptain[name]</option>";
    }
	?>
    </select>

<hr>
Select Players<br>
     &nbsp;
     	<?php
    $sqlcaptain1 = "SELECT * FROM players where teamid='$_GET[playerid]'";
	$querycaptain1 = mysqli_query($cnn,$sqlcaptain1);
	while($rscaptain = mysqli_fetch_array($querycaptain1))
    {
		echo "$rscaptain[name]<input type='checkbox' name='players[]' value='$rscaptain[playerid]'><hr>";
    }
	?>