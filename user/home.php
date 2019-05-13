<?php
include('config.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
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
                    <div class="col-sm-8">
                        <h6> <span class="fa fa-edit"></span> Notice</h6>
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
                                        <th><a href="notice.php?view=1&id=<?php echo $res['id']; ?>" style="margin-left: 10px; font-size:medium"> <h6><?php echo $res['Title']; ?></h6></a></th>

                                    </tr>
                                    <tr>
                                        <td><h6 class="card-title" style="margin-left:20px; font-size: small"><?php echo $res['Sub_title']; ?></h6></td>
                                    </tr>
                                    <tr>
                                        <td><p class="card-text" style="font-size:10px;margin-left:20px;"><?php echo $res['Date']; ?></p></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                    }
                    mysqli_close($con);
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
