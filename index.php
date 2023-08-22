<?php

include("header.php");
include("dbconnection.php");
$dttim = date("Y-m-d h:i:s");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    
    <div id="homepage" class="clear">
      <div class="two_third first">
        <section class="main_slider">
          <div class="rslides_container clear">
            <ul class="rslides clear" id="rslides">
              <li><img src="images/slider/image1.jpg" alt=""   style=" max-height:280px;"></li>
              <li><img src="images/slider/image2.jpg" alt=""  style="max-height:280px;"></li>
              <li><img src="images/slider/image3.jpg" alt=""  style=" max-height:280px;"></li>
              <li><img src="images/slider/image4.jpg" alt=""  style=" max-height:280px;"></li>
              <li><img src="images/slider/image5.jpg" alt=""  style=" max-height:280px;"></li>
              <li><img src="images/slider/image6.png" alt=""  style=" max-height:280px;"></li>                            
              <li><img src="images/slider/image7.jpg" alt=""  style="max-height:280px;"></li>
            </ul>
          </div>
        </section>
        <ul class="nospace push50 clear">
         
         <?php
		 	$selectquery = mysqli_query($cnn, "SELECT * FROM videos order by videoid desc limit 0,3");
			while($rsarray = mysqli_fetch_array($selectquery))
			{

				if($i==0)
				{
		?>
         <li class="one_third first">
         <?php
		 $i =1;
				}
				else
				{
		?>
         <li class="one_third">        
        <?php			
				}
		?>
            <article>
              <div class="push20"><?php echo $rsarray['videopath']; ?></div>
              <p class="nospace"><?php echo $rsarray['description']; ?></p>
            </article>
          </li>
          <?php
			}
		 ?>
        </ul>
        <div class="divider2"></div>
        
       <!-- <?php
	   $i=0;
		 	$selectquerynews = mysqli_query($cnn, "SELECT * FROM news order by newsid desc limit 0,2");
			while($rsarraynews = mysqli_fetch_array($selectquerynews))
			{
				if($i==0)
				{
		?>
        <article class="one_half push30 first">
        <?php
			$i=1;
				}
				else
				{
		?>
        <article class="one_half push30">
        <?php
				}
		?>
          <div class="push20">
          <h2>
		  <?php
          echo $rsarraynews['newstitle'];
		  ?>
		  </h2>
          <img src="imgnews/<?php echo $rsarraynews['image']; ?>" alt="" style="max-height:180px; height:180px; max-width:250; width:250; "></div>
          
          <p><?php 
		  echo substr($rsarraynews['newsdescription'],0,125); 
		  ?></p>
          <footer class="read-more"><a href="#">Read More &raquo;</a></footer>
        </article>
        <?php
			}
		?> -->
        
      </div>
      <!-- #### -->
      <div class="one_third">
        <div class="tab-wrapper clear">
          <ul class="tab-nav clear">
            <li><a href="#tab-1">Scores</a></li>
            <li><a href="#tab-2">Results</a></li>
            <li><a href="#tab-3">Fixtures</a></li>
          </ul>
          <div class="tab-container">
            <!-- Tab Content -->
            <div id="tab-1" class="tab-content clear">
              <article class="clear push20">
                <div class="imgl"><img src="images/download.jpg" alt=""></div>
                <h2 class="font-medium nospace"><a href="#">IND V/S AUS.</a></h2>
                <p class="nospace">ODI TO BE HELD</p>
              </article>
              <article class="clear push20">
                <div class="imgl"><img src="images/d1.jpg" alt=""></div>
                <h2 class="font-medium nospace"><a href="#">IND V/S SA</a></h2>
                <p class="nospace">TEST MATCH</p>
              </article>
              <article class="clear">
                <div class="imgl"><img src="images/d2.jpg"  alt="" height="50px" width="50px"></div>
                <h2 class="font-medium nospace"><a href="#">IND V/S SRI LANKA</a></h2>
                <p class="nospace">T20 TO BE HELD </p>
              </article>
            </div>
            <!-- ## TAB 2 ## -->
            <div id="tab-2" class="tab-content clear">
