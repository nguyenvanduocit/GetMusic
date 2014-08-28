<?php
header('Content-Type: text/xml; charset=utf-8');
//header('Cache-Control: max-age=604800');
header('Content-Transfer-Encoding: binary');
require_once 'lib/SongStealingGenerator.php';
if ($_GET['id'] == 1) {
    $link = 'http://mp3.zing.vn/album/Tuyen-Tap-Cac-Bai-Hat-Hay-Nhat-Cua-Quang-Le-Quang-Le/ZWZ9CD67.html';
} else if ($_GET['id'] == 2) {
    $link = 'https://soundcloud.com/newyorker/the-political-scene-june-13';
} else {
    $link = 'http://nhacso.net/nghe-nhac/su-that-sau-mot-loi-hua.X1tUUUBcbA==.html';
}
echo SongStealingGenerator::getInstance()->getPlaylist($link)->toXML();