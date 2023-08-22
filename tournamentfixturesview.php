<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");
if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}
include("header.php");
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
    <h3>Fixtures:</h3>
    <?php
    $qfixt = mysqli_query($cnn, "select *  from fixtures LEFT JOIN tournaments ON tournaments.tournamentid=fixtures.tournamentid ");
	while($arrfix = mysqli_fetch_array($qfixt))
	{
		echo "<table border='0'>";
		echo "<tr>";
    	echo "<td>";
		echo " <strong>Date Time:</strong> ".$arrfix['fixdatetime']. " <br>";
		echo  "<strong>Tournament:</strong> ". $arrfix['name']. " <br>";
		    $qfixteams = mysqli_query($cnn, "select *  from teams where teamid='$arrfix[teamid1]' ");
			$arrfixteams1 = mysqli_fetch_array($qfixteams);

		    $qfixteams2 = mysqli_query($cnn, "select *  from teams where teamid='$arrfix[teamid2]' ");
			$arrfixteams2 = mysqli_fetch_array($qfixteams2);

		echo "<strong>Playing teams:</strong> ".$arrfixteams1['teamname'] ." V/S ". $arrfixteams2['teamname']. " <br>";
		echo "<strong>Venue:</strong> ".$arrfix['venue'];
		echo "</td>";	
		echo "</tr>";
		echo "</table>";
	}
  ?>



</div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>