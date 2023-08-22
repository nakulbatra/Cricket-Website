<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");

$dt = date("Y-m-d");

//if($_SESSION[setvar] == $_POST[setvar])
{

if($_FILES['image']['name'] == "")
{
	$fiename = $_POST['teamlogoimg'];
}
else
{
	$fiename = rand(). $_FILES['image']['name'];
	move_uploaded_file($_FILES['image']['tmp_name'], "imgphotos/".$fiename);
}

if(isset($_POST['submit']))
{
		if(isset($_GET['editid']))
		{
			$insres = mysqli_query($cnn,"UPDATE teams SET teamname='$_POST[teamname]',teamlogo='$fiename',teaminfo='$_POST[teaminfo]',teamowners='$_POST[teamowners]',teamorganiser='$_POST[teamorganiser]',address='$_POST[address]',contactno='$_POST[contactno]',status='$_POST[status]' where teamid='$_GET[editid]'");
			if(!$insres)
			{
				$qresulti =  1;
				$qresult =   "Failed to update record";
			}
			else
			{
				$qresulti =  1;
				$qresult =   "Record updated successfully..";
			}
		}
		else
		{
	$insres = mysqli_query($cnn, "INSERT INTO gallery (tournamentid,imagepath,description,date,status) values ('$_POST[tournamentid]','$fiename','$_POST[imageinfo]','$dt','$_POST[status]')");
	
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

$selectquery = mysqli_query($cnn, "SELECT * FROM teams where teamid='$_GET[editid]'");
$rsarray = mysqli_fetch_array($selectquery);
?>
<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
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
<h2>Upload photos</h2>    
<form method="post" action="" enctype="multipart/form-data" name="form1" onsubmit="return validation()">
<input type="hidden" name="setvar" value="<?php echo $_SESSION['setvar']; ?>">
<table border=9 height=193 width=522>
<?php
if($qresulti == 1 )
{
	echo "<tr><td colspan='2'>$qresult</td></tr>";
}
?>
<tr>
  <th height="38">Tournament</th>
  <th>
    <select name="tournamentid" id="tournamentid">
    <option value=""></option>
    <?php
	$selectquery = mysqli_query($cnn, "SELECT * FROM tournaments where status='Active'");
	while($rsarray = mysqli_fetch_array($selectquery))
	{
		echo "<option value='$rsarray[tournamentid]'>$rsarray[name]</option>";
	}
	?>
    </select>
    </th>
</tr>
<tr>
  <th width="162" height="38">Image</th>
  <th width="328">
    <input name=image type=file id="image">
    <input type="hidden" name="teamlogoimg" value="<?php echo $rsarray['teamlogo']; ?>" />
  <?php   
if(isset($_GET['editid']))     
{
	if($rsarray['teamlogo'] == "")
	{
	echo "<img src='images/noimage.jpg' width='150' height='100'>";		
	}
	else
	{
	echo "<img src='imgteam/$rsarray[teamlogo]' width='150' height='100'>";
	}
}
?>	
    </th>
</tr>
<tr>
  <th height="45">
    Image info
    </th>
  <th>
    <textarea name=imageinfo><?php echo $rsarray['teaminfo']; ?></textarea>
    </th>
</tr>
<tr>
  <th height="45">
    Status
    </th>
  <th>
    ENABLED<input type=radio name=status value="Enabled"
        <?php
        if($rsarray['status'] == "Enabled")
		{
			echo "checked";
		}
		?>
        >
    DISABLED<input type=radio name=status value="Disabled"
        <?php
        if($rsarray['status'] == "Disabled")
		{
			echo "checked";
		}
		?>
        >
    </th>
</tr>
<tr>
	<th colspan="2" align="center">
    <input type=submit name="submit" value="Upload photos" />
	<input type=RESET>
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