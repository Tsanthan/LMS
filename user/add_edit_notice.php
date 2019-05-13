<?php
session_start();
include("config.php");
$id="0";
$title="";
$sub="";
$desc="";

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $sub = $_POST['sub'];
    $desc = $_POST['desc'];
    // $date = $_POST['date'];

    if($_POST['txtid']=="0") {
        // checking empty fields
        if ($title != "" && $sub != "" && $desc != "") {
            $insersql = "INSERT INTO notice(Title,Sub_title,Description,Date,Status)VALUES('$title','$sub','$desc',NOW(),'Active')";
            if ($con->query($insersql)) {
                header("location:home.php");
                //header('Refresh:0;home.php');
                //$notice_suc = "<i style='color:green;'> Notice Sucessfully Created. </i>";
            } else {
                $notice_suc = "<i style='color:red;'> Created faild </i>";
            }
        }
    }
    else{
        $id = $_POST['txtid'];
        $sql="UPDATE notice SET Title='$title', Sub_title='$sub', Description='$desc' WHERE id='$id'";
        $query=mysqli_query($con,$sql);
        if($query)
        {
            header("location:home.php");
            //header('Refresh:0;home.php');
           // $notice_suc = "<i style='color:green;'> Notice Sucessfully Updated. </i>";
        }
        else
        {
            $notice_suc = "<i style='color:green;'> Notice Updated Faild </i>";
        }

    }
}
if (isset($_GET['edited'])){
    $sql="SELECT * FROM notice WHERE id='{$_GET['id']}'";
    $query=mysqli_query($con,$sql);
    $row=mysqli_fetch_object($query);
    $id=$row->id;
    $title=$row->Title;
    $sub=$row->Sub_title;
    $desc=$row->Description;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%">
    <?php
    include ('header.php');
    ?>

    <div class="container" style="margin-top:0px">
        <div class="row">
            <div class="col-sm-8">

            </div>
            <div class="col-sm-4">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-bell"></i>
                    Notificaton <span class="badge badge-light">9</span>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <p>Some text in the modal.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Notice bar start.//-->
            <div class="col-sm-8 " style="margin-top: 10px">

                        <div class="card">
                            <header class="card-header">
                                <?php
                                if($id=="0") {
                                    echo '<h4 class="card-title mt-2">Create Notice</h4>';
                                }
                                else{
                                    echo '<h4 class="card-title mt-2">Edit Notice</h4>';
                                }
                                ?>
                            </header>
                            <article class="card-body">
                                <form id="noticeForm" action="" method="post">
                                    <div class="form-group">
                                        <div class="text-center" style="color:green; "><?php if(isset($notice_suc)) echo $notice_suc; ?></div>
                                        <div><?php if(isset($faild_err)) echo $faild_err; ?></div>
                                        <label>Title</label>
                                        <div><?php if(isset($title_err)) echo $title_err; ?></div>
                                        <input type="text" name="title" class="form-control" placeholder="Enter the title here..."  value="<?php echo $title; ?>" required>
                                        <input type="hidden" name="txtid" value="<?php echo $id; ?>" />
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label>Sub Title</label>
                                        <div><?php if(isset($email_err)) echo $email_err; ?></div>
                                        <input type="text" name="sub" class="form-control" placeholder="Enter the sub title here..." value="<?php echo $sub; ?>" required>
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="desc" class="form-control" placeholder="Enter text here..." required ><?php echo $desc; ?></textarea>
                                    </div> <!-- form-group end.// -->

                                    <div class="form-group">
                                        <?php
                                        if($id=="0") {
                                            echo '<button type="submit" name="submit" class="btn btn-primary btn-block"> Submit  </button>';
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


            <div class="col-sm-4 " > <!-- side bar start.//-->
                <div style="background-color:#F0F3F5; padding:2%; border-radius: 4px; margin-top:10px">

                    <div class="card" style="margin-bottom:7%">
                        <header class="card-header">
                            <h5 class="card-title mt-1">My Courses</h5>
                        </header>
                        <div style="padding:10px">
                            <p>SPM</p>
                            <p>ISDM</p>
                            <p>OOP</p>
                        </div>
                    </div>

                    <div class="card" style="margin-bottom:7%">
                        <header class="card-header">
                            <h5 class="card-title mt-1">Assignment Submission</h5>
                            <a href="" class="float-right fa fa-plus"></a>

                        </header>
                        <div style="padding:10px">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Active</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="#">Disabled</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- side bar end.//-->

            </div>
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
