<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
include("dbconnection.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="gallery" class="three_quarter first">
      <section>
        <figure>
          <h2>Photo Gallery</h2>
          <ul class="clear">
          <?php
		  $sqlimg = "SELECT * FROM  gallery";
		  $qimg = mysqli_query($cnn,$sqlimg);
		  $i=0;
		  while($rs = mysqli_fetch_array($qimg))
		  {
		  ?>
				<?php
                if($i == 0)
                {
                ?>
                <li class="one_third first"><a href="#"><img src="imgphotos/<?php echo $rs['imagepath']; ?>" alt=""></a><br>
<?php echo $rs['description']; ?><br>

</li>
                <?php
					$i++;
                }
                else
                {
                ?>
                <li class="one_third"><a href="#"><img src="imgphotos/<?php echo $rs['imagepath']; ?>" alt=""></a><br>
<?php echo $rs['description']; ?></li>
                <?php
					if($i==2)
					{
						$i =0 ;
					}
					else
					{
						$i++;
					}
                }
                ?>
          <?php
		  }
		  ?>
          </ul>
        </figure>
      </section>

    </div>
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter">
      <aside>
        <!-- ########################################################################################## -->
        <h2>Select tournament</h2>
        <nav>
          <ul>
          <?php
		  $sqltournaments = "SELECT * FROM  tournaments";
		  $qtournaments = mysqli_query($cnn,$sqltournaments);
		  while($rstournaments = mysqli_fetch_array($qtournaments))
		  {
            echo "<li><a href=''>$rstournaments[type] - $rstournaments[name]</a></li>";
		  }
		  ?>  
          </ul>
        </nav>
        <!-- /nav -->

        <!-- ########################################################################################## -->
      </aside>
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>