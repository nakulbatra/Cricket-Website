<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");

$battingteam = $_GET['firstteamid'];

if($battingteam == $_GET['team1'])
{
$bownlingteam = $_GET['team2'];
}
else
{
$bownlingteam = $_GET['team1'];
}

if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}
include("header.php");

//Code to delete batting performance data
if(isset($_GET['batdelid']))
{
	mysqli_query($cnn,"DELETE FROM batperformance where batperformanceid='$_GET[batdelid]'");
	?>
    <script type="application/javascript">
		alert("Batting performance record deleted successfully...");
	</script>
    <?php
}

//Code to delete bowling performance data
if(isset($_GET['bowldelid']))
{
	mysqli_query($cnn,"DELETE FROM bowlingperformance where bowlperformanceid='$_GET[bowldelid]'");
}

if($_SESSION['batsession'] == $_POST['batsession'] )
{
    if(isset($_POST['submitbat']))
	{  
		if(isset($_GET['bateditid']))
		{
		$insres = mysqli_query($cnn,"UPDATE batperformance SET resultid='$_POST[resultid]',playerid='$_POST[playerid]',dismisstype='$_POST[dismisstype]',catchid='$_POST[catchid]',bowledid='$_POST[bowledid]',runs='$_POST[runs]',balls='$_POST[balls]',fours='$_POST[fours]',sixes='$_POST[sixes]',dismissovers='$_POST[dismissovers]',fow='$_POST[fow]' where playerid='$_GET[editid]'");
					if(mysqli_affected_rows($cnn) == 1)
					{
						$qresulti =  1;
						$qresult =  "Record updated successfully..";
					}
					else
					{
						$qresulti =  1;
						$qresult =  "No records found to update";	
					}
		}
		else
		{
		$insres = mysqli_query($cnn, "INSERT INTO batperformance (resultid,playerid,dismisstype,catchid,bowledid,runs,balls,fours,sixes,dismissovers,fow) values ('$_GET[resultid]','$_POST[playerid2]','$_POST[dismisstype]','$_POST[catch]','$_POST[bowler]','$_POST[runs]','$_POST[ball]','$_POST[four]','$_POST[six]','$_POST[dismissover]','$_POST[fow]')");
		
		if(!$insres)
		{
			$qresulti =  1;
			$qresult =   "Failed to insert record";
			echo mysqli_error($cnn);
		}
		else
		{
			$qresulti =  1;
			$qresult =  "Record inserted successfully..";
		}
		}
	}
}

if($_SESSION['ballsession'] == $_POST['ballsession'] )
{
    if(isset($_POST['submitbowl']))
	{
		if(isset($_GET['bowleditid']))
		{
			
//bownling
$insres = mysqli_query($cnn,"UPDATE bowlingperformance SET resultid='$_POST[resultid]',playerid='$_POST[playerid]',overs='$_POST[overs]',maidens='$_POST[maidens]',runs='$_POST[runs]',wickets='$_POST[wickets]' where playerid='$_GET[editid]'");
			if(mysqli_affected_rows($cnn) == 1)
			{
				$qresulti =  1;
				$qresult =  "Record updated successfully..";
			}
			else
			{
				$qresulti =  1;
				$qresult =  "No records found to update";	
			}
		}
		else
		{
			$insres1 = mysqli_query($cnn, "INSERT INTO bowlingperformance (resultid,playerid,overs,maidens,runs,wickets) values ('$_GET[resultid]','$_POST[bowler2]','$_POST[overs]','$_POST[maidens]','$_POST[runs]','$_POST[wickets]')");
						
					if(!$insres)
					{
						$qresulti =  1;
						$qresult =   "Failed to insert record";
						echo mysqli_error($cnn);
					}
					else
					{
						$qresulti =  1;
						$qresult =  "Record inserted successfully..";
					}
		}
	}
}

//Session for bowling performance and batting performance
$_SESSION['batsession']  = rand().time();
$_SESSION['ballsession']  = rand().time();

