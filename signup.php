<!DOCTYPE html>
<?php require_once("dbconnection.php");
//  $fname = $_POST['fname'];
//  $lname = $_POST['lname'];
//  $username = $_POST['username'];
// $email = $_POST['email'];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="l1.css">
    <title>L1</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php
            if (isset($_POST['signup'])) {
                extract($_POST);
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                //error_reporting("E_ALL&~E_NOTICE");         

                //first name validations.
                if (strlen($fname < 3)) {
                    $error[] = 'ENTER ATLEAST 3 CHARACTERS FOR FIRST NAME';
                }
                if (strlen($fname) > 20) {
                    $error[] = 'MAXIMUM 20 CHARACTERS ARE ALLOWED FOR FIRST NAME';
                }
                if (!preg_match("/^[A-Za-z]*[A-Za-z]+[A-Za-z]*$/", $fname)) {
                    $error[] = 'NO DIGITS AND SPECIAL CHARACTERS ARE ALLOWED FOR FIRST NAME';
                }
                //last name validations.
                if (strlen($lname < 3)) {
                    $error[] = 'ENTER ATLEAST 3 CHARACTERS FOR LAST NAME';
                }
                if (strlen($lname) > 20) {
                    $error[] = 'MAXIMUM 20 CHARACTERS ARE ALLOWED FOR LAST NAME';
                }
                if (!preg_match("/^[A-Za-z]*[A-Za-z]+[A-Za-z]*$/", $lname)) {
                    $error[] = 'NO DIGITS AND SPECIAL CHARACTERS ARE ALLOWED FOR LAST NAME';
                }
                //username validations.
                if (strlen($username < 3)) {
                    $error[] = 'ENTER ATLEAST 3 CHARACTERS FOR USERNAME';
                }
                if (strlen($username) > 20) {
                    $error[] = 'MAXIMUM 20 CHARACTERS ARE ALLOWED FOR USERNAME';
                }
                if (!preg_match("/^^[^0-9][a-z0-9]+([_-]?[a-z0-9])*$/", $username)) {
                    $error[] = 'ENTER LOWERCASE LETTERS WITHOUT ANY SPACE AND NO NUMBER AT THE START FOR USERNAME';
                }
                if (strlen($email) > 50) { // Max

                    $error[] = 'Email: Max length 50 Characters Not allowed';
                }
                if ($cpassword == '') {

                    $error[] = 'Please confirm the password.';
                }

                if ($password != $cpassword) {
                    $error[] = 'Passwords do not match.';
                }

                if (strlen($password) < 5) {
                    $error[] = 'The password is 6 characters long.';
                }

                if (strlen($password) > 20) { // Max

                    $error[] = 'Password: Max length 20 Characters Not allowed';
                }
                $res = mysqli_query($dbc, "select * from users where username='$username' OR email='$email';");
                if (mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_assoc($res);
                    if ($username == $row['username']) {
                        $error[] = 'Username alredy Exists.';
                    }
                    if ($email == $row['email']) {
                        $error[] = 'Email alredy Exists.';
                    }
                }
            }
            //$sql = "select * from users where (username='$username' OR email='$email');";   
            // $res = mysqli_query($dbc, "select * from users where username='$username' OR email='$email';");
            // if (mysqli_num_rows($res) > 0) 
            // {
            //     $row = mysqli_fetch_assoc($res);
            //     if ($username == $row['username']) 
            //     {
            //         $error[] = 'Username alredy Exists.';
            //     }
            //     if ($email == $row['email']) 
            //     {
            //         $error[] = 'Email alredy Exists.';
            //     }
            // } 

            if (isset($error)) {
                $date = date('Y-m-d');
                $options = array("cost=>4");
                $password = password_hash($password, PASSWORD_BCRYPT, $options);
                $result = mysqli_query($dbc, "INSERT into users values('','$fname','$lname','$username','$email', '$password', '$date')");
                if ($result) {
                    $done = 2;
                } else {
                    $error[] = 'Failed:Something went wrong';
                }
            }
            ?>
            <div class="col-sm-4 my">
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<p class="errmsg">&#x26A0;' . $error . '</p>';
                    }
                }
                ?>
            </div>
            <div class="col-sm-4">
                <?php if (isset($done)) { ?>
                    <div class="successmsg"><span style="font-size:100px;">&#9989;</span> <br> You have registered successfully. <br> <a href="l1.php" style=" color:#fff;">Login here... </a> </div>
                <?php } else { ?>
                    <div class="signup_form">
                        <img src="logo.jpeg" id="img1" class="logo">

                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="mb-3">
                                <label class=" label_txt form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" value="<?php if (isset($error)) {
                                                                                                echo $fname;
                                                                                            } ?>" required>
                            </div>


                            <div class="mb-3">
                                <label class=" label_txt form-label">Last Name</label>
                                <input type="text" class="form-control" name="lname" value="<?php if (isset($error)) {
                                                                                                echo $lname;
                                                                                            } ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class=" label_txt form-label">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php if (isset($error)) {
                                                                                                    echo $username;
                                                                                                } ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class=" label_txt form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php if (isset($error)) {
                                                                                                    echo $email;
                                                                                                } ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class=" label_txt form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label class=" label_txt form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="cpassword" required>
                            </div>

                            <button type="submit" name="signup" class="form_btn btn btn-primary">Signup</button>
                        </form>
                        <p style="font-size: 12px;text-align: center; margin-top: 10px;"><a href=" Forgot-password.php" style="color: #00376b;">Forgot Password?</a> </p>
                        <br>

                        <p>Have an account? <a href="l1.php">Login</a> </p>
                    <?php } ?>


                    </div>
            </div>

            </form>

            <div class="col-sm-4">


            </div>
        </div>
    </div>




</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>