<?php
require_once 'Track.class.php';
require_once 'Curl.class.php';
require_once 'GetTrackAbstract.php';

class ZippyShare extends GetTrackAbstract{
	
	private $link;

	public function __construct($link = "") {
		$this->link = $link;
	}

	protected function GetTrackID($link = "")
	{
		return null;
	}

	public function checkLink($link = "") {
		if($link == "")
		{
			$link = $this->link;
		}
		$regexlink_baihat = '/http\:\/\/(www\.)?mp3\.zing\.vn\/.*\/(.*)\.html/';
		if (preg_match($regexlink_baihat, $this->link)) 
			return true;
		return false;
	}

	public function GetTrack($link = "") {
		$output = array();
		if($link == "")
		{
			$link = $this->link;
		}

		$url=explode('/',$link);
		$server = explode('.',$url[2]);
		$fakePath = $this->GetFakePath();

		$urlSource=$fakePath."zippyshare/".$server[0]."/".$url[4].".flv";

		if ($urlSource)
		{
			$output[] = new Track("Manh Vo", "Untitle", "Unknow", $urlSource);
		}
		return $output;
	}
	private function GetFakePath()
	{
		$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
		    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
		} 
		else 
		{
		    $pageURL .= $_SERVER["SERVER_NAME"];
		}
		$requestURIExploded = explode("?", $_SERVER["REQUEST_URI"]);
		return $pageURL.$requestURIExploded[0];
	}
}