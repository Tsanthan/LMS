<?php
include('config.php');
session_start();
//delete notice ...............
if (isset($_GET['deleteUser']))
{
    $sql="UPDATE users SET Status='Delete' WHERE uid='{$_GET['uid']}'";
    $query=mysqli_query($con,$sql);
    if($query)
    {
        header("location:users.php");

    }
}


if(isset($_POST["submit"]))
{
    $fname=$_POST["aFname"];
    $lname=$_POST["aLname"];
    $email=$_POST["aEmail"];
    $regNum=$_POST["aRegNum"];
    $phone=$_POST["aPhone"];
    $gender=$_POST["aGender"];
    $course=$_POST["aCourse"];
    $year=$_POST["aYear"];
    $password=$_POST["aPassword"];
    $password2=$_POST["aPassword2"];

    if($fname!="" && $lname!="" && $email!="" && $regNum!="" && $phone!="" && $course!="" && $year!="" && $password!="" && $gender!="" )
    {
        $sql="SELECT Email FROM users WHERE Email='$email'";
        $result=$con->query($sql);
        if($result->num_rows>0)
        {
            $email_err = "<i style='color:red;'> Email already registered </i>";
        }
        $sql="SELECT RegNumber FROM users WHERE RegNumber='$regNum'";
        $result=$con->query($sql);
        if($result->num_rows>0)
        {
            $regNum_err = "<i style='color:red;'> Registration Number already has a account </i>";
        }
        $sql="SELECT PhoneNumber FROM users WHERE PhoneNumber='$phone'";
        $result=$con->query($sql);
        if($result->num_rows>0)
        {
            $phone_err = "<i style='color:red;'> Phone Number already has a account </i>";
        }
        else {
            $phone = preg_replace("/[^0-9]/", "", $phone);
            if(strlen($phone)==10)
            {
                if(preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_.@#$&]).{6,15}$/", $password))
                {
                    if($password == $password2)
                    {
                        //$profileImageName = time() . '_' . $_FILES['profileImage']['name'];
                        //$target = 'image/' .$profileImageName;

                        $image=addslashes(file_get_contents($FILES["profileImage"]["tmp_name"]));

                        $insersql="INSERT INTO users(RegNumber,FirstName,LastName,Email,PhoneNumber,Gender,Course,Year,Image,Password,Status)
						VALUES('$regNum','$fname','$lname','$email','$phone','$gender','$course','$year','$image','$password','Active')";
                        if($con->query($insersql))
                        {
                            header("location:users.php?mes=<p> Registration Sucessfully. </p>");
                        }
                        else {
                            $faild_err = "<i style='color:red;'> registration faild </i>";
                        }
                    }
                    else {
                        $cpass_err = "<i style='color:red;'> Conform Password not match </i>";
                    }

                }
                else {
                    $pass_err = "<i style='color:red;'> Weak password!</i>";
                }
            }
            else {
                $phone_err = "<i style='color:red;'> Invalid phone number </i>";
            }
        }
    }
    else
    {
        $blank_err = "<i style='color:red;'> Fill all data </i>";
    }
}
else
{

}

//update
if(isset($_POST["update"]))
{
    $uid=$_POST["UID"];
    $fname=$_POST["Fname"];
    $lname=$_POST["Lname"];
    $email=$_POST["Email"];
    $regNum=$_POST["RegNum"];
    $phone=$_POST["Phone"];
    $gender=$_POST["gender"];
    $course=$_POST["Course"];
    $year=$_POST["Year"];
    // $password=$_POST["Password"];

    if($fname!="" && $lname!="" && $email!="" && $regNum!="" && $phone!="" && $course!="" && $year!="" && $gender!="" )
    {
        $sql="SELECT Email FROM users WHERE Email='$email'";
        $result=$con->query($sql);
        if($result->num_rows>0)
        {
            $email_err = "<i style='color:red;'> Email already registered </i>";
        }
        $sql="SELECT RegNumber FROM users WHERE RegNumber='$regNum'";
        $result=$con->query($sql);
        if($result->num_rows>0)
        {
            $regNum_err = "<i style='color:red;'> Registration Number already has a account </i>";
        }
        $sql="SELECT PhoneNumber FROM users WHERE PhoneNumber='$phone'";
        $result=$con->query($sql);
        if($result->num_rows>0)
        {
            $phone_err = "<i style='color:red;'> Phone Number already has a account </i>";
        }
        else {
            $phone = preg_replace("/[^0-9]/", "", $phone);
            if(strlen($phone)==10)
            {


                //$profileImageName = time() . '_' . $_FILES['profileImage']['name'];
                //$target = 'image/' .$profileImageName;

                $image=addslashes(file_get_contents($FILES["profileImage"]["tmp_name"]));

                $insersql="UPDATE users SET RegNumber='$regNum',FirstName='$fname',LastName='$lname',Email='$email',PhoneNumber='$phone',Gender='$gender',Cours='$course',Year='$year',Image='$image' WHERE uid='$uid'";
                if($con->query($insersql))
                {
                    header("location:users.php?mes=<p> Registration Sucessfully. Please login here </p>");
                }
                else {
                    $faild_err = "<i style='color:red;'> registration faild </i>";
                }



            }
            else {
                $phone_err = "<i style='color:red;'> Invalid phone number </i>";
            }
        }
    }
    else
    {

    }
}
else
{

}
?>
<?php
$sucess_mes="";
if(isset($_GET["mes"]))
{
    $sucess_mes = $_GET["mes"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>

    <script>
        function triggerClick() {
            document.querySelector('#profileImage').click();
        }
        function displayImage(e) {
            if (e.files[0]){
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.querySelector('#profileDisplay').setAttribute('src',e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
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
                <div class="text-center"><i style="color:green; "><?php if(isset($sucess_mes)) echo $sucess_mes; ?></i></div>
                <div class="row">
                    <div class="col-sm-6">
                        <h6> <span class="fa fa-user"></span> Admins Details</h6>
                    </div>
                    <div class="col-sm-6">
                        <a href=""  data-toggle="modal" data-target="#exampleModal" >
                            <button type="button" class="btn btn-success float-right">
                                <span class="fa fa-plus"></span>
                                Add
                            </button> </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 overflow-auto">
                        <table class="table table-striped " style="font-size: 14px; margin-top: 10px;">
                            <thead>
                            <tr>
                                <th  style="width: 5px;">No</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Gender</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Setting</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php


                            $result=mysqli_query($con,"SELECT * FROM admin WHERE Status='Active' ");

                            if($result === FALSE) {
                                die(mysqli_error());
                            }
                            $num =1;
                            while($res=mysqli_fetch_array($result))
                            {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $num; ?></th>
                                <td>
                                    <img src="../user/a.jpg" class="img-fluid " alt="Sheep" style="width:30px; height:30px; ">
                                </td>
                                <td style="max-width: 120px;"><?php echo $res['FirstName']; ?> <br> <?php echo $res['LastName']; ?> </td>
                                <td><?php echo $res['Email']; ?></td>
                                <td><?php echo $res['Gender']; ?></td>
                                <td><?php echo $res['username']; ?></td>
                                <td>
                                    <a href="#viewUser<?php echo $res['uid']; ?>" class="float-left " title="View" style="margin: 10px 5px;" data-toggle="modal"><span class="fa fa-eye" style="color: green"></span></a>
                                    <a href="#editUser<?php echo $res['uid']; ?>" class="float-left " title="Edit" style="margin: 10px 5px;" data-toggle="modal"><span class="fa fa-pencil"></span></a>
                                    <a href="#deleteUser<?php echo $res['uid']; ?>" class="float-left " title="Delete" style="margin: 10px 5px;" data-toggle="modal"><span class="fa fa-trash" style="color: red;"></span></a>
                                </td>
                            <tr>


                                <!-- Delete Modal -->
                                <div id="deleteUser<?php echo $res['uid']; ?>" class="modal fade" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteUserLabel">Delete Conformation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <span style="font-weight: bold"> <?php echo $res['FirstName']; ?> </span> <span style="font-weight: bold"> <?php echo $res['LastName']; ?> </span>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                                                <a href="users.php?deleteUser=1&uid=<?php echo $res['uid']; ?>" class="float-right "><button type="button" class="btn btn-primary">Yes</button></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Delete Modal -->

                                <!--view profile Modal -->
                                <div id="viewUser<?php echo $res['uid']; ?>" class="modal fade" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" >
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewUserLabel">Student Profile</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <article class="card-body">
                                                    <form method="post">
                                                        <div class="form-group text-center" >
                                                            <img src="image/user.png" onclick="triggerClick()" alt="profile" id="profileDisplay" style="display:block;width:150px; height:150px; margin:10px auto;border-radius:50%;">
                                                            <input type='file' name='profileImage' onchange="displayImage(this)" id="profileImage" style="display: none;"/>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col form-group">
                                                                <label style="font-weight: bold">First Name </label>
                                                            </div> <!-- form-group end.// -->
                                                            <div class="col form-group">
                                                                <label><?php echo $res['FirstName']; ?></label>
                                                            </div> <!-- form-group end.// -->
                                                        </div> <!-- form-row end.// -->
                                                        <div class="form-row">
                                                            <div class="col form-group">
                                                                <label style="font-weight: bold">Last Name </label>
                                                            </div> <!-- form-group end.// -->
                                                            <div class="col form-group">
                                                                <label><?php echo $res['LastName']; ?></label>
                                                            </div> <!-- form-group end.// -->
                                                        </div> <!-- form-row end.// -->
                                                        <div class="form-row">
                                                            <div class="col form-group">
                                                                <label style="font-weight: bold">Email</label>
                                                            </div> <!-- form-group end.// -->
                                                            <div class="col form-group">
                                                                <label><?php echo $res['Email']; ?></label>
                                                            </div> <!-- form-group end.// -->
                                                        </div> <!-- form-row end.// -->
                                                        <div class="form-row">
                                                            <div class="col form-group">
                                                                <label style="font-weight: bold">Reg Number</label>
                                                            </div> <!-- form-group end.// -->
                                                            <div class="col form-group">
                                                                <label><?php echo $res['RegNumber']; ?></label>
                                                            </div> <!-- form-group end.// -->
                                                        </div> <!-- form-row end.// -->
                                                        <div class="form-row">
                                                            <div class="col form-group">
                                                                <label style="font-weight: bold">Phone Number</label>
                                                            </div> <!-- form-group end.// -->
                                                            <div class="col form-group">
                                                                <label><?php echo $res['PhoneNumber']; ?></label>
                                                            </div> <!-- form-group end.// -->
                                                        </div> <!-- form-row end.// -->
                                                        <div class="form-row">
                                                            <div class="col form-group">
                                                                <label style="font-weight: bold">Gender</label>
                                                            </div> <!-- form-group end.// -->
                                                            <div class="col form-group">
                                                                <label><?php echo $res['Gender']; ?></label>
                                                            </div> <!-- form-group end.// -->
                                                        </div> <!-- form-row end.// -->
                                                        <div class="form-row">
                                                            <div class="col form-group">
                                                                <label style="font-weight: bold">Course</label>
                                                            </div> <!-- form-group end.// -->
                                                            <div class="col form-group">
                                                                <label><?php echo $res['Course']; ?></label>
                                                            </div> <!-- form-group end.// -->
                                                        </div> <!-- form-row end.// -->
                                                        <div class="form-row">
                                                            <div class="col form-group">
                                                                <label style="font-weight: bold">Year</label>
                                                            </div> <!-- form-group end.// -->
                                                            <div class="col form-group">
                                                                <label><?php echo $res['Year']; ?></label>
                                                            </div> <!-- form-group end.// -->
                                                        </div> <!-- form-row end.// -->

                                                    </form>
                                                </article> <!-- card-body end .// -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end view model .// -->

                                <!-- edit profile Modal -->
                                <div id="editUser<?php echo $res['uid']; ?>" class="modal fade" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" >
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewUserLabel">Update Profile</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <article class="card-body">
                                                    <form method="post">
                                                        <div class="form-group text-center" >
                                                            <img src="image/user.png" onclick="triggerClick()" alt="profile" id="profileDisplay" style="display:block;width:150px; height:150px; margin:10px auto;border-radius:50%;">
                                                            <input type='file' name='profileImage' onchange="displayImage(this)" id="profileImage" style="display: none;"/>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col form-group">
                                                                <label>First Name </label>
                                                                <input type="text" name="Fname" class="form-control" required value="<?php echo $res['FirstName']; ?>">
                                                                <input type="hidden" name="UID" class="form-control" required value="<?php echo $res['uid']; ?>">
                                                            </div> <!-- form-group end.// -->
                                                            <div class="col form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" name="Lname" class="form-control" required value="<?php echo $res['LastName']; ?>">
                                                            </div> <!-- form-group end.// -->
                                                        </div> <!-- form-row end.// -->
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="text" name="Email" class="form-control" required value="<?php echo $res['Email']; ?>">
                                                        </div> <!-- form-group end.// -->
                                                        <div class="form-group">
                                                            <label>Reg Number</label>
                                                            <input type="text" name="RegNum" class="form-control" required value="<?php echo $res['RegNumber']; ?>">
                                                        </div> <!-- form-group end.// -->
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input type="text" name="Phone" class="form-control" required value="<?php echo $res['PhoneNumber']; ?>">
                                                        </div> <!-- form-group end.// -->
                                                        <div class="form-group">
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="gender" <?php if($res['Gender']=="Male"){?> checked="true" <?php } ?> value="Male">
                                                                <span class="form-check-label"> Male </span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="gender" <?php if($res['Gender']=="Female"){?> checked="true" <?php } ?> value="Female">
                                                                <span class="form-check-label"> Female</span>
                                                            </label>
                                                        </div> <!-- form-group end.// -->
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Facultie</label>
                                                                <select id="inputState" class="form-control" name="Course">
                                                                    <option> Choose...</option>
                                                                    <option value="IT" <?php if($res['Course']=="IT") echo 'selected="selected"'; ?> >IT</option>
                                                                    <option value="SE" <?php if($res['Course']=="SE") echo 'selected="selected"'; ?> >SE</option>
                                                                    <option value="IM" <?php if($res['Course']=="IM") echo 'selected="selected"'; ?> >IM</option>
                                                                </select>
                                                            </div> <!-- form-group end.// -->
                                                            <div class="form-group col-md-6">
                                                                <label>Year</label>
                                                                <select id="inputState" class="form-control" name="Year">
                                                                    <option> Choose...</option>
                                                                    <option value="1" <?php if($res['Year']=="1") echo 'selected="selected"'; ?> >1</option>
                                                                    <option value="2" <?php if($res['Year']=="2") echo 'selected="selected"'; ?> >2</option>
                                                                    <option value="3" <?php if($res['Year']=="3") echo 'selected="selected"'; ?> >3 </option>
                                                                    <option value="4" <?php if($res['Year']=="4") echo 'selected="selected"'; ?> >4</option>
                                                                </select>
                                                            </div> <!-- form-group end.// -->
                                                        </div> <!-- form-row.// -->

                                                </article> <!-- card-body end .// -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="update" class="btn btn-primary">Update</button></span>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end edit model .// -->

                                <?php
                                $num++;
                                }
                                mysqli_close($con);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- Notice bar end.//-->

            <!-- Add profile Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewUserLabel">Add New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <article class="card-body">
                                <form action="" method="post">
                                    <div><?php if(isset($blank_err)) echo $blank_err; ?></div>
                                    <div class="form-group text-center" >
                                        <div><?php if(isset($faild_err)) echo $faild_err; ?></div>
                                        <img src="../user/image/user.png" onclick="triggerClick()" alt="profile" id="profileDisplay" style="display:block;width:150px; height:150px; margin:10px auto;border-radius:50%;">
                                        <input type='file' name='profileImage' onchange="displayImage(this)" id="profileImage" style="display: none;"/>
                                        <label><b>Choose profile</b></label>
                                    </div>


                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>First name </label>
                                            <input type="text" name="aFname" class="form-control" placeholder="" required>
                                        </div> <!-- form-group end.// -->
                                        <div class="col form-group">
                                            <label>Last name</label>
                                            <input type="text" name="aLname" class="form-control" placeholder="" required>
                                        </div> <!-- form-group end.// -->
                                    </div> <!-- form-row end.// -->
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <div><?php if(isset($email_err)) echo $email_err; ?></div>
                                        <input type="email" name="aEmail" class="form-control" placeholder="" required>
                                        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label>Reg Number</label>
                                        <div><?php if(isset($regNum_err)) echo $regNum_err; ?></div>
                                        <input type="text" name="aRegNum" class="form-control" placeholder="" required>
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <div><?php if(isset($phone_err)) echo $phone_err; ?></div>
                                        <input type="text" name="aPhone" class="form-control" placeholder="" required>
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="aGender" value="Male">
                                            <span class="form-check-label"> Male </span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="aGender" value="Female">
                                            <span class="form-check-label"> Female</span>
                                        </label>
                                    </div> <!-- form-group end.// -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Course</label>
                                            <select id="Course" class="form-control" name="aCourse">
                                                <option> Choose...</option>
                                                <option>IT</option>
                                                <option>SE</option>
                                                <option>IM</option>
                                            </select>
                                        </div> <!-- form-group end.// -->
                                        <div class="form-group col-md-6">
                                            <label>Year</label>
                                            <select id="year" class="form-control" name="aYear">
                                                <option> Choose...</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option selected="">3 </option>
                                                <option>4</option>
                                            </select>
                                        </div> <!-- form-group end.// -->
                                    </div> <!-- form-row.// -->
                                    <div class="form-group">
                                        <label>Create password</label>
                                        <div><?php if(isset($pass_err)) echo $pass_err; ?></div>
                                        <input class="form-control" type="password" name="aPassword" required >
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <label>Confirm password</label>
                                        <div><?php if(isset($cpass_err)) echo $cpass_err; ?></div>
                                        <input class="form-control" type="password" name="aPassword2"  required>
                                    </div> <!-- form-group end.// -->
                                    <div class="form-group">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block"> Register  </button>
                                    </div> <!-- form-group// -->
                                    <small class="text-muted">By clicking the 'Register' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
                                </form>
                            </article> <!-- card-body end .// -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- add profile model end.// -->

            <div class="modal" id="userAddSuccess" tabindex="-1" role="dialog" aria-labelledby="userAddSuccessLable" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Success Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>User Add Successfully...</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>

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
