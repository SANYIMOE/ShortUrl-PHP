<?php
/*
=========================================================
* 玉桂短网址源 - 使用你自己的域名搭建更好的短网址服务 - v0.1.0
=========================================================
* Product Page: https://github.com/Cinnamoroll-Home/Cinnamoroll-ShortUrl/
* Copyright 2022 Cinnamoroll (https://mojy.xyz)
* Coded by Cinnamoroll
*/
include "functions/database.php";

$data = $db->query("SELECT * FROM settings");
$info = $db->fetch_array($data);
$ads = $db->query("SELECT * FROM ads");
$ads_info = $db->fetch_array($ads);


$shr = $db->escape_value($_GET['id']);


$getLink = $db->query("SELECT URL, date, hits, id, pass FROM links WHERE BINARY link = '$shr'");
$getLink = $db->fetch_array($getLink);
$url = $getLink["URL"];
$date = $getLink["date"];
$hits = $getLink["hits"];
$id = $getLink["id"];
$pass = $getLink["pass"];

if ($url == !'') {


    $upd = "UPDATE links SET hits = hits+1 WHERE id = '$id'";
    $retval = $db->query($upd);
    $upd01 = "UPDATE links SET last_visit = NOW() WHERE id = '$id'";
    $retval01 = $db->query($upd01);


    if ($pass != '') { //link has password
        if ($_POST['txtpass'] != $pass) {
            include "functions/password.php";
        } else {
            include "functions/redirect.php";
        }
    } else {
        include "functions/redirect.php";
    }
} else { // link not found
    $error_msg = "找不到您跳转的链接";
    include "functions/error.php"; //error page
}
$db->close_connection();


?>
