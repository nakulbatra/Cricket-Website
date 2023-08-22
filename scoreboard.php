<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
include("dbconnection.php");
?>
<script>
function updaterec(batperformanceid,valuetype,codevalue)
{
	/*
alert(batperformanceid);
alert(valuetype);
alert(codevalue);
*/
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajaxscoreboard.php?batperformanceid="+batperformanceid+"&valuetype="+valuetype+"&codevalue="+codevalue,true);
xmlhttp.send();
}
</script>
<div id="txtHint"><b>Person info will be listed here.</b></div>
<?php
//Retrieve records using GET method

$resultid =  $_GET['resultid'];

//Delete players
if(isset($_GET['delid']) || isset($_GET['delid']))
{
$sqlresults = "DELETE from batperformance WHERE playerid='$_GET[delid]' AND resultid='$resultid'";
$qresults = mysqli_query($cnn,$sqlresults);

$sqlresults = "DELETE from bowlingperformance WHERE playerid='$_GET[delid]' AND resultid='$resultid'";
$qresults = mysqli_query($cnn,$sqlresults);
}


//Records from results 
$sqlresults = "SELECT * FROM results WHERE resultid='$resultid'";
$qresults = mysqli_query($cnn,$sqlresults);
$rsresults = mysqli_fetch_array($qresults);

$fixtureid = $rsresults['fixtureid'];
$tossid = $rsresults['tossid'];

// Retrive playing teams record
$sqlfixtureid = "SELECT * FROM fixtures WHERE fixtureid='$fixtureid'";
$qfixtureid = mysqli_query($cnn,$sqlfixtureid);
$rsfixtureid = mysqli_fetch_array($qfixtureid);
$team1id = $rsfixtureid['teamid1'];
$team2id = $rsfixtureid['teamid2'];
$tournamentid = $rsfixtureid['tournamentid'];

//Records from tournaments
$sqltournaments = "SELECT * FROM  tournaments WHERE tournamentid='$tournamentid'";
$qtournaments = mysqli_query($cnn,$sqltournaments);
$rstournaments = mysqli_fetch_array($qtournaments);



//Team1 information
$sqlTeam1 = "SELECT * FROM teams WHERE teamid='$team1id'";
$qTeam1 = mysqli_query($cnn,$sqlTeam1);
$rsTeam1 = mysqli_fetch_array($qTeam1);

//Team2 information
$sqlTeam2 = "SELECT * FROM teams WHERE teamid='$team2id'";
$qTeam2 = mysqli_query($cnn,$sqlTeam2);
$rsTeam2 = mysqli_fetch_array($qTeam2);

$qoversplayed2 = mysqli_query($cnn,$sqloversplayed2);
$rsoversplayed2 = mysqli_fetch_array($qoversplayed2);
$oversplayed2 =  $rsoversplayed2[0];
//ends here : Code to count nubmer of overs played by team 2

//Code to check first batting team and second batting team $rsTeam1 $rsTeam2
if($team1id == $tossid)
{
	$firstbat = $team1id;
	$secondbat = $team2id;
}
else
{
	$firstbat = $team2id;
	$secondbat = $team1id;
}

//
$sqlinsbat = "SELECT * FROM batperformance WHERE resultid='$_GET[resultid]'";
$qinsbat = mysqli_query($cnn,$sqlinsbat);
if(mysqli_num_rows($qinsbat) == 0)
{
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///Insert team 1
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$sqlinsbat = "SELECT * FROM players WHERE teamid='$firstbat'";
	$qinsbat = mysqli_query($cnn,$sqlinsbat);
	while($rsinsbat = mysqli_fetch_array($qinsbat))
	{
		
		$insres = mysqli_query($cnn, "INSERT INTO batperformance (resultid,playerid,catchid) values ('$_GET[resultid]','$rsinsbat[playerid]','0')");
	}
	
	//Bowling performance
	$sqlinsbat = "SELECT * FROM players WHERE teamid='$secondbat'";
	$qinsbat = mysqli_query($cnn,$sqlinsbat);
	while($rsinsbat = mysqli_fetch_array($qinsbat))
	{
		
		$insres = mysqli_query($cnn, "INSERT INTO bowlingperformance (resultid,playerid) values ('$_GET[resultid]','$rsinsbat[playerid]')");
	}

	//Insert team1 extras
		$insres = mysqli_query($cnn, "INSERT INTO batperformance (resultid,playerid,catchid,dismisstype) values ('$_GET[resultid]','0','$firstbat','Extras')");
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///Insert team 2
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$sqlinsbat = "SELECT * FROM players WHERE teamid='$secondbat'";
	$qinsbat = mysqli_query($cnn,$sqlinsbat);
	while($rsinsbat = mysqli_fetch_array($qinsbat))
	{
		
		$insres = mysqli_query($cnn, "INSERT INTO batperformance (resultid,playerid,catchid) values ('$_GET[resultid]','$rsinsbat[playerid]','0')");
	}

	//Insert team2 extras
		$insres = mysqli_query($cnn, "INSERT INTO batperformance (resultid,playerid,catchid,dismisstype) values ('$_GET[resultid]','0','$secondbat','Extras')");
	
	//Bowling performance
	$sqlinsbat = "SELECT * FROM players WHERE teamid='$firstbat'";
	$qinsbat = mysqli_query($cnn,$sqlinsbat);
	while($rsinsbat = mysqli_fetch_array($qinsbat))
	{
		
		$insres = mysqli_query($cnn, "INSERT INTO bowlingperformance (resultid,playerid) values ('$_GET[resultid]','$rsinsbat[playerid]')");
	}
	

}

