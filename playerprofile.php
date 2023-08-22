<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
include("dbconnection.php");
$playerquery = mysqli_query($cnn, "SELECT players.*,teams.* FROM players INNER JOIN teams where playerid='$_GET[playerid]'");
$playersqlquery = mysqli_fetch_array($playerquery);

?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div class="clear">
      <!-- ################################################################################################ -->
      <div class="one_half first">
        <h1>Player Name: <?php echo $playersqlquery['name']; ?></h1>
        <h1>Team Name: <?php echo $playersqlquery['teamname']; ?></h1>
        <div class="push30"><img src="imgplayer/<?php echo $playersqlquery['profilepic']; ?>" alt=""></div>
        <h2>About Player</h2>
       	<p><?php echo $playersqlquery['playerprofile']; ?> </p>
        <p><strong>Pet name: </strong><?php echo $playersqlquery['petname']; ?> </p>
        <p><strong>Date of Birth:</strong> <?php echo $playersqlquery['dob']; ?> </p>
        <p><strong>Playing role:</strong> <?php echo $playersqlquery['playingrole']; ?> </p>
        <p><strong>Batting Stlyle: </strong><?php echo $playersqlquery['battingstyle']; ?> </p>
        <p><strong>Bowling Style: </strong><?php echo $playersqlquery['bowlingstyle']; ?> </p>
		<p><strong>Phone No: </strong><?php echo $playersqlquery['phoneno']; ?> </p>
        
      </div>
      <div class="one_half">
        <h2>Skillset</h2>
        <div class="skillset push30">
          <ul class="nospace clear">
            <li class="size-20">Text Here
              <div class="rnd5"><strong class="rnd5">20%</strong></div>
            </li>
            <!--<li class="size-25">Text Here
      <div class="rnd5"><strong class="rnd5">25%</strong></div>
    </li>-->
            <li class="size-30">Text Here
              <div class="rnd5"><strong class="rnd5">30%</strong></div>
            </li>
            <!--<li class="size-35">Text Here
      <div class="rnd5"><strong class="rnd5">35%</strong></div>
    </li>-->
            <li class="size-40">Text Here
              <div class="rnd5"><strong class="rnd5">40%</strong></div>
            </li>
            <!--<li class="size-45">Text Here
      <div class="rnd5"><strong class="rnd5">45%</strong></div>
    </li>-->
            <li class="size-50">Text Here
              <div class="rnd5"><strong class="rnd5">50%</strong></div>
            </li>
            <!--<li class="size-55">Text Here
      <div class="rnd5"><strong class="rnd5">55%</strong></div>
    </li>-->
            <li class="size-60">Text Here
              <div class="rnd5"><strong class="rnd5">60%</strong></div>
            </li>
            <!--<li class="size-65">Text Here
      <div class="rnd5"><strong class="rnd5">65%</strong></div>
    </li>-->
            <li class="size-70">Text Here
              <div class="rnd5"><strong class="rnd5">70%</strong></div>
            </li>
            <!--<li class="size-75">Text Here
      <div class="rnd5"><strong class="rnd5">75%</strong></div>
    </li>-->
            <li class="size-80">Text Here
              <div class="rnd5"><strong class="rnd5">80%</strong></div>
            </li>
            <!--<li class="size-85">Text Here
      <div class="rnd5"><strong class="rnd5">85%</strong></div>
    </li>-->
            <li class="size-90">Text Here
              <div class="rnd5"><strong class="rnd5">90%</strong></div>
            </li>
            <!--<li class="size-95">Text Here
      <div class="rnd5"><strong class="rnd5">95%</strong></div>
    </li>-->
            <li class="size-100">Text Here
              <div class="rnd5"><strong class="rnd5">100%</strong></div>
            </li>
          </ul>
        </div>
        <h2>Latest Photos</h2>
        <ul class="nospace spacing clear">
          <li class="one_quarter first"><a href="#"><img src="images/demo/120x120.gif" alt=""></a></li>
          <li class="one_quarter"><a href="#"><img src="images/demo/120x120.gif" alt=""></a></li>
          <li class="one_quarter"><a href="#"><img src="images/demo/120x120.gif" alt=""></a></li>
          <li class="one_quarter"><a href="#"><img src="images/demo/120x120.gif" alt=""></a></li>
        </ul>
      </div>
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>