<?php
include('config.php');
session_start();

$clickFaculty = $_SESSION['fa'];
$clickYear = $_SESSION['yea'];

//Delete course
if (isset($_GET['y']))
{
    $courseID=$_GET['courseID'];
    $sql="UPDATE course SET courseStatus='Delete' WHERE courseID='$courseID'";
    $query=mysqli_query($con,$sql);
    if($query)
    {
        header("location:course.php");
    }
}

if(isset($_POST["subject"])){
    $txtID=$_POST["txtID"];
    $_SESSION["courseID"]=$txtID;
    echo $txtID;
    if($txtID!="") {
        header("location:subject.php");
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
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%">
    <?php
    include ('header.php');
    ?>

    <div class="container" style="margin-top:0px">
        <div class="row">
            <!-- Notice bar start.//-->
            <div class="col-sm-8" >
                <div class="row">
                    <div class="col-sm-10">
                        <h6> <span class="fa fa-graduation-cap"></span> Faculty of <?php echo $clickFaculty ?> - Year <?php echo $clickYear ?>  </h6>
                    </div>
                    <div class="col-sm-2">
                        <a href="courseAddEdit.php" >
                            <button type="button" class="btn btn-success float-right"><span class="fa fa-plus"></span>
                                Add
                            </button>
                        </a>

                    </div>
                </div>

                <div class="overflow-auto" style="margin-top: 40px">
                    <div class="p-3 mb-2 bg-secondary text-white border-left" style="border-width:5px !important; border-color: #1E90FF !important;">Semester 1</div>
                    <form action="" method="POST">
                        <input type="hidden" id="txtID" name="txtID">
                    <div style="margin-left: 20px;">
                        <?php
                        $result=mysqli_query($con,"SELECT * FROM course WHERE courseFaculty='$clickFaculty' and courseYear='$clickYear' and courseSemi=1 and courseStatus='Active' order by courseID asc ");

                        if($result === FALSE) {
                            die(mysqli_error());
                        }
                        while($res=mysqli_fetch_array($result))
                        {
                            ?>
                            <table class="table" style="margin: unset; padding: unset">
                                <tbody >
                                <tr>
                                    <td colspan="2"><span class="fa fa-chevron-circle-right" style="color: #FF8C00"> </span> <button type="submit" name="subject" value="<?php echo $res['courseID'];?>" name="submit1" class="btn btn-link " style="margin: unset; padding: unset; text-decoration: none;"> <?php echo $res['courseID'];?> - <?php echo $res['courseName'];?></button></td>
                                    <th>
                                        <a href="#deleteCourse<?php echo $res['courseID']; ?>"  class="float-right " title="Delete" data-toggle="modal" ><span class="fa fa-trash" style="color: red; "></span></a>
                                        <a href="courseAddEdit.php?y=1&courseID=<?php echo $res['courseID']; ?>&faculty=<?php echo $res['courseFaculty']; ?>&course=<?php echo $res["courseName"]; ?>&year=<?php echo $res['courseYear']; ?>" class="float-right " title="Edit"><span class="fa fa-pencil" style="margin:0 10px"></span></a>
                                    </th>
                                </tr>
                                </tbody>

                            </table>
                            <!-- delete course -->
                            <div id="deleteCourse<?php echo $res['courseID']; ?>" class="modal fade"  role="dialog"  aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Conformation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Do you want to delete this course <span style="font-weight: bold"> "<?php echo $res['courseName']; ?> "</span>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                                            <a href="course.php?y=1&courseID=<?php echo $res['courseID']; ?>" class="float-right "><button type="button" name="yes" class="btn btn-primary"> Yes </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end Modal -->
                            <?php

                        }
                        ?>

                    </div>

                        <div class="p-3 mb-2 bg-secondary text-white border-left" style="border-width:5px !important; border-color: #1E90FF !important;">Semester 2</div>
                    <div style="margin-left: 20px;">
                        <?php
                        $result=mysqli_query($con,"SELECT * FROM course WHERE courseFaculty='$clickFaculty' and courseYear='$clickYear' and courseSemi=2 and courseStatus='Active' order by courseID asc ");

                        if($result === FALSE) {
                            die(mysqli_error());
                        }
                        while($res=mysqli_fetch_array($result))
                        {
                            ?>
                            <table class="table" style="margin: unset; padding: unset">
                                <tbody>
                                <tr>
                                    <td colspan="2"><span class="fa fa-chevron-circle-right" style="color: #FF8C00"> </span> <button type="submit" name="subject" value="<?php echo $res['courseID'];?>" name="submit1" class="btn btn-link " style="margin: unset; padding: unset;text-decoration: none;"> <?php echo $res['courseID'];?> - <?php echo $res['courseName'];?></button></td>
                                    <th>
                                        <a href="#deleteCourse<?php echo $res['courseID']; ?>"  class="float-right " title="Delete" data-toggle="modal" ><span class="fa fa-trash" style="color: red; "></span></a>
                                        <a href="courseAddEdit.php?y=1&courseID=<?php echo $res['courseID']; ?>&faculty=<?php echo $res['courseFaculty']; ?>&course=<?php echo $res["courseName"]; ?>&year=<?php echo $res['courseYear']; ?>" class="float-right " title="Edit"><span class="fa fa-pencil" style="margin:0 10px"></span></a>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                            <!-- delete course -->
                            <div id="deleteCourse<?php echo $res['courseID']; ?>" class="modal fade"  role="dialog"  aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Conformation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Do you want to delete this course <span style="font-weight: bold"> "<?php echo $res['courseName']; ?> "</span>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                                            <a href="course.php?y=1&courseID=<?php echo $res['courseID']; ?>" class="float-right "><button type="button" name="yes" class="btn btn-primary"> Yes </button></a>
                                        </div>
                                    </div>
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
