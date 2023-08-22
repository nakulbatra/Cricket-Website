<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..

$dt = date("Y-m-d");
if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}
include("dbconnection.php");

if(isset($_GET["delid"]))
{
	$delres2 = mysqli_query($cnn, "DELETE FROM fixtures where fixtureid='$_GET[delid]'");
		if(!$delres2)
			{
				$resdel2 = "Failed to delete record";
			}
			else
			{
				$resdel2 =  "Record deleted successfully..";
			}
}

if($_SESSION['setvar'] == $_POST['setvar'])
{
	if(isset($_POST['submit']))
	{
		$fixdate = $_POST['fixdate'];
		$fixtime =$_POST['fixtime'];
		$fixdatetime = $fixdate. " " . $fixtime;
		
		if(isset($_GET['editid']))
		{
			$insres = mysqli_query($cnn, "UPDATE  fixtures SET  levelid='$_POST[levelid]',level='$_POST[level]',tournamentid =  '$_GET[tournamentid]',teamid1 =  '$_POST[team1]',teamid2 =  '$_POST[team2]',venue =  '$_POST[venue]',fixdatetime = '$fixdatetime', matchtype =  '$_POST[type]' WHERE  fixtureid ='$_GET[editid]'");
			echo mysqli_error($cnn);
			if(!$insres)
			{
				$qresulti =  1;
				$qresult =   "Failed to insert record";
			}
			else
			{
				header("Location: fixtures.php?tournamentid=$_GET[tournamentid]&updrec=1");
			}
		}
		else
		{
			$insres = mysqli_query($cnn, "INSERT INTO fixtures (levelid,level,tournamentid,teamid1,teamid2,venue,fixdatetime,matchtype) values ('$_POST[levelid]','$_POST[level]','$_GET[tournamentid]','$_POST[team1]','$_POST[team2]','$_POST[venue]','$fixdatetime','$_POST[type]')");
			echo mysqli_error($cnn);
			if(!$insres)
			{
				$qresulti =  1;
				$qresult =   "Failed to insert record";
			}
			else
			{
				$qresulti =  1;
				header("Location: fixtures.php?tournamentid=$_GET[tournamentid]&insrec=1");
			}
		}
	}
}
$_SESSION["setvar"] = rand();

$selectquery = mysqli_query($cnn, "SELECT * FROM fixtures where fixtureid='$_GET[editid]'");
$rsarray = mysqli_fetch_array($selectquery);


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
	echo "<a href='fixtures.php?tournamentid=$_GET[tournamentid]&editid=$arrtournamentteamsview[fixtureid]'>Edit</a> | <a href='fixtures.php?tournamentid=$_GET[tournamentid]&delid=$arrtournamentteamsview[fixtureid]'>Delete</a>";
	echo "</td>
	</tr>";
	
	}
?>  
  <tr>

    <td>&nbsp;
  <form method="post" name="form1" action="" >
<input type="hidden" name="setvar" value="<?php echo $_SESSION["setvar"]; ?>">
<input type="hidden" name="levelid" value="<?php echo $arrtournamentlevel['levelid']; ?>" />
<input type="hidden" name="level" value="<?php echo $arrtournamentlevel['level']; ?>" />
    <select name="team1">
    <option value="">Select</option>
    <?php
		for($i=0; $i < count($playingteamid); $i++)
		{		
			if($rsarray['teamid1'] == $playingteamid[$i])
			{
			echo "<option value='$playingteamid[$i]' selected>$playingteamname[$i]</option>";
			}
			else
			{
			echo "<option value='$playingteamid[$i]'>$playingteamname[$i]</option>"; 
			}
		}
	?>
    </select>
    </td>
    <td>&nbsp;
    <select name="team2">
    <option value="">Select</option>
    <?php
		for($i=0; $i < count($playingteamid); $i++)
		{		
			if($rsarray['teamid2'] == $playingteamid[$i])
			{
			echo "<option value='$playingteamid[$i]'  selected>$playingteamname[$i]</option>"; 
			}
			else
			{
			echo "<option value='$playingteamid[$i]'>$playingteamname[$i]</option>"; 			
			}
		}
	?>
    </select>
    </td>
    <td><textarea name="venue" id="venue"><?php echo $rsarray['venue']; ?></textarea></td>
   	<?php
	if(isset($_GET['editid']))
	{
		$phpfixdate = strtotime($rsarray['fixdatetime']);
		$mysqldate = date( 'Y-m-d', $phpfixdate );
		
		$phpfixtime = strtotime($rsarray['fixdatetime']);
		$mysqltime = date( 'h:i:s', $phpfixtime );
	}
	?>
    <td><input type="date" name="fixdate" value="<?php echo $mysqldate; ?>" /><br /><input type="time" name="fixtime" value="<?php echo $mysqltime; ?>"  /></td>
    <td><select name="type">
   		<option value="">Select</option>
        <?php
			$arr = array("Day", "Night", "Day and Night");
			foreach($arr as $val)
			{
				if($val == $rsarray['matchtype'])
				{
				echo "<option value='$val' selected>$val</option>";
				}
				else
				{
				echo "<option value='$val'>$val</option>";				
				}
			}
		?>

    	</select>
    </td>
        <td><input type="submit" value"submit" name="submit" />
      		<input type="reset" />      
			</form>
    </td>
  </tr>

