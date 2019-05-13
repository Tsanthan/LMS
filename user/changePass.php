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
                        <h5> <span class="fa fa-edit"></span> Change Password</h5>

                    </div>
                </div>

                <div class="">

                    <!-- Change pass start-->

                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <article class="card-body">
                                    <form  method="post">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" class="form-control" name="opass" required>
                                        </div> <!-- form-group end.// -->

                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input class="form-control" type="password" name="npass" required>
                                        </div> <!-- form-group end.// -->
                                        <div class="text-center"><i style="color:green; "><?php if(isset($sucess_mes)) echo $sucess_mes; ?></i></div>

                                        <div class="form-group">
                                            <button type="submit" name="submit2"  class="btn btn-primary btn-block">Change Password</button>
                                        </div> <!-- form-group// -->

                                    </form>
                                </article> <!-- card-body end .// -->

                            </div> <!-- card.// -->
                        </div> <!-- col.//-->

                    </div> <!-- row.//-->
                    <?php
                    if(isset($_POST["submit2"])) {
                        $oldPass = $_POST["opass"];
                        $newPass = $_POST["npass"];
                        $data_pwd = $row['Password'];
                        // checking empty fields
                        if ($oldPass != "" && $newPass != "" ) {
                            if ($data_pwd == $oldPass) {
                                if(preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_.@#$&]).{6,15}$/", $newPass)) {
                                    $sql = "UPDATE users SET Password='$newPass' WHERE uid='$id'";
                                    $query = mysqli_query($con, $sql);
                                    if ($query) {
                                        $sucess_mes = "Password Changed ";
                                        echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                                    } else {
                                        $sucess_mes = "Password Updated Faild";
                                        echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                                    }
                                }
                                else {
                                    $sucess_mes = "Weak password! ";
                                    echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                                }
                            }
                            else {
                                $sucess_mes = "invalid old password ";
                                echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                            }
                        }

                    }
                    ?>
                    <!-- Change pass end-->
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
