<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
include("dbconnection.php");
$sqlteams = "SELECT * FROM  teams WHERE teamid='$_GET[teamid]'";
$sqlteamsquery = mysqli_query($cnn,$sqlteams);
$rsteamsfetch = mysqli_fetch_array($sqlteamsquery);
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1><?php echo $rsteamsfetch["teamname"]; ?></h1>
      <div class="two_third first">
         <p>
<?php         
    if($rsteamsfetch['teamlogo'] == "")
	{
	echo "<img src='images/noimage.jpg' width='570' height='570'>";		
	}
	else
	{
	echo "<img src='imgteam/$rsteamsfetch[teamlogo]' width='570' height='570'>";
    }
?>	
	</p>
         <p><strong>Team owners :</strong> <?php echo ucfirst($rsteamsfetch["teamowners"]); ?></p>       
         <p><strong>Team Organiser :</strong> <?php echo ucfirst($rsteamsfetch["teamorganiser"]); ?></p>  
        <p><strong>About team :</strong> <br><?php echo ucfirst($rsteamsfetch["teaminfo"]); ?></p>

      </div>
      <div class="one_third">
        <div class="calltoaction opt1">
          <div class="push20">
            <h1>Contact Information</h1>
            <p><strong>Address:</strong><br>
<?php echo $rsteamsfetch["address"]; ?><br>
            <strong>Contact No.:</strong> <?php echo $rsteamsfetch["contactno"]; ?>
            </p>
          </div>
         
        </div>
      </div>
    </section>
    <!-- ################################################################################################ -->
    <section>
      <h2><a href="displayplayers.php?displayid=<?php echo $_GET['teamid']; ?>"  >Team Members</a></h2>
      <ul class="nospace clear">
<?php
$sqlteam = "SELECT *  FROM players WHERE teamid =  '$_GET[teamid]' AND status='Enabled' ORDER BY RAND()  LIMIT 4 ";
$sqlqueryteam = mysqli_query($cnn,$sqlteam);
$i=0;
while($rsteam = mysqli_fetch_array($sqlqueryteam))
{
	if($i == 0)
	{
?>            
            <li class="one_quarter first">
              <figure class="team-member"><img src="imgplayer/<?php echo $rsteam['profilepic']; ?>" alt="">
                <figcaption>
                  <p class="team-name"><?php echo $rsteam['name']; ?></p>
                  <p class="team-description"><?php echo $rsteam['playingrole']; ?></p>
                  <p class="team-description">Batting style: <?php echo $rsteam['battingstyle']; ?></p>
                  <p class="team-description">Bownling style: <?php echo $rsteam['bowlingstyle']; ?></p>
                  <p class="read-more"><a href="displayplayers.php?displayid=<?php echo $_GET['teamid']; ?>">Read More &raquo;</a></p>
                </figcaption>
              </figure>
            </li>
<?php
$i=1;
	}
	else
	{
?>		
            <li class="one_quarter">
              <figure class="team-member"><img src="imgplayer/<?php echo $rsteam['profilepic']; ?>" alt="">
                <figcaption>
                  <p class="team-name"><?php echo $rsteam['name']; ?></p>
                  <p class="team-description"><?php echo $rsteam['playingrole']; ?></p>
                  <p class="team-description">Batting style: <?php echo $rsteam['battingstyle']; ?></p>
                  <p class="team-description">Bownling style: <?php echo $rsteam['bowlingstyle']; ?></p>
                  <p class="read-more"><a href="">Read More &raquo;</a></p>
                </figcaption>
              </figure>
            </li>
<?php
	}
}
?>            
      </ul>
    </section>
    
<a href="displayplayers.php?displayid=<?php echo $_GET['teamid']; ?>"  >All Team members </a>

    
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>