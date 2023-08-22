<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");


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
			$insres = mysqli_query($cnn, "INSERT INTO videos (videopath,description,status) values ('$_POST[videopath]','$_POST[description]','$_POST[status]')");
	
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
?>
<?php
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
<form method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="setvar" value="<?php echo $_SESSION['setvar']; ?>">
<table border=9 height=550 width=550>
<tr>
	<th>
		VIDEO URL
	</th>
	<th> <textarea name="videopath"></textarea>
	</th>
</tr>
<tr>
	<th>
		VIDEO Description
	</th>
	<th> <textarea name="description"></textarea>
	</th>
</tr>

<tr>
	<th>
		Status
	</th>
	<th>
		ENABLE<input type=radio name=status value=enable>
		DISABLE<input type=radio name=status value=disable>
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