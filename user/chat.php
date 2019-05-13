<?php
include('config.php');
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Message</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <style>
        .user_info{
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 15px;
        }
        .user_info span{
            font-size: 18px;
            color: black;
        }
        .user_info p{
            font-size: 10px;
            color: mediumblue;
            padding: unset;
            margin: unset;
        }
        .user_img{
            height: 60px;
            width: 60px;
            border:1.5px solid #f5f6fa;

        }
        .user_img_msg{
            height: 40px;
            width: 40px;
            border:1.5px solid #f5f6fa;

        }
        .img_cont{
            position: relative;
            height: 70px;
            width: 70px;
        }
        .img_cont_msg{
            height: 40px;
            width: 40px;
        }
        .msg_cotainer{
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 10px;
            border-radius: 10px;
            background-color: #82ccdd;
            padding: 5px;
            position: relative;

        }
        .msg_cotainer_send{
            margin-top: auto;
            margin-bottom: auto;
            margin-right: 10px;
            border-radius: 10px;
            background-color: #78e08f;
            padding: 5px;
            position: relative;
        }
        .msg_time{
            position: absolute;
            left: 0;
            bottom: -15px;
            color: darkblue;
            font-size: 10px;
            min-width: 100px;
        }
        .msg_time_send{
            position: absolute;
            right:0;
            bottom: -15px;
            color: darkblue;
            font-size: 10px;
            min-width: 100px;
        }
        .msg_head{
            position: relative;
        }
        .card-footer{
            border-radius: 0 0 15px 15px !important;
            border-top: 0 !important;

        }
        .type_msg{
            background-color: rgba(0,0,0,0.2) !important;
            border:0 !important;
            color:black !important;
            height: 50px !important;
            overflow-y: auto;
        }
        .type_msg:focus{
            box-shadow:none !important;
            outline:1px !important;
        }
        .send_btn{
            border-radius: 0  !important;
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color: white !important;
            cursor: pointer;
        }
        .online_icon{
            position: absolute;
            height: 22px;
            min-width:22px;
            background-color: darkorange;
            border-radius: 50%;
            bottom: 0.6em;
            right: 0.6em;
            border:1.5px solid white;
            color: white;
            text-align: center;
            font-size: 14px;
        }
        .offline{
            background-color: #c23616 !important;
        }

    </style>

    <script>
        function SubmitFormData() {
            var message = $("#message").val();
            var userID = $("#userID").val();
            $.post("messageSubmit.php", { message: message,userID: userID},
                function(data) {
                    $('#myForm')[0].reset();
                });

        }
