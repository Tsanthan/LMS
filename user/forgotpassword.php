<?php


    use PHPMailer\PHPMailer\PHPMailer;

    if(isset($_POST['email'])){
        include("config.php");
        $email = $con->real_escape_string($_POST['email']);

        $sql = $con->query("SELECT uid FROM users WHERE Email = '$email'");
        if($sql ->num_rows >0){
            $token = "poiuytrewqmnbvczasdf1234567890";
            $token = str_shuffle($token);
            $token = substr($token, 0, 10);

            $con->query("UPDATE users SET token='$token', tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE Email='$email'");

            require_once "PHPMailer/src/PHPMailer.php";
            require_once "PHPMailer/src/Exception.php";

            $mail = new PHPMailer();
            $mail->addAddress($email);
            $mail->setFrom("from@example.com", "CPI");
            $mail->isHTML(true);
            $mail->Subject ="Reset Password";
            $mail->Body ="
                        Hi, <br><br>
                        
                        In order to reset your password, please click on the link below: <br>
                        <a href='
                        http://localhost:8080/ITPM_SonarqubeSampleProject/user/login.php?email=$email&token=$token
                        '>http://localhost:8080/ITPM_SonarqubeSampleProject/user/login.php?email=$email&token=$token </a> <br><br>
                        
                        Kind Regards,<br>
                        Administrator
                        ";

            if($mail->send())
                $forgot_err = "<i style='color:green;'> Please Check Your Email Inbox</i>";
            else
                $forgot_err = "<i style='color:red;'> Something Wrong Just Happened! Please try again! </i>";
        }
        else
            $forgot_err = "<i style='color:red;'> Invalid Email </i>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

</head>

<body id="backimage">
<div class="container border-top"  style="background-color:#FBFCFC; margin-top:1%; margin-bottom:2%">
    <div class=" text-left" style="background-color:#FBFCFC;margin:0 10px">
        <div class="row">
            <div class="col-md-auto">
                <img src="logo.png" alt="logo" style="width:100px;">
            </div>
            <div class="col col-lg-6">
                <h1>ABC INSTITUTE</h1>
                <p>Learning Management</p>
            </div>
        </div>
    </div>
    <hr>

    <div class="container" style="margin-top:30px">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <header class="card-header">
                        <a href="login.php" class="float-right btn btn-outline-primary mt-1">Log in</a>
                        <h4 class="card-title mt-2">Forgot Password</h4>
                    </header>
                    <article class="card-body">
                        <form  method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" required>
                            </div> <!-- form-group end.// -->

                            <div class="text-center"><i style="color:green; "><?php if(isset($forgot_err)) echo $forgot_err; ?></i></div>
                            <div class="form-group">
                                <button type="submit" name="submit" value="login" class="btn btn-primary btn-block"> Reset Password  </button>
                            </div> <!-- form-group// -->

                        </form>
                    </article> <!-- card-body end .// -->
                </div> <!-- card.// -->
            </div> <!-- col.//-->

        </div> <!-- row.//-->
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