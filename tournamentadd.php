<?php
//session_start(); 
include("header.php");
include("dbconnection.php");
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
		
		$insres = mysqli_query($cnn, "INSERT INTO tournaments (type,name,noofteams,startdate,enddate,overs,status) values ('$_POST[type]','$_POST[name]','$_POST[noofteams]','$_POST[startdate]','$_POST[enddate]','$_POST[overs]','$_POST[status]')");
		
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
$_SESSION["setvar"] = rand();
$selectquery = mysqli_query($cnn, "SELECT * FROM tournaments where tournamentid='$_GET[editid]'");
$rsarray = mysqli_fetch_array($selectquery);

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
<form method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="setvar" value="<?php echo $_SESSION['setvar']; ?>">
<input type="hidden" name="cupid" value="<?php echo $rsarray['cupid']; ?>">

<table border=9 height=550 width=550>
<?php
if($qresulti == 1 )
{
	echo "<tr><td colspan='2'>$qresult</td></tr>";
}
?>
<tr>
	<th>
		TOURNAMENT TYPE
	</th>
	<th>

		<select name=type>
			 <?php
			 	$arradtype = array("Select","League","Knock out");
			foreach($arradtype as $value)
			{
				if($value == $rsarray['type'])
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
		TOURNAMENT Name
	</th>
	<th>
		<input type=text name=name value="<?php echo $rsarray['name']; ?>">
	</th>
</tr>
<tr>
	<th>
		Max teams
	</th>
	<th>
		<input type=text name=noofteams value="<?php echo $rsarray['noofteams']; ?>">
	</th>
</tr>

<tr>
	<th>
		START DATE
	</th>
	<th>
		<input type="date" name="startdate" value="<?php echo $rsarray['startdate']; ?>">
		
	</th>
</tr>
<tr>
	<th>
		END DATE
	</th>
	<th>
		<input type="date" name="enddate" value="<?php echo $rsarray['enddate']; ?>">
		
	</th>
</tr>
<tr>
	<th>
		OVERS
	</th>
	<th>
		<input type=text name=overs value="<?php echo $rsarray['overs']; ?>">
		
	</th>
</tr>
<tr>
	<th>
		status
	</th>
	<th>
		Active
        <input type=radio name=status value=Active
        <?php
        		if($rsarray['status']== "Active")
				{
				echo "checked";
				}
		?>
        >
		Inactive
        <input type=radio name=status value=Inactive
        <?php
        		if($rsarray['status']== "Inactive")
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