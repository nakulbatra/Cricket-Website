<?php
//session_start(); //For latest updates visit www.freestudentprojects.com ..
include("header.php");
if(isset($_SESSION['userid']))
{
	header("Location: dashboard.php");
}
include("dbconnection.php");
if(isset($_POST['submit']))
{
  // echo "hi".$_POST['username'];
  // echo $_POST['password'];
	$sql = "SELECT * FROM users where username='$_POST[username]' AND password='$_POST[password]' AND status='Enabled'";
	$qresult = mysqli_query($cnn,$sql);
	if(mysqli_num_rows($qresult) == 1)
	{
		$rs = mysqli_fetch_array($qresult);
		$_SESSION['userid'] = $rs['userid'];
		header("Location: dashboard.php");
	}
	else
	{
		$msg =  "<font color='red'><strong>Invalid login</strong></font>";
	}
}

?>
<!-- content -->

<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
      <aside>
        <!-- ########################################################################################## -->
        <h2>&nbsp;</h2>
        <section>
          <article> </article>
      </section>
        <!-- /section -->
        <!-- ########################################################################################## -->
      </aside>
    </div>
    <!-- ################################################################################################ -->
    <div class="one_half">


<form method="post" action="">
<table border=9 height=264 width=250>
	<tr>
	  <th height="32" colspan="2">&nbsp;<?php echo $msg ; ?></th>
    </tr>
	<tr>
    	<th>
        	 USERNAME
         </th>
         <th>
         		<input type=text name="username">
          </th>
     </tr>
      <tr>
    	<th>
        	PASSWORD
         </th>
         <th>
         		<input type=password name="password">
          </th>
     </tr>
      <tr>
    	         <th>
         		<input type=submit name="submit" value=SUBMIT>
          </th>
           
    	         <th>
         		<input type=reset>
          </th>
          </tr>
          
     </table>
     </form>
     
      
      
    </div>
    <!-- ################################################################################################ -->
    <div id="sidebar_2" class="sidebar one_quarter">
      <aside class="clear">
        <!-- ########################################################################################## -->
        <h2>&nbsp;</h2>
        <section class="clear"></section>
        <!-- /section -->
        <!-- ########################################################################################## -->
      </aside>
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php
include("footer.php");
?>