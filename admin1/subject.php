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

// Delete subject
if (isset($_GET['s']))
{
    $subjectID=$_GET['subjectID'];
    $sql="UPDATE subject SET subjectStatus='Delete' WHERE subjectID='$subjectID'";
    $query=mysqli_query($con,$sql);
    if($query)
    {
        header("location:subject.php");
    }
}

// Delete files
if (isset($_GET['y']))
{
    $fileID=$_GET['fileID'];
    $sql="UPDATE subjectfile SET fileStatus='Delete' WHERE fileID='$fileID'";
    $query=mysqli_query($con,$sql);
    if($query)
    {
        header("location:subject.php");
    }
}

// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM subjectfile WHERE fileID='$id'";
    $result = mysqli_query($con, $sql);

    $file = mysqli_fetch_array($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)== true) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['size']));
        readfile('uploads/' . $file['name']);

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
                    <div class="col-sm-10">
                        <h6> <span class="fa fa-graduation-cap"></span> Faculty of <?php echo $clickFaculty ?> - Year <?php echo $clickYear ?> - Semester <?php echo $clickSemi ?> - <b><?php echo $clickCourse ?></b> </h6>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-success float-right" onclick="window.location.href='subjectAddEdit.php'"><span class="fa fa-plus"></span>
                            Add
                        </button>
                    </div>

                </div>

                <div style="margin-top: 40px">
                    <?php
                    $result=mysqli_query($con,"SELECT DISTINCT s.subjectTitle,s.subjectID 
                                                      FROM subject s 
                                                      WHERE s.courseID='$CourseID' and s.subjectStatus='Active'
                                                      order by s.subjectID asc ");

                    if($result === FALSE) {
                        die(mysqli_error());
                    }
                    while($res=mysqli_fetch_array($result))
                    {
                    ?>

                        <div class="p-2 mb-3 border-bottom" style="border-width:3px !important; border-color: #FF8C00 !important; background-color: #E5E7E9; "><span ><?php echo $res['subjectTitle']; ?></span>
                        <a href="#deleteSubject<?php echo $res['subjectID']; ?>"  class="float-right " title="Delete" data-toggle="modal" ><span class="fa fa-trash" style="color: red; "></span></a>
                        <!-- subject Delete Modal -->
                        <div id="deleteSubject<?php echo $res['subjectID']; ?>" class="modal fade"  role="dialog"  aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Conformation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you want to delete this subject <span style="font-weight: bold"> "<?php echo $res['subjectTitle']; ?> "</span>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                                        <a href="subject.php?s=1&subjectID=<?php echo $res['subjectID']; ?>" class="float-right "><button type="button" name="yes" class="btn btn-primary"> Yes </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Modal -->
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
                                <td colspan="2"><span class="fa fa-file" style="color: #EC7063"> </span> <a href="subject.php?file_id=<?php echo $res2['fileID'] ?> " style="text-decoration: none; color: #5a6268"><?php echo $res2['name']; ?></a></td>
                                <th>
                                    <a href="#deleteFile<?php echo $res2['fileID']; ?>"  class="float-right " title="Delete" data-toggle="modal" ><span class="fa fa-trash" style="color: red; "></span></a>
                                </th>
                            </tr>
                                <!-- file Delete Modal -->
                                <div id="deleteFile<?php echo $res2['fileID']; ?>" class="modal fade"  role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Conformation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Do you want to delete this file <span style="font-weight: bold"> "<?php echo $res2['name']; ?> "</span>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                                                <a href="subject.php?y=1&fileID=<?php echo $res2['fileID']; ?>" class="float-right "><button type="button" name="yes" class="btn btn-primary"> Yes </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Modal -->
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
