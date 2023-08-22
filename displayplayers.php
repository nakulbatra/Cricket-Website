<?php
include("header.php");
include("dbconnection.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ --><!-- ################################################################################################ -->
    <section>
      <h2>Players</h2>
      
<?php
if(isset($_GET['displayid']))
{
$sqlteams = "SELECT * FROM  players where teamid='$_GET[displayid]'";
}
else
{
$sqlteams = "SELECT * FROM  players";
}

$sqlteamsquery = mysqli_query($cnn,$sqlteams);
	$i=0;
while($rsteamsfetch = mysqli_fetch_array($sqlteamsquery))
{	
	$sqlteams1 = "SELECT * FROM  teams where teamid='$rsteamsfetch[teamid]'";
	$sqlteamsquery1 = mysqli_query($cnn,$sqlteams1);
	$rsteamsfetch1 = mysqli_fetch_array($sqlteamsquery1);

		//$i=0;
		if($i == 0)
		{
?>      
		<ul class="nospace clear">
        <li class="one_quarter first">
<?php
		}
		else
		{
?>
        <li class="one_quarter">
<?php
		}
		
?>			
        
          <figure class="team-member">  
    <a href="#">
    <?php
    if($rsteamsfetch['profilepic'] == "")
	{
	echo "<img src='images/noimage.jpg' style='height:275px; width:250px' >";		
	}
	else
	{
	echo "<img src='imgplayer/$rsteamsfetch[profilepic]' style='height:275px; width:250px'>";
	}
	?>
    </a>
            <figcaption>
              <p class="team-name"><a href="displayteamsmore.php?teamid=<?php echo $rsteamsfetch['teamid']; ?>"><?php echo $rsteamsfetch['teamname']; ?></a></p>
              <p class="team-title"><strong>Players Name:</strong> <?php echo ucfirst($rsteamsfetch['name']); ?></p>
              <p class="team-title"><strong>Team Name:</strong> <?php echo ucfirst($rsteamsfetch1['teamname']); ?></p>
              <p class="team-title"><strong>Playing role:</strong> <?php echo ucfirst($rsteamsfetch['playingrole']); ?></p>
              <p class="team-title"><strong>Batting style:</strong> <?php echo ucfirst($rsteamsfetch['battingstyle']); ?></p>
              <p class="team-title"><strong>Bowlinig style:</strong> <?php echo ucfirst($rsteamsfetch['bowlingstyle']); ?></p>
              <p class="team-description"><?php echo substr($rsteamsfetch['teaminfo'],0,90); ?> </p>
            </figcaption>
          </figure>
        </li>
		<?php 
		
		 if($i == 3)	
			{ 
        ?>
        </ul>
		<?php
		$i=0;
			}
			else
			{
				$i++;
			}
		
        ?>
<?php
}
?>
      
    </section>
    <!-- ################################################################################################ --><!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>