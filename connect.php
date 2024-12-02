<?php
$con = new mysqli('localhost','root','','mobile_shop');
if($con->connect_error){
    die('connection failed' . $con->connect_error);
}
return $con;
?>