//Batting performance of Team1 and Team2
$sqlscoreboard = "SELECT     batperformance.*, players.*, results.*, fixtures.*
FROM players RIGHT OUTER JOIN
 batperformance ON players.playerid = batperformance.playerid LEFT OUTER JOIN
 fixtures INNER JOIN
 results ON fixtures.fixtureid = results.fixtureid ON batperformance.resultid = results.resultid";

//Bowling performance of Team1 and Team2
$sqlbowingperformance = "SELECT     players.*, bowlingperformance.*, results.*, fixtures.*
FROM         fixtures INNER JOIN
                      results ON fixtures.fixtureid = results.fixtureid RIGHT OUTER JOIN
                      bowlingperformance LEFT OUTER JOIN
                      players ON bowlingperformance.playerid = players.playerid ON results.resultid = bowlingperformance.resultid"
;


//starts here : Code to count number of overs played by team 1
$sqloversplayed1 = "SELECT     SUM(overs)
FROM         fixtures INNER JOIN
                      results ON fixtures.fixtureid = results.fixtureid RIGHT OUTER JOIN
                      bowlingperformance LEFT OUTER JOIN
                      players ON bowlingperformance.playerid = players.playerid ON results.resultid = bowlingperformance.resultid WHERE players.teamid='$team2id'"
;
$qoversplayed1 = mysqli_query($cnn,$sqloversplayed1);
$rsoversplayed1 = mysqli_fetch_array($qoversplayed1);
$oversplayed1 =  $rsoversplayed1[0];
//ends here : Code to count nubmer of overs played by team 1

//starts here : Code to count number of overs played by team 2
$sqloversplayed2 = "SELECT     SUM(overs)
FROM         fixtures INNER JOIN
                      results ON fixtures.fixtureid = results.fixtureid RIGHT OUTER JOIN
                      bowlingperformance LEFT OUTER JOIN
                      players ON bowlingperformance.playerid = players.playerid ON results.resultid = bowlingperformance.resultid WHERE players.teamid='$team1id'"
;

?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
 <!-- ################################################################################################ -->

    <!-- ################################################################################################ -->

      
      <section class="clear">
        <table width="341" class="tftable" >
            <tr>
              <td>&nbsp;<strong><?php echo ucfirst($rsTeam1['teamname']) . " vs ". ucfirst($rsTeam2['teamname']); ?></strong></td>
              <td>&nbsp;<strong><?php echo ucfirst($rstournaments['name']); ?> <?php echo $rstournaments['type']; ?> <?php echo $rsfixtureid['level']; ?>
			  , <?php echo $rstournaments['overs']; ?> overs match </strong>
              </td>
            </tr>
            <tr>
              <td>&nbsp;<strong><?php echo $rsresults['comment']; ?></strong></td>
              <td>&nbsp;<strong>Played at <?php echo $rsfixtureid['venue'] ; ?> on  
			  <?php 
			  	$dateSrc = $rsfixtureid['fixdatetime'];
   				$dateTime = date_create($dateSrc);
				echo date_format($dateTime,"d-m-Y"); 
			  	//echo date_format($rsfixtureid[fixdatetime],"d-m-Y"); 
				?></strong>
              
              </td>
            </tr>
          </table>
</section>
<!-- First BAtting team statistics starts here -->
    <div class="toggle-wrapper"><a href="javascript:void(0)" class="toggle-title orange"><span>First innings</span></a>
    <div class="toggle-content">
      <section>
        <h1><?php echo $rsTeam1['teamname']; ?> innings</h1>
        <table  class="tftable">
        
            <tr>
              <th>Batsman</th>
              <th>Dismissal type</th>
              <th>Runs</th>
              <th>Balls</th>
              <th>4s</th>
              <th>6s</th>
              <th>Del</th>
            </tr>				              
