<?php
include("dbconnection.php");
if(isset($_GET["deleteid"]))
{
	$delres = mysqli_query($cnn, "DELETE FROM advertisers where advertsmentid='$_GET[deleteid]'");
		if(!$delres)
			{
				echo "Failed to delete record";
			}
			else
			{
				echo "Record deleted successfully..";
			}
}
?>
<table width="581" border="1">
  <tr>
    <th scope="col">Image</th>
    <th scope="col">Advertisement info</th>
    <th scope="col">Position</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
  <?php
    $qres = mysqli_query($cnn, "select * from advertisers");
	while($arrrec = mysqli_fetch_array($qres))
	{
	echo "<tr>";
    echo "<td>&nbsp;<img src='files/$arrrec[image]'></td>";
    echo "<td>&nbsp;$arrrec[advertisement]</td>";
    echo "<td>&nbsp;$arrrec[position]</td>";
    echo "<td>&nbsp;$arrrec[status]</td>";
    echo "<td>&nbsp; <a href='advertiser.php?editid=$arrrec[advertsmentid]'>Edit</a> | 
	<a href='viewadvertisement.php?deleteid=$arrrec[advertsmentid]'>Delete</a> </td>";
	echo "</tr>";
	}
  ?>
</table>
