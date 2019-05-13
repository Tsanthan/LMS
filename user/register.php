<?php
include("config.php");

if(isset($_POST["submit"]))
{
    $fname=$_POST["Fname"];
    $lname=$_POST["Lname"];
    $email=$_POST["Email"];
    $regNum=$_POST["RegNum"];
    $phone=$_POST["Phone"];
    $gender=$_POST["gender"];
    $course=$_POST["Course"];
    $year=$_POST["Year"];
    $password=$_POST["Password"];
    $password2=$_POST["Password2"];

$check = getimagesize($_FILES["profileImage"]["tmp_name"]);
    $image = $_FILES['profileImage']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));

    if($fname!="" && $lname!="" && $email!="" && $regNum!="" && $phone!="" && $course!="" && $year!="" && $password!="" && $gender!="" )
    {

        $sql="SELECT Email FROM users WHERE Email='$email'";
        $result=$con->query($sql);
        if($result->num_rows>0)
        {
            $email_err = "<i style='color:red;'> Email already registered </i>";
        }
        $sql="SELECT RegNumber FROM users WHERE RegNumber='$regNum'";
        $result=$con->query($sql);
        if($result->num_rows>0)
        {
            $regNum_err = "<i style='color:red;'> Registration Number already has a account </i>";
        }
        $sql="SELECT PhoneNumber FROM users WHERE PhoneNumber='$phone'";
        $result=$con->query($sql);
        if($result->num_rows>0)
        {
            $phone_err = "<i style='color:red;'> Phone Number already has a account </i>";
        }
        else {
            $phone = preg_replace("/[^0-9]/", "", $phone);
            if(strlen($phone)==10)
            {
                if(preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_.@#$&]).{6,15}$/", $password))
                {
                    if($password == $password2) {


                            $insersql = "INSERT INTO users(RegNumber,FirstName,LastName,Email,PhoneNumber,Gender,Course,Year,Image,Password,Status)VALUES('$regNum','$fname','$lname','$email','$phone','$gender','$course','$year','$imgContent','$password ','Active')";
                            if ($con->query($insersql)) {
                                header("location:login.php?mes=<p> Registration Sucessfully. Please login here </p>");
                            } else {
                                $imageErr = "<i style='color:red;'> registration faild </i>";
                            }


                    }
                    else {
                        $cpass_err = "<i style='color:red;'> Conform Password not match </i>";
                    }

                }
                else {
                    $pass_err = "<i style='color:red;'> Weak password!</i>";
                }
            }
            else {
                $phone_err = "<i style='color:red;'> Invalid phone number </i>";
            }
        }
    }
    else
    {

    }
}
else
{

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ABC Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">



    <script>
        function triggerClick() {
            document.querySelector('#profileImage').click();
        }
        function displayImage(e) {
            if (e.files[0]){
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.querySelector('#profileDisplay').setAttribute('src',e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>

</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%; text-transform: capitalize;">
    <div class=" text-left" style="background-color:#FBFCFC;margin:0 10px">
        <div class="row">
            <div class="col-md-auto">
                <img src="logo.png" alt="logo" style="width:100px;">
            </div>
            <div class="col col-lg-6">
                <h1>ABC INSTITUTE</h1>
                <p>Learning Management</p>
            </div>

        </div>
    </div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="margin:0 10px">
        <a class="navbar-brand" href="#">ABC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Faculties</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">IT</a>
                        <a class="dropdown-item" href="#">SE</a>
                        <a class="dropdown-item" href="#">IM</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">My Courses</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">IT</a>
                        <a class="dropdown-item" href="#">SE</a>
                        <a class="dropdown-item" href="#">IM</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#section1">About</a>
                </li>
            </ul>
        </div>
        <form class="form-inline " id="collapsibleNavbar" action="/action_page.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-success" type="submit"><i class="fa fa-search"></i> </button>

        </form>
    </nav>

    <div class="container" style="margin-top:30px">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <header class="card-header">
                        <a href="login.php" class="float-right btn btn-outline-primary mt-1">Log in</a>
                        <h4 class="card-title mt-2">Sign up</h4>
                    </header>
                    <article class="card-body">
                        <form action="" method="post">
                            <div class="form-group text-center" >
                                <div><?php if(isset($imageErr)) echo $imageErr; ?></div>
                                <img src="image/user.png" onclick="triggerClick()" alt="profile" id="profileDisplay" style="display:block;width:150px; height:150px; margin:10px auto;border-radius:50%;">
                                <input type="file" name="profileImage"  onchange="displayImage(this)" id="profileImage" style="display: none;"/>
                                <label><b>Choose profile</b></label>
                            </div>


                            <div class="form-row">
                                <div class="col form-group">
                                    <label>First name </label>
                                    <input type="text" name="Fname" class="form-control" required>
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Last name</label>
                                    <input type="text" name="Lname" class="form-control" required>
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-group">
                                <label>Email address</label>
                                <div><?php if(isset($email_err)) echo $email_err; ?></div>
                                <input type="email" name="Email" class="form-control" required>
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Reg Number</label>
                                <div><?php if(isset($regNum_err)) echo $regNum_err; ?></div>
                                <input type="text" name="RegNum" class="form-control" required>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Phone Number</label>
                                <div><?php if(isset($phone_err)) echo $phone_err; ?></div>
                                <input type="text" name="Phone" class="form-control" required>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Male">
                                    <span class="form-check-label"> Male </span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Female">
                                    <span class="form-check-label"> Female</span>
                                </label>
                            </div> <!-- form-group end.// -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Facultie</label>
                                    <select id="inputState" class="form-control" name="Course">
                                        <option> Choose...</option>
                                        <option>IT</option>
                                        <option>SE</option>
                                        <option>IM</option>
                                    </select>
                                </div> <!-- form-group end.// -->
                                <div class="form-group col-md-6">
                                    <label>Year</label>
                                    <select id="inputState" class="form-control" name="Year">
                                        <option> Choose...</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option selected="">3 </option>
                                        <option>4</option>
                                    </select>
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row.// -->
                            <div class="form-group">
                                <label>Create password</label>
                                <div><?php if(isset($pass_err)) echo $pass_err; ?></div>
                                <input class="form-control" type="password" name="Password" required >
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Confirm password</label>
                                <div><?php if(isset($cpass_err)) echo $cpass_err; ?></div>
                                <input class="form-control" type="password" name="Password2"  required>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary btn-block"> Register  </button>
                            </div> <!-- form-group// -->
                            <small class="text-muted">By clicking the 'Register' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
                        </form>
                    </article> <!-- card-body end .// -->
                    <div class="border-top card-body text-center">Have an account? <a href="login.php">Log In</a></div>
                </div> <!-- card.// -->
            </div> <!-- col.//-->

        </div> <!-- row.//-->
    </div>

    <!-- About start.// -->
    <?php
    include ('footer.php');
    ?>
    <!-- About end.// -->


    <footer style="margin:0 10px">
        <p>ABC @ 2019 All Rights Reserved. </p>
    </footer>
</div>
</body>
</html>