</table>
<hr />
<?php
$levelid = $arrtournamentlevel['levelid'];
	}
?>


<h2 align="center"><u>Level <?php echo $levelid = $levelid +1; ?> Add New </u></h2>

<form method="post" name="form1" action="" >
<input type="hidden" name="setvar" value="<?php echo $_SESSION["setvar"]; ?>">
<input type="hidden" name="levelid" value="<?php echo $levelid; ?> " />

<table width="734" border="1">
  <tr>
    <td width="168" align="center"><strong>Level</strong></td>
    <td width="73" align="center"><strong>Teams</strong></td>
    <td width="161" align="center"><strong>Venue</strong></td>
    <td width="147" align="center"><strong>Date / Time</strong></td>
    <td width="81" align="center"><strong>Match type</strong></td>
    <td width="64" align="center"><strong>Action</strong></td>
  </tr>
  <tr>
      <td align="center" valign="middle">
<input type="text" name="level" />			
    </td>

    <td>
    <select name="team1">
    <option value="">Select</option>
    <option value="">TBC</option>
    <?php
		for($i=0; $i < count($playingteamid); $i++)
		{		
			if($rsarray['teamid1'] == $playingteamid[$i])
			{
			echo "<option value='$playingteamid[$i]' selected>$playingteamname[$i]</option>";
			}
			else
			{
			echo "<option value='$playingteamid[$i]'>$playingteamname[$i]</option>"; 
			}
		}
	?>
    </select>
    
    <select name="team2">
    <option value="">Select</option>
    <option value="">TBC</option>
    <?php
		for($i=0; $i < count($playingteamid); $i++)
		{		
			if($rsarray['teamid2'] == $playingteamid[$i])
			{
			echo "<option value='$playingteamid[$i]'  selected>$playingteamname[$i]</option>"; 
			}
			else
			{
			echo "<option value='$playingteamid[$i]'>$playingteamname[$i]</option>"; 			
			}
		}
	?>
    </select>
    </td>
    <td><textarea name="venue" id="venue"><?php echo $rsarray['venue']; ?></textarea></td>
    <td>
       	<?php
	if(isset($_GET['editid']))
	{
		$phpfixdate = strtotime($rsarray['fixdatetime']);
		$mysqldate = date( 'Y-m-d', $phpfixdate );
		
		$phpfixtime = strtotime($rsarray['fixdatetime']);
		$mysqltime = date( 'h:i:s', $phpfixtime );
	}
	?>
    <input type="date" name="fixdate" value="<?php echo $mysqldate; ?>" /><input type="time" name="fixtime" value="<?php echo $mysqltime; ?>"  /></td>
    <td><select name="type">
   		<option value="">Select</option>
        <?php
			$arr = array("Day", "Night", "Day and Night");
			foreach($arr as $val)
			{
				if($val == $rsarray['matchtype'])
				{
				echo "<option value='$val' selected>$val</option>";
				}
				else
				{
				echo "<option value='$val'>$val</option>";				
				}
			}
		?>

    	</select>
    </td>
        <td><input type="submit" value"submit" name="submit" />
      		<input type="reset" />      
			
    </td>
  </tr>
</table>
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