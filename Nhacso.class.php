<?php
require_once 'Track.class.php';
require_once 'Curl.class.php';
require_once 'GetTrackAbstract.php';

class Nhacso extends GetTrackAbstract{
	
	private $link;
    private $type;

	public function __construct($link = "") {
		$this->link = $link;
        $this->type = $this->checkType($link);
	}

	public function checkType() {
		$regexlink_baihat = '/http\:\/\/(www\.)?nhacso\.net\/(.*)\/[^>]*\.[^>]*\.html/';
		if(preg_match($regexlink_baihat, $this->link,$matches) ==1)
			return $matches[2];
		return null;
	}

	public function GetTrack() {
		
		$output = array();

		$content = curlClass::getInstance()->fetchURL($this->link);
		$regex = '#xmlPath=(.+?)\&#si';
		if(preg_match_all($regex, $content, $matches) == false)
			return new Track();
		$xml=simplexml_load_file($matches[1][0], null, LIBXML_NOCDATA);

		if ($xml)
		{
			switch ($this->type) {
				case 'nghe-nhac':
					$song = $xml->playlist->song;
					$urlSource = trim($song->mp3link);
					$output[] = new Track($song->artist, $song->name, $song->artist, $urlSource);
					break;
				
				case 'xem-video':
					$output[] = new Track($xml->track->name, $xml->track->name, $xml->track->name, $xml->track->sourceUrl);
					break;
				case 'nghe-playlist':
				case 'nghe-album':
						$songs = $xml->playlist->song;
						foreach ($songs as $key => $song) {
							$output[] = new Track($song->artist, $song->name, $song->artist, trim($song->mp3link));
						}
						break;
			}
		}
		return $output;
	}
}