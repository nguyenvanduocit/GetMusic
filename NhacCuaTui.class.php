<?php
require_once 'Track.class.php';
require_once 'Curl.class.php';
require_once 'GetTrackAbstract.php';

class NhacCuaTui extends GetTrackAbstract{
	
	private $link;

	public function __construct($link = "") {
		$this->link = $link;
	}

	protected function GetTrackID($link = "")
	{
		return null;
	}

	public function checkType($link = "") {
		if($link == "")
		{
			$link = $this->link;
		}
		$regexlink_baihat = '/http\:\/\/(www\.)?nhaccuatui\.com\/(.*)\/[^>]*\.[^>]*\.html/';
		if(preg_match($regexlink_baihat, $link,$matches)==1)
			return $matches[2];
		return null;
	}

	public function GetTrack($link = "") {
		
		$output = array();

		if($link == "")
		{
			$link = $this->link;
		}

		$content = curlClass::getInstance()->fetchURL($link);
		$regex = '/<link rel="video_src" href="(.*?)"/is';
		preg_match($regex, $content, $matches);
		$Content = curlClass::getInstance()->getRedirectURL($matches[1]);
		$regex = '/file=(.*)&autostart/';
		preg_match($regex, $Content, $matches);
		$Content = $matches[1];
		$xml=simplexml_load_file($Content, null, LIBXML_NOCDATA);

		if ($xml)
		{
			$type = $this->checkType($link);

			switch ($type) {
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