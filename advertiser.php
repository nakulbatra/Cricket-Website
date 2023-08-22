<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..

include("dbconnection.php");

if($_FILES['image']['name'] == "")
{
$imgname = $_POST['imagename'];
}
else
{
$imgname = rand(). $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "files/".$imgname);
}



if($_SESSION['setvar'] == $_POST['setvar'])
{
	if(isset($_POST['submit']))
	{
		if(isset($_GET['editid']))
		{

			
			$insres = mysqli_query($cnn,"UPDATE advertisers SET advertisement='$_POST[advertisment]',image='$imgname',position='$_POST[position]',status='$_POST[status]' where advertsmentid='$_POST[advertsmentid]'");
			if(!$insres)
			{
				echo "Failed to update record";
			}
			else
			{
				echo "Record updated successfully..";
			}
		}
		else
		{
			$insres = mysqli_query($cnn, "INSERT INTO advertisers (advertisement,image,position,status) values ('$_POST[advertisment]','$imgname','$_POST[position]','$_POST[status]')");
			
			if(!$insres)
			{
				echo "Failed to insert record";
			}
			else
			{
				echo "Record inserted successfully..";
			}
		}
		
	}
}

$_SESSION["setvar"] = rand();


if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}
include("header.php");

if(isset($_GET['editid']))
{
	$selectquery = mysqli_query($cnn, "SELECT * FROM advertisers where advertsmentid='$_GET[editid]'");
	$rsarray1a = mysqli_fetch_array($selectquery);
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
<input type="hidden" name="advertsmentid" value="<?php echo $rsarray1a['advertsmentid']; ?>">
<input type="hidden" name="imagename" value="<?php echo $rsarray1a['image']; ?>">
<table border=9 height=350 width=400>
<tr>
	<th>
		Advertisement title
	</th>
	<th>
		<input type=text name=advertisment value="<?php echo $rsarray1a['advertisement']; ?>">
	</th>
</tr>
<tr>
	<th>
		Image
	</th>
	<th>
		<input type=file name=image>
        <?php
		if(isset($_GET['editid']))
		{
        echo "<br /><img src='files/$rsarray1a[image]' /></img>";
		}
		?>
	</th>
</tr>
<tr>
	<th>
		Position
	</th>
	<th>
    <?php
	$arradposition = array("TOP","BOTTOM","RIGHT","LEFT");
	?>
		<select name=position>
			<option>Select</option>
            <?php
			foreach($arradposition as $value)
			{
				if($value == $rsarray1a['position'])
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
		Status
	</th>
	<th>
		Active
        <input type=radio name=status value=Active
        <?php
        		if($rsarray1a['status']== "Active")
				{
				echo "checked";
				}
		?>
        >
		Inactive
        <input type=radio name=status value=Inactive
        <?php
        		if($rsarray1a['status']== "Inactive")
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
		<input type=RESET value="Reset" name="reset">
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