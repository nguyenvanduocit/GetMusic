<?php
header('Content-Type: text/xml; charset=utf-8');
header('Cache-Control: max-age=604800');
header('Content-Transfer-Encoding: binary');
require_once 'lib/SongStealingGenerator.php';
if ($_GET['id'] == 1) {
    $link = 'http://mp3.zing.vn/album/Nhac-Hot-Viet-Thang-08-2014-Various-Artists/ZWZB7OIO.html';
} else if ($_GET['id'] == 2) {
    $link = 'https://soundcloud.com/rere_mody84/sets/katy-perry';
} else {
    $link = 'http://nhacso.net/nghe-playlist/nhac-viet-hot-thang-8-2014.V15ZUUte.html';
}
echo SongStealingGenerator::getInstance()->getPlaylist($link)->toXML();