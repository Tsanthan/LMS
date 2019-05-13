<?php
include('config.php');
session_start();

$clickFaculty = $_SESSION['fa'];
$clickYear = $_SESSION['yea'];

if(!isset($_SESSION["uname"]))
{
    header("location:..\user\login.php?mes=<p> Please login here </p>");
}




if(isset($_POST["btnKey"])){
    $courseKey=$_POST["courseKey"];
    $courseID=$_GET['CourseID'];

    $Courseresult2 = mysqli_query($con,"SELECT * FROM course WHERE courseID='$courseID' ");
    $corow = mysqli_fetch_assoc($Courseresult2);
    $cKey= $corow['courseKey'];

    $uname = $_SESSION['uname'];
    $Userresult = mysqli_query($con,"SELECT * FROM users WHERE RegNumber='$uname'");
    $urow = mysqli_fetch_assoc($Userresult);
    $id= $urow['uid'];

    $Courseresult = mysqli_query($con,"SELECT * FROM mycourse WHERE courseID='$courseID' and userID='$id' ");
    $crow = mysqli_fetch_assoc($Courseresult);
    $cid= $crow['courseID'];

    $Courseresult2 = mysqli_query($con,"SELECT * FROM mycourse WHERE courseID='$courseID' and userID='$id' and courseStatus='Deactive'");
    $crow2 = mysqli_fetch_assoc($Courseresult2);
    $cid2= $crow2['courseID'];

    if ($courseKey!="") {
        if ($courseKey==$cKey) {
            if ($courseID != $cid) {
                $insersql = "INSERT INTO mycourse(courseID,userID,courseStatus)VALUES('$courseID','$id','Active')";
                $query = mysqli_query($con, $insersql);
                if ($query) {
                    header("location:course.php");
                }
            }
            if ($courseID == $cid2) {
                $sql2 = "UPDATE mycourse SET courseStatus='Active' WHERE courseID='$courseID' and userID='$id'";
                $query2 = mysqli_query($con, $sql2);
                if ($query2) {
                    header("location:course.php");
                }
            } else {
                $sucess_mes = "Course already Enrolled !";
                echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
            }

        } else {
            $sucess_mes = "Incorrect enrolment key !, please try again";
            echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
        }
    }
    else{
        $sucess_mes = "Enter Enrolment key";
        echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
    }
}


if(isset($_POST["subject"])){
    $txtID=$_POST["txtID"];
    $_SESSION["courseID"]=$txtID;

    $uname = $_SESSION['uname'];
    $Userresult = mysqli_query($con,"SELECT * FROM users WHERE RegNumber='$uname'");
    $urow = mysqli_fetch_assoc($Userresult);
    $id= $urow['uid'];

    $Courseresult = mysqli_query($con,"SELECT * FROM mycourse WHERE courseID='$txtID' and userID='$id' and courseStatus='Active'");
    $crow = mysqli_fetch_assoc($Courseresult);
    $cid= $crow['courseID'];

    if($txtID==$cid) {
        if ($txtID != "") {
            header("location:subject.php");
        }
    }
    else{
        $sucess_mes = "Course does not Enrol";
        echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
    }
}

$semi1=1;
$semi2=2;



?>

<!DOCTYPE html>
<html>
<head>
    <title>Course</title>

