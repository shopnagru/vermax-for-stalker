<?php
header('Content-type: text/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>
	<notification_list>';
while($msg = $messages->fetch_assoc()){
    echo '
		   	 <notification>
		   	 	<id>'.$msg['id'].'</id>
		   	 	<time>'.$msg['addtime'].'</time>
				<text>'.$msg['msg'].'</text>
			</notification>';
    $send = $mysqli->query("UPDATE `events` SET `sended` = 1 WHERE `id` = '".$msg['id']."'");
}
echo '</notification_list>';