<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
include("dbconnection.php");

//Retrieve records using GET method
$fixtureid = $_GET['fixtureid'];
$resultid =  $_GET['resultid'];

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

//Records from results 
$sqlresults = "SELECT * FROM results WHERE resultid='$resultid'";
$qresults = mysqli_query($cnn,$sqlresults);
$rsresults = mysqli_fetch_array($qresults);

//Team1 information
$sqlTeam1 = "SELECT * FROM teams WHERE teamid='$team1id'";
$qTeam1 = mysqli_query($cnn,$sqlTeam1);
$rsTeam1 = mysqli_fetch_array($qTeam1);

//Team2 information
$sqlTeam2 = "SELECT * FROM teams WHERE teamid='$team2id'";
$qTeam2 = mysqli_query($cnn,$sqlTeam2);
$rsTeam2 = mysqli_fetch_array($qTeam2);

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
$qoversplayed2 = mysqli_query($cnn,$sqloversplayed2);
$rsoversplayed2 = mysqli_fetch_array($qoversplayed2);
$oversplayed2 =  $rsoversplayed2[0];
//ends here : Code to count nubmer of overs played by team 2
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div class="three_quarter first">
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
              <th>SR</th>
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
				
					if($rsscoreboard1['dismisstype'] == "Caught" )
					{
						echo "c ";
					}
					else if($rsscoreboard1['dismisstype'] == "Not out" )
					{
						echo "Not out ";
					}
					else if($rsscoreboard1['dismisstype'] == "Bowled" )
					{
						echo "b ";
					}
					else if($rsscoreboard1['dismisstype'] == "LBW" )
					{
						echo "LBW b ";
					}
						else if($rsscoreboard1['dismisstype'] == "Bowled" )
					{
						echo "b ";
					}
						else if($rsscoreboard1['dismisstype'] == "Run out" )
					{
						echo "Run out ";
					}
						else if($rsscoreboard1['dismisstype'] == "Stumped" )
					{
						echo "St ";
					}
						else if($rsscoreboard1['dismisstype'] == "Hit Wicket" )
					{
						echo "Hit Wicket ";
					}	
					else if($rsscoreboard1['dismisstype'] == "Timed out" )
					{
						echo "Timed out ";
					}
					else if($rsscoreboard1['dismisstype'] == "Timed out" )
					{
						echo "Timed out ";
					}
					else if($rsscoreboard1['dismisstype'] == "Handling the ball" )
					{
						echo "Handling the ball ";
					}
					else if($rsscoreboard1['dismisstype'] == "Obstructing the field" )
					{
						echo "Obstructing the field ";
					}	
					else if($rsscoreboard1['dismisstype'] == "Hitting the ball twice" )
					{
						echo "Hitting the ball twice ";
					}
					else if($rsscoreboard1['dismisstype'] == "Retired hurt")
					{
							echo "Retired hurt ";	
					}
					else
					{
						echo "Program error ";
					}
				
				//catchid
				if($rsscoreboard1['catchid'] != 0)
				{
				
				$sqlcatchid = "SELECT * FROM players WHERE playerid='$rsscoreboard1[catchid]'";
				$qcatchid = mysqli_query($cnn,$sqlcatchid);
				$rscatchid = mysqli_fetch_array($qcatchid);
				echo $rscatchid['name']; 
				}
				
					//b
					if($rsscoreboard1['dismisstype'] == "Caught" )
					{
						echo " b ";
					}
					else if($rsscoreboard1['dismisstype'] == "Stumped" )
					{
						echo " b ";
					}
					else if($rsscoreboard1['dismisstype'] == "Hit Wicket" )
					{
						echo " b ";
					}
					
				//catchid
				if($rsscoreboard1['bowledid'] != 0)
				{
				$sqlcatchid = "SELECT * FROM players WHERE playerid='$rsscoreboard1[bowledid]'";
				$qcatchid = mysqli_query($cnn,$sqlcatchid);
				$rscatchid = mysqli_fetch_array($qcatchid);
				echo $rscatchid['name']; 
				}
					
					 echo "</td>
					  <td>&nbsp;$rsscoreboard1[runs]</td>
					  <td>&nbsp;$rsscoreboard1[balls]</td>
					  <td>&nbsp;$rsscoreboard1[fours]</td>
					  <td>&nbsp;$rsscoreboard1[sixes]</td>
					  <td>&nbsp;";
				$sr = 0;
			 	$sr = (100 * $rsscoreboard1['runs']) /$rsscoreboard1['balls'];
				echo round($sr, 2);
				$runs = $runs + $rsscoreboard1['runs'];
					  echo "</td>
					</tr>";
	}
 }
