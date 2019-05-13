<?php
include("config.php");
session_start();
if (isset($_GET['view'])){
    $sql="SELECT * FROM notice WHERE id='{$_GET['id']}'";
    $query=mysqli_query($con,$sql);
    $row=mysqli_fetch_object($query);
    $id=$row->id;
    $title=$row->Title;
    $sub=$row->Sub_title;
    $desc=$row->Description;
    $date=$row->Date;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%;text-transform: capitalize;">
    <?php
    include ('header.php');
    ?>

    <div class="container" style="margin-top:0px">
        <div class="row">
            <!-- Notice bar start.//-->
            <div class="col-sm-8" >
                <div class="row">
                    <div class="col-sm-8">
                        <h6> <span class="fa fa-edit"></span> Notice</h6>
                    </div>

                </div>

                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading"><?php echo $title; ?></h4>
                    <hr>
                    <h6 class="alert-heading" style="color: #117a8b"><?php echo $sub; ?></h6>
                    <p style="font-size: 12px"><?php echo $date; ?></p>
                    <hr>
                    <p class="mb-2" style="color: #1C2833;"><?php echo $desc; ?></p>
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
