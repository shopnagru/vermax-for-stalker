<?php
/*
 * Класс для работы приставок Vermax(NAG) с системой Stalker
 * Copyright (c) 2016 ООО "НАГ"
 * Developer: Ivan Slyusar xvanok@nag.ru
 */
class User
{
    //Получаем IP приставки
    public function getIp(){
        if(!empty($_SERVER['HTTP_X_REAL_IP'])){
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }
        else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    //Получаем MAC приставки
    public function getMac(){
        if(isset($_GET['mac'])) {
            return $_GET['mac'];
        }
        else{
            return '';
        }
    }
}

class Config
{
    public function find(){
        $vm = new vermaxActions;
        $mysqli = $vm->initDB();
        $user = new User;
        $ip = $user->getIp();
        $mac = $user->getMac();

        $conf_to_user = $mysqli->query("SELECT * FROM `vermax_conf_user` WHERE LOWER(mac) = '".$mac."' OR `ip` = '".$ip."' LIMIT 1");
        $field = $conf_to_user->fetch_assoc();
        if(isset($field['id'])) {
            return $field;
        }
        else{
            $max_mask = 0;
            $conf_to_user = $mysqli->query("SELECT * FROM `vermax_conf_user`");
            while($conf = $conf_to_user->fetch_assoc()){
                $confIp = $conf['ip'];
                @list($net, $mask) = explode("/", $confIp);
                if(!empty($mask)){
                    if($this->ipIn($ip, $net, $mask)) {
                        if ($mask == 32) {
                            $name = $conf;
                            break;
                        } else if ($mask > $max_mask) {
                            $max_mask = $mask;
                            $name = $conf;
                        } else {
                        }
                    }
                    else if(empty($name)){
                        $name = '';
                    }
                    else{}
                }
                else if(empty($name)){
                    $name = '';
                }
                else{}
            }
        }
        if(empty($name)){
            return '';
        }
        else{
            return $name;
        }

    }

    public function getConfig(){
        $user = new User;
        $ip = $user->getIp();
        $mac = $user->getMac();
        $vm = new vermaxActions;
        $mysqli = $vm->initDB();
        $conf_ar = $this->find();
        if($conf_ar != '') {
            $conf_id = $conf_ar['conf_id'];
        }
        else{
            $conf_id = 1;
        }
        $conf_query = $mysqli->query("SELECT * FROM `vermax_conf_params` WHERE `conf_id` = '".$conf_id."'");
        $conf = array();
        while($param = $conf_query->fetch_assoc()){
            $conf[] = $param;
        }
        $user_query = $mysqli->query("SELECT * FROM `users` WHERE `ip` = '".$ip."' OR `mac` = '".$mac."' LIMIT 1");
        $user = $user_query->fetch_assoc();
        $pin = $user['parent_password'];
        $uid = $user['id'];
        $conf[] = array('name' => 'child_lock_pin_code', 'value' => $pin, 'comment' => 'Пин-код родительского контроля [только цифры, не более 11 символов, по умолчанию 0000]');
        $mysqli->query("INSERT INTO `user_log` (`mac`, `uid`, `action`, `param`, `type`) VALUES ('".$mac."', '".$uid."', 'get_config', 'Запрос конфигурации', '1')");
        return $conf;
    }

    public function getUpdate(){
        $user = new User;
        $ip = $user->getIp();
        $mac = $user->getMac();
        $vm = new vermaxActions;
        $mysqli = $vm->initDB();
        $conf_ar = $this->find();
        if($conf_ar != '') {
            $conf_id = $conf_ar['conf_id'];
        }
        else{
            $conf_id = 1;
        }
        $conf_query = $mysqli->query("SELECT * FROM `vermax_update_params` WHERE `conf_id` = '".$conf_id."'");
        $conf = array();
        while($param = $conf_query->fetch_assoc()){
            $conf[] = $param;
        }
        $user_query = $mysqli->query("SELECT * FROM `users` WHERE `ip` = '".$ip."' OR `mac` = '".$mac."' LIMIT 1");
        $user = $user_query->fetch_assoc();
        $uid = $user['id'];
        $mysqli->query("INSERT INTO `user_log` (`mac`, `uid`, `action`, `param`, `type`) VALUES ('".$mac."', '".$uid."', 'get_update', 'Запрос обновления', '1')");
        return $conf;
    }

