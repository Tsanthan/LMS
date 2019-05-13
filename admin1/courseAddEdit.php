<?php
session_start();
include("config.php");

$clickFaculty = $_SESSION['fa'];
$clickYear = $_SESSION['yea'];

$semi1=1;
$semi2=2;

$cID="0";
if(isset($_POST['submit'])) {
    $courseName = $_POST['courseName'];
    $courseSemi = $_POST['courseSemi'];
    $courseKey = $_POST['courseKey'];


    if($_POST['cID']=="0") {
        // checking empty fields
        if ($courseName != "" && $courseSemi != "" && $courseKey != "") {
            $insersql = "INSERT INTO course(courseName,courseFaculty,courseYear,courseSemi,courseKey,courseStatus)VALUES('$courseName','$clickFaculty','$clickYear','$courseSemi','$courseKey','Active')";
            $sql1 = "INSERT INTO notification(notification)VALUES('added new course $courseName')";
            if ($con->query($insersql)&&$con->query($sql1)) {

                $sl3="SELECT MAX(id) FROM notification";
                $query1=mysqli_query($con,$sl3);
                $row1=mysqli_fetch_array($query1);
                $r2=$row1[0];
                $sl2="SELECT uid FROM users where Course='$clickFaculty'";
                $query=mysqli_query($con,$sl2);
                while($row=mysqli_fetch_array($query)) {
                    $r=$row[0];

                    $sl4 = "INSERT INTO notification_status(nid, uid, status)VALUES('$r2','$r',0)";
                    $con->query($sl4);

                }

                    $sucess_mes = "Course Added Successfully";
                    echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                    header("location:course.php");

            } else {
                $notice_suc = "<i style='color:red;'> Created faild </i>";
            }
        }
    }
    else{
        $nid = $_POST['cID'];
        $sql="UPDATE course SET courseName='$courseName', courseSemi='$courseSemi', courseKey='$courseKey' WHERE courseID='$nid'";
        $query=mysqli_query($con,$sql);
        if($query)
        {
            $sql2="UPDATE mycourse SET courseStatus='Deactive' WHERE courseID='$nid'";
            $query2=mysqli_query($con,$sql2);
            if($query2) {
                header("location:course.php");
            }
        }
        else
        {
            $notice_suc = "<i style='color:green;'> Notice Updated Faild </i>";
        }

    }
}

if (isset($_GET['y'])){
    $sql="SELECT * FROM course WHERE courseID='{$_GET['courseID']}'";
    $query=mysqli_query($con,$sql);
    $row=mysqli_fetch_object($query);
    $cID=$row->courseID;
    $cName=$row->courseName;
    $cSEMI=$row->courseSemi;
    $cKEY=$row->courseKey;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>course</title>
</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%">
    <?php
    include ('header.php');
    ?>

    <div class="container" style="margin-top:0px">

        <div class="row">
            <!-- Notice bar start.//-->
            <div class="col-sm-8 overflow-auto" style="max-height:800px">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        if($cID=="0") {
                            echo "<h6> <span class='fa fa-graduation-cap'></span> Faculty of  $clickFaculty - Year $clickYear - Create Course</h6>";
                        }
                        else{
                            echo "<h6> <span class='fa fa-graduation-cap'></span> Faculty of  $clickFaculty - Year $clickYear - Edit Course</h6>";
                        }
                        ?>
                    </div>
                </div>

                <div class="">

                    <article class="card-body">
                        <form id="courseForm" action="" method="post" style="font-weight: bold">
                            <div class="form-group">
                                <label>Course Name</label>
                                <input type="text" name="courseName" class="form-control" placeholder="" required  value="<?php  if(isset($cName)){ echo $cName; } ?>">
                                <input type="hidden" name="cID" value="<?php echo $cID; ?>" />
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Course Semester</label>
                                <select id="inputState" class="form-control" name="courseSemi">
                                    <option> Choose...</option>
                                    <option value="1" <?php if($cID=="0"){ echo ''; } else if($cSEMI=="1") echo 'selected="selected"'; ?> ><?php echo $semi1; ?></option>
                                    <option value="2" <?php if($cID=="0"){ echo ''; } else if($cSEMI=="2") echo 'selected="selected"'; ?> ><?php echo $semi2; ?></option>
                                </select>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Enrolment key</label>
                                <input type="text" name="courseKey" class="form-control" placeholder="" required value="<?php if(isset($cKEY)){ echo $cKEY; } ?>">
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <?php
                                if($cID=="0") {
                                    echo '<button type="submit" name="submit" class="btn btn-primary btn-block"> Add Course  </button>';
                                }
                                else{
                                    echo '<button type="submit" name="submit" class="btn btn-primary btn-block" onclick="return confirm(\'Are you sure want to Update notice?\');"> Update  </button>';
                                }
                                ?>

                            </div> <!-- form-group// -->
                        </form>
                    </article> <!-- card-body end .// -->
                </div> <!-- card.// -->

            </div> <!-- Notice bar end.//-->

            <!-- Side bar.//-->
            <?php
            include ('side_menu.php');
            ?>
            <!-- Side bar end.//-->

        </div>
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
