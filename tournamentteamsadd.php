<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");
?>
<script>
function showplayers(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
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
xmlhttp.open("GET","ajaxtournamentplayers.php?playerid="+str,true);
xmlhttp.send();
}
</script>
<?php
if($_SESSION['setvar'] == $_POST['setvar'])
{
	if(isset($_POST['submit']))
	{
		
		if(isset($_GET['editid']))
		{
			$insres = mysqli_query($cnn,"UPDATE tournaments SET type='$_POST[type]',name='$_POST[name]',noofteams='$_POST[noofteams]',year='$_POST[year]',startdate='$_POST[startdate]',enddate='$_POST[enddate]',overs='$_POST[overs]',status='$_POST[status]' where tournamentid='$_GET[editid]'");
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
		
		$arrplayer = $_POST['players'];
		for($i=0; $i<count($_POST['players']);$i++)
		{
			if($i==0)
			{
				$playertype = "Captain";
			}
			else
			{
				$playertype = "";				
			}
			$insres = mysqli_query($cnn, "INSERT INTO tournamentteams (tournamentid,teamid,playerid,playertype,description,status) values ('$_POST[tournamentid]','$_POST[teamid]','$arrplayer[$i]','$playertype','$_POST[description]','$_POST[status]')");
			if(!$insres)
			{
				$qresulti =  1;
				$qresult =   "Failed to insert record". mysqli_error($cnn);
			}
			else
			{
				$qresulti =  1;
				$qresult =  "Record inserted successfully..";
			}
		}
		
	}
}
}
$_SESSION["setvar"] = rand();
$selectquery = mysqli_query($cnn, "SELECT * FROM tournaments where tournamentid='$_GET[editid]'");
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
<form method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="setvar" value="<?php echo $_SESSION['setvar']; ?>">
<input type="hidden" name="tournamentid" value="<?php echo $_GET['tournamentid'];?>" />
<table border=9 height=357 width=550>
<?php
if($qresulti == 1 )
{
	echo "<tr><td colspan='2'>$qresult</td></tr>";
}
?>
<tr>
	<th width="178" height="47">
		&nbsp; &nbsp; TOURNAMENT NAME
	</th>
	<th width="340" align="left"> &nbsp; 

        <?php
        $selectquery = mysqli_query($cnn, "SELECT * FROM tournaments where tournamentid='$_GET[tournamentid]'");
		$rsarray = mysqli_fetch_array($selectquery);
		echo $rsarray['name'];
		?>
	</th>
</tr>
<tr>
	<th height="61">
		 &nbsp; &nbsp; Tournament type
	</th>
	<th align="left">
		 &nbsp; <?php
		echo $rsarray['type'];
		?>
	</th>
</tr>

<tr>
	<th height="36">
		 &nbsp; Select Team
	</th>
	<th align="left">
     &nbsp; <select name="teamid"  onchange="showplayers(this.value)">
    <option value="">Select</option>
	<?php
    $qresteams = mysqli_query($cnn, "select * from teams where status='Enabled'");
	while($arrrecteams = mysqli_fetch_array($qresteams))
	{  
		echo "<option value='$arrrecteams[teamid]'>$arrrecteams[teamname]</value>";
	}
	?>
    </select>
	</th>
</tr>

<tr>
	<th height="36" valign="top">
		 &nbsp; Select Players	</th>
	<th align="left">
    <div id="txtHint">
    
    &nbsp; <select name="captainid">
    <option value="">Select</option>
    </select>
    </div>
	</th>
</tr>


<tr>
	<th height="73">
		 &nbsp; Description
	</th> 
	<th align="left">
		 &nbsp; <textarea name="description" rows="5" cols="5" ></textarea>
	</th>
</tr>


<tr>
	<th height="41">
		&nbsp; status
	</th>
    <th align="left">
	 &nbsp; <select name=status>
    <option value="">Select</option>
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
    </select>
    </th>
</tr>
<tr>
	<th height="53" colspan="2" align="center">
	  <input type=submit name="submit" value=SUBMIT> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=RESET name="reset" value="RESET">
	  </th>
	</tr>
</table>
</form>
  </div>
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>