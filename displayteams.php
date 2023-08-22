<?php
include("header.php");
include("dbconnection.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    
    <section>
      <h2>Teams</h2>
      
<?php
$sqlteams = "SELECT * FROM  teams";
$sqlteamsquery = mysqli_query($cnn,$sqlteams);
	$i=0;
while($rsteamsfetch = mysqli_fetch_array($sqlteamsquery))
{	

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
    <a href="displayteamsmore.php?teamid=<?php echo $rsteamsfetch['teamid']; ?>">        
    <?php
    if($rsteamsfetch['teamlogo'] == "")
	{
	echo "<img src='images/noimage.jpg' style='height:168px; width:300px' >";		
	}
	else
	{
	echo "<img src='imgteam/$rsteamsfetch[teamlogo]' style='height:168px; width:300px'>";
	}
	?>
    </a>
            <figcaption>
              <p class="team-name"><a href="displayteamsmore.php?teamid=<?php echo $rsteamsfetch['teamid']; ?>"><?php echo $rsteamsfetch['teamname']; ?></a></p>
              <p class="team-title"><strong>Owner:</strong> <?php echo ucfirst($rsteamsfetch['teamowners']); ?></p>
              <p class="team-description"><?php echo substr($rsteamsfetch['teaminfo'],0,90); ?> </p>
              <p class="read-more"><a href="displayteamsmore.php?teamid=<?php echo $rsteamsfetch['teamid']; ?>">Read More &raquo;</a></p>
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