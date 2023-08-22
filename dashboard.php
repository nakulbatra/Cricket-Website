<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}

include("dbconnection.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
		<?php
		include("adminmenu.php");
		?>
    </div>
    <!-- ################################################################################################ -->
    <div id="portfolio" class="three_quarter">
      <ul class="clear">
        <li class="one_third first">
          <article class="clear">
            <header>
              <h2 class="blog-post-title"><a href="#">No. of users</a></h2>
              <div class="blog-post-meta">
                <h2 class="blog-post-title "><a href="#" class="button large gradient orange"> &nbsp; 
				<?php 
				$sqlcount = "select * from users";
				$qcount = mysqli_query($cnn,$sqlcount);
				echo  mysqli_num_rows($qcount);
				?> Users</a></h2>
              </div>
            </header>
          </article>
        </li>
        <li class="one_third">
          <article class="clear">
            <header>
              <h2 class="blog-post-title"><a href="#">No. of Advertisements</a></h2>
              <div class="blog-post-meta">
                <h2 class="blog-post-title"><a href="#" class="button large gradient orange"> &nbsp;
				<?php 
				$sqlcount = "select * from advertisers";
				$qcount = mysqli_query($cnn,$sqlcount);
				echo  mysqli_num_rows($qcount);
				?> Advt's </a></h2>
              </div>
            </header>
          </article>
        </li>
        <li class="one_third">
          <article class="clear">
            <header>
              <h2 class="blog-post-title"><a href="#">No. of tournaments</a></h2>
              <div class="blog-post-meta">
                <h2 class="blog-post-title"><a href="#" class="button large gradient orange"> &nbsp; 
                <?php 
				$sqlcount = "select * from tournaments";
				$qcount = mysqli_query($cnn,$sqlcount);
				echo  mysqli_num_rows($qcount);
				?> Tournaments </a>
                </h2>
              </div>
            </header>
          </article>
        </li>
        <li class="one_third first">
          <article class="clear">
            <header>
              <h2 class="blog-post-title"><a href="#">No. of Teams</a></h2>
              <div class="blog-post-meta">
                <h2 class="blog-post-title"><a href="#" class="button large gradient orange"> &nbsp; 
                <?php 
				$sqlcount = "select * from teams";
				$qcount = mysqli_query($cnn,$sqlcount);
				echo  mysqli_num_rows($qcount);
				?> teams </a></h2>
              </div>
            </header>
          </article>
        </li>
        <li class="one_third">
          <article class="clear">
            <header>
              <h2 class="blog-post-title"><a href="#">No. of Upcoming fixures</a></h2>
              <div class="blog-post-meta">
                <h2 class="blog-post-title"><a href="#" class="button large gradient orange"> &nbsp; 
                <?php 
				$sqlcount = "select * from fixtures";
				$qcount = mysqli_query($cnn,$sqlcount);
				echo  mysqli_num_rows($qcount);
				?> fixtures </a></h2>
              </div>
            </header>
          </article>
        </li>
        <li class="one_third">
          <article class="clear">
            <header>
              <h2 class="blog-post-title"><a href="#">No. of Matches played</a></h2>
              <div class="blog-post-meta">
                <h2 class="blog-post-title"><a href="#" class="button large gradient orange"> &nbsp; 
                <?php 
				$sqlcount = "select * from results";
				$qcount = mysqli_query($cnn,$sqlcount);
				echo  mysqli_num_rows($qcount);
				?> Matches </a></h2>
              </div>
            </header>
          </article>
        </li> 
        <li class="one_third first">
          <article class="clear">
            <header>
              <h2 class="blog-post-title"><a href="#">No. of players</a></h2>
              <div class="blog-post-meta">
                <h2 class="blog-post-title"><a href="#" class="button large gradient orange"> &nbsp; 
                <?php 
				$sqlcount = "select * from players";
				$qcount = mysqli_query($cnn,$sqlcount);
				echo  mysqli_num_rows($qcount);
				?> players </a></h2>
              </div>
            </header>
          </article>
        </li>
       <li class="one_third">
          <article class="clear">
            <header>
              <h2 class="blog-post-title"><a href="#">No. of News published</a></h2>
              <div class="blog-post-meta">
                <h2 class="blog-post-title"><a href="#" class="button large gradient orange"> &nbsp; 
                <?php 
				$sqlcount = "select * from news";
				$qcount = mysqli_query($cnn,$sqlcount);
				echo  mysqli_num_rows($qcount);
				?> posts </a></h2>
              </div>
            </header>
          </article>
        </li>
        <li class="one_third">
          <article class="clear">
            <header>
              <h2 class="blog-post-title"><a href="#">No. of Images</a></h2>
              <div class="blog-post-meta">
                <h2 class="blog-post-title"><a href="#" class="button large gradient orange"> &nbsp; 
                <?php 
				$sqlcount = "select * from gallery";
				$qcount = mysqli_query($cnn,$sqlcount);
				echo  mysqli_num_rows($qcount);
				?> Images </a></h2>
              </div>
            </header>
          </article>
        </li>
        <li class="one_third first">
          <article class="clear">
            <header>
              <h2 class="blog-post-title"><a href="#">No. of Videos</a></h2>
              <div class="blog-post-meta">
                <h2 class="blog-post-title"><a href="#" class="button large gradient orange"> &nbsp; 
                <?php 
				$sqlcount = "select * from videos";
				$qcount = mysqli_query($cnn,$sqlcount);
				echo  mysqli_num_rows($qcount);
				?> videos </a></h2>
              </div>
            </header>
          </article>
        </li>   
      </ul>
  
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>