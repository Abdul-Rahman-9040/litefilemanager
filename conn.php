<?php
$mysql_host='localhost';
$mysql_user='root';
$mysql_password='';
$mysql_name='litefilemanager';

$conn=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_name);
if(!$conn)
{
    die('faile'.mysqli_connect_error());

}
?>