?>
           <tr>
             <th>Extras</th>
             <th> <?php echo " nb $nb, wb $wb, b $b, lb $lb "; ?></th>
             <th colspan="5" align="left"><?php echo $extras = $nb + $wb + $b + $lb; ?></th>
            </tr>
           <tr>
             <th><strong>Total</strong></th>
             <th> <?php echo $oversplayed1; ?> overs</th>
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
             <th colspan="3" align="left"> (<?php echo round($totalruns / $oversplayed1,2); ?> runs per over)</th>
           </tr>
        </table>

        <table class="tftable" >
            <tr>
              <th>Bowler</th>
              <th>Overs</th>
              <th>Maiden</th>
              <th>Runs</th>
              <th>Wickets</th>
              <th>Econ</th>
            </tr>
<?php
$qbowlingperformance1 = mysqli_query($cnn,$sqlbowingperformance);
 while($rsbowlingperformance1 = mysqli_fetch_array($qbowlingperformance1))
 {
	if($rsbowlingperformance1[1] ==  $team2id)	
	{ 
			 echo "
			 <tr>
			  <td>&nbsp;$rsbowlingperformance1[name]</td>
			  <td>&nbsp;";
			  echo str_replace(".0","",$rsbowlingperformance1['overs']);
			  echo "</td>
			  <td>&nbsp;$rsbowlingperformance1[maidens]</td>
			  <td>&nbsp;$rsbowlingperformance1[runs]</td>
			  <td>&nbsp;$rsbowlingperformance1[wickets]</td>
			  <td>&nbsp;";	
			  $econ = 0;
			 	$econ = $rsbowlingperformance1['runs'] /$rsbowlingperformance1['overs'];
				echo round($econ, 2);
			  echo "</td></tr>";
	}
 }
?>            

        </table>
      </section>
<!-- First batting team statistics ends here -->

<?php
//Clear value
$runs=0;
?>

<!-- Second BAtting team statistics starts here -->
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
              <th>SR</th>
            </tr>				              
<?php
$nowickets = 0;
$qscoreboard1 = mysqli_query($cnn,$sqlscoreboard);
 while($rsscoreboard1 = mysqli_fetch_array($qscoreboard1))
 {
	 
	if($rsscoreboard1['catchid'] == $team2id  && $rsscoreboard1['dismisstype'] == "Extras" )
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
				
					if($rsscoreboard1['dismisstype'] == "Caught" )
					{
						echo "c ";
					}
					else if($rsscoreboard1['dismisstype'] == "Not out" )
					{
						echo "Not out ";
					}
					else if($rsscoreboard1['dismisstype'] == "Bowled" )
					{
						echo "b ";
					}
					else if($rsscoreboard1['dismisstype'] == "LBW" )
					{
						echo "LBW b ";
					}
						else if($rsscoreboard1['dismisstype'] == "Bowled" )
					{
						echo "b ";
					}
						else if($rsscoreboard1['dismisstype'] == "Run out" )
					{
						echo "Run out ";
					}
						else if($rsscoreboard1['dismisstype'] == "Stumped" )
					{
						echo "St ";
					}
						else if($rsscoreboard1['dismisstype'] == "Hit Wicket" )
					{
						echo "Hit Wicket ";
					}	
					else if($rsscoreboard1['dismisstype'] == "Timed out" )
					{
						echo "Timed out ";
					}

					else if($rsscoreboard1['dismisstype'] == "Handling the ball" )
					{
						echo "Handling the ball ";
					}
					else if($rsscoreboard1['dismisstype'] == "Obstructing the field" )
					{
						echo "Obstructing the field ";
					}	
					else if($rsscoreboard1['dismisstype'] == "Hitting the ball twice" )
					{
						echo "Hitting the ball twice ";
					}
					else if($rsscoreboard1['dismisstype'] == "Retired hurt")
					{
							echo "Retired hurt ";	
					}
					else
					{
						echo "Program error ";
					}
				
				//catchid
				if($rsscoreboard1['catchid'] != 0)
				{
				
				$sqlcatchid = "SELECT * FROM players WHERE playerid='$rsscoreboard1[catchid]'";
				$qcatchid = mysqli_query($cnn,$sqlcatchid);
				$rscatchid = mysqli_fetch_array($qcatchid);
				echo $rscatchid['name']; 
				}
				
					//b
					if($rsscoreboard1['dismisstype'] == "Caught" )
					{
						echo " b ";
					}
					else if($rsscoreboard1['dismisstype'] == "Stumped" )
					{
						echo " b ";
					}
					else if($rsscoreboard1['dismisstype'] == "Hit Wicket" )
					{
						echo " b ";
					}
					
				//catchid
				if($rsscoreboard1['bowledid'] != 0)
				{
				$sqlcatchid = "SELECT * FROM players WHERE playerid='$rsscoreboard1[bowledid]'";
				$qcatchid = mysqli_query($cnn,$sqlcatchid);
				$rscatchid = mysqli_fetch_array($qcatchid);
				echo $rscatchid['name']; 
				}
					
					 echo "</td>
					  <td>&nbsp;$rsscoreboard1[runs]</td>
					  <td>&nbsp;$rsscoreboard1[balls]</td>
					  <td>&nbsp;$rsscoreboard1[fours]</td>
					  <td>&nbsp;$rsscoreboard1[sixes]</td>
					  <td>&nbsp;";
				if($rsscoreboard1['balls'] == 0 && $rsscoreboard1['runs'] == 0)
				{
					echo 0;
				}
				else
				{
					$sr = 0;
					$sr = (100 * $rsscoreboard1['runs']) /$rsscoreboard1['balls'];
					echo round($sr, 2);
				}
				//Coding to calculate total runs
				$runs = $runs + $rsscoreboard1['runs'];
					  echo "</td>
					</tr>";
	}
 }
