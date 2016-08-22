<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vermax - IPTV - Stalker</title>
    <link rel="stylesheet" href="/vermax/assets/main.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/vermax/assets/js.js"></script>
</head>
<body>
    <div id="main">
        <div id="header">
            <div class="lwrap" onclick="portal();">
                <img src ="/vermax/assets/logo.png" class="logo">
                <div id="ver" title="Версия панели управления">v. S1.0.2 for</div>
                <img src="/vermax/assets/logo_stalker_black.png" title="Перейти в Stalker" class="stalk">
            </div>
            <div id="menu">
                <select id="conf" class="tab selbut" name="conf">
                    <option value="0" id="title" selected="true" disabled style="display: none;">Изменить конфиг</option>
                    <option value="add" style="background: rgb(157, 252, 162);">Создать новый</option>
                    <?php
                    foreach ($conf_list as $config){
                        echo "<option value=".$config['id'].">".$config['name']."</option>";
                    }
                    ?>
                </select>
                <span class='t_menu' style="margin-left: -4px; display: inline-block; border-right: 1px dotted black; padding: 9px; font-size: 15px;" onclick="getUsers();">Назначение конфигов</span>
                <img id="ch_log" src="/vermax/assets/ch_log.png" alt="changelog" onclick="changelog();" title="История изменений">
                <img id="docs" src="/vermax/assets/docs_icon.png" alt="docs" onclick="documentation();" title="Документация">
            </div>
        </div>
        <iframe src="/stalker_portal/server/adm/"></iframe>
        <div id="content">

        </div>
    </div>
    <div id="request" style="display: none;"></div>
<script>
    hash();
    $('#conf').on('change', function(){
        var config = this.value;
        getConf(config);
    });

    $fr = $('iframe');
    $fr.load(function(){
        var hr = $fr.contents().get(0).location.href;
        var last = hr.split('/');
        last = last[last.length-1];
        if(last == 'login'){
            window.location.replace('/vermax.php');
        }
    });
</script>
</body>
</html>
