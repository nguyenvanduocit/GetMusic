<?php
require_once 'Track.class.php';
require_once 'Curl.class.php';
require_once 'GetTrackAbstract.php';
	class SoundcloudAPI extends GetTrackAbstract
	{
		protected $clientID;
		protected $track;
		protected $link;
        private $type;
        private $id;

	    function __construct($link = "") {
	        $this->clientID = "69b6a6bc4f7d483fd21b170137a9cd51";
	        $this->link = $link;
            $this->type = $this->checkType();
            $this->id = $this->GetTrackID();
	    }

		protected function GetTrackID()
		{
			$pattern = '/[^>]*soundcloud.com\/[^>]*\/(.*)/s';
			if(preg_match($pattern, $this->link, $matches)) {
                return $matches[1];
            }
            else{
                return false;
            }
		}

		public function checkType() {
			//sound set
			$pattern = '/[^>]*soundcloud.com\/[^>]*\/sets\/(.*)/s';
			if(preg_match($pattern, $this->link,$matches) == 1)
			{
				return "set";
			}
			$pattern = '/[^>]*soundcloud.com\/[^>]*\/(.*)/s';
			if(preg_match($pattern, $this->link,$matches) == 1)
			{
				return "sound";
			}
			return null;
		}

		public function GetTrack()
		{
			$output = array();
	    	if($this->id)
	    	{
	    		
				$fakePath = $this->GetFakePath();
	    		switch ($this->type) {
	    			//https://soundcloud.com/newyorker/the-political-scene-june-13
	    			case 'sound':
	    				$trackinforURL = "http://api.soundcloud.com/resolve.json?url={$this->link}&client_id={$this->clientID}";
	    				$trackJS = json_decode(curlClass::getInstance()->fetchURL($trackinforURL));
	    				var_dump($trackJS);
	    				if($trackJS)
	    				{
		    				$streamURL = $fakePath."soundcloud/$this->clientID/{$trackJS->id}.mp3";
							$output[] = new Track($trackJS->tag_list, $trackJS->title, $trackJS->user->username, $streamURL , $trackJS->genre, $trackJS->artwork_url);			
						}
	    				break;
	    			//https://soundcloud.com/grimeybear/sets/swi-ch
	    			case 'set':
	    				$trackinforURL = "http://api.soundcloud.com/resolve.json?url={$this->link}&client_id={$this->clientID}";
	    				$trackJS = json_decode(curlClass::getInstance()->fetchURL($trackinforURL));
	    				
	    				if($trackJS)
	    				{
	    					$tracks = $trackJS->tracks;
	    					$count = count($tracks);
	    					for ($i=0; $i < $count; $i++) {
	    						$streamURL = $fakePath."soundcloud/$this->clientID/".$tracks[$i]->id.".mp3";
								$output[] = new Track($tracks[$i]->tag_list, $tracks[$i]->title, $tracks[$i]->user->username, $streamURL , $tracks[$i]->genre, $tracks[$i]->artwork_url);				
	    					}
						}
	    				break;
	    		}
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