<?php
include("dbconnection.php");
include("header.php");
if(isset($_GET["deleteid"]))
{
	$delres = mysqli_query($cnn, "DELETE FROM teams where teamid='$_GET[deleteid]'");
		if(!$delres)
			{
				$resdel = "<strong>Failed to delete record</strong>";
			}
			else
			{
				$resdel =  "<strong>Record deleted successfully..</strong>";
			}
}
?>
<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
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
echo $resdel; 
?>
  <?php
    $qres = mysqli_query($cnn, "select * from teams");
	while($arrrec = mysqli_fetch_array($qres))
	{  
	echo "<table width='581' border='1'>";
	echo "<tr>";
    echo "<td>
	<strong>Team detail</strong><br>
	&nbsp;Team name: $arrrec[teamname] <br> ";
	if($arrrec['teamlogo'] == "")
	{
	echo "<img src='images/noimage.jpg' width='150' height='100'>";		
	}
	else
	{
	echo "<img src='imgteam/$arrrec[teamlogo]' width='150' height='100'>";
	}
	echo "</td><td>
	<strong>Contact details</strong><br>
	Team Owner: $arrrec[teamowners] <br>
	Team Organizer: $arrrec[teamorganiser]<br>
	$arrrec[address]&nbsp;<br>Contacct No. : $arrrec[contactno]</td>";
    echo "<td>&nbsp; Status: $arrrec[status] <br>
	Created Date: $arrrec[createddate] <br>
	&nbsp; <a href='teams.php?editid=$arrrec[teamid]'>Edit</a> | 
	<a href='viewteam.php?deleteid=$arrrec[teamid]'>Delete</a> </td>";
	echo "</tr>";
	
	echo "<tr>";
    echo "<td colspan='3'><strong>About Team:</strong> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$arrrec[teaminfo]</td>";
	echo "</tr>";
	echo "</table>";
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