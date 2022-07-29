<?php


require_once "config.php";


if(isset($_GET['id']))
{
    $tabname= $_GET['tbname'];
    $keyname = $_GET['key'];
    $keyval = $_GET['id'];
    $loc = $_GET['loc'];
    $conn = new mysqli($sn, $un, $pw, $nameDB);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DELETE FROM $tabname WHERE $keyname = '$keyval'";
    $conn->query($sql);
    header("location:../".$loc);
    $conn->close();
}



?>