<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
$dt = date("Y-m-d");

include("dbconnection.php");
include("header.php");

$_SESSION["setvar"] = rand();

$selectquery = mysqli_query($cnn, "SELECT * FROM fixtures where fixtureid='$_GET[editid]'");
$rsarray = mysqli_fetch_array($selectquery);



?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
	      <aside>
        <!-- ########################################################################################## -->
        <h2>Upcoming Tournament</h2>
        <nav>
          <ul>
			<?php
			$sqlteams = "SELECT * FROM tournaments where status='Active'";
			$sqlquery  = mysqli_query($cnn,$sqlteams);
			while($rsres = mysqli_fetch_array($sqlquery))
			{
				echo "<li><a href='displayfixtures.php?tournamentid=$rsres[tournamentid]'>$rsres[name]</a></li>";
			}
			?>
          </ul>
          
        </nav>
        <!-- /nav --><!-- /section --><!-- /section -->
        <!-- ########################################################################################## -->
      </aside>
    </div>
    <!-- ################################################################################################ -->
    <div id="portfolio" class="three_quarter">

<?php
if(isset($_GET['tournamentid']))
{
  $qtournamentlevel = mysqli_query($cnn, "SELECT DISTINCT levelid,level FROM fixtures where  tournamentid =  '$_GET[tournamentid]' ORDER BY fixdatetime");
}
else
{
	$qtournamentlevel = mysqli_query($cnn, "SELECT DISTINCT levelid,level FROM fixtures  ORDER BY fixdatetime");
}
	while($arrtournamentlevel = mysqli_fetch_array($qtournamentlevel))
	{
?>		
<h2 align="center"><u>Level <?php echo $arrtournamentlevel['levelid']. " - " . $arrtournamentlevel['level'] ; ?> </u></h2>

<table width="734" border="1">
  <tr>
    <td width="144" align="center"><strong>Date / Time</strong></td>
    <td width="67" align="center"><strong>Team 1</strong></td>
    <td width="61" align="center"><strong>Team 2</strong></td>
    <td width="161" align="center"><strong>Venue</strong></td>
    <td width="117" align="center"><strong>Match type</strong></td>
    </tr>
<?php  
if(isset($_GET['tournamentid']))
{
  $qtournamentteamsview = mysqli_query($cnn, "SELECT * FROM fixtures where  tournamentid =  '$_GET[tournamentid]' AND levelid='$arrtournamentlevel[levelid]'");
}
else
{
    $qtournamentteamsview = mysqli_query($cnn, "SELECT * FROM fixtures where levelid='$arrtournamentlevel[levelid]'");
}
	while($arrtournamentteamsview = mysqli_fetch_array($qtournamentteamsview))
	{
		  	$qteamsviewteams1 = mysqli_query($cnn, "SELECT * FROM teams where  teamid ='$arrtournamentteamsview[teamid1]'");
			$arrteams1 = mysqli_fetch_array($qteamsviewteams1);
			
			$qteamsviewteams2 = mysqli_query($cnn, "SELECT * FROM teams  where teamid =  '$arrtournamentteamsview[teamid2]'");
			$arrteams2 = mysqli_fetch_array($qteamsviewteams2);
			
			
	echo "<tr>";
	    echo "<td>&nbsp;";
	$phpdate = strtotime($arrtournamentteamsview['fixdatetime']);
	echo "Date: ".$mysqldate = date( 'd-M-Y', $phpdate );
	//echo date_format($arrtournamentteamsview[fixdatetime], 'Y-m-d H:i:s');
	echo "<br />";
	$phpdate = strtotime($arrtournamentteamsview['fixdatetime']);
	echo "&nbsp;Time: ".$mysqldate = date( 'G:i A', $phpdate );
	echo "</td>";
	echo "<td>&nbsp;";
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
    <td>&nbsp;$arrtournamentteamsview[venue]</td>";
	echo "<td>&nbsp;";
	echo $arrtournamentteamsview['matchtype'];
	echo "</td></tr>";
	
	}
?>  
</table>
<hr />
<?php
$levelid = $arrtournamentlevel['levelid'];
	}
?>


<p>&nbsp;</p>

    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>