<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");
include("header.php");

$dt = date("Y-m-d");

if($_SESSION['setvar'] == $_POST['setvar'])
{

if($_FILES['teamlogo']['name'] == "")
{
	$fiename = $_POST['teamlogoimg'];
}
else
{
	$fiename = rand(). $_FILES['teamlogo']['name'];
	move_uploaded_file($_FILES['teamlogo']['tmp_name'], "imgteam/".$fiename);
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
	$insres = mysqli_query($cnn, "INSERT INTO teams (teamname,teamlogo,teaminfo,teamowners,teamorganiser,address,contactno,status,createddate) values ('$_POST[teamname]','$fiename','$_POST[teaminfo]','$_POST[teamowners]','$_POST[teamorganiser]','$_POST[address]','$_POST[contactno]','$_POST[status]','$dt		')");
	
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
<h2>Team</h2>    
<form method="post" action="" enctype="multipart/form-data" name="form1" onsubmit="return validation()">
<input type="hidden" name="setvar" value="<?php echo $_SESSION['setvar']; ?>">
<table border=9 height=350 width=400>
<?php
if($qresulti == 1 )
{
	echo "<tr><td colspan='2'>$qresult</td></tr>";
}
?>
<tr>
	<th>TEAM NAME</th><th><input type=text name=teamname value="<?php echo $rsarray['teamname']; ?>"></th>
</tr>
<tr>
	<th>
		TEAM LOGO
	</th>
	<th>
		<input type=file name=teamlogo>
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
	<th>
		TEAM INFO
	</th>
	<th>
		<textarea name=teaminfo><?php echo $rsarray['teaminfo']; ?></textarea>
	</th>
</tr>
<tr>
	<th>
		TEAM OWNERS
	</th>
	<th>
		<input type=text name=teamowners value="<?php echo $rsarray['teamowners']; ?>">
		
	</th>
</tr>
<tr>
	<th>
		TEAM ORGANISER
	</th>
	<th>
		<input type=text name=teamorganiser value="<?php echo $rsarray['teamorganiser']; ?>">
		
	</th>
</tr>
<tr>
	<th>
		ADDRESS
	</th>
	<th>
		<textarea name=address><?php echo $rsarray['address']; ?></textarea>
	</th>
</tr>
<tr>
	<th>
		CONTACT NO.
	</th>
	<th>
		<input type=text name=contactno value="<?php echo $rsarray['contactno']; ?>">
		
	</th>
</tr>
<tr>
	<th>
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
	<th>
		<input type=submit name="submit" value=SUBMIT>
	</th>
	<th>
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
<script language="javascript" type="application/javascript">
function validation()
{
	if(form1.teamname.value == "" )
	{
		alert("Team name should not be empty..");
		form1.teamname.focus();
		return false;
	}
	else if(form1.teamname.value.length < 3 )
	{
		alert("Minimum length should be more than 3 characters..");
		form1.teamname.focus();
		return false;
	}
	else if(isNaN(form1.teamname.value) != true)
	{
		alert("Please enter alphabets in Team name..");
		form1.teamname.focus();
		return false;
	}
	else if(isNaN(form1.teamlogo.value) =="")
	{
		alert("Please upload Team Logo..");
		return false;
	}
	if ( ( form1.status[0].checked == false ) && ( form1.status[1].checked == false ) ) 
	{
		alert("Please slect status..");

		return false;
	}
	else
	{
		return true;
	}
}
</script>