</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%; text-transform: capitalize;">
    <?php
    include ('header.php');
    ?>

    <div class="container" style="margin-top:0px">
        <div class="row">
            <!-- Notice bar start.//-->
            <div class="col-sm-8" >
                <div class="row">
                    <div class="col-sm-12">
                        <h6> <span class="fa fa-graduation-cap"></span> Faculty of <?php echo $clickFaculty ?> - Year <?php echo $clickYear ?>  </h6>
                    </div>
                </div>

                <div class="overflow-auto" style="margin-top: 40px">
                    <form action="" method="POST">


                        <input type="hidden" id="txtID" name="txtID">
                        <div style="margin-left: 20px;">
                            <div class="p-3 mb-2 bg-secondary text-white border-left" style="border-width:5px !important; border-color: #1E90FF !important;">Semester 1</div>
                            <?php
                            $result2=mysqli_query($con,"SELECT * 
                                                              FROM course 
                                                              WHERE courseFaculty='$clickFaculty' and courseYear='$clickYear' and courseSemi=1 and courseStatus='Active' 
                                                              order by courseID asc ");

                            if($result2 == FALSE) {
                                die(mysqli_error());
                            }
                            while($res2=mysqli_fetch_array($result2))
                            {
                                ?>
                                <table class="table" style="margin: unset; padding: unset">
                                    <tbody >
                                    <tr>
                                        <td colspan="2"><span class="fa fa-chevron-circle-right" style="color: #FF8C00"> </span> <button type="submit" name="subject" value="<?php echo $res2['courseID'];?>" class="btn btn-link " style="margin: unset; padding: unset;text-decoration: none;"> <?php echo $res2['courseID'];?> - <?php echo $res2['courseName'];?></button></td>
                                        <th>
                                            <a href="#CourseID<?php echo $res2['courseID']; ?>" class="float-right " title="Key" data-toggle="modal" ><span class="fa fa-key" "></span></a>
                                        </th>
                                    </tr>
                                    </tbody>

                                </table>

                                <!-- delete course -->
                                <div id="CourseID<?php echo $res2['courseID']; ?>" class="modal fade"  role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="course.php?CourseID=<?php echo $res2['courseID']; ?>" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Enrolment key for <span style="font-weight: bold"> "<?php echo $res2['courseName']; ?> "</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <input type="text" name="courseKey" class="form-control" placeholder="Enter here">
                                                    </div> <!-- form-group end.// -->

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                                                    <button type="submit" name="btnKey" class="btn btn-primary"> Submit </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end Modal -->
                                <?php
                            }
                            ?>
                            <div class="p-3 mb-2 bg-secondary text-white border-left" style="border-width:5px !important; border-color: #1E90FF !important;">Semester 2</div>
                                <?php
                                $result2=mysqli_query($con,"SELECT * 
                                                              FROM course 
                                                              WHERE courseFaculty='$clickFaculty' and courseYear='$clickYear' and courseSemi=2 and courseStatus='Active' 
                                                              order by courseID asc ");

                                if($result2 === FALSE) {
                                    die(mysqli_error());
                                }
                                while($res2=mysqli_fetch_array($result2))
                                {
                                    ?>
                                    <table class="table" style="margin: unset; padding: unset">
                                        <tbody >
                                        <tr>
                                            <td colspan="2"><span class="fa fa-chevron-circle-right" style="color: #FF8C00"> </span> <button type="submit" name="subject" value="<?php echo $res2['courseID'];?>" class="btn btn-link " style="margin: unset; padding: unset;text-decoration: none;"> <?php echo $res2['courseID'];?> - <?php echo $res2['courseName'];?></button></td>
                                            <th>
                                                <a href="#CourseID<?php echo $res2['courseID']; ?>" class="float-right " title="Key" data-toggle="modal" ><span class="fa fa-key" "></span></a>
                                            </th>
                                        </tr>
                                        </tbody>

                                    </table>

                                    <!-- key course -->
                                    <div id="CourseID<?php echo $res2['courseID']; ?>" class="modal fade"  role="dialog"  aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="course.php?CourseID=<?php echo $res2['courseID']; ?>" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Enrolment key for <span style="font-weight: bold"> "<?php echo $res2['courseName']; ?> "</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <input type="text" name="courseKey" class="form-control" placeholder="Enter here">
                                                        </div> <!-- form-group end.// -->

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                                                        <button type="submit" name="btnKey" class="btn btn-primary"> Submit </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- end Modal -->
                                    <?php

                                }
                                ?>
                        </div>


                    </form>
                    <script type="text/javascript">
                        $("button[type='submit']").hover(function(){
                            var v = this.value;
                            var textcontrol = document.getElementById("txtID");
                            textcontrol.value = this.value;
                            //window.location.href = "course.php";
                        });
                    </script>
                </div>
            </div><!-- Notice bar end.//-->

            <!-- Side bar.//-->
            <?php
            include ('side_menu.php');
            ?>
            <!-- Side bar end.//-->
        </div>
    </div>

    <?php
    include ('footer.php');
    ?>

    <footer style="margin:0 10px">
        <p>ABC @ 2019 All Rights Reserved. </p>
    </footer>
</div>
</body>
</html>
