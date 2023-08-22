<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");
if(isset($_GET["deleteid"]))
{
	$delres = mysqli_query($cnn, "DELETE FROM players where playerid='$_GET[deleteid]'");
	if(!$delres)
			{				
				$resdel = "You cant delete this records..";
			}
			else
			{
				$resdel =  "Record deleted successfully..";
			}
}

session_start(); //For latest updates visit www.freestudentprojects.com ..
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
    <p>
      <?php
	echo $resdel;
	?>
    </p>
    <form id="form1" name="form1" method="post" action="">
    Select Team : <select name="teamid">
    <option value="">Select</option>
	<?php
	$qres = mysqli_query($cnn, "select * from teams where status='Enabled'");
	while($arrrec = mysqli_fetch_array($qres))
	{
		echo "<option value='$arrrec[teamid]'>$arrrec[teamname]</option>"; 
	}
    ?>
    </select>
    <input name="selectteam" type="submit" value="Submit" />
    </form><br />
    <table width="441" border="1">
      <tr>
    <th width="105" scope="col">profilepic</th>
    <th width="105" scope="col">Team name</th>
    <th width="105" scope="col">name</th>
    <th width="105" scope="col">DOB</th>
    <th width="105" scope="col">pnoneno</th> 
    <th width="105" scope="col">createddate</th>  
    <th width="87" scope="col">Status</th>

      <th width="87" scope="col">Action</th>
  </tr>
  <?php
		if(isset($_POST['selectteam']))
		{
		$qres = mysqli_query($cnn, "select players.*,teams.* from players INNER JOIN teams ON teams.teamid=players.teamid where teams.teamid='$_POST[teamid]' and players.teamid!='0' ");
		}
		else
		{
		$qres = mysqli_query($cnn, "select players.*,teams.* from players INNER JOIN teams ON teams.teamid=players.teamid  and players.teamid!='0' ");
		}
	
	while($arrrec = mysqli_fetch_array($qres))
	{
	echo "<tr>";
	echo "<td>&nbsp;";
		if($arrrec['profilepic'] == "")
	{
	echo "<img src='images/noimage.jpg' width='150' height='100'>";		
	}
	else
	{
	echo "<img src='imgplayer/$arrrec[profilepic]' width='150' height='100'>";
	}
	echo "</td>";
   	echo "<td>$arrrec[teamname]</td>"; 
	echo "<td>&nbsp;$arrrec[name]</td>";
	echo "<td>&nbsp;$arrrec[dob]</td>";	
	echo "<td>&nbsp;$arrrec[phoneno]</td>";
	echo "<td>&nbsp;$arrrec[createddate]</td>";
	echo "<td>&nbsp;$arrrec[status]</td>";
    echo "<td>&nbsp; <a href='players.php?editid=$arrrec[playerid]'>Edit</a> | 
	<a href='viewplayer.php?deleteid=$arrrec[playerid]'>Delete</a> </td>";
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