    public function getSetting(){
        $user = new User;
        $ip = $user->getIp();
        $mac = $user->getMac();
        $vm = new vermaxActions;
        $mysqli = $vm->initDB();
        $conf_ar = $this->find();
        if($conf_ar != '') {
            $conf_id = $conf_ar['conf_id'];
        }
        else{
            $conf_id = 1;
        }
        $conf_query = $mysqli->query("SELECT * FROM `vermax_setting_params` WHERE `conf_id` = '".$conf_id."'");
        $conf = array();
        while($param = $conf_query->fetch_assoc()){
            $conf[] = $param;
        }
        $user_query = $mysqli->query("SELECT * FROM `users` WHERE `ip` = '".$ip."' OR `mac` = '".$mac."' LIMIT 1");
        $user = $user_query->fetch_assoc();
        $uid = $user['id'];
        $mysqli->query("INSERT INTO `user_log` (`mac`, `uid`, `action`, `param`, `type`) VALUES ('".$mac."', '".$uid."', 'get_setting', 'Запрос настройки', '1')");
        return $conf;
    }

    public function getFirmware(){
        $user = new User;
        $ip = $user->getIp();
        $mac = $user->getMac();
        $vm = new vermaxActions;
        $mysqli = $vm->initDB();
        $conf_ar = $this->find();
        if($conf_ar != '') {
            $conf_id = $conf_ar['conf_id'];
        }
        else{
            $conf_id = 1;
        }
        $conf_query = $mysqli->query("SELECT * FROM `vermax_firmware_params` WHERE `conf_id` = '".$conf_id."'");
        $conf = array();
        while($param = $conf_query->fetch_assoc()){
            $conf[] = $param;
        }
        $user_query = $mysqli->query("SELECT * FROM `users` WHERE `ip` = '".$ip."' OR `mac` = '".$mac."' LIMIT 1");
        $user = $user_query->fetch_assoc();
        $uid = $user['id'];
        $mysqli->query("INSERT INTO `user_log` (`mac`, `uid`, `action`, `param`, `type`) VALUES ('".$mac."', '".$uid."', 'get_firmware', 'Запрос прошивки', '1')");
        return $conf;
    }

    //Преобразование маски
    public function ipIn($Tip, $T_net, $T_mask){
        $l_net = ip2long($T_net);
        $lip = ip2long($Tip);
        $bin_net = str_pad(decbin($l_net), 32, "0", STR_PAD_LEFT);
        $fPart = substr($bin_net, 0, $T_mask);
        $bin_ip = str_pad(decbin($lip), 32, "0", STR_PAD_LEFT);
        $fIp = substr($bin_ip, 0, $T_mask);
        return(strcmp($fPart, $fIp)==0);
    }
}

class vermaxActions
{
    public function getConfig($c){
        $mysqli = $this->initDB();
        $user = new User();
        $ip = $user->getIp();
        $mac = $user->getMac();
        $config = new Config;
        switch($c){
            case "config":
                $config = $config->getConfig();
                break;
            case "update":
                $config = $config->getUpdate();
                break;
            case "setting":
                $config = $config->getSetting();
                break;
            case "firmware":
                $config = $config->getFirmware();
                break;
        }
        $f_user = $mysqli->query("SELECT * FROM `vermax_conf_user` WHERE `mac` = '".$mac."'");
        if($f_user->num_rows === 0){
            $mysqli->query("INSERT INTO `vermax_conf_user` (`ip`, `mac`, `conf_id`, `upd_id`, `settings_id`, `fw_id`) VALUES ('".$ip."', '".$mac."', 1, 1, 1, 1)");
        }

        include($_SERVER["DOCUMENT_ROOT"]."/vermax/templates/{$c}.php");
    }

