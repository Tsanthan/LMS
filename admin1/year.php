<?php
session_start();
include('config.php');
if (isset($_GET['faculty'])){
    $clickFaculty =$_GET['facultyName'];
}

$_SESSION["fa"]=$clickFaculty;

if($clickFaculty==null){
    header("location:home.php");
}
if(isset($_POST["submit1"])){
        $txtyear=$_POST["txtyear"];
        $_SESSION["yea"]=$txtyear;
        echo $txtyear;
        if($txtyear!="") {
            header("location:course.php");
        }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Year</title>
</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%">
    <?php
    include ('header.php');
    $year1=1;
    $year2=2;
    $year3=3;
    $year4=4;

    ?>

    <div class="container" style="margin-top:0px">
        <div class="row">
            <!-- Notice bar start.//-->
            <div class="col-sm-8" >
                <div class="row">
                    <div class="col-sm-8">
                        <h6> <span class="fa fa-graduation-cap"></span> Faculty of <?php echo $clickFaculty ?></h6>
                    </div>

                </div>

                <div class="overflow-auto" style="max-height:800px; margin-top: 40px">
                    <form action="" method="POST">
                        <input type="hidden" id="txtyear" name="txtyear">
                        <button type="submit" value="1" name="submit1" class="btn btn-secondary btn-block text-left p-3 mb-2" > Year 1</button>
                        <button type="submit" value="2" name="submit1" class="btn btn-secondary btn-block text-left p-3 mb-2"> Year 2</button>
                        <button type="submit" value="3" name="submit1" class="btn btn-secondary btn-block text-left p-3 mb-2"> Year 3</button>
                        <button type="submit" value="4" name="submit1" class="btn btn-secondary btn-block text-left p-3 mb-2"> Year 4</button>
                    </form>
                    <script type="text/javascript">
                        $("button[type='submit']").hover(function(){
                            var v = this.value;
                            var textcontrol = document.getElementById("txtyear");
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
