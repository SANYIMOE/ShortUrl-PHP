<?php
/*
=========================================================
* 玉桂短网址源 - 使用你自己的域名搭建更好的短网址服务 - v0.1.0
=========================================================
* Product Page: https://github.com/Cinnamoroll-Home/Cinnamoroll-ShortUrl/
* Copyright 2022 Cinnamoroll (https://mojy.xyz)
* Coded by Cinnamoroll
*/
include "functions/random.php";
include "functions/database.php";
ini_set('display_errors', 0);
ini_set('log_errors', 0);
$data = $db->query("SELECT * FROM settings");
$info = $db->fetch_array($data);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $_POST = json_decode(file_get_contents("php://input"),true);
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    $_POST = $_GET;
}
$myweb = $info['URL'];
$long = $_POST['url'];
$cust = $_POST['cust'];
$pass = $_POST['pass'];
$aValid = array('-', '_');
$error = 0;
$spam = array("admin", "contact", "tos", "about", "api-about","404");

if (in_array($cust, $spam)) {
    echo "Error: Invalid custom alias"; //error message
    $error = 1;
} else {
    $chk_rand = $db->query("SELECT link FROM links WHERE BINARY link = '$rand'");
    if ($db->num_rows($chk_rand) == 0) {
        $nrand = $rand;
    } else {
        $nrand = $rand2;
    } // checking the generated random links

    if ($long == '') {
        $error = 1;
        echo "Error: You should provide a URL.";
    } else {
        if (filter_var($long, FILTER_VALIDATE_URL)) {
            $long2 = $long;
        } else {
            $error = 1;
            echo "Error: URL is invalid.";
        }
    }

    if ($cust == !'') {
        if (ctype_alnum(str_replace($aValid, '', $cust))) {
            $cust2 = $cust;
        } else {
            $error = 1;
            echo "Error: Invalid Custum alias";
        }
    }

    if ($pass == !'') {
        if (ctype_alnum($pass)) {
            $pass2 = $pass;
        } else {
            echo "Error: Password error";
            $error = 1;
        }
    }
    if ($cust2 == !'') {
        $chk_cust = $db->query("SELECT link FROM links WHERE BINARY link = '$cust2'");
        if ($db->num_rows($chk_cust) == 0) {
            $cust3 = $cust2;
        } else {
            $error = 1;
            echo "Error: Custom alias already exists.";
        }
    }

    if ($cust3 == '') {
        $rand1 = $nrand;
        $is_cust = 0;
    } else {
        $rand1 = $cust3;
        $is_cust = 1;
    }

    if (!$error) {
        $action = $db->query("INSERT INTO links (URL, link, pass, custom, last_visit) 
                    VALUES ('$long','$rand1','$npass','$is_cust', NOW())");
        if (!$action) {
            echo "Error: Internal Server Error ".mysqli_errno();
        } else {
            echo "$myweb"."$rand1";
        }
    }
}
header("Access-Control-Allow-Origin: *");
header("content-type: application/json");
?>