?>
           <tr>
             <th>Extras</th>
             <th> <?php echo " nb $nb, wb $wb, b $b, lb $lb "; ?></th>
             <th colspan="5" align="left"><?php echo $extras = $nb + $wb + $b + $lb; ?></th>
            </tr>
           <tr>
             <th><strong>Total</strong></th>
             <th> <?php echo $oversplayed2; ?> overs</th>
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
             <th colspan="3" align="left"> (<?php echo round($totalruns / $oversplayed2,2); ?> runs per over)</th>
           </tr>
        </table>

        <table class="tftable" >
            <tr>
              <th>Bowler</th>
              <th>Overs</th>
              <th>Maiden</th>
              <th>Runs</th>
              <th>Wickets</th>
              <th>Econ</th>
            </tr>
<?php
$qbowlingperformance1 = mysqli_query($cnn,$sqlbowingperformance);
 while($rsbowlingperformance1 = mysqli_fetch_array($qbowlingperformance1))
 {
	if($rsbowlingperformance1[1] ==  $team1id)	
	{ 
			 echo "
			 <tr>
			  <td>&nbsp;$rsbowlingperformance1[name]</td>
			  <td>&nbsp;";
			  echo str_replace(".0","",$rsbowlingperformance1['overs']);
			  echo "</td>
			  <td>&nbsp;$rsbowlingperformance1[maidens]</td>
			  <td>&nbsp;$rsbowlingperformance1[runs]</td>
			  <td>&nbsp;$rsbowlingperformance1[wickets]</td>
			  <td>&nbsp;";	
			  $econ = 0;
			 	$econ = $rsbowlingperformance1['runs'] /$rsbowlingperformance1['overs'];
				echo round($econ, 2);
			  echo "</td></tr>";
	}
 }
?>            

        </table>
      </section>
<!-- Second batting team statistics ends here -->

<!--Scrap book Post form starts here  -->      
      <div id="respond">
        <h2>Scrap book</h2>
<?php

if($_POST['setcmtid'] == $_SESSION['setcmtid'])
{

	if(isset($_POST['submit']))
	{
		$insscrapbook = "INSERT INTO scrapbook (name ,posttype ,message ,status ,sdatetime)VALUES ('$_POST[author]',  '$pagename',  '$_POST[message]',  'Enabled',  '$dttim')";
		if(!mysqli_query($cnn,$insscrapbook))
		{
			echo mysqli_error($cnn);
		?>
		<script type="application/javascript" language="javascript">
		alert("Problem in connection...");
		</script>
		<?php
		}
		else
		{
		?>
		<script type="application/javascript" language="javascript">
		alert("Comment published successfully...");
		</script>
		<?php
		}
	}
}
$_SESSION['setcmtid'] = rand();
?>
        <form class="rnd5" action="" method="post">
        <input type="hidden" name="setcmtid" value="<?php echo $_SESSION['setcmtid']; ?>" />
          <div class="form-input clear">
            <label class="one_third first" for="author">Name <span class="required">*</span>
              <input type="text" name="author" id="author" value="" size="22">
            </label>
          </div>
          <div class="form-message">
            <textarea name="message" id="message" cols="25" rows="3"></textarea>
          </div>
          <p>
            <input type="submit" value="Submit" name="submit">
            &nbsp;
            <input type="reset" value="Reset">
          </p>
        </form>
      </div>
<!-- Scrap book post form ends here -->   
   
<!--Scrap book View code starts here  -->   
<?php
$selectquery = mysqli_query($cnn, "SELECT * FROM  scrapbook ORDER BY sbid DESC ");
while($rsarray = mysqli_fetch_array($selectquery))
{
?>
      <div class="alert-msg info">
      Author: <a href='#' ><?php echo $rsarray['name']; ?></a> <a href='#' style='float: right;vertical-align:top' >Published date: <?php echo $rsarray['sdatetime']; ?> </a>
	  <hr>
      <?php echo $rsarray['message']; ?>
      </div>
	  
<?php	  
}
?>	  
<!-- Scrap book View code ends here -->   
      
    </div>
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter">
		<?php
		include("subpagesidebar.php");
		?>
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>