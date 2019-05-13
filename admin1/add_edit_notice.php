<?php
include("config.php");
session_start();
$nid="0";
$title="";
$sub="";
$desc="";

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $sub = $_POST['sub'];
    $desc = $_POST['desc'];

    if($_POST['txtid']=="0") {
        // checking empty fields
        if ($title != "" && $sub != "" && $desc != "") {
            $insersql = "INSERT INTO notice(Title,Sub_title,Description,Date,Status)VALUES('$title','$sub','$desc',NOW(),'Active')";
            if ($con->query($insersql)) {
                header("location:home.php");
            } else {
                $notice_suc = "<i style='color:red;'> Created faild </i>";
            }
        }
    }
    else{
        $nid = $_POST['txtid'];
        $sql="UPDATE notice SET Title='$title', Sub_title='$sub', Description='$desc' WHERE id='$nid'";
        $query=mysqli_query($con,$sql);
        if($query)
        {
            header("location:home.php");
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
    $nid=$row->id;
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
            <!-- Notice bar start.//-->
            <div class="col-sm-8 overflow-auto" style="max-height:800px">
                <div class="row">
                    <div class="col-sm-8">
                        <?php
                        if($nid=="0") {
                            echo '<h6> <span class="fa fa-edit"></span> Create Notice</h6>';
                        }
                        else{
                            echo '<h6> <span class="fa fa-pencil-square-o"></span> Edit Notice</h6>';
                        }
                        ?>
                    </div>
                </div>

                <div class="">

                            <article class="card-body">
                                <form id="noticeForm" action="" method="post" style="font-weight: bold">
                                    <div class="form-group">
                                        <div class="text-center" style="color:green; "><?php if(isset($notice_suc)){ echo $notice_suc; }?></div>
                                        <div><?php if(isset($faild_err)){echo $faild_err;} ?></div>
                                        <label>Title</label>
                                        <div><?php if(isset($title_err)) {echo $title_err;} ?></div>
                                        <input type="text" name="title" class="form-control" placeholder="Enter the title here..."  value="<?php if(isset($title)){ echo $title; } ?>" required>
                                        <input type="hidden" name="txtid" value="<?php echo $nid; ?>" />
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label>Sub Title</label>
                                        <input type="text" name="sub" class="form-control" placeholder="Enter the sub title here..." value="<?php if(isset($sub)){ echo $sub; } ?>" required>
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="desc" class="form-control" placeholder="Enter text here..." required ><?php if(!isset($notice_suc)){ echo $desc; } ?></textarea>
                                    </div> <!-- form-group end.// -->

                                    <div class="form-group">
                                        <?php
                                        if($nid=="0") {
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
