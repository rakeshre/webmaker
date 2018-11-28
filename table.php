<?php
include('connection.php');
$sql = "SHOW TABLE_NAME from information_schema.tables where table_schema = cwdcour2_onlinenotes";
$result = mysqli_query($link,$sql);
//mysqldump cwdcour2_onlinenotes;
if($result){
    echo "success";
}else
    echo "fail";
?>