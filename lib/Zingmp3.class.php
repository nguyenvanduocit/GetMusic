<?php
require_once 'Track.class.php';
require_once 'Curl.class.php';
require_once 'GetTrackAbstract.php';

class ZingMp3 extends GetTrackAbstract
{

    private $link;
    private $type;

    public function __construct($link = "")
    {
        $this->link = $link;
        $this->type = $this->checkType();
    }

    public function checkType()
    {
        $regexlink_baihat = '/http\:\/\/(www\.)?mp3\.zing\.vn\/(.*)\/[^>]*\/[^>]*\.html/';
        if (preg_match($regexlink_baihat, $this->link, $matches) == 1)
            return $matches[2];
        return null;
    }

    public function GetTrack()
    {

        $output = array();

        $content = curlClass::getInstance(true)->fetchURL($this->link);
        $regex = '#xmlURL=(.+?)\&amp\;textad#s';
        if (preg_match_all($regex, $content, $matches) == false) {
            return array(new Track());
        }
        $xmlURL = $matches[1][0];
        $xml = simplexml_load_file("compress.zlib://" . $xmlURL, 'SimpleXMLElement', LIBXML_NOCDATA);

if ($xml) {
    switch ($this->type) {
        case 'bai-hat':
            $urlSource = explode("?", trim($xml->urlSource));
            $output[] = new Track($xml->singer, $xml->title, $xml->singer, $urlSource[0]);
            break;

        case 'video-clip':

            if ($xml->item->f1080) {
                $output[] = new Track($xml->item->performer, $xml->item->title, $xml->item->performer, $xml->item->f1080);
            }else if ($xml->item->f720) {
                $output[] = new Track($xml->item->performer, $xml->item->title, $xml->item->performer, $xml->item->f720);
            }else if ($xml->item->f480) {
                $output[] = new Track($xml->item->performer, $xml->item->title, $xml->item->performer, $xml->item->f480);
            }
            else if ($xml->item->f360) {
                $output[] = new Track($xml->item->performer, $xml->item->title, $xml->item->performer, $xml->item->f360);
            }

            break;
        case 'playlist':
        case 'album':
            foreach ($xml->item as $key => $item) {
                //Chay rat cham va tang time, chi su dung khi that su can thiet
                //$item->source = curlClass::getInstance()->getRedirectURL($item->source);
                $output[] = new Track($item->performer, $item->title, $item->performer, $item->source);
            }
            break;
    }
}
        return $output;
    }
}