<?php
include('config.php');
if(!isset($_SESSION["uname"]))
{
    header("location:..\user\login.php?mes=<p> Please login here </p>");
}

$uname = $_SESSION['uname'];
$result = mysqli_query($con,"SELECT * FROM users WHERE RegNumber='$uname'");
$row = mysqli_fetch_assoc($result);

$id= $row['uid'];
$uName=$row['RegNumber'];
$fname=$row['FirstName'];
$lname=$row['LastName'];
$email=$row['Email'];
$regNumber=$row['RegNumber'];
$phone=$row['PhoneNumber'];
$gender=$row['Gender'];
$course=$row['Course'];
$year=$row['Year'];



$unRead = mysqli_query($con,"SELECT count(mshStatus) as unRead FROM chat WHERE mshStatus='unRead' and toUserID='$id'");
$unReadMsh = mysqli_fetch_assoc($unRead);
$unRead= $unReadMsh['unRead'];

$unseen = mysqli_query($con,"SELECT count(status) as unseen FROM notification_status WHERE status='0' and uid='$id'");
$unseenmsg = mysqli_fetch_assoc($unseen);
$unseen= $unseenmsg['unseen'];

if(isset($_POST["btnMycourse"])){
    $course_id=$_POST["course_id"];
    $sqll="SELECT * FROM course WHERE courseID='$course_id'";
    $queryy=mysqli_query($con,$sqll);
    $row=mysqli_fetch_object($queryy);
    $Semi=$row->courseFaculty;
    $Year=$row->courseYear;

    $_SESSION["fa"]=$Semi;
    $_SESSION["yea"]=$Year;
    $_SESSION["courseID"]=$course_id;
    if($course_id!="") {
        header("location:subject.php");
    }
}
if(isset($_POST["s"])) {

    $sql="UPDATE notification_status SET status=1 WHERE uid='$userID'" ;
    $query=mysqli_query($con,$sql);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> </title>
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
    function showHint() {
        var xhttp;
        var pass=
        xhttp = new XMLHttpRequest();
        xhttp.open("GET", "asdf.php?q=<?php echo $id ?>", true);
        xhttp.send();
    }
</script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .notification {
            color: black;
            text-decoration: none;
            position: relative;
            display: inline-block;
            border-radius: 2px;
        }
        .notification .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 50%;
            background-color: darkorange;
            color: white;
        }
        .iconcolor{
            color: white;
        }
        a:hover .iconcolor{
            color: deepskyblue;
            border-color: blue;
        }
    </style>
</head>
<body>
<div class=" text-left" style="background-color:#FBFCFC;margin:0 10px">
    <div class="row">
        <div class="col-md-auto">
            <img src="../image/logo.png" alt="logo" style="width:100px;">
        </div>
        <div class="col col-lg-6">
            <h1 style="font-family:cursive, sans-serif">ABC INSTITUTE</h1>
            <p>Learning Management</p>
        </div>
        <div class="col text-right">
            <form>
            <span>

                <button type="button" onclick="showHint()" style="border: none;background: transparent" class="notification btn-link" data-toggle="modal" name="s" data-target="#myModal">
                <span class="fa fa-bell"></span>
                <?php

                    if($unseen=='0' ){
                        ?>
                        <span class="badge"></span>
                        <?php
                    }
                    else{
                        ?>
                        <span class="badge"><?php echo $unseen; ?></span>
                        <?php
                    }
                    ?>
                </button>

            </span>
                <form>
            <div class="dropdown">
                <button class="dropbtn"><span style="font-weight: bold"><?php echo $uName; ?></span></button>
                <div class="dropdown-content text-left">
                    <a href="profile.php">Profile</a>
                    <a href="../user/logout.php">Logout</a>
                </div>
            </div>

            <img src="image/<?php echo $users['Image']; ?>" alt="profile" style="width:60px;">
        </div>
    </div>
</div>

<!-- Notification Panel -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button"  onclick="location.reload()" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Notifications</h4>
            </div>

            <div class="modal-body">
                <?php
                $not = mysqli_query($con,"SELECT nid FROM notification_status WHERE uid='$id'");
                while($rown=mysqli_fetch_array($not)) {
                    $q=$rown[0];
                    $sql="SELECT notification FROM notification WHERE id='$q'";
                    $qury=mysqli_query($con,$sql);
                while($rowl=mysqli_fetch_array($qury)) {
                    echo "<p>$rowl[0]</p>";
                }

                }
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- End Notification Panel -->

<nav class="navbar navbar-expand-sm bg-dark navbar-dark border-bottom" style="margin:0 10px; border-width:3px !important; border-color: #FF8C00 !important;">
    <a class="navbar-brand" href="#">ABC</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="home.php">Home</a>
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
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">My Courses</a>
                <form action="" method="POST">
                    <input type="hidden" id="course_id" name="course_id">
                <div class="dropdown-menu">
                    <?php
                    $result=mysqli_query($con,"SELECT c.courseName,c.courseID 
                                                      FROM course c, mycourse mc 
                                                      WHERE c.courseID=mc.courseID and mc.userID='$id' and mc.courseStatus='Active' 
                                                      order by mc.courseID asc");

                    if($result === FALSE) {
                        die(mysqli_error());
                    }
                    while($res=mysqli_fetch_array($result))
                    {
                        ?>
                        <button type="submit" name="btnMycourse" class="dropdown-item btn btn-link" value="<?php echo $res['courseID']; ?>"> <?php echo $res['courseName']; ?> </button>
                        <?php
                    }
                    ?>
                </div>
                </form>
                <script type="text/javascript">
                    $("button[type='submit']").hover(function(){
                        var v = this.value;
                        var textcontrol = document.getElementById("course_id");
                        textcontrol.value = this.value;
                        //window.location.href = "course.php";
                    });
                </script>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#section1">About</a>
            </li>
        </ul>
    </div>
    <form class="form-inline " id="collapsibleNavbar">
            <span>
                 <a href="chat.php" class="notification" style="margin: 0 15px ">
                <span class="fa fa-envelope iconcolor" ></span>
                     <?php

                     if($unRead=='0' ){
                         ?>
                            <span class="badge"></span>
                     <?php
                     }
                     else{
                     ?>
                     <span class="badge"><?php echo $unRead; ?></span>
                     <?php
                     }
                     ?>

                </a>
            </span>

        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-success" type=""><span class="fa fa-search"></span> </button>

    </form>
</nav>
</body>
</html>
