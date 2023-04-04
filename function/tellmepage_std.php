<?php
function tellMetoLocationOfTopic($page){
    switch($page){
        case '1':
            return array("การขอนอน");
            break;
        case '2':
            return array("การขอยา");
            break;
        default:
            include_once('fun/easteregg_listdata.php');
            return array($topic,$story,$links);
    }
}