</script>
    <script>
        $('input#msgf').on('click') function(){
            var name = $('input#name').val();
            if($.trim(name) != ''){
                $post('ajax/name.php'),{name:name}, function(data){
                    $('div#name-data').text(data);
                }
            }
        }
    </script>
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
                    <div class="col-lg-8">
                        <h6> <span class="fa fa-envelope"></span> Message</h6>
                    </div>

                </div>

                <div class="row">
                    <!-- user details.//-->
                    <div class="col-lg-5">
                        <form action="" method="POST">
                            <input type="hidden" id="txtID" name="txtID">
                            <div class="card" style="min-height: 100px">
                                <header class="card-header">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input class="form-control mr-sm-2" type="text" placeholder="Search" name="chatSearch">
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="submit" name="btnsearch"><span class="fa fa-search"></span> </button>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="submit" name="btnsearch"><span class="fa fa-refresh"></span> </button>
                                        </div>
                                    </div>
                                </header>
                                <div class="overflow-auto" style="max-height:480px; padding:10px; font-size:13px">
                                    <?php

                                    if(empty($_REQUEST['chatSearch'])) {
                                        $chatUser = mysqli_query($con, "SELECT *
                                                              FROM users 
                                                              WHERE Status='Active'
                                                              order by uid asc ");
                                    }
                                    if(isset($_POST["btnsearch"])){
                                        $searchTxt=$_POST["chatSearch"];
                                        $chatUser=mysqli_query($con,"SELECT * 
                                                              FROM users 
                                                              WHERE FirstName LIKE '%".$searchTxt."%' or LastName LIKE '%".$searchTxt."%' and Status='Active' 
                                                              order by uid asc ");
                                    }

                                    if(mysqli_num_rows($chatUser) == 0){
                                        echo "No Results";
                                    }

                                    if($chatUser === FALSE) {
                                        die(mysqli_error());
                                    }
                                    while($res=mysqli_fetch_array($chatUser)) {
                                        ?>
                                        <ui class="nav nav-pills flex-column">
                                            <button type="submit" name="chatUser" class="btn btn-light text-sm-left" value="<?php echo $res['RegNumber'];?>" style="height: 100px;text-transform: capitalize;">
                                                <li style="margin-top: 10px">
                                                    <div class="d-flex bd-highlight">
                                                        <div class="img_cont">
                                                            <img src="a.jpg" class="rounded-circle user_img">
                                                            <?php
                                                            $fuser=$res['uid'];
                                                            $countMsh = mysqli_query($con,"SELECT count(chatMsh) as total FROM chat WHERE fromUserID='$fuser' and toUserID='$id' and mshStatus='unRead'");
                                                            $count = mysqli_fetch_assoc($countMsh);
                                                            $total= $count['total'];

                                                            if($total=='0' ){
                                                                ?>
                                                                <span class=""></span>
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                <span class="online_icon"><?php echo $total; ?> </span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="user_info">
                                                            <span style="font-size: 14px"> <?php echo $res['FirstName']; ?></span>
                                                            <span style="font-size: 14px"> <?php echo $res['LastName']; ?></span>
                                                            <p style="color: black; font-size: 11px;"><?php echo $res['RegNumber']; ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </button>
                                        </ui>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </form>
                        <script type="text/javascript">
                            $("button[type='submit']").hover(function(){
                                var v = this.value;
                                var textcontrol = document.getElementById("txtID");
                                textcontrol.value = this.value;
                            });
                        </script>
                    </div>
                    <!-- user details end-->

                    <!-- chat box//-->
                    <div  class="col-lg-7">
                        <?php
                        $regNum2='0';

                        if(isset($_POST["chatUser"])) {
                            $regNum = $_POST["txtID"];
                            $_SESSION["regNum"] = $regNum;

                            $result = mysqli_query($con, "SELECT * FROM users WHERE RegNumber='$regNum'");
                            $res = mysqli_fetch_assoc($result);
                            $userID = $res['uid'];
                            $cfname = $res['FirstName'];
                            $clname = $res['LastName'];

                            $sql="UPDATE chat SET mshStatus='Read' WHERE fromUserID='$userID' and toUserID='$id'";
                            $query=mysqli_query($con,$sql);
                        }

                         if($regNum2!=null){
                            $regNum= $_SESSION['regNum'];
                            $result = mysqli_query($con, "SELECT * FROM users WHERE RegNumber='$regNum'");
                            $res = mysqli_fetch_assoc($result);
                            $userID = $res['uid'];
                            $cfname = $res['FirstName'];
                            $clname = $res['LastName'];
                        }


                            ?>
                            <div style="height: 550px" class="card">
                                <header class="card-header">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="a.jpg" class="rounded-circle user_img">
                                        </div>
                                        <div class="user_info">
                                            <span> <?php if($cfname!=null) echo $cfname; else echo 'No User';?></span>
                                            <span> <?php if(isset($clname)) echo $clname; ?></span>
                                            <input type="hidden" id="userID" name="userID" value="<?php if(isset($userID)) echo $userID; ?>" readonly="">
                                        </div>
                                    </div>
                                </header>

                                <div style="padding:10px; font-size:13px; height:400px; border: 0 !important;" class="card overflow-auto" >
                                    <?php
                                    $reMsh=mysqli_query($con,"SELECT c.* 
                                                              FROM chat c
                                                              WHERE c.fromUserID='$userID' and c.toUserID='$id' or c.fromUserID='$id' and c.toUserID='$userID'
                                                              order by c.chatID asc ");



                                    if($reMsh == FALSE ) {
                                        die(mysqli_error());
                                    }

                                    while($res2=mysqli_fetch_array($reMsh))
                                    {
                                        if($res2['fromUserID']!=$id) {
                                            ?>
                                            <!-- recive msh-->
                                            <div class="d-flex justify-content-start mb-2">
                                                <div class="img_cont_msg">
                                                    <img src="a.jpg" class="rounded-circle user_img_msg">
                                                </div>
                                                <div class="msg_cotainer">
                                                    <div><?php echo $res2['chatMsh']; ?></div>
                                                    <span class="msg_time"><?php echo $res2['chatTime']; ?></span>
                                                </div>

                                            </div>
                                            <!-- recive msh end-->
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <!-- send msh-->
                                            <div class="d-flex justify-content-end mb-2">
                                                <div class="msg_cotainer_send">
                                                    <div><?php echo $res2['chatMsh']; ?></div>
                                                    <span class="msg_time_send"><?php echo $res2['chatTime']; ?></span>
                                                </div>
                                                <div class="img_cont_msg">
                                                    <img src="b.jpg" class="rounded-circle user_img_msg">
                                                </div>
                                            </div>
                                            <!-- send msh end-->
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <form method="post" id="myForm">
                                <div class="input-group card-footer" style="position: relative;">
                                    <textarea name="message" id="message" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                    <div class="input-group-append">
                                        <button class="input-group-text send_btn" type="button" value="send" id="send" onclick="SubmitFormData();" ><span class="fa fa-location-arrow"></span></button>
                                    </div>
                                </div>
                                </form>
                            </div>

                    </div>
                    <!-- chat box end-->
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
