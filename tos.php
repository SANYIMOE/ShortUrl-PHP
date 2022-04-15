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
?>
<!DOCTYPE html>
<html class="full" lang="zh">

    <head>
	    <base href="<?php echo $info['URL']; ?>/" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>使用许可 - <?php echo $info['name']; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">

        <!-- Custom CSS for the Template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">

        <link href="https://fonts.loli.net/css?family=Fjalla+One" rel="stylesheet">
        <link rel="stylesheet" href="css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <style>
            <?php echo $info['cstm-style']; ?>
        </style>
    </head>

    <body>
        <?php
            include "functions/menu.php";
        ?>
        <div class="container">
            <div class="row logo">
                <div class="col-lg-12" style="text-align:center">
                    <?php 
                        include "functions/logo.php";
                        include "functions/darkmode.php";
                    ?>
                </div>
            </div>
        </div>
        <div class="container  animated fadeIn">

            <div class="row" style="margin-top: -25px;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="myModalLabel">使用许可</h2>
                        </div>
                        <div class="modal-body" style="min-height:10%; max-height:350px; overflow-y:scroll; overflow-x:none; position:relative;">
                        <P>禁止垃圾邮件的网站</p> 
                        <p>禁止任何病毒，恶意软件的链接</p> 
                        <p>禁止任何短，不合法的链接</p> 
                        <p>禁止没用的垃圾网站</p> 
                        <p>禁止涉嫌垃圾网站的链接</p> 
                        </div>

                    </div><!-- /.modal-content -->
                </div>
            </div>


        </div>
        <!-- JavaScript -->
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>

</html>
<?php $db->close_connection(); ?>
