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
    <title>Notice</title>

    <style>
        .top-right {
            position: absolute;
            top: 8px;
            right: 5px;
        }
    </style>
</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%">
    <?php
    include ('header.php');
    ?>

    <div class="container" style="margin-top:0px">

        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" style="margin:30px 10px; ">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../user/image/a.jpg" class="d-block w-100" alt="...">
                    <div class="top-right">
                        <a href="home.php?deleted=1&id=<?php echo $res['id']; ?>" class="float-right " title="Delete" onclick="return confirm('Are you sure want to Delete notice?');" style="margin: 10px 5px;"><span class="fa fa-trash" style="color: red;"></span></a>
                        <a href="add_edit_notice.php?edited=1&id=<?php echo $res['id']; ?>" class="float-right " title="Edit" style="margin: 10px 5px;"><span class="fa fa-pencil"></span></a>
                        <a href="add_edit_notice.php?edited=1&id=<?php echo $res['id']; ?>" class="float-right " title="Add" style="margin: 10px 5px;"><span class="fa fa-plus"></span></a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../user/image/b.jpg" class="d-block w-100" alt="...">
                    <div class="top-right">
                        <a href="home.php?deleted=1&id=<?php echo $res['id']; ?>" class="float-right " title="Delete" onclick="return confirm('Are you sure want to Delete notice?');" style="margin: 10px 5px;"><span class="fa fa-trash" style="color: red;"></span></a>
                        <a href="add_edit_notice.php?edited=1&id=<?php echo $res['id']; ?>" class="float-right " title="Edit" style="margin: 10px 5px;"><span class="fa fa-pencil"></span></a>
                        <a href="add_edit_notice.php?edited=1&id=<?php echo $res['id']; ?>" class="float-right " title="Add" style="margin: 10px 5px;"><span class="fa fa-plus"></span></a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../user/image/c.jpg" class="d-block w-100" alt="...">
                    <div class="top-right">
                        <a href="home.php?deleted=1&id=<?php echo $res['id']; ?>" class="float-right " title="Delete" onclick="return confirm('Are you sure want to Delete notice?');" style="margin: 10px 5px;"><span class="fa fa-trash" style="color: red;"></span></a>
                        <a href="add_edit_notice.php?edited=1&id=<?php echo $res['id']; ?>" class="float-right " title="Edit" style="margin: 10px 5px;"><span class="fa fa-pencil"></span></a>
                        <a href="add_edit_notice.php?edited=1&id=<?php echo $res['id']; ?>" class="float-right " title="Add" style="margin: 10px 5px;"><span class="fa fa-plus"></span></a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- notice -->
        <?php
        $note=mysqli_query($con,"SELECT DISTINCT * 
                                                      FROM dashboard_note
                                                      order by noteID asc ");

        if($note === FALSE) {
            die(mysqli_error());
        }
        while($resnote=mysqli_fetch_array($note))
        {
        ?>
        <div class="col">
            <a href="home.php?deleted=1&id=<?php echo $res['id']; ?>" class="float-right " title="Delete" onclick="return confirm('Are you sure want to Delete notice?');" style="margin: 10px 5px;"><span class="fa fa-trash" style="color: red;"></span></a>
            <a href="add_edit_notice.php?edited=1&id=<?php echo $res['id']; ?>" class="float-right " title="Edit" style="margin: 10px 5px;"><span class="fa fa-pencil"></span></a>
        </div>
        <div class="jumbotron" style="margin:0 10px">
            <h3 class="display-5"><?php echo $resnote['noteTitle']; ?></h3>
            <hr class="my-4">
            <p><?php echo $resnote['noteDes']; ?></p>
        </div>
            <?php
        }
        ?>
        <!-- end notice-->

        <!-- our course -->
        <div class="container">
            <div class="row" style="margin:0 10px">
                <!-- course -->
                <?php
                $result=mysqli_query($con,"SELECT DISTINCT * 
                                                      FROM dashboard_card
                                                      order by cardID asc ");

                if($result === FALSE) {
                    die(mysqli_error());
                }
                while($res=mysqli_fetch_array($result))
                {
                ?>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <a href="home.php?deleted=1&id=<?php echo $res['id']; ?>" class="float-right " title="Delete" onclick="return confirm('Are you sure want to Delete notice?');" style="margin: 10px 5px;"><span class="fa fa-trash" style="color: red;"></span></a>
                            <a href="add_edit_notice.php?edited=1&id=<?php echo $res['id']; ?>" class="float-right " title="Edit" style="margin: 10px 5px;"><span class="fa fa-pencil"></span></a>

                            <p><img class="img-fluid" src="../user/image/1.jpg" alt="card image"></p>
                            <h4 class="card-title"><?php echo $res['cardTitle']; ?></h4>
                            <p class="card-text"><?php echo $res['cardDes']; ?></p>
                            <a href="#" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                        </div>
                    </div>
                </div>
                    <?php
                }
                ?>
                <!-- ./course -->
            </div>
        </div>
        <!-- our course -->

        </div>

        <!-- About start.// -->
    <?php
    include ('footer.php');
    ?>

    <footer style="margin:0 10px">
        <p>ABC @ 2019 All Rights Reserved. </p>
    </footer>
    </div>
</body>
</html>
