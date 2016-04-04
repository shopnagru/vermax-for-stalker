<?php
header('Content-Type: text/plain; charset=utf-8');
$epg = '';
if(!empty($epg_list)){
    $epg = 'url-tvg="'.implode(",", $epg_list).'" ';
}
echo <<<EOF
#EXTM3U {$epg}\r\n
EOF;
ksort($channels);
foreach($channels as $ch){
    $cen = $ch['censored'] != 0 ? 'censored=1 ' : '';
    $logo = $ch['logo'] != '' ? 'tvg-logo="http://'.$_SERVER['SERVER_NAME'].'/stalker_portal//misc/logos/original/'.$ch['logo'].'" ' : '';
    $t = round($ch['correct_time']/60);
    $time = $t != 0 ? ' tvg-shift="'.$t.'"' : '';
    echo <<<EOF
#EXTINF:-1 {$cen}{$logo}tvg-name="{$ch['name']}"{$time},{$ch['name']}
{$ch['cmd']}

EOF;
}