<?php
include('config.php');
session_start();

//delete notice ...............
if (isset($_GET['deleteNotice']))
{
    $id=$_GET['id'];
    $sql="UPDATE notice SET Status='Delete' WHERE id='$id'";
    $query=mysqli_query($con,$sql);
    if($query)
    {
        header("location:home.php");
    }
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
            <!-- Notice bar start.//-->
            <div class="col-sm-8" >
                <div class="row">
                    <div class="col-sm-8">
                        <h5> <span class="fa fa-edit"></span> Notice</h5>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-success float-right" onclick="window.location.href='add_edit_notice.php'"><span class="fa fa-plus"></span>
                            Add
                        </button>
                    </div>
                </div>

                <div class="overflow-auto" style="max-height:800px">
                    <?php
                    $result=mysqli_query($con,"SELECT * FROM notice WHERE Status='Active' order by id desc");

                    if($result === FALSE) {
                        die(mysqli_error());
                    }
                    while($res=mysqli_fetch_array($result))
                    {
                        ?>
                        <div class="card" style="margin-top:2%">
                            <div class="card">
                                <table >
                                    <tr class="card-header">
                                        <th><a href="notice.php?view=1&id=<?php echo $res['id']; ?>" style="margin-left: 10px; text-decoration:red; "> <h5 style="font-size:medium"><?php echo $res['Title']; ?></h5></a></th>
                                        <th> <a href="#deleteNotice<?php echo $res['id']; ?>" class="float-right " title="Delete" data-toggle="modal" ><span class="fa fa-trash" style="color: red; margin:0 10px"></span></a>
                                            <a href="add_edit_notice.php?edited=1&id=<?php echo $res['id']; ?>" class="float-right " title="Edit"><span class="fa fa-pencil"></span></a></th>
                                    </tr>
                                    <tr>
                                        <td><h6 class="card-title" style="margin-left:20px; font-size: small"><?php echo $res['Sub_title']; ?></h6></td>
                                    </tr>
                                    <tr>
                                        <td><p class="card-text" style="font-size:10px;margin-left:20px;"><span class="fa fa-calendar" style="size: 18px"></span> <?php echo $res['Date']; ?></p></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- delete Modal -->
                        <div id="deleteNotice<?php echo $res['id']; ?>" class="modal fade"  role="dialog"  aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Conformation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you want to delete this<span style="font-weight: bold"> <?php echo $res['Title']; ?> </span>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                                        <a href="home.php?deleteNotice=1&id=<?php echo $res['id']; ?>" class="float-right "><button type="button" class="btn btn-primary">Yes</button></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Modal -->
                        <?php
                    }
                    mysqli_close($con);
                    ?>
                </div>
            </div> <!-- Notice bar end.//-->

            <!-- Side bar.//-->
            <?php
            include ('side_menu.php');
            ?>
            <!-- Side bar end.//-->

        </div>
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
