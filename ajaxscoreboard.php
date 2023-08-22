<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");

if($_GET['valuetype'] == "dismisstype")
{
	if(!mysqli_query($cnn,"UPDATE batperformance SET dismisstype='$_GET[codevalue]' WHERE batperformanceid='$_GET[batperformanceid]'"))
	{
		mysqli_error($cnn);
	}
}

if($_GET['valuetype'] == "cid")
{
	if(!mysqli_query($cnn,"UPDATE batperformance SET catchid='$_GET[codevalue]' WHERE batperformanceid='$_GET[batperformanceid]'"))
	{
		mysqli_error($cnn);
	}
}

if($_GET['valuetype'] == "bid")
{
	if(!mysqli_query($cnn,"UPDATE batperformance SET bowledid='$_GET[codevalue]' WHERE batperformanceid='$_GET[batperformanceid]'"))
	{
		mysqli_error($cnn);
	}
}
  
if($_GET['valuetype'] == "runs")
{
	if(!mysqli_query($cnn,"UPDATE batperformance SET runs='$_GET[codevalue]' WHERE batperformanceid='$_GET[batperformanceid]'"))
	{
		mysqli_error($cnn);
	}
}
if($_GET['valuetype'] == "balls")
{
	if(!mysqli_query($cnn,"UPDATE batperformance SET balls='$_GET[codevalue]' WHERE batperformanceid='$_GET[batperformanceid]'"))
	{
		mysqli_error($cnn);
	}
}
if($_GET['valuetype'] == "fours")
{
	if(!mysqli_query($cnn,"UPDATE batperformance SET fours='$_GET[codevalue]' WHERE batperformanceid='$_GET[batperformanceid]'"))
	{
		mysqli_error($cnn);
	}
}
if($_GET['valuetype'] == "sixes")
{
	if(!mysqli_query($cnn,"UPDATE batperformance SET sixes='$_GET[codevalue]' WHERE batperformanceid='$_GET[batperformanceid]'"))
	{
		mysqli_error($cnn);
	}
}
?>