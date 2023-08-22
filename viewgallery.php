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
		  $sqlimg = "DELETE FROM  gallery WHERE galleryid='$_GET[delid]'";
		  $qimg = mysqli_query($cnn,$sqlimg);
		  
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
                <li class="one_third first"><a href="#"><img src="imgphotos/<?php echo $rs['imagepath']; ?>" alt=""></a><br />
            <?php echo $rs['description']; ?>    <br />
            <center><a href='viewgallery.php?delid=<?php echo $rs['galleryid']; ?>'>Delete this image</a></center>
                </li>
                <?php
					$i++;
                }
                else
                {
                ?>
                <li class="one_third"><a href="#"><img src="imgphotos/<?php echo $rs['imagepath']; ?>" alt=""></a><br />
                <?php echo $rs['description']; ?>
            <center><a href='viewgallery.php?delid=<?php echo $rs['galleryid']; ?>'>Delete this image</a></center>
                </li>
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
      <!-- ####################################################################################################### -->
      <nav class="pagination">
        <ul>
          <li class="prev"><a href="#">&laquo; Previous</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li class="splitter"><strong>&hellip;</strong></li>
          <li><a href="#">6</a></li>
          <li class="current"><strong>7</strong></li>
          <li><a href="#">8</a></li>
          <li class="splitter"><strong>&hellip;</strong></li>
          <li><a href="#">14</a></li>
          <li><a href="#">15</a></li>
          <li class="next"><a href="#">Next &raquo;</a></li>
        </ul>
      </nav>
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