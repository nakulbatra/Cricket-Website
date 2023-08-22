<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");



if($_SESSION['setvar'] == $_POST['setvar'])
{

if(isset($_POST['submit']))
{
	$insres = mysqli_query($cnn, "INSERT INTO subcribers (fname,lname,emailid,favteam,password,confirmpass,phno,address,status) values ('$_POST[fname]','$_POST[lname]','$_POST[emailid]','$_POST[favteam]','$_POST[password]','$_POST[confirmpass]','$_POST[phno]','$_POST[address]','$_POST[status]')");
	
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
$_SESSION["setvar"] = rand();
?>

<form method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="setvar" value="<?php echo $_SESSION['setvar']; ?>">
<table border=9 height=550 width=550>
<tr>
	<th>
		FIRST NAME
	</th>
	<th>
		<input type=text name=fname>
	</th>
</tr>
<tr>
	<th>
		SECOND Name
	</th>
	<th>
		<input type=text name=lname>
	</th>
</tr>
<tr>
	<th>
		E-MAIL ID
	</th>
	<th>
		<input type=text name=emailid>
	</th>
</tr>
<tr>
	<th>
		FAVOURITE TEAM
	</th>
	<th>
		<select name=favteam>
			<option>INDIA</option>
			<option>Bfgfdg</option>
			<option>gfdgfdC</option>
			<option>Ddfgfdgdf</option>
		</select>
	</th>
</tr>
<tr>
	<th>
		pASSWORD
	</th>
	<th>
		<input type=password name=password>
	</th>
</tr>
<tr>
	<th>
		CONFIRM PASSWORD
	</th>
	<th>
		<input type=password name=confirmpass>
	</th>
</tr>




<tr>
	<th>
		CONTACT NO.
	</th>
	<th>
		<input type=text name=phno>
		
	</th>
</tr>
<tr>
	<th>
		ADDRESS
	</th>
	<th> <textarea name="address"></textarea>
		
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
