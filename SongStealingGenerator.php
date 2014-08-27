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
require_once 'PlaylistMaker.class.php';

class SongStealingGenerator
{

    private $link;
    private $playlist;
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
        }
    }

    public function __construct($link = "")
    {
        $this->link = $link;
        $this->playlist = new PlaylistMaker();
    }

    public function getPlaylist()
    {
        $link = $this->link;
        $urlInfo = parse_url($link);
        $trackGetter = null;
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

            case (preg_match('/.*zippyshare.com.*/', $urlInfo['host']) ? true : false) :
                $trackGetter = new ZippyShare($link);
                break;
        }

        if ($trackGetter) {
            $trackList = $trackGetter->GetTrack();
            $trackCount = count($trackList);
            for ($i = 0; $i < $trackCount; $i++) {
                $this->playlist->AddTrack($trackList[$i]);
            }
        }
        return $this->playlist;
    }
} 