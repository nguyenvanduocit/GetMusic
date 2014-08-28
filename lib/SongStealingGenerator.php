<?php
/**
 * Project : GetMusic
 * User: thuytien
 * Date: 8/27/2014
 * Time: 8:57 PM
 */

require_once 'GetTrackAbstract.php';
require_once 'Soundcloud.class.php';
require_once 'Zingmp3.class.php';
require_once 'NhacCuaTui.class.php';
require_once 'ZippyShare.php';
require_once 'Nhacso.class.php';
require_once 'PlaylistMaker.class.php';

class SongStealingGenerator
{
    private static $instance;

    public static function getInstance()
    {
        if(static::$instance)
        {
            return static::$instance;
        }
        else
        {
            static::$instance = new self();
            return static::$instance;
        }
    }

/**
 * Đầu tiên là kiểm tra xem url này là của trang nhạc nào, tùy từng trang nhạc mà new các class tương ứng, lấy các track, add vào playlist và return lại playlist.
 * @param $link
 * @return mixed
 */
public function getPlaylist($link)
{
    $urlInfo = parse_url($link);
    $trackGetter = null;
    $playlist = new PlaylistMaker();
    switch ($urlInfo['host']) {
        case 'mp3.zing.vn':
            $trackGetter = new ZingMp3($link);
            break;
        case 'soundcloud.com':
            $trackGetter = new SoundcloudAPI($link);
            break;
        case 'www.nhaccuatui.com':
            $trackGetter = new NhacCuaTui($link);
            break;
        case 'nhacso.net':
            $trackGetter = new Nhacso($link);
            break;
        case (preg_match('/.*zippyshare.com.*/', $urlInfo['host']) ? true : false) :
            $trackGetter = new ZippyShare($link);
            break;
    }
    if ($trackGetter) {
        $trackList = $trackGetter->GetTrack();
        $trackCount = count($trackList);
        for ($i = 0; $i < $trackCount; $i++) {
            $playlist->AddTrack($trackList[$i]);
        }
    }
    return $playlist;
}
} 