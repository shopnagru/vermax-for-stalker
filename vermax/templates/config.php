<?php
header('Content-Type: text/plain; charset=utf-8');
?>
playlist=http://update.vermax.com/vermax.php?type=m3u&mac=<?php echo $mac."\r\n"; ?>
<?php
foreach($config as $param){
    if($param['comment'] != null) {
        echo "\r\n#" . str_replace("\r\n", "\r\n#", $param['comment']) . "\r\n";
    }
    echo $param['name']."=".$param['value']."\r\n";
}
