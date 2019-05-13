<?php
session_start();
include("config.php");

$clickFaculty = $_SESSION['fa'];
$clickYear = $_SESSION['yea'];
$CourseID = $_SESSION['courseID'];

$sql="SELECT * FROM course WHERE courseID='$CourseID'";
$query=mysqli_query($con,$sql);
$row=mysqli_fetch_object($query);
$clickSemi=$row->courseSemi;
$clickCourse=$row->courseName;


$cID="0";
if(isset($_POST['addSubject'])) {
    $Title = $_POST['title'];
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if ($Title != "" && $filename != "") {
        $query = "SELECT * FROM subject WHERE subjectTitle='$Title' and courseID='$CourseID' and subjectStatus='Active'";
        $result4 = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result4);
        $ID=$row['subjectID'];
        $courseid=$row['courseID'];
        $title=$row['subjectTitle'];

        if($title==$Title and $courseid==$CourseID ){
            if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                $sucess_mes= "You file extension must be .zip, .pdf or .docx";
                echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
            } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
                $sucess_mes= "File too large!";
                echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
            } else {
                if(!file_exists($destination)) //check file not exist in your upload folder path
                {
                    // move the uploaded (temporary) file to the specified destination
                    if (is_uploaded_file($file)) {
                        move_uploaded_file($file, $destination);
                        $insersql = "INSERT INTO subjectfile(subjectID,subjectTitle,name,size,downloads,fileStatus)VALUES('$ID','$Title','$filename','$size',0,'Active')";
                        if ($con->query($insersql)) {
                            $sucess_mes = "subject Added Successfully";
                            echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                            header("location:subject.php");

                        } else {
                            $sucess_mes = "Failed to upload file.";
                            echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                        }
                    }
                }
                else
                {
                    $sucess_mes = "File Already Exists.";
                    echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                }
            }
        }
        else {
            if($title!=$Title and $courseid!=$CourseID ){
            $insersql2 = "INSERT INTO subject(courseID,subjectTitle,subjectStatus)VALUES('$CourseID','$Title','Active')";
            if ($con->query($insersql2)) {
                $lastid = mysqli_insert_id($con);

                if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
                    $sucess_mes = "You file extension must be .zip, .pdf or .docx";
                    echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
                    $sucess_mes = "File too large!";
                    echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                } else {
                    // move the uploaded (temporary) file to the specified destination
                    if (is_uploaded_file($file)) {
                        move_uploaded_file($file, $destination);
                        $insersql3 = "INSERT INTO subjectfile(subjectID,subjectTitle,name,size,downloads,fileStatus)VALUES('$lastid','$Title','$filename','$size',0,'Active')";
                        if ($con->query($insersql3)) {
                            $sucess_mes = "subject Added Successfully";
                            echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                            header("location:subject.php");

                        } else {
                            $sucess_mes = "Failed to upload file.";
                            echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                        }
                    }
                }
            } else {
                $notice_suc = "<i style='color:red;'> Created faild </i>";
            }
        }
        }
    }
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
                        <h6> <span class="fa fa-graduation-cap"></span> Faculty of <?php echo $clickFaculty ?> - Year <?php echo $clickYear ?> - Semester <?php echo $clickSemi ?> - <?php echo $clickCourse ?> - Add </h6>
                    </div>
                </div>

                <div class="">

                    <article class="card-body">
                        <form id="subjectForm" action="" method="post" style="font-weight: bold" enctype="multipart/form-data">
                            <div class="form-group ">
                                <label>Title</label>
                                <input type="text" list="cars" class="form-control" placeholder="" required name="title" />
                                <datalist id="cars"  >
                                    <?php
                                    $result=mysqli_query($con,"SELECT subjectTitle 
                                                                      FROM subject
                                                                      WHERE courseID='$CourseID' and subjectStatus='Active'
                                                                      order by subjectID asc");

                                    if($result === FALSE) {
                                        die(mysqli_error());
                                    }
                                    while($res=mysqli_fetch_array($result))
                                    {
                                        ?>
                                        <option value="<?php echo $res['subjectTitle']; ?>"></option>
                                        <?php
                                    }
                                    ?>
                                </datalist>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" name="myfile" class="form-control" placeholder="" required >
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <button type="submit" name="addSubject" class="btn btn-primary btn-block"> Add   </button>
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
