<?php
include('config.php');
session_start();

$clickFaculty = $_SESSION['fa'];
$clickYear = $_SESSION['yea'];
$CourseID = $_SESSION['courseID'];

$sql="SELECT * FROM course WHERE courseID='$CourseID'";
$query=mysqli_query($con,$sql);
$row=mysqli_fetch_object($query);
$clickSemi=$row->courseSemi;
$clickCourse=$row->courseName;

// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM subjectfile WHERE fileID='$id'";
    $result = mysqli_query($con, $sql);

    $file = mysqli_fetch_array($result);
    $filepath = '../admin1/uploads/' . $file['name'];

    if (file_exists($filepath)== true) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('../admin1/uploads/' . $file['size']));
        readfile('../admin1/uploads/' . $file['name']);

        echo $file['downloads'];
        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE subjectfile SET downloads='$newCount' WHERE fileID='$id'";
        mysqli_query($con, $updateQuery);
        exit;
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Year</title>
</head>

<body id="backimage" >
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
                        <h6> <span class="fa fa-graduation-cap"></span> Faculty of <?php echo $clickFaculty ?> - Year <?php echo $clickYear ?> - Semester <?php echo $clickSemi ?> - <b><?php echo $clickCourse ?></b> </h6>
                    </div>
                </div>

                <div style="margin-top: 40px">
                    <?php
                    $result=mysqli_query($con,"SELECT DISTINCT s.subjectTitle,s.subjectID 
                                                      FROM subject s, course c, mycourse mc
                                                      WHERE s.courseID='$CourseID' and s.subjectStatus='Active' and s.courseID=mc.courseID and mc.userID='$id'and mc.courseStatus='Active'
                                                      order by s.subjectID asc ");


                    if($result === FALSE) {
                        die(mysqli_error());
                    }
                    while($res=mysqli_fetch_array($result))
                    {
                        ?>

                        <div class="p-2 mb-3 border-bottom" style="border-width:3px !important; border-color: #FF8C00 !important;background-color: #E5E7E9;">
                            <span><?php echo $res['subjectTitle']; ?></span>
                        </div>
                        <div style="margin-left: 20px;">
                            <table class="table table-sm table-borderless">
                                <tbody>
                                <?php
                                $subjectTitle =$res['subjectTitle'];
                                $result2=mysqli_query($con,"SELECT DISTINCT f.name,f.fileID
                                                                FROM subjectfile f, subject s
                                                                WHERE f.subjectID=s.subjectID and s.courseID='$CourseID' and s.subjectTitle='$subjectTitle' and f.fileStatus='Active' 
                                                                order by f.fileID asc ");

                                if($result2 === FALSE) {
                                    die(mysqli_error());
                                }
                                while($res2=mysqli_fetch_array($result2))
                                {
                                    ?>
                                    <tr>
                                        <td colspan="2" ><span class="fa fa-file" style="color: #EC7063"> </span> <a href="subject.php?file_id=<?php echo $res2['fileID'] ?>" style="text-decoration: none; color: #5a6268"><?php echo $res2['name']; ?></a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    ?>

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
