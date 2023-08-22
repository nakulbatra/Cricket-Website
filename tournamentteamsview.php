<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
include("dbconnection.php");
if(isset($_GET["deleteid"]))
{
	$delres = mysqli_query($cnn, "DELETE FROM tournaments where tournamentid='$_GET[deleteid]'");
		if(!$delres)
			{
				$resdel = "Failed to delete record";
			}
			else
			{
				$resdel =  "Record deleted successfully..";
			}
}

if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}


?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
		<?php
		include("adminmenu.php");
		?>
    </div>
    <!-- ################################################################################################ -->
    <div id="portfolio" class="three_quarter">
    <?php
	echo "<strong>$resdel</strong>";
	?>

<a href="tournamentteamsadd.php?tournamentid=<?php echo $_GET['tournamentteams'] ?>"><h2>Add tournament teams</h2></a>
    
<table width="581" border="1">
  <tr>
    	<th width="177" scope="col">Teams</th>
        <th width="201" scope="col">description</th>
   		<th width="91" scope="col">status</th>      
    	<th width="84" scope="col">Action</th>
  </tr>
  <?php
  /*
    $qres = mysqli_query($cnn, "select tournaments.*,tournamentteams.*,teams.*  from tournaments INNER JOIN tournamentteams INNER JOIN teams ON tournaments.tournamentid=tournamentteams.tournamentid AND tournamentteams.teamid= teams.teamid where tournamentteams.tournamentid='$_GET[tournamentteams]' ");*/
$qresteams = mysqli_query($cnn, "SELECT DISTINCT teamid FROM tournamentteams WHERE tournamentid =  '$_GET[tournamentteams]'");
	while($arrrecteams = mysqli_fetch_array($qresteams))
	{

$qres = mysqli_query($cnn, "select tournaments.*,tournamentteams.*,teams.* from tournaments INNER JOIN tournamentteams INNER JOIN teams ON tournaments.tournamentid=tournamentteams.tournamentid AND tournamentteams.teamid= teams.teamid where tournamentteams.teamid='$arrrecteams[teamid]' ");
$arrrec = mysqli_fetch_array($qres);

		echo "<tr>";
    	echo "<td>&nbsp;<strong>Team name: </strong>$arrrec[teamname] <br>";
			if($arrrec['teamlogo'] == "")
			{
				echo "<img src='images/noimage.jpg' width='150' height='100'>";		
			}
			else
			{
				echo "<img src='imgteam/$arrrec[teamlogo]' width='150' height='100'>";
			}
		echo "</td>";
	 	echo "<td>&nbsp;$arrrec[description]</td>";
    	echo "<td>&nbsp;$arrrec[status]</td>";
	 
	  	echo "<td>&nbsp;<a href='tournamentteamsview.php?deleteid=$arrrec[tournamentid]'>Delete</a> </td>";
		echo "</tr>";
	}
  ?>
</table>
</div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>