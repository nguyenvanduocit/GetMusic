<?php
require_once 'Track.class.php';
require_once 'Curl.class.php';
require_once 'GetTrackAbstract.php';

class ZippyShare extends GetTrackAbstract{
	
	private $link;

	public function __construct($link = "") {
		$this->link = $link;
	}


	public function GetTrack() {
		$output = array();

		$url=explode('/',$this->link);
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
        $protocol = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        $url = $_SERVER['REQUEST_URI']; //returns the current URL
        $parts = explode('/',$url);
        $dir = $_SERVER['SERVER_NAME'];
        for ($i = 0; $i < count($parts) - 1; $i++) {
            $dir .= $parts[$i] . "/";
        }
        return $protocol.$dir;
    }
}