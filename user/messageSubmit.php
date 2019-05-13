<?php
session_start();
include("config.php");
include("header.php");
include("chat.php");

$message = $_POST['message'];
$userID = $_POST['userID'];

$insersql = "INSERT INTO chat(fromUserID,toUserID,chatMsh,mshStatus)VALUES('$id','$userID','$message','unRead')";
if ($con->query($insersql)) {
    header('Refresh: 1; url=chat.php');

} else {
    $notice_suc = "<i style='color:red;'> Created faild </i>";
}


?>
