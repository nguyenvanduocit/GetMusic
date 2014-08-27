<?php
require_once 'Track.class.php';
require_once 'Curl.class.php';
require_once 'GetTrackAbstract.php';

class ZingMp3 extends GetTrackAbstract{
	
	private $link;
    private $type;

	public function __construct($link = "") {
		$this->link = $link;
        $this->type = $this->checkType();
	}

	public function checkType() {
		$regexlink_baihat = '/http\:\/\/(www\.)?mp3\.zing\.vn\/(.*)\/[^>]*\/[^>]*\.html/';
		if(preg_match($regexlink_baihat, $this->link,$matches) ==1)
			return $matches[2];
		return null;
	}

	public function GetTrack() {
		
		$output = array();

		$content = curlClass::getInstance()->fetchURL($this->link);
		$regex = '#\_strAuto(.+?)value="(.+?)" \/>#s';
        //Get fail
		if(preg_match_all($regex, $content, $matches) == false) {
            return new Track();
        }

		$Content = preg_replace(array('@_strAuto" value="@siu','@" />@siu'),array("",""),$matches[0][0]);
		$xml=simplexml_load_file($Content, null, LIBXML_NOCDATA);

		if ($xml)
		{
			switch ($this->type) {
				case 'bai-hat':
					$urlSource = explode("?",trim($xml->urlSource));
					$output[] = new Track($xml->singer, $xml->title, $xml->singer, $urlSource[0]);
					break;
				
				case 'video-clip':
					$output[] = new Track($xml->item->performer, $xml->item->title, $xml->item->performer, $xml->item->f480);
					break;
				case 'playlist':
				case 'album':
						foreach ($xml->item as $key => $item) {
							$source = curlClass::getInstance()->getRedirectURL($item->source);
							$output[] = new Track($item->performer, $item->title, $item->performer, $source);
						}
						break;
			}
		}
		return $output;
	}
}