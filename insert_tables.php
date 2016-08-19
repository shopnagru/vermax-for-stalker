<?php
try {
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
} catch (Exception $e){
    echo "Возникла ошибка! Проверьте, указаны ли данные для подключения к базе данных в файле /stalker_portal/server/config.ini";
    echo "Текст ошибки: ".$e;
    die();
}

$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_configs` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` VARCHAR( 255 ) NULL , `descript` TEXT NULL) ENGINE = INNODB");
if($mysqli->errno){
	echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\nПовторная попытка создания таблицы.\r\n\r\n";
	$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_configs` (`id` INT NOT NULL AUTO_INCREMENT, `name` VARCHAR( 255 ) NULL , `descript` TEXT NULL, PRIMARY KEY ( `id` )) ENGINE = INNODB");
	if($mysqli->errno){
		echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\n";
	}
	else{
		echo "\r\nТаблица `vermax_configs` успешно создана!\r\n\r\n";
	}
}
else{
	echo "\r\nТаблица `vermax_configs` успешно создана!\r\n\r\n";
}

$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_conf_params` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `conf_id` INT NULL, `name` VARCHAR( 255 ) NULL, `value` VARCHAR( 255 ) NULL, `comment` TEXT NULL) ENGINE = INNODB");
if($mysqli->errno){
	echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\nПовторная попытка создания таблицы.\r\n\r\n";
	$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_conf_params` (`id` INT NOT NULL AUTO_INCREMENT, `conf_id` INT NULL, `name` VARCHAR( 255 ) NULL, `value` VARCHAR( 255 ) NULL, `comment` TEXT NULL, PRIMARY KEY ( `id` )) ENGINE = INNODB");
	if($mysqli->errno){
		echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\n";
	}
	else{
		echo "\r\nТаблица `vermax_conf_params` успешно создана!\r\n\r\n";
	}
}
else{
	echo "\r\nТаблица `vermax_conf_params` успешно создана!\r\n\r\n";
}

$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_firmware_params` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `conf_id` INT NULL, `name` VARCHAR( 255 ) NULL, `value` VARCHAR( 255 ) NULL, `comment` TEXT NULL) ENGINE = INNODB");
if($mysqli->errno){
	echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\nПовторная попытка создания таблицы.\r\n\r\n";
	$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_firmware_params` (`id` INT NOT NULL AUTO_INCREMENT, `conf_id` INT NULL, `name` VARCHAR( 255 ) NULL, `value` VARCHAR( 255 ) NULL, `comment` TEXT NULL, PRIMARY KEY ( `id` )) ENGINE = INNODB");
	if($mysqli->errno){
		echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\n";
	}
	else{
		echo "\r\nТаблица `vermax_firmware_params` успешно создана!\r\n\r\n";
	}
}
else{
	echo "\r\nТаблица `vermax_firmware_params` успешно создана!\r\n\r\n";
}

$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_setting_params` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `conf_id` INT NULL, `name` VARCHAR( 255 ) NULL, `value` VARCHAR( 255 ) NULL, `comment` TEXT NULL) ENGINE = INNODB");
if($mysqli->errno){
	echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\nПовторная попытка создания таблицы.\r\n\r\n";
	$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_setting_params` (`id` INT NOT NULL AUTO_INCREMENT, `conf_id` INT NULL, `name` VARCHAR( 255 ) NULL, `value` VARCHAR( 255 ) NULL, `comment` TEXT NULL, PRIMARY KEY ( `id` )) ENGINE = INNODB");
	if($mysqli->errno){
		echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\n";
	}
	else{
		echo "\r\nТаблица `vermax_setting_params` успешно создана!\r\n\r\n";
	}
}
else{
	echo "\r\nТаблица `vermax_setting_params` успешно создана!\r\n\r\n";
}

$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_update_params` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `conf_id` INT NULL, `name` VARCHAR( 255 ) NULL, `value` VARCHAR( 255 ) NULL, `comment` TEXT NULL) ENGINE = INNODB");
if($mysqli->errno){
	echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\nПовторная попытка создания таблицы.\r\n\r\n";
	$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_update_params` (`id` INT NOT NULL AUTO_INCREMENT, `conf_id` INT NULL, `name` VARCHAR( 255 ) NULL, `value` VARCHAR( 255 ) NULL, `comment` TEXT NULL, PRIMARY KEY ( `id` )) ENGINE = INNODB");
	if($mysqli->errno){
		echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\n";
	}
	else{
		echo "\r\nТаблица `vermax_update_params` успешно создана!\r\n\r\n";
	}
}
else{
	echo "\r\nТаблица `vermax_update_params` успешно создана!\r\n\r\n";
}

$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_conf_user` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `ip` VARCHAR( 50 ) NULL, `mac` VARCHAR ( 255 ) NULL, `conf_id` INT NULL, `upd_id` INT NULL, `settings_id` INT NULL, `fw_id` INT NULL) ENGINE = INNODB");
if($mysqli->errno){
	echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\nПовторная попытка создания таблицы.\r\n\r\n";
	$mysqli->query("CREATE TABLE IF NOT EXISTS `vermax_conf_user` (`id` INT NOT NULL AUTO_INCREMENT, `ip` VARCHAR( 50 ) NULL, `mac` VARCHAR ( 255 ) NULL, `conf_id` INT NULL, `upd_id` INT NULL, `settings_id` INT NULL, `fw_id` INT NULL, PRIMARY KEY ( `id` )) ENGINE = INNODB");
	if($mysqli->errno){
		echo "При создании таблицы возникла ошибка:\r\n\r\n########## SYSTEM INFO ##########\r\n\r\n".php_uname()."\r\n\r\n########## MySQLi INFO ##########\r\n\r\n".$mysqli->server_info."\r\n\r\n############# ERROR #############\r\n\r\n".$mysqli->errno.": ".$mysqli->error."\r\n\r\n#################################\r\n\r\n";
	}
	else{
		echo "\r\nТаблица `vermax_conf_user` успешно создана!\r\n\r\n";
	}
}
else{
	echo "\r\nТаблица `vermax_conf_user` успешно создана!\r\n\r\n";
}