<?php            
$sqlqresults = "SELECT results . * , fixtures . * FROM fixtures INNER JOIN results ON fixtures.fixtureid = results.fixtureid WHERE  fixdatetime <  '$dttim' ORDER BY  fixtures.fixdatetime DESC LIMIT 0 , 5";
$qresults = mysqli_query($cnn, $sqlqresults);
while($arrresults = mysqli_fetch_array($qresults))
	{
		  	$qteamsviewteams1 = mysqli_query($cnn, "SELECT * FROM teams where  teamid ='$arrresults[teamid1]'");
			$arrteams1 = mysqli_fetch_array($qteamsviewteams1);
			$team1name = $arrteams1['teamname'];
			
			$qteamsviewteams2 = mysqli_query($cnn, "SELECT * FROM teams  where teamid =  '$arrresults[teamid2]'");
			$arrteams2 = mysqli_fetch_array($qteamsviewteams2);
			 $team2name = $arrteams2['teamname'];
			
		echo " <article class='clear push20'>
                <div class='imgl'><img src='images/demo/50x50.gif' ></div>
				
                <h2 class='font-medium nospace'><a href=''> ";
				if($team1name == "")
				{
					echo "TBC";
				}
				else
				{
					echo $team1name ;
				}
 		echo " V/S " ;
				if($team2name == "")
				{
					echo "TBC";
				}
				else
				{
					echo $team2name ;
				}
 
		echo "</a></h2>
                <p class='nospace'>Date: ".$mysqldate = date( 'd-m-Y', strtotime($arrresults['fixdatetime']) ) . " ". $mysqldate = date( 'G:i A', $arrresults['fixdatetime'] ) ."</p>
				<p class='nospace'> " . $arrresults['comment'] ."</p>
             </article>";
			 echo "<hr>";
			
	}

?> 
            </div>
            <!-- ## TAB 3 ## -->
            <div id="tab-3" class="tab-content clear">
<?php  

	$sqlqfixtures = "SELECT *  	FROM  fixtures 	WHERE  fixdatetime >  '$dttim' 	ORDER BY  `fixtures`.`fixdatetime` ASC  	LIMIT 0 , 5";
  	$qtournamentteamsview = mysqli_query($cnn, $sqlqfixtures);
	
	while($arrtournamentteamsview = mysqli_fetch_array($qtournamentteamsview))
	{
		  	$qteamsviewteams1 = mysqli_query($cnn, "SELECT * FROM teams where  teamid ='$arrtournamentteamsview[teamid1]'");
			$arrteams1 = mysqli_fetch_array($qteamsviewteams1);
			$team1name = $arrteams1['teamname'];
			
			$qteamsviewteams2 = mysqli_query($cnn, "SELECT * FROM teams  where teamid =  '$arrtournamentteamsview[teamid2]'");
			$arrteams2 = mysqli_fetch_array($qteamsviewteams2);
			 $team2name = $arrteams2['teamname'];
			
		echo " <article class='clear push20'>
                <div class='imgl'><img src='images/demo/50x50.gif' ></div>
				
                <h2 class='font-medium nospace'><a href=''> ";
				if($team1name == "")
				{
					echo "TBC";
				}
				else
				{
					echo $team1name ;
				}
 		echo " V/S " ;
				if($team2name == "")
				{
					echo "TBC";
				}
				else
				{
					echo $team2name ;
				}
 
		echo "</a></h2>
                <p class='nospace'>Date: ".$mysqldate = date( 'd-m-Y', strtotime($arrtournamentteamsview['fixdatetime']) ) . " ". $mysqldate = date( 'G:i A', $arrtournamentteamsview['fixdatetime'] ) ."</p>
				
             </article>";
			  echo "<hr>";
			
	}
?>  

            </div>
            
          </div>
        </div>
        <div class="clear push30"></div>
        <div class="clear">
         
        </div>
      </div>
    </div>
    
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>