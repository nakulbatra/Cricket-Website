<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");
if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}

if($_SESSION['setvar'] == $_POST['setvar'])
{

		if(isset($_POST['submit']))
		{
			$qtournamentteamsview = mysqli_query($cnn, "SELECT * FROM results where  fixtureid =  '$_GET[fixid]' ");
			if(mysqli_num_rows($qtournamentteamsview) ==0)
			{
				$insres = mysqli_query($cnn, "INSERT INTO results (fixtureid,team1score,team2score,tossid,comment) values ('$_GET[fixid]','$_POST[team1score]','$_POST[team2score]','$_POST[tossid]','$_POST[comment]')");
			
				if(!$insres)
				{
					$qresulti =  1;
					$qresult =   "Failed to insert record";
				}
				else
				{
					$qresulti =  1;
					$qresult =  "Record inserted successfully..";
				}	
			}
			else
			{
				$insres = mysqli_query($cnn, "UPDATE results  SET team1score='$_POST[team1score]',team2score='$_POST[team2score]',tossid='$_POST[tossid]',comment='$_POST[comment]' where fixtureid='$_GET[fixid]' ");
			
				if(!$insres)
				{
					$qresulti =  1;
					$qresult =   "Failed to insert record";
				}
				else
				{
					$qresulti =  1;
					$qresult =  "Record updated successfully..";
				}	
			}
		}
	
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
<form method="post" action="">
<input type="hidden" name="setvar" value="<?php echo $_SESSION['setvar']; ?>">
<table width="737" height="404" border="1">
  <tr>
    <td height="46" colspan="2"><h1>RESULTS</h1>
        <strong><?php
	if($qresulti== 1)
	{
		echo $qresult;
	}
	?></strong>
    </td>
    </tr>
  <tr>
    <td width="170" height="40"><div align="center">
      <h2><strong>Team details</strong></h2>
    </div>

    </td>
    <td width="106">
    <table width="734" border="1">
  <tr>
    <td width="67" align="center"><strong>Team 1</strong></td>
    <td width="61" align="center"><strong>Team 2</strong></td>
     <td width="161" align="center"><strong>Date</strong></td>
  </tr>
<?php  
$qtournamentresults = mysqli_query($cnn, "SELECT * FROM results where  fixtureid =  '$_GET[fixid]' ");
$arrresults = mysqli_fetch_array($qtournamentresults);
	
  	$qtournamentteamsview = mysqli_query($cnn, "SELECT * FROM fixtures where  fixtureid =  '$_GET[fixid]' ");
	while($arrtournamentteamsview = mysqli_fetch_array($qtournamentteamsview))
	{
		  	$qteamsviewteams1 = mysqli_query($cnn, "SELECT * FROM teams where  teamid ='$arrtournamentteamsview[teamid1]'");
			$arrteams1 = mysqli_fetch_array($qteamsviewteams1);
			$team1id = $arrteams1[0];
			$team1name = $arrteams1['teamname'];
			
			$qteamsviewteams2 = mysqli_query($cnn, "SELECT * FROM teams  where teamid =  '$arrtournamentteamsview[teamid2]'");
			$arrteams2 = mysqli_fetch_array($qteamsviewteams2);
			$team2id = $arrteams2[0];
			$team2name = $arrteams2['teamname'];
			
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
    <td>&nbsp;";
	$phpdate = strtotime($arrtournamentteamsview['fixdatetime']);
	echo "Date: ".$mysqldate = date( 'd-m-Y', $phpdate );
	//echo date_format($arrtournamentteamsview[fixdatetime], 'Y-m-d H:i:s');
	echo "<br />";
	$phpdate = strtotime($arrtournamentteamsview['fixdatetime']);
	echo "&nbsp;Time: ".$mysqldate = date( 'G:i A', $phpdate );
	echo "</td></tr>";
	
	}
?>  
</table>
    </td>
  </tr>
 <tr>
    <td height="30"><div align="center">
      <h2><strong>Toss</strong></h2>
    </div></td>
    <td><div align="center">
      <select name="tossid">
      <option value="">Select</option>
        <option value="<?php echo $team1id; ?>"
        <?php
		if($arrresults['tossid'] == $team1id)
		{
			echo "selected";
		}
		?>
        ><?php echo $team1name; ?></option>
        <option value="<?php echo $team2id; ?>"
        <?php
		if($arrresults['tossid'] == $team2id)
		{
			echo "selected";
		}
		?>
        ><?php echo $team2name; ?></option>
      </select>
    </div></td>
  </tr>
  <tr>
    <td height="46"><div align="center">
      <h2><strong><?php echo $team1name; ?> Score</strong></h2>
    </div></td>
    <td><div align="center">
      <input type="text" name="team1score" value="<?php echo $arrresults['team1score']; ?>" />
    </div></td>
  </tr>
  
  <tr>
    <td><div align="center">
      <h2><strong><?php echo $team2name; ?> Score </strong></h2>
    </div></td>
    <td><div align="center">
      <input type="text" name="team2score" value="<?php echo $arrresults['team2score']; ?>" />
    </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <h2><strong>Comment</strong></h2>
    </div></td>
    <td><div align="center">
      <div align="center">
        <textarea name="comment"><?php echo $arrresults['comment']; ?></textarea>
      </div>
      
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
        <input type="submit" name="submit" value="Update Result" />
        &nbsp;
      </div></td>
    </tr>
</table>
</form>
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>
