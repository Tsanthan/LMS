<?php
include "config.php";
$q = $_REQUEST["q"];
    $sql="UPDATE notification_status SET status=1 WHERE uid='$q'" ;
    $query=mysqli_query($con,$sql);
