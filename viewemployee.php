<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");
$sql="SELECT * FROM Employee";
$resemployee=mysqli_query($con,$sql);
?>
<table border="2">
<tr>
<th>Emp Namne</th>
<th>Login Type</th>
<th>Login Id</th>
<th>Designation</th>
<th>Last Login</th>
<th>Status</th>
</tr>
<?php
while($rs=mysqli_fetch_array($resemployee))
{
	echo "<tr>";
	echo "<td>$rs[empname]</td>";
	echo "<td>$rs[logintype]</td>";
	echo "<td>$rs[loginid]</td>";
	echo "<td>$rs[designation]</td>";
	echo "<td>$rs[lastlogin]</td>";
	echo "<td>$rs[status]</td>";
	echo "</tr>";
}
?>
</table>
