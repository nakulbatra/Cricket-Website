<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("dbconnection.php");
$pagename = basename($_SERVER['PHP_SELF']);
$dttim = date("Y-m-d h:i:s");
error_reporting(E_ALL & ~E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>KARAVALI-SIXER</title>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="layout/styles/main.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/styles/mediaqueries.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/scripts/responsiveslides.js-v1.53/responsiveslides.css" rel="stylesheet" type="text/css" media="all">
</head>
<body class="">
<div class="wrapper row1">
  <header id="header" class="full_width clear">
    <hgroup>
      <h1><a href="index.php">CRIC-OL-360</a></h1>
      <h2>A 360 DEGREE VIEW TOWARDS CRICKET.</h2>
    </hgroup>
    <div id="header-contact">
    <div class="push20">
<!-- <?php
$selectquery = mysqli_query($cnn, "SELECT * FROM  advertisers where advertsmentid='20");
$rsarray = mysqli_fetch_array($selectquery);
?>  -->
<img src="images/advt.jpeg"  style="max-width:620px; max-height:80px;">

        </div>
    </div>
  </header>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <nav id="topnav">
    <ul class="clear">
      <li class="active"><a href="index.php" title="Home">Home</a></li>
      <li><a href="displaytournaments.php" title="Tournaments">Tournaments</a></li>
      <li><a href="displayteams.php" title="Teams">Teams</a></li>
      <li><a href="displayfixtures.php" title="Fixtures">Fixtures</a></li>
      <li><a href="displayresults.php" title="Results">Results</a></li>
      <li><a href="displayplayers.php" title="Link Text">Players</a></li>
      <li><a href="displaynews.php" title="Link Text">News</a></li>    
      <!-- <li><a href="displaygallery.php" title="Gallery Layouts">Photos</a></li>
      <li><a href="#" title="Link Text">Videos</a></li>     -->
    </ul>
  </nav>
</div>