    //Запрос уведомлений
    public function getMessage(){
        $mysqli = $this->initDB();
        $user = new User;
        $ip = $user->getIp();
        $mac = $user->getMac();
        $user_query = $mysqli->query("SELECT * FROM `users` WHERE `mac` LIKE '".$mac."' OR `ip` LIKE '".$ip."' LIMIT 1");
        while($usr = $user_query->fetch_assoc()){
            $uid = $usr['id'];
        }
        $messages = $mysqli->query("SELECT * FROM `events` WHERE `uid` = '".$uid."' AND `sended` = 0");
        include($_SERVER["DOCUMENT_ROOT"]."/vermax/templates/message.php");
    }

    //Запрос плейлиста
    public function getM3U(){
        $mysqli = $this->initDB();

        $user = new User;
        $ip = $user->getIp();
        $mac = $user->getMac();

        $tp = NULL;
        $user_sql = $mysqli->query("SELECT * FROM `users` WHERE `mac` LIKE '".$mac."' OR `ip` LIKE '".$ip."' LIMIT 1");
        while($field = $user_sql->fetch_assoc()){
            $uid =$field['id'];
            $tp = $field['tariff_plan_id'];
        }
        $pi = NULL;
        $pack_sql = $mysqli->query("SELECT * FROM `package_in_plan` WHERE `plan_id` LIKE '".$tp."' LIMIT 1");
        while($pack = $pack_sql->fetch_assoc()){
            $pi = $pack['package_id'];
        }
        $ch = array();
        $ch_sql = $mysqli->query("SELECT `service_id` FROM `service_in_package` WHERE `package_id` LIKE '".$pi."'");
        while($chan = $ch_sql->fetch_assoc()){
            $ch[] = $chan['service_id'];
        }
        $channels = array();
        foreach($ch as $cid) {
            $ch_sql = $mysqli->query("SELECT * FROM `itv` WHERE `id` LIKE '" . $cid . "' LIMIT 1");
            while ($channel = $ch_sql->fetch_assoc()) {
                $channels[$channel['number']] = $channel;
            }
        }
        $epg_list = array();
        $epg_query = $mysqli->query("SELECT * FROM `epg_setting` WHERE `status` = 1");
        while($epg = $epg_query->fetch_assoc()){
            $epg_list[] = $epg['uri'];
        }

        $mysqli->query("INSERT INTO `user_log` (`mac`, `uid`, `action`, `param`, `type`) VALUES ('".$mac."', '".$uid."', 'get_playlist', 'Запрос плейлиста', '1')");

        include($_SERVER["DOCUMENT_ROOT"]."/vermax/templates/m3u.php");
    }

    //Получение события
    public function setEvent(){
        $mysqli = $this->initDB();
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $mac = $obj->mac;
        $events = $obj->events;

        $uid = NULL;
        $user_sqli = $mysqli->query("SELECT * FROM `users` WHERE `mac` LIKE '".$mac."' LIMIT 1");
        while($field = $user_sqli->fetch_assoc()){
            $uid = $field['id'];
        }
        foreach($events as $event){
            $mysqli->query("INSERT INTO `user_log` (`mac`, `uid`, `action`, `param`, `type`) VALUES ('".$mac."', '".$uid."', '".$event->type."', '".json_encode($event)."', '1')");
        }
        return include($_SERVER["DOCUMENT_ROOT"]."/vermax/templates/event.php");
    }

