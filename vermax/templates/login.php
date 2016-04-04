<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    html, body{
        height: 100%;
        width: 100%;
        position: relative;
    }
    iframe{
        border: none;
        width: 100%;
        height: 100%;
        display: inherit;
    }
</style>
</head>
<body>
<iframe src="/stalker_portal/server/adm/login"></iframe>
<script>
    $fr = $('iframe');
    $fr.load(function(){
        var hr = $fr.contents().get(0).location.href;
        var last = hr.split('/');
        last = last[last.length-1];
        if(last != 'login'){
            window.location.replace('/vermax.php');
        }
    });
</script>
</body>
<?php
//header("Location: http://stalker.dev.nag.ru/stalker_portal/server/adm/login");
//die();