//Team name 1
$sqlteams1 = mysqli_query($cnn,"SELECT * FROM teams where teamid='$_REQUEST[firstteamid]'");
$rsteams1 = mysqli_fetch_array($sqlteams1);
$teamname1 =  $rsteams1['teamname'];
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
if(isset($_GET['firstteamid']))
{
?>

    <form method="post" name="formbatting" action="" enctype="multipart/form-data">
<p>
<input type="hidden" name="batsession" value="<?php echo $_SESSION['batsession']; ?>" />
  <input type="hidden" name="setvar" value="<?php echo $_SESSION['setvar']; ?>">
  <input type="hidden" name="firstteamid" value="<?php echo $_REQUEST['firstteamid']; ?>">
  
</p>

<br />
<table width="737" border="1">
  <tr>
  		<td colspan=2><center><strong>BATTING PERFORMANCE OF <?php echo $teamname1; ?> </strong>
        </center></td>
    </tr>
    <tr>
    <td width="170" ><div align="center">
      <strong>Player Name</strong>
    </div></td>
    <td width="106"><div align="center">
      <select name="playerid2"> 
        <option value="Select">Select</option>
		<?php
        $sqlteams = "SELECT * FROM players where teamid='$battingteam' AND status='Enabled'";
        $sqlquery  = mysqli_query($cnn,$sqlteams);
        while($rsres = mysqli_fetch_array($sqlquery))
        {
            if($_GET['bateditid'] == $rsres['playerid'] )
			{
			echo "<option value='$rsres[playerid]' selected>$rsres[name]</option>";
			}
			else
			{
            echo "<option value='$rsres[playerid]'>$rsres[name]</option>";
			}
        }
        ?>
      </select>
    </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <strong>Dismiss type</strong>
    </div></td>
    <td><div align="center">
      <select name="dismisstype" id="dismisstype">
        <option value="Select">Select</option>
        <option value="Not out">Not out</option>
        <option value="Caught">Caught</option>
        <option value="Bowled">Bowled</option>
        <option value="LBW">LBW</option>
       	<option value="Run out">Run out</option>
       	<option value="Stumped">Stumped</option>
       	<option value="Hit Wicket">Hit Wicket</option>
       	<option value="Timed out">Timed out</option>
       	<option value="Handling the ball">Handling the ball</option>
       	<option value="Obstructing the field">Obstructing the field</option>
       	<option value="Hitting the ball twice">Hitting the ball twice</option>
        <option value="Retired hurt"><br />
Retired hurt</option>
      </select>
     
    </div></td>
  </tr>
  <tr>
    <td >
     <div align="center"> <strong>Catch</strong></div>
   </td>
    <td>
   <div align="center">
   <select name="catch">
   <option value="0"></option>
   <option value="0">Not applicable</option>
   	<?php
		$sqlteams = "SELECT * FROM players where teamid='$bownlingteam' AND status='Enabled'";
		$sqlquery  = mysqli_query($cnn,$sqlteams);
		while($rsres = mysqli_fetch_array($sqlquery))
		{
			echo "<option value='$rsres[playerid]' selected>$rsres[name]</option>";
		}
	?>
   </select>
  </div>
  </td>
  </tr>
  <tr>
    <td><div align="center">
      <strong>Bowler</strong></div></td>
    <td><div align="center"> 
      <select name="bowler">
       <option value="0">Not applicable</option>
       <option value="Select"></option>
        <?php
            $sqlteams = "SELECT * FROM players where teamid='$bownlingteam' AND status='Enabled'";
            $sqlquery  = mysqli_query($cnn,$sqlteams);
            while($rsres = mysqli_fetch_array($sqlquery))
            {
                echo "<option value='$rsres[playerid]' selected>$rsres[name]</option>";
            }
        ?>        
      </select>
    </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <strong>Runs</strong>
    </div></td>
    <td><div align="center">
      <input type="number" name="runs" />
    </div></td>
  </tr><tr>
    <td ><div align="center">
      <strong>Six's</strong>
    </div></td>
    <td><div align="center">
      <input type="number" name="six" />
    </div></td>
  </tr><tr>
    <td ><div align="center">
      <strong>Four's</strong>
    </div></td>
    <td><div align="center">
      <input type="number" name="four" />
    </div></td>
  </tr><tr>
    <td><div align="center">
      <strong>Ball's</strong>    
    </div></td>
    <td><div align="center">
      <input type="number" name="ball" />
    </div></td>
  </tr><tr>
    <td><div align="center">
      <strong>Dismiss Over</strong>
    </div></td>
    <td><div align="center">
      <input type="number" name="dismissover" /> &nbsp;
    </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <strong>Fall of wickets</strong>
    </div></td>
    <td><div align="center">
      <input type="number" name="fow" /> &nbsp;
    </div></td>
  </tr>
  <tr>
    <td  colspan="2" align="center">
        <input type="submit" name="submitbat" value="Update scoreboard" />
        &nbsp;
        <input type=reset value="reset" />
</td>
    </tr>
</table>
</form>

<!-- 
Pending to work
No ball, Wide, Bye, Leg bye, Penalty runs

-->

<table width="736" border="1">
  <tr>
 
  
    <td colspan="11"><center><strong>BATTING PERFORMANCE</strong></center></td>
  </tr>
  <tr>
    <th scope="row"><div align="center"><strong>Player name</strong></div></th>
    <td><div align="center"><strong>Dismiss type</strong></div></td>
    <td><div align="center"><strong>Catch</strong></div></td>
    <td><div align="center"><strong>Bowler</strong></div></td>
    <td><div align="center"><strong>Runs</strong></div></td>
    <td><div align="center"><strong>Six's</strong></div></td>
    <td><div align="center"><strong>Four's</strong></div></td>
    <td><div align="center"><strong>Ball's</strong></div></td>
     <td><div align="center"><strong>FOW</strong></div></td>
    <td><div align="center"><strong>ACTION</strong></div></td>
  </tr>
<?php
$sql = "SELECT     batperformance.*, players_1.*
FROM         batperformance LEFT OUTER JOIN
                      players AS players_1 ON batperformance.playerid = players_1.playerid WHERE (players_1.teamid = '$_GET[firstteamid]' AND batperformance.resultid='$_GET[resultid]')";
$querybat = mysqli_query($cnn,$sql);
$i=1;
while($rsplayersbat = mysqli_fetch_array($querybat))
{
?>
  <tr>
    <th scope="row">&nbsp;<?php echo $rsplayersbat['name']; ?></th>
    <td>&nbsp;<?php echo $rsplayersbat['dismisstype']; ?></td>
    <td>&nbsp;<?php 
		//catchid
				if($rsplayersbat['catchid'] != 0)
				{
				
				$sqlcatchid = "SELECT * FROM players WHERE playerid='$rsplayersbat[catchid]'";
				$qcatchid = mysqli_query($cnn,$sqlcatchid);
				$rscatchid = mysqli_fetch_array($qcatchid);
				echo $rscatchid['name']; 
				}
	?></td>
    <td>&nbsp;<?php 
					if($rsplayersbat['bowledid'] != 0)
				{
				
				$sqlcatchid = "SELECT * FROM players WHERE playerid='$rsplayersbat[bowledid]'";
				$qcatchid = mysqli_query($cnn,$sqlcatchid);
				$rscatchid = mysqli_fetch_array($qcatchid);
				echo $rscatchid['name']; 
				}
	?></td>
    <td>&nbsp;<?php echo $rsplayersbat['runs']; ?></td>
    <td>&nbsp;<?php echo $rsplayersbat['sixes']; ?></td>
    <td>&nbsp;<?php echo $rsplayersbat['fours']; ?></td>
    <td>&nbsp;<?php echo $rsplayersbat['balls']; ?></td>
    <td>&nbsp;<?php echo $i; ?>-<?php echo $rsplayersbat['fow']; ?>(<?php echo $rsplayersbat['dismissovers']; ?>)</td>
    <td>&nbsp; <a href='scoreboard.php?resultid=<?php echo $_GET['resultid']; ?>&firstteamid=<?php echo $_GET['firstteamid']; ?>&team1=<?php echo $_GET['team1']; ?>&team2=<?php echo $_GET['team2']; ?>&btnselectteam=<?php echo $_GET['btnselectteam']; ?>&bateditid=<?php echo $rsplayersbat['batperformanceid']; ?>'>Update</a> | 
    		   <a href='scoreboard.php?resultid=<?php echo $_GET['resultid']; ?>&firstteamid=<?php echo $_GET['firstteamid']; ?>&team1=<?php echo $_GET['team1']; ?>&team2=<?php echo $_GET['team2']; ?>&btnselectteam=<?php echo $_GET['btnselectteam']; ?>&batdelid=<?php echo $rsplayersbat['batperformanceid']; ?>'>Delete</a></td>    
  </tr>
<?php
$i++;
}
?>
</table>    

<form method="post" action="" name="formbowning">
<input type="hidden" name="ballsession" value="<?php echo $_SESSION['ballsession'] ; ?>" />
<table width="737" height="243" border="1">
  <tr>
  		<td height="40" colspan=2><h1><center>
  		      BOWLING PERFORMANCE
  		</center></h1></td>
    </tr>
    <tr>
    <td width="170" height="30"><div align="center">
      <strong>Player Name</strong></div></td>
    <td width="106"><div align="center">
      <select name="bowler2">
         <option value="">Select</option>
         <option value="0">Not applicable</option>
      
        <?php
            $sqlteams = "SELECT * FROM players where teamid='$bownlingteam' AND status='Enabled'";
            $sqlquery  = mysqli_query($cnn,$sqlteams);
            while($rsres = mysqli_fetch_array($sqlquery))
            {
                echo "<option value='$rsres[playerid]'>$rsres[name]</option>";
            }
        ?>
      </select>
    </div></td>
  </tr>
  <tr>
    <td height="30"><div align="center">
      <strong>Over's</strong></div></td>
    <td><div align="center">
   <input type="text" name="overs" value="" />
    </div></td>
  </tr>
  <tr>
    <td height="30"><div align="center">
      <strong>Maiden</strong></div></td>
    <td><div align="center">
     <input type="text" name="maidens" value="" />
    </div></td>
  </tr>
  <tr>
    <td height="30"><div align="center">
      <strong>Runs</strong></div></td>
    <td><div align="center">
      <input type="text" name="runs" />
    </div></td>
  </tr><tr>
    <td height="30"><div align="center">
      <strong>Wicket's</strong></div></td>
    <td><div align="center">
      <input type="text" name="wickets" />
    </div></td>
  </tr>
  <tr>
    <td height="28"><div align="center">
        <input type="submit" name="submitbowl" />
        &nbsp;
    </div></td>
    <td><div align="center">
      <input type=reset value="Reset">
    </div></td>
  </tr>
</table>



<table width="736" border="1">
  <tr>
 
  
    <td colspan="10"><center>
    <strong>BOWLING PERFORMANCE</strong>
    </center></td>
  </tr>
  <tr>
    <th scope="row"><div align="center"><strong>Player name</strong></div></th>
    <td><div align="center"><strong>Overs</strong></div></td>
    <td><div align="center"><strong>Maidens</strong></div></td>
    <td><div align="center"><strong>Runs</strong></div></td>
    <td><div align="center"><strong>Wickets</strong></div></td>
   <td><div align="center"><strong>Action</strong></div></td>
  </tr>
<?php
$sqlteams = "SELECT     players.*, bowlingperformance.*, players.teamid AS Expr1, bowlingperformance.resultid AS Expr2
FROM         bowlingperformance LEFT OUTER JOIN
                      players ON bowlingperformance.playerid = players.playerid
WHERE     (players.teamid = '$bownlingteam') AND (bowlingperformance.resultid = '$_GET[resultid]')";
$qplayerbowl = mysqli_query($cnn,$sqlteams) or mysqli_error($cnn);
while($rsbowling = mysqli_fetch_array($qplayerbowl))
{
?>					  
  <tr>
    <th scope="row">&nbsp;<?php echo $rsbowling['name']; ?></th>
    <td>&nbsp;<?php echo $rsbowling['overs']; ?></td>
    <td>&nbsp;<?php echo $rsbowling['maidens']; ?></td>
    <td>&nbsp;<?php echo $rsbowling['runs']; ?></td>
    <td>&nbsp;<?php echo $rsbowling['wickets']; ?></td>
    <td>&nbsp;  <a href='scoreboard.php?resultid=<?php echo $_GET['resultid']; ?>&firstteamid=<?php echo $_GET['firstteamid']; ?>&team1=<?php echo $_GET['team1']; ?>&team2=<?php echo $_GET['team2']; ?>&btnselectteam=<?php echo $_GET['btnselectteam']; ?>&bowleditid=<?php echo $rsbowling['bowlperformanceid']; ?>'>Update</a> | 
    <a href='scoreboard.php?resultid=<?php echo $_GET['resultid']; ?>&firstteamid=<?php echo $_GET['firstteamid']; ?>&team1=<?php echo $_GET['team1']; ?>&team2=<?php echo $_GET['team2']; ?>&btnselectteam=<?php echo $_GET['btnselectteam']; ?>&bowldelid=<?php echo $rsbowling['bowlperformanceid']; ?>'>Delete</a> </td>
  </tr>
<?php
}
?>
</table>
<p>&nbsp;</p>
    </form>

<?php
}
else
{
?>
    <form method="get" action="">
    <input type="hidden" name="resultid" value="<?php echo $_GET['resultid']; ?>" />
    <table width="737" border="1">
      <tr>
        <td colspan="2" align="center"> <strong>Select batting team</strong></td>
      </tr>
      <tr>
        <td width="253" ><div align="center"><strong>Team name</strong></div></td>
        <td width="468"><div align="center">
          <?php
    $sqlquery  = mysqli_query($cnn,"SELECT fixtures.*, results.* FROM results INNER JOIN fixtures ON results.fixtureid = fixtures.fixtureid WHERE results.resultid = '$_GET[resultid]'");
    while($rsres1 = mysqli_fetch_array($sqlquery))
    {
        $sqlteams1 = mysqli_query($cnn,"SELECT * FROM teams where teamid='$rsres1[teamid1]'");
        $rsteams1 = mysqli_fetch_array($sqlteams1);
		

		
        echo "<select name='firstteamid'>";
        echo "<option value='Select'>Select</option>";
        echo "<option value='$rsteams1[teamid]'>$rsteams1[teamname]</option>";
        
        $sqlteams2 = mysqli_query($cnn,"SELECT * FROM teams where teamid='$rsres1[teamid2]'");
        $rsteams2 = mysqli_fetch_array($sqlteams2);
        echo "<option value='$rsteams2[teamid]'>$rsteams2[teamname]</option>";
        echo "</select>";
		
		$rst1 = $rsteams1['teamid'];
		$rst2 = $rsteams2['teamid'];
    }
    ?>
        </div></td>
      </tr>
      <tr>
        <td colspan="2" align="center" >
        <input type="hidden" name="team1" value="<?php echo $rst1; ?>"  />
        <input type="hidden" name="team2" value="<?php echo $rst2; ?>"  />
        <input type="submit" name="btnselectteam" id="btnselectteam" /></td>
        </tr>
    </table>
    </form>
<?php
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