    //Подключить базу
    public function initDB(){
        if(file_exists($_SERVER["DOCUMENT_ROOT"]."/stalker_portal/server/custom.ini")){
            $conf = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/stalker_portal/server/custom.ini");
            $d_conf = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "/stalker_portal/server/config.ini");
            if(!isset($conf["mysql_host"])){
                $conf["mysql_host"] = $d_conf["mysql_host"];
            }
            if(!isset($conf["mysql_user"])){
                $conf["mysql_user"] = $d_conf["mysql_user"];
            }
            if(!isset($conf["mysql_pass"])){
                $conf["mysql_pass"] = $d_conf["mysql_pass"];
            }
            if(!isset($conf["db_name"])){
                $conf["db_name"] = $d_conf["db_name"];
            }
        }
        else {
            $conf = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "/stalker_portal/server/config.ini");
        }
        $mysqli = new mysqli($conf["mysql_host"], $conf["mysql_user"], $conf["mysql_pass"], $conf["db_name"]);
        $mysqli->set_charset("utf8");
        return $mysqli;
    }

    public function getUVersion(){
        if(isset($_GET['version'])){
            return $_GET['version'];
        }
        else{
            return 'undefined';
        }
    }
    public function getUFirmware(){
        if(isset($_GET['fw'])){
            return $_GET['fw'];
        }
        else{
            return 'undefined';
        }
    }

    public function getIndex(){
        session_start();
        if(isset($_SESSION['uid'])) {
            $mysqli = $this->initDB();
            $conf_list = array();
            if(isset($_POST['save_conf'])){
                $save_conf = $_POST['save_conf'];
                $c_cid = $save_conf['conf_id'];
                $c_id = $save_conf['id'];
                $table = $save_conf['table'];
                $desc = $save_conf['date'];
                $conf_name = $save_conf['conf_name'];
                if(isset($save_conf['name']) && isset($save_conf['value'])) {
                    $c_n = $save_conf['name'];
                    $c_v = $save_conf['value'];
                }
                else{
                }
                $c_c = isset($save_conf['comment']) ? $save_conf['comment'] : '';
                if($c_cid == 'add'){
                    $f_c = $mysqli->query("SELECT * FROM `vermax_configs` WHERE `descript` = '".$desc."' LIMIT 1");
                    while($c = $f_c->fetch_assoc()){
                        $c_cid = $c['id'];
                    }
                    if($c_cid == 'add'){
                        $mysqli->query("INSERT INTO `vermax_configs` (`name`, `descript`) VALUES ('".$conf_name."', '".$desc."')");
                        $c_cid = $mysqli->insert_id;
                    }
                }
                if($c_id == 'add'){
                    $mysqli->query("INSERT INTO `vermax_".$table."_params` (`conf_id`, `name`, `value`, `comment`) VALUES ('".$c_cid."', '".$c_n."', '".$c_v."', '".$c_c."')");
                }
                else{
                    $mysqli->query("UPDATE `vermax_".$table."_params` SET `name` = '".$c_n."', `value` = '".$c_v."', `comment` = '".$c_c."' WHERE `id` = ".$c_id."");
                }
                $mysqli->query("UPDATE `vermax_configs` SET `name` = '".$conf_name."' WHERE `id` = '".$c_cid."'");
                echo $c_cid;
            }
            else if(isset($_POST['rm_conf'])){
                $conf = $_POST['rm_conf'];
                if(isset($conf['id'])) {
                    $id = $conf['id'];
                    if(isset($conf['table'])) {
                        $table = $conf['table'];
                        $mysqli->query("DELETE FROM `vermax_" . $table . "_params` WHERE `id` = '" . $id . "'");
                    }
                }
                else{}
            }
            else if (isset($_POST['get_conf'])) {
                $conf_id = $_POST['get_conf'];
                if ($conf_id == "add") {
                    $conf_list['configs'] = array();
                    $conf_list['settings'] = array();
                    $conf_list['updates'] = array();
                    $conf_list['firmwares'] = array();
                    $conf_n = '';
                } else {
                    $c_conf_q = $mysqli->query("SELECT * FROM `vermax_conf_params` WHERE `conf_id` = '" . $conf_id . "'");
                    while ($c_conf = $c_conf_q->fetch_assoc()) {
                        $conf_list['configs'][] = $c_conf;
                    }
                    $c_set_q = $mysqli->query("SELECT * FROM `vermax_setting_params` WHERE `conf_id` = '" . $conf_id . "'");
                    while ($c_set = $c_set_q->fetch_assoc()) {
                        $conf_list['settings'][] = $c_set;
                    }
                    $c_upd_q = $mysqli->query("SELECT * FROM `vermax_update_params` WHERE `conf_id` = '" . $conf_id . "'");
                    while ($c_upd = $c_upd_q->fetch_assoc()) {
                        $conf_list['updates'][] = $c_upd;
                    }
                    $c_fw_q = $mysqli->query("SELECT * FROM `vermax_firmware_params` WHERE `conf_id` = '" . $conf_id . "'");
                    while ($c_fw = $c_fw_q->fetch_assoc()) {
                        $conf_list['firmwares'][] = $c_fw;
                    }
                }
                $cn = $mysqli->query("SELECT * FROM `vermax_configs` WHERE `id` = '".$conf_id."'");
                while($con = $cn->fetch_assoc()){
                    $conf_n = $con['name'];
                }
                if(!isset($conf_n)){
                    $conf_n = '';
                }
                include($_SERVER["DOCUMENT_ROOT"] . "/vermax/templates/editconfig.php");
            }
            else if(isset($_POST['get_users'])){
                $users = array();
                $configs = array();
                $users_query = $mysqli->query("SELECT * FROM `vermax_conf_user`");
                while($users_r = $users_query->fetch_assoc()){
                    $pass = '';
                    $us_query = $mysqli->query("SELECT * FROM `users` WHERE `mac` = '".$users_r['mac']."' LIMIT 1");
                    while($us = $us_query->fetch_assoc()){
                        $pass = $us['parent_password'];
                    }
                    $users[] = array(
                        'id' => $users_r['id'],
                        'ip' => $users_r['ip'],
                        'mac' => $users_r['mac'],
                        'conf' => $users_r['conf_id'],
                        'pass' => $pass
                        );
                }
                $conf_query = $mysqli->query("SELECT * FROM `vermax_configs`");
                while($conf = $conf_query->fetch_assoc()){
                    $configs[] = array(
                        'id' => $conf['id'],
                        'name' => $conf['name']
                    );
                }
                include($_SERVER["DOCUMENT_ROOT"] . "/vermax/templates/users.php");
            }
            else if(isset($_POST['set_users'])){
                $req = $_POST['set_users'];
                $conf = $req['conf'];
                $pass = $req['pass'];
                $id = $req['id'];
                $mac = $req['mac'];
                $insert_conf = $mysqli->query("UPDATE `vermax_conf_user` SET `conf_id` = '".$conf."', `upd_id` = '".$conf."', `settings_id` = '".$conf."', `fw_id` = '".$conf."' WHERE `id` = '".$id."'");
                if(is_numeric($pass)) {
                    $insert_conf = $mysqli->query("UPDATE `users` SET `parent_password` = '" . $pass . "' WHERE `mac` = '" . $mac . "'");
                }
                echo 'ok';
            }
            else {
                $configs_query = $mysqli->query("SELECT * FROM `vermax_configs`");
                $conf_list = array();
                while ($configs = $configs_query->fetch_assoc()) {
                    $conf_list[] = array("id" => $configs['id'], "name" => $configs['name'], "description" => $configs['descript']);
                }
                include($_SERVER["DOCUMENT_ROOT"] . "/vermax/templates/hello.php");
            }
        }
        else{
            include($_SERVER["DOCUMENT_ROOT"] . "/vermax/templates/login.php");
        }
    }
}