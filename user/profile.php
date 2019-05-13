<?php
include("config.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
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
                        <h5> <span class="fa fa-user"></span> Profile</h5>
                    </div>

                </div>
                <!-- Profile start.//-->
                <div class="overflow" style="margin: 10px">
                    <div class="row justify-content">
                        <div class="card">

                            <article class="card-body">

                                <form method="post">
                                    <div class="form-group text-center" >
                                        <div><?php if(isset($faild_err)) echo $faild_err; ?></div>
                                        <img src="image/user.png" onclick="triggerClick()" alt="profile" id="profileDisplay" style="display:block;width:150px; height:150px; margin:10px auto;border-radius:50%;">
                                        <input type='file' name='profileImage' onchange="displayImage(this)" id="profileImage" style="display: none;"/>
                                        <label style="font-weight: bold;">Choose profile</label>
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>First name </label>
                                            <input type="text" name="Fname" class="form-control" readonly value="<?php  echo $fname; ?>" >
                                        </div> <!-- form-group end.// -->
                                        <div class="col form-group">
                                            <label>Last name</label>
                                            <input type="text" name="Lname" class="form-control" readonly value="<?php  echo $lname; ?>">
                                        </div> <!-- form-group end.// -->
                                    </div> <!-- form-row end.// -->
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <div><?php if(isset($email_err)) echo $email_err; ?></div>
                                        <input type="email" name="Email" class="form-control" readonly value="<?php  echo $email; ?>">
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label>Reg Number</label>
                                        <div><?php if(isset($regNum_err)) echo $regNum_err; ?></div>
                                        <input type="text" name="RegNum" class="form-control" readonly value="<?php  echo $regNumber; ?>">
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <div><?php if(isset($phone_err)) echo $phone_err; ?></div>
                                        <input type="text" name="Phone" class="form-control" required value="<?php  echo $phone; ?>">
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender"  <?php if($gender=="Male"){?> checked="true" <?php } ?> value="Male">
                                            <span class="form-check-label"> Male </span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" <?php if($gender=="Female"){?> checked="true" <?php } ?> value="Female">
                                            <span class="form-check-label"> Female</span>
                                        </label>
                                    </div> <!-- form-group end.// -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Course</label>
                                            <select id="inputState" class="form-control" name="Course" readonly>
                                                <option> Choose...</option>
                                                <option value="IT" <?php if($course=="IT") echo 'selected="selected"'; ?> >IT</option>
                                                <option value="SE" <?php if($course=="SE") echo 'selected="selected"'; ?> >SE</option>
                                                <option value="IM" <?php if($course=="IM") echo 'selected="selected"'; ?> >IM</option>
                                            </select>
                                        </div> <!-- form-group end.// -->
                                        <div class="form-group col-md-6">
                                            <label>Year</label>
                                            <select id="inputState" class="form-control" name="Year" readonly>
                                                <option> Choose...</option>
                                                <option value="1" <?php if($year=="1") echo 'selected="selected"'; ?> >1</option>
                                                <option value="2" <?php if($year=="2") echo 'selected="selected"'; ?> >2</option>
                                                <option value="3" <?php if($year=="3") echo 'selected="selected"'; ?> >3 </option>
                                                <option value="4" <?php if($year=="4") echo 'selected="selected"'; ?> >4</option>
                                            </select>
                                        </div> <!-- form-group end.// -->
                                    </div> <!-- form-row.// -->
                                    <div class="form-group">
                                        <button type="submit" name="updateProfile" class="btn btn-primary btn-block"> Update  </button>
                                    </div> <!-- form-group// -->
                                </form>
                            </article> <!-- card-body end .// -->
                        </div> <!-- card.// -->

                    </div> <!-- row.//-->
                    <?php
                    if(isset($_POST["updateProfile"])) {
                        $phone = $_POST["Phone"];
                        // checking empty fields
                        if ($phone != ""  ) {
                            $sql="SELECT PhoneNumber FROM users WHERE PhoneNumber='$phone'";
                            $result=$con->query($sql);
                            if($result->num_rows>0)
                            {
                                $sucess_mes = "<i style='color:red;'> Phone Number already has a account </i>";
                                echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                            }
                            else {
                                $phone = preg_replace("/[^0-9]/", "", $phone);
                                if (strlen($phone) == 10) {
                                    $sql = "UPDATE users SET PhoneNumber='$phone' WHERE uid='$id'";
                                    $query = mysqli_query($con, $sql);
                                    if ($query) {
                                        $sucess_mes = "Phone number Changed ";
                                        echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                                    } else {
                                        $sucess_mes = "Phone number Updated Faild";
                                        echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                                    }
                                } else {
                                    $sucess_mes = "Invalid phone number ";
                                    echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                                }
                            }

                        }

                    }
                    ?>
                    <!-- Change pass start-->

                    <div class="row justify-content" style="margin-top: 10px">
                        <div class="card">
                            <header class="card-header">
                                <h4 class="card-title mt-2">Change Password</h4>
                            </header>
                            <article class="card-body">
                                <form  method="post">
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" name="opass" required >
                                    </div> <!-- form-group end.// -->

                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input class="form-control" type="password" name="npass" required>
                                    </div> <!-- form-group end.// -->
                                    <div class="text-center"><i style="color:green; "><?php if(isset($sucess_mes)) echo $sucess_mes; ?></i></div>

                                    <div class="form-group">
                                        <button type="submit" name="changePassword"  class="btn btn-primary btn-block">Change Password</button>
                                    </div> <!-- form-group// -->

                                </form>
                            </article> <!-- card-body end .// -->

                        </div> <!-- card.// -->
                    </div> <!-- col.//-->

                    <?php
                    include("config.php");

                    if(isset($_POST["changePassword"])) {
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

                    <!-- Change pass start-->

                </div>
                <!-- Profile End.//-->
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
