<?php
class Track
{
	protected $annotation;
	protected $title;
	protected $creator;
	protected $location;
	protected $info;
	protected $image;

    function __construct($annotation="Unknow", $title="Unknow", $creator="Unknow", $location="", $info="Unknow", $image="") {
        $this->annotation 	= $this->getPlainText($annotation);
        $this->title 		= $this->getPlainText($title);
        $this->creator 		= $this->getPlainText($creator);
        $this->location 	= $this->getPlainText($location);
        $this->info 		= $this->getPlainText($info);
        $this->image 		= $this->getPlainText($image);
    }
    private function getPlainText($string)
    {
        return preg_replace("/[\n\r]/","",trim($string));
    }
    public function ToString()
    {
        $output ="<track>"; 
        if($this->title != "")
            $output .= "<title>$this->title</title>";

        if($this->creator != "")
            $output .= "<creator>$this->creator</creator>";
        if($this->annotation != "")
            $output .= "<annotation>$this->annotation</annotation>";
        if($this->location != "")
            $output .="<location>$this->location</location>";
        if($this->info != "")
            $output .="<info>$this->info</info>";
        if($this->image != "")
            $output .= "<image>$this->image</image>";
        $output .= "</track>";
    	return $output;
    }
}