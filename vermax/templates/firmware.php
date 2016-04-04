<?php
header('Content-type: text/xml; charset=utf-8');
?>
<update>
    <?php
    foreach($config as $param){
        echo "<".$param['name'].">".$param['value']."</".$param['name'].">\r\n";
    }
    ?>
?>
</update>
