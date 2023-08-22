<?php
session_start(); //For latest updates visit www.freestudentprojects.com ..
if(!isset($_SESSION['userid']))
{
	header("Location: login.php");
}
include("header.php");

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
    <div id="portfolio" class="three_quarter"></div>
   ---------------------------------------------------------------
     </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>