<?php
$nowickets = 0;
$qscoreboard1 = mysqli_query($cnn,$sqlscoreboard);
 while($rsscoreboard1 = mysqli_fetch_array($qscoreboard1))
 {
	 
	if($rsscoreboard1['catchid'] == $team1id  && $rsscoreboard1['dismisstype'] == "Extras" )
	{
		$nb = $rsscoreboard1['runs'];
		$wb = $rsscoreboard1['balls'];
		$b = $rsscoreboard1['fours'] ;
		$lb = $rsscoreboard1['sixes'] ;
	}
	if($rsscoreboard1[13] ==  $team1id)	
	{
		//Wickets code
		if($rsscoreboard1['dismisstype'] != "Not out")
		{		 
			$nowickets = $nowickets +1;		
		}
					echo "<tr>
					  <td>&nbsp;$rsscoreboard1[name]</td>
					  <td>&nbsp;";
					?> 
        <select name="dismisstype" id="dismisstype" onchange="updaterec(<?php echo $rsscoreboard1['batperformanceid']; ?>,'dismisstype',this.value)">
        <?php
		$arr = array("Select","Not out","Caught","Bowled","LBW","Run out","Stumped","Hit Wicket","Timed out","Handling the ball","Obstructing the field","Hitting the ball twice","Retired hurt");
		foreach($arr as $value)
		{
					if($rsscoreboard1['dismisstype'] == $value )
					{
						echo "<option value='$value' selected>$value</option>";
					}
					else
					{
						echo "<option value='$value'>$value</option>";	
					}
		}
		?>
      </select>
              
              <select name="cid" id="cid" onchange="updaterec(<?php echo $rsscoreboard1['batperformanceid']; ?>,'cid',this.value)">
              <option value="">Select</option>
                    <?php					
				//catchid
				$sqlcatchid = "SELECT * FROM players WHERE teamid='$team2id'";
				$qcatchid = mysqli_query($cnn,$sqlcatchid);
					while($rscatchid = mysqli_fetch_array($qcatchid))
					{
						if($rsscoreboard1['catchid'] == $rscatchid['playerid'])
						{
						echo "<option value='$rscatchid[playerid]' selected>$rscatchid[name]</option>"; 
						}
						else
						{
						echo "<option value='$rscatchid[playerid]'>$rscatchid[name]</option>"; 
						}
					}
					?>
				</select>

				<select name="bid" id="bid" onchange="updaterec(<?php echo $rsscoreboard1['batperformanceid']; ?>,'bid',this.value)">
	             <option value="">Select</option>                
                    <?php	
						$sqlcatchid = "SELECT * FROM players WHERE teamid='$team2id'";
						$qcatchid = mysqli_query($cnn,$sqlcatchid);
						while($rscatchid = mysqli_fetch_array($qcatchid))
						{
						if($rsscoreboard1['bowledid'] == $rscatchid['playerid'])
								{
								echo "<option value='$rscatchid[playerid]' selected>$rscatchid[name]</option>"; 
								}
								else
								{
								echo "<option value='$rscatchid[playerid]'>$rscatchid[name]</option>"; 
								}
						} 
				?>
				</select>
<?php	
					 echo "</td><td>&nbsp;";
					 ?>
<input type='text' name='runs' value='<?php echo $rsscoreboard1['runs']; ?>' size='3' onkeyup="updaterec(<?php echo $rsscoreboard1['batperformanceid']; ?>,'runs',this.value)" >
					  </td>
					  <td>&nbsp;
<input type='text' name='balls' value='<?php echo $rsscoreboard1['balls']; ?>' size='3' onkeyup="updaterec(<?php echo $rsscoreboard1['batperformanceid']; ?>,'balls',this.value)"></td>
					  <td>&nbsp;
<input type='text' name='fours' value='<?php echo $rsscoreboard1['fours']; ?>' size='2' onkeyup="updaterec(<?php echo $rsscoreboard1['batperformanceid']; ?>,'fours',this.value)"></td>
					  <td>&nbsp;
<input type='text' name='sixes' value='<?php echo $rsscoreboard1['sixes']; ?>' size='2' onkeyup="updaterec(<?php echo $rsscoreboard1['batperformanceid']; ?>,'sixes',this.value)"></td>
					  <td>&nbsp;<a href='scoreboard.php?delid=$rsscoreboard1[playerid]&resultid=$_GET[resultid]'>X</a></td>
					</tr>
<?php                    
	}
 }
