<?php
$servername = "localhost";
$username = "root";
$pass = "root";
$db = "abc";
try{
$con = mysqli_connect($servername,$username,$pass,$db);
}catch (MySQLi_Sql_Exception $ex){
    echo "error in connecting";
}
?>
