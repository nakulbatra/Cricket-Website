<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
include("dbconnection.php");
?>
<script type="application/javascript">
function validation()
{
	if(document.form1.teamid.value=="Select")
	{
		alert("Team name is not valid");
		return false();
	}
}
</script>
<?php
if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}

$dt = date("Y-m-d");
if($_SESSION['setvar'] == $_POST['setvar'])
{	

if(isset($_POST['submit']))
{
	
		if($_FILES['profilepic']['name'] == "")
	{
		$fiename = $_POST['profilepichidden'];
	}
	else
	{
		$fiename = rand(). $_FILES['profilepic']['name'];
		move_uploaded_file($_FILES['profilepic']['tmp_name'], "imgplayer/".$fiename);
	}
	if(isset($_GET['editid']))
		{

$insres = mysqli_query($cnn,"UPDATE players SET teamid='$_POST[teamid]',name='$_POST[name]',dob='$_POST[dob]',petname='$_POST[petname]',playingrole='$_POST[playingrole]',battingstyle='$_POST[battingstyle]',bowlingstyle='$_POST[bowlingstyle]',playerprofile='$_POST[playerprofile]',profilepic='$fiename',phoneno='$_POST[phoneno]',status='$_POST[status]' where playerid='$_GET[editid]'");
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
	$insres = mysqli_query($cnn, "INSERT INTO players (teamid,name,dob,petname,playingrole,battingstyle,bowlingstyle,playerprofile,profilepic,phoneno,createddate,status) values
 ('$_POST[teamid]','$_POST[name]','$_POST[dob]','$_POST[petname]','$_POST[playingrole]', '$_POST[battingstyle]','$_POST[bowlingstyle]','$_POST[playerprofile]','$fiename','$_POST[phoneno]','$dt','$_POST[status]')");
	
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
	}
}
$_SESSION["setvar"] = rand();


if(isset($_GET['editid']))
{
$selectquery = mysqli_query($cnn, "SELECT * FROM players where playerid='$_GET[editid]'");
$rsplarray = mysqli_fetch_array($selectquery);
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
<form name="form1" method="post" action="" enctype="multipart/form-data" onsubmit="return validation()">
<input type="hidden" name="setvar" value="<?php echo $_SESSION['setvar']; ?>">
<table border=9 height=550 width=550>
<?php
if($qresulti == 1 )
{
	echo "<tr><td colspan='2'>$qresult</td></tr>";
}
?>
<tr>
	<th>
		TEAM NAME
	</th>
	<th>
<select name="teamid">
<option value="Select">Select</option>
<?php
$sqlteams = "SELECT * FROM teams where status='Enabled'";
$sqlquery  = mysqli_query($cnn,$sqlteams);
while($rsres = mysqli_fetch_array($sqlquery))
{
	if($rsres['teamid']== $rsplarray["teamid"])
	{
	echo "<option value='$rsres[teamid]' selected>$rsres[teamname]</option>";
	}
	else
	{
	echo "<option value='$rsres[teamid]'>$rsres[teamname]</option>";
	}
}
?>
</select>
	</th>
</tr>
<tr>
	<th>
		Player Name
	</th>
	<th>
		<input type=text name=name value="<?php echo $rsplarray['name']; ?>">
	</th>
</tr>
<tr>
	<th>
		Date OF Birth
	</th>
	<th>
		<input type=date name=dob value="<?php echo $rsplarray['dob']; ?>">
	</th>
</tr>
<tr>
	<th>
		Pet Name
	</th>
	<th>
		<input type=text name=petname value="<?php echo $rsplarray['petname']; ?>">
	</th>
</tr>
<tr>
	<th>
		Playing Role
	</th>
	<th>
    <?php
	$arr = array("Batsman","Bowler","Wicket Keeper Batsman","Allrounder");
	foreach($arr as $value)
	{
		if($value == $rsplarray['playingrole'])
		{
		echo "$value <input type=radio name='playingrole' value='$value' checked><hr>";
		}
		else
		{
		echo "$value <input type=radio name='playingrole' value='$value'><hr>";
		}
	}
	?>
		
	</th>
</tr>
<tr>
	<th>
		BATTING STYLE
	</th>
	<th>
    <select name="battingstyle">
            	<option value="Select">Select</option>

	<?php
	$arr = array("Right-hand bat","Left-hand bat");
	foreach($arr as $value)
	{
		if($value == $rsplarray['battingstyle'])
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
	</th>
</tr>
<tr>
	<th>
		BOWLING STYLE
	</th>
	<th>
			<select name=bowlingstyle>
   <?php
	$arr = array("RIGHT-Arm Fast","LEFT-Arm Fast","RIGHT-Arm MEDIUM Fast","LEFT-Arm MEDIUM Fast","RIGHT-Arm OFF Spin","LEFT-Arm OFF Spin","RIGHT-Arm LEG break","LEFT-Arm LEG break","RIGHT-Arm GOOGLY","LEFT-Arm GOOGLY","RIGHT-UNDER Arm","LEFT-UNDER Arm");
	foreach($arr as $value)
	{
		if($value == $rsplarray['bowlingstyle'])
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
		
	</th>
</tr>
<tr>
	<th>
		PLAYER PROFILE
	</th>
	<th>
		<textarea name=playerprofile><?php echo $rsplarray['playerprofile']; ?></textarea>
	</th>
</tr>
<tr>
	<th>
		PLAYER Display Picture
	</th>
	<th>
		<input type=file name="profilepic">
        <input type="hidden" name="profilepichidden" value="<?php echo $rsplarray['profilepic']; ?>" />
<?php        
	if($rsplarray['profilepic'] == "")
	{
	echo "<img src='images/noimage.jpg' width='100' height='125'>";		
	}
	else
	{
	echo "<img src='imgplayer/$rsplarray[profilepic]' width='100' height='125'>";
	}
?>	
	</th>
</tr>
<tr>
	<th>
		CONTACT NO.
	</th>
	<th>
		<input type=text name=phoneno value="<?php echo $rsplarray['phoneno']; ?>">
		
	</th>
</tr>
<tr>
	<th>
		Status
	</th>
	<th>
			ENABLED<input type=radio name=status value="Enabled"
        <?php
        if($rsplarray['status'] == "Enabled")
		{
			echo "checked";
		}
		?>
        >
		DISABLED<input type=radio name=status value="Disabled"
        <?php
        if($rsplarray['status'] == "Disabled")
		{
			echo "checked";
		}
		?>
        >
	</th>
</tr>
<tr>
	<th>
		<input type=submit name="submit" value=SUBMIT>
	</th>
	<th>
		<input type="reset" name="reset">
	</th>
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