?>
           <tr>
             <th>Extras</th>
             <th> <?php echo " 
			 nb <input type='text' name='nb' value='$nb' size='2'  >, 
			 wb <input type='text' name='nb' value='$wb' size='2' >, 
			 b <input type='text' name='nb' value='$b' size='2' >, 
			 lb <input type='text' name='nb' value='$lb' size='2' > "; ?></th>
             <th colspan="5" align="left"></th>
            </tr>
           <tr>
             <th><strong>Total</strong></th>
             <th><input type='text' name='sixes' value='<?php echo $oversplayed1; ?>' size='3'> overs</th>
             <th colspan="2" align="left"> <?php echo $totalruns =  $runs + $extras; ?>
              /  
              <?php 
			  if($nowickets == 10)
			  {
				 	echo "All out"; 
			  }
			  else if($nowickets == 10)
			  {
				 	echo $nowickets. " wicket"; 
			  }
			  else
			  {
					echo $nowickets ." wickets"; 
			  }
			  ?> 
              
             </th>
             <th colspan="3" align="left"> </th>
           </tr>
        </table>

        <table class="tftable" >
            <tr>
              <th>Bowler</th>
              <th>Overs</th>
              <th>Maiden</th>
              <th>Runs</th>
              <th>Wickets</th>
              <th>Del</th>
            </tr>
<?php
$qbowlingperformance1 = mysqli_query($cnn,$sqlbowingperformance);
 while($rsbowlingperformance1 = mysqli_fetch_array($qbowlingperformance1))
 {
	if($rsbowlingperformance1[1] ==  $team2id)	
	{ 
			 echo "<tr>
			  <td>&nbsp;$rsbowlingperformance1[name]</td>
			  <td>&nbsp;";
			  echo "<input type='text' name='maidens' value='$rsbowlingperformance1[overs]' size='3'>";
			  echo "</td>
			  <td>&nbsp;<input type='text' name='maidens' value='$rsbowlingperformance1[maidens]' size='2'></td>
			  <td>&nbsp;<input type='text' name='runs' value='$rsbowlingperformance1[runs]' size='3'></td>
			  <td>&nbsp;<input type='text' name='wickets' value='$rsbowlingperformance1[wickets]' size='2'></td>
			  <td>&nbsp;<a href='scoreboard.php?delid=$rsbowlingperformance1[playerid]&resultid=$_GET[resultid]'>X</a></td>
			  </tr>";
	}
 }
?>            

        </table>
      </section>
    </div>
    </div>
<!-- First batting team statistics ends here -->

<?php
//Clear value
$runs=0;
?>

<!-- Second BAtting team statistics starts here -->

    <div class="toggle-wrapper"><a href="javascript:void(0)" class="toggle-title orange"><span>Second innings</span></a>
    <div class="toggle-content">
      <section>
        <h1><?php echo $rsTeam2['teamname']; ?> innings</h1>
        <table  class="tftable">
        
            <tr>
              <th>Batsman</th>
              <th>Dismissal type</th>
              <th>Runs</th>
              <th>Balls</th>
              <th>4s</th>
              <th>6s</th>
              <th>Del</th>
            </tr>				              
