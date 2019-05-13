<?php
include("config.php");
session_start();

if(isset($_POST["submit"]))
{
    $name = $_POST["username"];
    $pass = $_POST["password"];
    if($name!=""&&$pass!="")
    {
        $sql="SELECT * FROM users WHERE RegNumber='$name' AND Password='$pass' AND Status='Active'";
        $result=$con->query($sql);
        if($result->num_rows==1)
        {
            $n='0';
            $_SESSION["regNum"] = $n;

            $_SESSION["uname"]=$name;
            header("location:home.php");
        }

        $sql="SELECT * FROM admin WHERE username='$name' AND password='$pass' AND Status='Active'";
        $result=$con->query($sql);
        if($result->num_rows==1)
        {
            $_SESSION["uname"]=$name;
            header("location:..\admin1\home.php");
        }
        else {
            $login_err = "<i style='color:red;'> username or password invalid </i>";
        }
    }
    else {
        $login_err = "<i style='color:red;'>Enter username or password </i>";
    }
}
else {
}
?>

<?php
if(isset($_GET["mes"]))
{
    $sucess_mes = $_GET["mes"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ABC Login</title>
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

</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%">
    <div class=" text-left" style="background-color:#FBFCFC;margin:0 10px">
        <div class="row">
            <div class="col-md-auto">
                <img src="logo.png" alt="logo" style="width:100px;">
            </div>
            <div class="col col-lg-6">
                <h1 style="font-family:cursive, sans-serif">ABC INSTITUTE</h1>
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
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Faculties</a>
                    <div class="dropdown-menu">
                        <?php
                        $result=mysqli_query($con,"SELECT * FROM faculty  order by facultyID asc");

                        if($result === FALSE) {
                            die(mysqli_error());
                        }
                        while($res=mysqli_fetch_array($result))
                        {
                            ?>
                            <a class="dropdown-item" href="year.php?faculty=1&facultyName=<?php echo $res['facultyName']; ?>"><?php echo $res['facultyName']; ?> </a>
                            <?php
                        }
                        ?>
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
                        <a href="register.php" class="float-right btn btn-outline-danger mt-1">Register</a>
                        <h4 class="card-title mt-2">Log in</h4>
                    </header>
                    <article class="card-body">
                        <form  method="post">
                            <div class="form-group">
                                <div class="text-center"><i style="color:green; "><?php if(isset($sucess_mes)) echo $sucess_mes; ?></i></div>
                                <label>User Name</label>
                                <input type="text" class="form-control" name="username" required>
                            </div> <!-- form-group end.// -->

                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" required>
                            </div> <!-- form-group end.// -->
                            <div class="text-center"><i style="color:green; "><?php if(isset($login_err)) echo $login_err; ?></i></div>
                            <div class="form-group">
                                <button type="submit" name="submit" value="login" class="btn btn-primary btn-block"> Login  </button>
                            </div> <!-- form-group// -->

                        </form>
                    </article> <!-- card-body end .// -->
                    <div class="border-top card-body text-center">Forgot? <a href="forgotpassword.php">Password</a></div>
                </div> <!-- card.// -->
            </div> <!-- col.//-->

        </div> <!-- row.//-->
    </div>

    <!-- About start.// -->
    <div class="row text-center" style="margin: 0 10px 1% 10px;background-color:#6c757d">
        <div class="col-sm-4">
            <div id="section1" class="container-fluid bg-secondary" style="padding-top:40px;padding-bottom:20px; min-height:200px">
                <h1>About</h1>
                <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="section1" class="container-fluid bg-secondary" style="padding-top:40px;padding-bottom:20px; min-height:200px">
                <h1>Contact</h1>
                <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="section1" class="container-fluid bg-secondary" style="padding-top:40px;padding-bottom:20px; min-height:200px">
                <h1>Follow</h1>
                <p>Facebook</p>
                <p>Twitter</p>
            </div>
        </div>
    </div>

    <footer style="margin:0 10px">
        <p>ABC @ 2019 All Rights Reserved. </p>
    </footer>
</div>
</body>
</html>
