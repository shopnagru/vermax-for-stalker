<?php
header('Content-Type: text/plain; charset=utf-8');
?>
<config>
    <?php
    foreach($config as $param){
        echo "<".$param['name'].">".$param['value']."</".$param['name'].">\r\n";
    }
    ?>
</config>
