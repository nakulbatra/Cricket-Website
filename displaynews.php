<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
include("dbconnection.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="portfolio" class="three_quarter first">
      <ul class="clear">
      <?php
	  	   $i=0;
$selectquerynews = mysqli_query($cnn, "SELECT * FROM news order by newsid desc");
			while($rsarraynews = mysqli_fetch_array($selectquerynews))
			{
				if($i==0)
				{
		?>		
        <li class="one_third first">
        <?php
				}
				else
				{
		?>
        <li class="one_third">
        <?php
				}
		?>
          <article class="clear">
            <figure class="post-image"><img src="imgnews/<?php echo $rsarraynews['image']; ?>" alt="" style="max-height:180px; height:180px; max-width:250; width:250; "></figure>
            <header>
              <h2 class="blog-post-title"><a href=""><?php  echo $rsarraynews['newstitle']; ?></a></h2>
              <div class="blog-post-meta">
                <ul>
                  <li class="blog-post-date">
                    <time datetime="2000-04-06T08:15+00:00"><strong>Completed:</strong> 6<sup>th</sup> April 2000</time>
                  </li>
                  <li class="blog-post-cats"><a href="#">Category 1</a>, <a href="#">Category 2</a></li>
                </ul>
              </div>
            </header>
            <p>
			<?php 
		  		echo substr($rsarraynews['newsdescription'],0,125); 
		  	?>
          </p>
            <footer class="read-more"><a href="#">Read More &raquo;</a></footer>
          </article>
        </li>
        <?php
				if($i==1)
				{
					$i++;
				}
				else if($i==2)
				{
					$i=0;
				}
				else
				{
					$i++;
				}
			}
		?>
        
      </ul>
      <!-- ####################################################################################################### -->

    </div>
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter">
      <aside>
        <!-- ########################################################################################## -->
        <h2>Side Navigation</h2>
        <nav>
          <ul>
            <li><a href="#">Free Website Templates</a></li>
            <li><a href="#">Free CSS Templates</a>
              <ul>
                <li><a href="#">Free XHTML Templates</a></li>
                <li><a href="#">Free Web Templates</a></li>
              </ul>
            </li>
            <li><a href="#">Free Website Layouts</a>
              <ul>
                <li><a href="#">Free HTML 5 Templates</a></li>
                <li><a href="#">Free Webdesign Templates</a>
                  <ul>
                    <li><a href="#">Free FireWorks Templates</a></li>
                    <li><a href="#">Free PNG Templates</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#">Free Responsive Templates</a></li>
          </ul>
        </nav>
        <!-- /nav -->
        <section>
          <h2>Get In Contact</h2>
          <address>
          Full Name<br>
          Address Line 1<br>
          Address Line 2<br>
          Town/City<br>
          Postcode/Zip<br>
          <br>
          Tel: xxxx xxxx xxxxxx<br>
          Email: <a href="#">contact@domain.com</a>
          </address>
        </section>
        <!-- /section -->
        <!-- <section>
          <article>
            <h2>Lorem ipsum dolor</h2>
            <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed.</p>
            <ul class="list indent disc">
              <li><a href="#">Lorem ipsum dolor sit</a></li>
              <li>Etiam vel sapien et</li>
              <li><a href="#">Etiam vel sapien et</a></li>
            </ul>
            <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed. Condimentumsantincidunt dui mattis magna intesque purus orci augue lor nibh.</p>
            <p class="more"><a href="#">Continue Reading &raquo;</a></p>
          </article>
        </section> -->
        <!-- /section -->
        <!-- ########################################################################################## -->
      </aside>
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<div class="wrapper row2">
  <div id="footer" class="clear">
    <div class="one_quarter first">
      <h2 class="footer_title">Footer Navigation</h2>
      <nav class="footer_nav">
        <ul class="nospace">
          <li><a href="#">Home Page</a></li>
          <li><a href="#">Our Services</a></li>
          <li><a href="#">Meet the Team</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Gallery</a></li>
          <li><a href="#">Portfolio</a></li>
          <li><a href="#">Online Shop</a></li>
        </ul>
      </nav>
    </div>
    <div class="one_quarter">
      <h2 class="footer_title">Latest Gallery</h2>
      <ul id="ft_gallery" class="nospace spacing clear">
        <li class="one_third first"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third first"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third first"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
        <li class="one_third"><a href="#"><img src="images/demo/80x80.gif" alt=""></a></li>
      </ul>
    </div>
    <div class="one_quarter">
      <h2 class="footer_title">From Twitter</h2>
      <div class="tweet-container">
        <ul class="list none">
          <li><strong>@<a href="#">name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
          <li><strong>@<a href="#">name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
          <li><strong>@<a href="#">name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
          <li><strong>@<a href="#">name</a></strong> <span class="tweet_text">RT <span class="at">@</span><a href="#">name</a> Donec suscipit vehicula turpis sed lutpat Quisque vitae quam neque.</span> <span class="tweet_time"><a href="#">about 9 hours ago</a></span></li>
        </ul>
      </div>
    </div>
    <div class="one_quarter">
      <h2 class="footer_title">Contact Us</h2>
      <form class="rnd5" action="#" method="post">
        <div class="form-input clear">
          <label for="ft_author">Name <span class="required">*</span><br>
            <input type="text" name="ft_author" id="ft_author" value="" size="22">
          </label>
          <label for="ft_email">Email <span class="required">*</span><br>
            <input type="text" name="ft_email" id="ft_email" value="" size="22">
          </label>
        </div>
        <div class="form-message">
          <textarea name="ft_message" id="ft_message" cols="25" rows="10"></textarea>
        </div>
        <p>
          <input type="submit" value="Submit" class="button small orange">
          &nbsp;
          <input type="reset" value="Reset" class="button small grey">
        </p>
      </form>
    </div>
  </div>
</div>
<?php
include("footer.php");
?>
<!-- Scripts -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="../layout/scripts/jquery-latest.min.js"><\/script>\
<script src="../layout/scripts/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="layout/scripts/jquery-mobilemenu.min.js"></script>
<script src="layout/scripts/custom.js"></script>
