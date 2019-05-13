<?php
include('config.php');

if(!isset($_SESSION["uname"]))
{
    header("location:..\user\login.php?mes=<p> Please login here </p>");
}

$uname = $_SESSION['uname'];
$result = mysqli_query($con,"SELECT * FROM admin WHERE username='$uname'");
$row = mysqli_fetch_assoc($result);

$id= $row['aid'];
$username= $row['username'];
$fname=$row['FirstName'];
$lname=$row['LastName'];
$email=$row['Email'];
$gender=$row['Gender'];
$uName=$row['username'];




?>
<!DOCTYPE html>
<html>
<head>
    <title> </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../user/css/bootstrap.css">
    <link rel="stylesheet" href="../user/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .notification {
            color: black;
            text-decoration: none;
            position: relative;
            display: inline-block;
            border-radius: 2px;
        }
        .notification .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 50%;
            background-color: darkorange;
            color: white;
        }
    </style>
    <script>
        function triggerClick() {
            document.querySelector('#cardImage').click();
        }
        function displayImage(e) {
            if (e.files[0]){
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.querySelector('#cardDisplay').setAttribute('src',e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
</head>
    <body>
    <div class=" text-left" style="background-color:#FBFCFC;margin:0 10px">
    <div class="row">
        <div class="col-md-auto">
            <img src="../user/logo.png" alt="logo" style="width:100px;">
        </div>
        <div class="col col-lg-6">
            <h1 style="font-family:cursive, sans-serif">ABC INSTITUTE</h1>
            <p>Learning Management</p>
        </div>
        <div class="col text-right">
            
            <div class="dropdown">
                <button class="dropbtn"><span style="font-weight: bold"><?php echo $username ?></span></button>
                <div class="dropdown-content text-left">
                    <a href="profile.php">Profile</a>
                    <a href="../user/logout.php">Logout</a>
                </div>
            </div>

            <img src="a.jpg" alt="profile" style="width:60px;">
        </div>
    </div>
    </div>

    <!-- Notification Panel -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Notifications</h4>
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
    <!-- End Notification Panel -->

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark border-bottom" style="margin:0 10px; border-width:3px !important; border-color: #FF8C00 !important;">
    <a class="navbar-brand" href="#">ABC</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="">Dashboard</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                    <a class="dropdown-item" href="#">Add Image</a>
                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal2">Add Des</a>
                    <a class="dropdown-item" href=""  data-toggle="modal" data-target="#exampleModal1" >Add Image Card</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="home.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Faculties</a>
                <div class="dropdown-menu">
                    <?php
                    $result=mysqli_query($con,"SELECT * FROM faculty  order by facultyID asc");

                    if($result === FALSE) {
                        die(mysqli_error());
                    }
                    while($res=mysqli_fetch_array($result))
                    {
                        ?>
                        <a class="dropdown-item" href="year.php?faculty=1&facultyName=<?php echo $res['facultyName']; ?>"><?php echo $res['facultyName']; ?> </a>
                        <?php
                    }
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#section1">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">More</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="users.php">Student</a>
                    <a class="dropdown-item" href="admin.php">Admin</a>
                    <a class="dropdown-item" href="#">Staff</a>
                </div>
            </li>
        </ul>
    </div>
    <form class="form-inline " id="collapsibleNavbar" action="/action_page.php">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-success" type="submit"><span class="fa fa-search"></span> </button>

    </form>
</nav>


    <!-- Add desc card Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserLabel">Add New Image Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <article class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="" required>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="desc" class="form-control" placeholder="Enter text here..." required ></textarea>
                            </div> <!-- form-group end.// -->

                            <div class="form-group">
                                <button type="submit" name="btnCardDesc" class="btn btn-primary btn-block"> Add  </button>
                            </div> <!-- form-group// -->
                            <?php
                            if(isset($_POST["btnCardDesc"])) {
                                $title = $_POST["title"];
                                $desc = $_POST["desc"];

                                if($title !="" && $desc !="" )
                                {
                                    $insertCard = "INSERT INTO dashboard_note(noteTitle,noteDes) VALUES('$title','$desc')";
                                    if ($con->query($insertCard)) {
                                        $sucess_mes = "Note Added Successfully";
                                        echo "<script type='text/javascript'>alert('$sucess_mes');</script>";

                                    } else {
                                        $sucess_mes = "Failed to Add note.";
                                        echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                                    }

                                }
                                else{
                                    $sucess_mes = "Please enter data";
                                    echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                                }
                            }
                            ?>
                        </form>

                    </article> <!-- card-body end .// -->
                </div>
            </div>
        </div>
    </div>
    <!-- add des card end.// -->

    <!-- Add image card Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserLabel">Add New Image Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <article class="card-body">
                        <form action="" method="post">
                            <div class="form-group text-center" >
                                <input type="file" name="image"  >
                                <label><b>Choose Image</b></label>
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="" required>
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="desc" class="form-control" placeholder="Enter text here..." required ></textarea>
                            </div> <!-- form-group end.// -->

                            <div class="form-group">
                                <button type="submit" name="btnCardImage" class="btn btn-primary btn-block"> Add  </button>
                            </div> <!-- form-group// -->
                            <?php
                            if(isset($_POST["btnCardImage"])) {
                                $title = $_POST["title"];
                                $desc = $_POST["desc"];

                                $filename = $_FILES["image"]["name"];
                                $tempname = $_FILES["image"]["tmp_name"];
                                $folder = "cardImage/".$filename;
                                move_uploaded_file($tempname,$folder);


                                if($title !="" && $desc !="" )
                                {
                                    $insertCard = "INSERT INTO dashboard_card(cardTitle,cardDes,cardImage) VALUES('$title','$desc','$folder')";
                                    if ($con->query($insertCard)) {
                                        $sucess_mes = "subject Added Successfully";
                                        echo "<script type='text/javascript'>alert('$sucess_mes');</script>";

                                    } else {
                                        $sucess_mes = "Failed to upload file.";
                                        echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                                    }

                                }
                                else{
                                    $sucess_mes = "Please select Image";
                                    echo "<script type='text/javascript'>alert('$sucess_mes');</script>";
                                }
                            }
                            ?>
                        </form>

                    </article> <!-- card-body end .// -->
                </div>
            </div>
        </div>
    </div>
    <!-- add image card end.// -->
</body>
</html>