<?php
$nowickets = 0;
$qscoreboard1 = mysqli_query($cnn,$sqlscoreboard);
 while($rsscoreboard1 = mysqli_fetch_array($qscoreboard1))
 {

	if($rsscoreboard1['catchid'] == $team1id  && $rsscoreboard1['dismisstype'] == "Extras" )
	{
		$nb = $rsscoreboard1['runs'];
		$wb = $rsscoreboard1['balls'];
		$b = $rsscoreboard1['fours'] ;
		$lb = $rsscoreboard1['sixes'] ;
	}
	if($rsscoreboard1[13] ==  $team2id)	
	{
		//Wickets code
		if($rsscoreboard1['dismisstype'] != "Not out")
		{		 
			$nowickets = $nowickets +1;		
		}
					echo "<tr>
					  <td>&nbsp;$rsscoreboard1[name]</td>
					  <td>&nbsp;";
					?> 
        <select name="dismisstype" id="dismisstype">
        <option value="">Select</option>
        <?php
		$arr = array("Select","Not out","Caught","Bowled","LBW","Run out","Stumped","Hit Wicket","Timed out","Handling the ball","Obstructing the field","Hitting the ball twice","Retired hurt");
		foreach($arr as $value)
		{
					if($rsscoreboard1['dismisstype'] == $value )
					{
						echo "<option value='$value' selected>$value</option>";
					}
					else
					{
						echo "<option value='$value'>$value</option>";	
					}
		}
		?>
      </select>
              <select name="cid" id="cid">
             <option value="">Select</option>              
                    <?php					
				//catchid
				$sqlcatchid = "SELECT * FROM players WHERE teamid='$team1id'";
				$qcatchid = mysqli_query($cnn,$sqlcatchid);
					while($rscatchid = mysqli_fetch_array($qcatchid))
					{
						if($rsscoreboard1['catchid'] == $rscatchid['playerid'])
						{
						echo "<option value='$rscatchid[playerid]' selected>$rscatchid[name]</option>"; 
						}
						else
						{
						echo "<option value='$rscatchid[playerid]'>$rscatchid[name]</option>"; 
						}
					}
					?>
				</select>

				<select name="bid" id="bid">
             <option value="">Select</option>                 
                    <?php	
						$sqlcatchid = "SELECT * FROM players WHERE teamid='$team1id'";
						$qcatchid = mysqli_query($cnn,$sqlcatchid);
						while($rscatchid = mysqli_fetch_array($qcatchid))
						{
						if($rsscoreboard1['bowledid'] == $rscatchid['playerid'])
								{
								echo "<option value='$rscatchid[playerid]' selected>$rscatchid[name]</option>"; 
								}
								else
								{
								echo "<option value='$rscatchid[playerid]'>$rscatchid[name]</option>"; 
								}
						} 
				?>
				</select>
<?php	
					 echo "</td><td>&nbsp;";
					 echo "<input type='text' name='runs' value='$rsscoreboard1[runs]' size='3'>
					  </td>
					  <td>&nbsp;<input type='text' name='balls' value='$rsscoreboard1[balls]' size='3'></td>
					  <td>&nbsp;<input type='text' name='fours' value='$rsscoreboard1[fours]' size='3'></td>
					  <td>&nbsp;<input type='text' name='sixes' value='$rsscoreboard1[sixes]' size='3'></td>
					  <td>&nbsp;<a href='scoreboard.php?delid=$rsscoreboard1[playerid]&resultid=$_GET[resultid]'>X</a></td>
					</tr>";
	}
 }
?>
           <tr>
             <th>Extras</th>
             <th> <?php echo " nb <input type='text' name='nb' value='$nb' size='2' >, wb <input type='text' name='nb' value='$wb' size='2' >, b <input type='text' name='nb' value='$b' size='2' >, lb <input type='text' name='nb' value='$lb' size='2' > "; ?></th>
             <th colspan="5" align="left"></th>
            </tr>
           <tr>
             <th><strong>Total</strong></th>
             <th><input type='text' name='sixes' value='<?php echo $oversplayed1; ?>' size='3'> overs</th>
             <th colspan="2" align="left"> <?php echo $totalruns =  $runs + $extras; ?>
              <?php 
			  if($nowickets == 10)
			  {
				 	echo "All out"; 
			  }
			  else if($nowickets == 10)
			  {
				 	echo $nowickets. " wicket"; 
			  }
			  else
			  {
					echo $nowickets ." wickets"; 
			  }
			  ?> 
              
             </th>
             <th colspan="3" align="left"> </th>
           </tr>
        </table>

        <table class="tftable" >
            <tr>
              <th>Bowler</th>
              <th>Overs</th>
              <th>Maiden</th>
              <th>Runs</th>
              <th>Wickets</th>
              <th>Del</th>
            </tr>
<?php
$qbowlingperformance1 = mysqli_query($cnn,$sqlbowingperformance);
 while($rsbowlingperformance1 = mysqli_fetch_array($qbowlingperformance1))
 {
	if($rsbowlingperformance1[1] ==  $team1id)	
	{ 
			 echo "<tr>
			  <td>&nbsp;$rsbowlingperformance1[name]</td>
			  <td>&nbsp;";
			  echo "<input type='text' name='maidens' value='$rsbowlingperformance1[overs]' size='3'>";
			  echo "</td>
			  <td>&nbsp;<input type='text' name='maidens' value='$rsbowlingperformance1[maidens]' size='3'></td>
			  <td>&nbsp;<input type='text' name='runs' value='$rsbowlingperformance1[runs]' size='3'></td>
			  <td>&nbsp;<input type='text' name='wickets' value='$rsbowlingperformance1[wickets]' size='3'></td>
			  <td>&nbsp;<a href='scoreboard.php?delid=$rsbowlingperformance1[playerid]&resultid=$_GET[resultid]'>X</a></td>
			  </tr>";
	}
 }
?>            

        </table>
      </section>

    </div>  
<!-- Second batting team statistics ends here -->

    </div>
    <!-- ################################################################################################ -->

    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>