<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
include("dbconnection.php");



if($_SESSION['setvar'] == $_POST['setvar'])
{
if(isset($_POST['submit']))
{

$imgname = rand(). $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "imgnews/".$imgname);

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
			$insres = mysqli_query($cnn, "INSERT INTO news (newstitle,publishingdate,image,newsdescription,status) values ('$_POST[newstitle]','$_POST[publishingdate]','$imgname','$_POST[newsdescription]','$_POST[status]')");
			
			if(!$insres)
			{
				$res = "Failed to insert record ".mysqli_error($cnn);
			}
			else
			{
				$res = "News published succcessfully..";
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
<?php echo $res; ?>    
      <form method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="setvar" value="<?php echo $_SESSION['setvar']; ?>">
<table border=9 height=350 width=400>
<tr>
	<th>
		NEWS TITLE
	</th>
	<th>
		<input type=text name=newstitle>
	</th>
</tr>
<tr>
	<th>
		ARTICLE DATE
	</th>
	<th>
		<input type="date" name=publishingdate>
	</th>
</tr>
<tr>
	<th>
		ARTICLE IMAGES
	</th>
	<th>
		<input type=file name=image>
	</th>
</tr>
<tr>
	<th>
		DESCRIPTION
	</th>
	<th>
		<textarea name=newsdescription></textarea>
	</th>
</tr>


<tr>
	<th>
		Status
	</th>
	<th>
		Enable<input type=radio name=status value=enable>
		Disable<input type=radio name=status value=disable>
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