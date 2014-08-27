<?php
require_once 'Track.class.php';
require_once 'Curl.class.php';
require_once 'GetTrackAbstract.php';

class NhacCuaTui extends GetTrackAbstract{
	
	private $link;
    private $type;

	public function __construct($link = "") {
		$this->link = $link;
        $this->type = $this->checkType();
	}

	public function checkType() {
		$regexlink_baihat = '/http\:\/\/(www\.)?nhaccuatui\.com\/(.*)\/[^>]*\.[^>]*\.html/';
		if(preg_match($regexlink_baihat, $this->link,$matches)==1)
			return $matches[2];
		return null;
	}

	public function GetTrack() {
		
		$output = array();

		$content = curlClass::getInstance()->fetchURL($this->link);
		$regex = '/<link rel="video_src" href="(.*?)"/is';
		preg_match($regex, $content, $matches);
		$Content = curlClass::getInstance()->getRedirectURL($matches[1]);
		$regex = '/file=(.*)&autostart/';
		preg_match($regex, $Content, $matches);
		$Content = $matches[1];
		$xml=simplexml_load_file($Content, null, LIBXML_NOCDATA);

		if ($xml)
		{
			switch ($this->type) {
				case 'bai-hat':
					$output[] = new Track(trim($xml->track->creator), $xml->track->title, $xml->track->creator, $xml->track->location, $xml->track->info, $xml->track->image);
					break;
				case 'playlist':
					$count = count($xml->track);
					for ($i=0; $i < $count; $i++) { 
						$output[] = new Track(trim($xml->track[$i]->creator), $xml->track[$i]->title, $xml->track[$i]->creator, $xml->track[$i]->location, $xml->track[$i]->info, $xml->track[$i]->image);
					}					
					break;
			}
		}
		return $output;
	}
}