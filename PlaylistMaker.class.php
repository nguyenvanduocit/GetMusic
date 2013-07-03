<?php
require_once 'Track.class.php';
class PlaylistMaker
{
	protected $trackList;

    function __construct() {
        $this->trackList =array();
    }
    //track class
    public function AddTrack($Track)
    {
    	$this->trackList[] = $Track;
    }

    public function MakePlaylist()
    {
    	$output = '<?xml version="1.0" encoding="utf-8"?>';
    	$output .='<playlist version="1"><trackList>';
    	foreach ($this->trackList as $key => $track) {
    		$output .=$track->ToString();
    	}
    	$output .= '</trackList></playlist>';
    	return $output;
    }
}