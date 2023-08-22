<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");
$dt = date("Y-m-d");

if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}

$selectquery = mysqli_query($cnn, "SELECT * FROM fixtures where fixtureid='$_GET[editid]'");
$rsarray = mysqli_fetch_array($selectquery);


if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}
include("header.php");
$_SESSION["setvar"] = rand();
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
    
<table width="737" height="78" border="1">
  <tr>
    <td width="317" height="30"><div align="center">
      <h2><strong>Tournament</strong></h2>
      </div></td>
    <td width="404" align="left">
      <form method="get" action="">
        <select name="tournamentid">
          <option value="">Select</option>
          <?php
			$sqlteams = "SELECT * FROM tournaments where status='Active'";
			$sqlquery  = mysqli_query($cnn,$sqlteams);
			while($rsres = mysqli_fetch_array($sqlquery))
			{
				if($rsres["tournamentid"]== $_GET["tournamentid"])
				{
				echo "<option value='$rsres[tournamentid]' selected>$rsres[name]</option>";
				}
				else
				{
				echo "<option value='$rsres[tournamentid]'>$rsres[name]</option>";
				}
			}
		?>
          </select>
        <input type="submit" name="submittournament" value="Select tournament">
        </form>
</td>
  </tr>
  <tr>
    <td height="40" align="center"><strong>&nbsp;Playing Teams</strong></td>
    <td><?php
  /*
    $qres = mysqli_query($cnn, "select tournaments.*,tournamentteams.*,teams.*  from tournaments INNER JOIN tournamentteams INNER JOIN teams ON tournaments.tournamentid=tournamentteams.tournamentid AND tournamentteams.teamid= teams.teamid where tournamentteams.tournamentid='$_GET[tournamentteams]' ");*/
$qresteams = mysqli_query($cnn, "SELECT DISTINCT teamid FROM tournamentteams WHERE tournamentid =  '$_GET[tournamentid]'");
	while($arrrecteams = mysqli_fetch_array($qresteams))
	{

$qres = mysqli_query($cnn, "select tournaments.*,tournamentteams.*,teams.* from tournaments INNER JOIN tournamentteams INNER JOIN teams ON tournaments.tournamentid=tournamentteams.tournamentid AND tournamentteams.teamid= teams.teamid where tournamentteams.teamid='$arrrecteams[teamid]' ");
$arrrec = mysqli_fetch_array($qres);
    	echo "$arrrec[teamname] <br>";
		$playingteamid[] = $arrrec['teamid'];
		$playingteamname[] = $arrrec['teamname'];
	}
  ?>
    </td>
  </tr>
  </table>
<br>
<?php
if(isset($resdel2))
{
echo "<strong>Record deleted successfully..</strong>";	
}
if($_GET['insrec'] == 1)
{
echo "<strong>Record inserted successfully...</strong>";
}
if($_GET['updrec'] == 1)
{
	echo "<strong>Record updated successfully...</strong>";
}
?>
<?php
  $qtournamentlevel = mysqli_query($cnn, "SELECT DISTINCT levelid,level FROM fixtures where  tournamentid =  '$_GET[tournamentid]'");
	while($arrtournamentlevel = mysqli_fetch_array($qtournamentlevel))
	{
?>		
<h2 align="center"><u>Level <?php echo $arrtournamentlevel['levelid']. " - " . $arrtournamentlevel['level'] ; ?> </u></h2>

<table width="734" border="1">
  <tr>
    <td width="67" align="center"><strong>Team 1</strong></td>
    <td width="61" align="center"><strong>Team 2</strong></td>
    <td width="161" align="center"><strong>Venue</strong></td>
    <td width="144" align="center"><strong>Date / Time</strong></td>
    <td width="117" align="center"><strong>Match type</strong></td>
    <td width="117" align="center"><strong>Action</strong></td>
  </tr>
<?php  
  $qtournamentteamsview = mysqli_query($cnn, "SELECT * FROM fixtures where  tournamentid =  '$_GET[tournamentid]' AND levelid='$arrtournamentlevel[levelid]'");
	while($arrtournamentteamsview = mysqli_fetch_array($qtournamentteamsview))
	{
		  	$qteamsviewteams1 = mysqli_query($cnn, "SELECT * FROM teams where  teamid ='$arrtournamentteamsview[teamid1]'");
			$arrteams1 = mysqli_fetch_array($qteamsviewteams1);
			
			$qteamsviewteams2 = mysqli_query($cnn, "SELECT * FROM teams  where teamid =  '$arrtournamentteamsview[teamid2]'");
			$arrteams2 = mysqli_fetch_array($qteamsviewteams2);
			
			
	echo "<tr><td>&nbsp;";
	if($arrteams1['teamname'] == "")
	{
		echo "TBC";
	}
	else
	{
	echo $arrteams1['teamname'] ;
	}
	echo "</td><td>&nbsp;";
	if($arrteams2['teamname'] == "")
	{
		echo "TBC";
	}
	else
	{
	echo $arrteams2['teamname'];
	}
	echo "</td>
    <td>&nbsp;$arrtournamentteamsview[venue]</td>
    <td>&nbsp;";
	$phpdate = strtotime($arrtournamentteamsview['fixdatetime']);
	echo "Date: ".$mysqldate = date( 'd-m-Y', $phpdate );
	//echo date_format($arrtournamentteamsview[fixdatetime], 'Y-m-d H:i:s');
	echo "<br />";
	$phpdate = strtotime($arrtournamentteamsview['fixdatetime']);
	echo "&nbsp;Time: ".$mysqldate = date( 'G:i A', $phpdate );
	echo "</td><td>&nbsp;";
	echo $arrtournamentteamsview['matchtype'];
	echo "</td>";
	echo "<td>&nbsp;";

			echo "<a href='resultsupdate.php?fixid=$arrtournamentteamsview[fixtureid]'>Update Result</a><hr>";

		  	$qteamsresults = mysqli_query($cnn, "SELECT * FROM results where  fixtureid ='$arrtournamentteamsview[fixtureid]'");
			$arrresults = mysqli_fetch_array($qteamsresults);
			if(mysqli_num_rows($qteamsresults) == 1)
			{
			echo "<a href='scoreboard.php?resultid=$arrresults[resultid]'>Update Scoreboard</a>";
			}

	echo "</td>
	</tr>";	
}
?>  
</table>
<hr />
<?php
	}
?>
</form>
<p>&nbsp;</p>

    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>