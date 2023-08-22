<?php
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
?>

<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
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
<table width="581" border="1">
  <tr>
    <th scope="col">CUP TYPE</th>
    <th scope="col">CUP NAME</th>
    	<th scope="col">Teams</th>
    <th scope="col">Startdate</th>
    <th scope="col">enddate</th>
    <th scope="col">overs</th>
    <th scope="col">status</th>    
    <th scope="col">Action</th>
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
    echo "<td>&nbsp;$arrrec[status]</td>";
	  echo "<td>&nbsp; <a href='tournamentadd.php?editid=$arrrec[tournamentid]'>Edit</a> | 
	<a href='tournamentview.php?deleteid=$arrrec[tournamentid]'>Delete</a> </td>";
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