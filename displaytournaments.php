<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");
include("header.php");

?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
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
    </div>
    <!-- ################################################################################################ -->
    <div id="portfolio" class="three_quarter">
    <?php
	echo "<strong>$resdel</strong>";
	?>
<table width="581" border="1">
  <tr>
    <th scope="col">CUP TYPE</th>
    <th scope="col">CUP NAME</th>
    	<th scope="col">Teams</th>
    <th scope="col">Startdate</th>
    <th scope="col">enddate</th>
    <th scope="col">overs</th>
   

  </tr>
  <?php
    $qres = mysqli_query($cnn, "select * from tournaments");
	while($arrrec = mysqli_fetch_array($qres))
	{
	echo "<tr>";
	echo "<td>&nbsp;$arrrec[type]</td>";
    echo "<td>&nbsp;$arrrec[name]</td>";
    echo "<td>&nbsp; Max Teams: $arrrec[noofteams] <br>";
	
	$qresteams = mysqli_query($cnn, "select DISTINCT teamid from tournamentteams where tournamentid='$arrrec[tournamentid]'");
	echo "&nbsp; No. of Teams: ". mysqli_num_rows($qresteams);
	echo "<br>&nbsp;&nbsp;<a href='tournamentteamsview.php?tournamentteams=$arrrec[tournamentid]'>View teams</a></td>";
    echo "<td>&nbsp;$arrrec[startdate]</td>";
	  echo "<td>&nbsp;$arrrec[enddate]</td>";
	     echo "<td>&nbsp;$arrrec[overs]</td>";
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