<?php 
header('Content-Type: text/html; charset=utf-8');
#Get list by y1n9
#Bat dau phan chung
$string = $_GET['id'];
if(strstr($string,"ftp:")){
header('Cache-Control: max-age=604800');
header('Content-type: audio/mpeg');
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($string));
readfile($string);

}
$auto = $_GET['auto'];
function grab_link($url)
{
if (strstr($url,".mp3") || strstr($url,".mp4") )
	return $url;
else{
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$header = "Location: ";
$pos = strpos($response, $header);
$pos += strlen($header);
$redirect_url = substr($response, $pos, strpos($response, "\r\n", $pos)-$pos);
return $redirect_url;
}
}

#ket thuc phan chung, bat dau zing.vn

if ( strstr($string,"http://mp3.zing.vn"))
	{
$url= file_get_contents($string);
preg_match('/xmlURL=(.*?)(-xml\/)([a-zA-Z]+)/is',$url, $xml);
$xml = trim ($xml[1].$xml[2].$xml[3]);
 $data = str_replace(array("<![CDATA[","]]>"),"",file_get_contents($xml));
 
 
if ( strstr($string,"/bai-hat/") ||strstr($string,"/video-clip/") || strstr($string,"/album/")|| strstr($string,"/playlist/"))
	{
	
	$data=preg_replace('/<suggest>(.*?)<\/suggest>/is',' ',$data);
	
	if (strstr($data,'<f480>'))
		$sr="f480";
	else	$sr="source";
	

    $song = preg_split('/<item type="(.*?)">/',$data);
    	
    $xml = '<?xml version="1.0" encoding="utf-8"?>	
    <playlist version="1"><trackList>';
			if ($_GET['type']=='pig') {
			$xml1='<!-- Music For Blog by y1n9 -->'.'<player showDisplay="yes" showPlaylist="yes" autoStart="'.$auto.'">'.''; }
		
    for($i=1;$i<count($song);$i++)
    {
if(preg_match('#<title>(.*?)<\/title>(.*?)<performer>(.*?)<\/performer>(.*?)<'.$sr.'>(.*?)<\/'.$sr.'>#is',$song[$i],$name) )
	
	$xml .= '<track>'.
'<annotation>'.htmlspecialchars($name[3]).' - '.htmlspecialchars($name[1]).'</annotation>'.
'<title>'.htmlspecialchars($name[3]).'</title>'.'<creator>'.htmlspecialchars($name[1]).'</creator>'.'
<location>'.grab_link(htmlspecialchars($name[5])).'</location>'.'
</track>';

			if ($_GET['type']=='pig') { $xml1.='<song path="'.htmlspecialchars($name[5]).'" title="'.htmlspecialchars($name[3]).' - '.htmlspecialchars($name[1]).'" />'.''; }
}   
        
        $xml .='<track>
					<title>Insertion Tool Music And Flash - wWw.y1n9.com </title>
					<creator>Avira Nguyen </creator>
					<annotation>Avira Nguyen - Insertion Tool Music And Flash - wWw.y1n9.com</annotation>
					<location>http://nct.y1n9.com/Sound/Play.mp3</location>
					<info>http://nct.y1n9.com/Sound/Play.mp3</info>

					<image> </image>
				

				</track>
			</trackList>
		</playlist> ';


	
if ($_GET['type']=='pig') { $xml1.='</player>'; 
    echo $xml1; }
	else { echo $xml;} 
	}
	
}

#Ket thuc zing.vn, Bat dau nhaccuatui 
else {
if ( strstr($string,"http://www.nhaccuatui.com"))
	{
	
$get_link = file_get_contents($string);
preg_match('/<link rel="video_src" href="(.*?)"/is',$get_link, $url);
$url=$url[1];
$rd=grab_link($url);
preg_match('/file=(.*?)&/is',$rd, $xmlurl);
$xmlurl=$xmlurl[1];
$xml=file_get_contents($xmlurl);
$data = str_replace(array("<![CDATA[","]]>"),"",$xml);
$link=explode('<location>',$data);
$link=explode('</location>',$link[1]);
    $song = explode('<track>',$data);

    $xml = '<?xml version="1.0" encoding="utf-8"?>
	
    <playlist version="1"><trackList>';
	if ($_GET['type']=='pig') {
			$xml1='<!-- Music For Blog by y1n9 -->'.'<player showDisplay="yes" showPlaylist="yes" autoStart="'.$auto.'">'.''; }
    for($i=1;$i<count($song);$i++)
    {
    if(preg_match('#<title>(.*?)<\/title>(.*?)<creator>(.*?)<\/creator>(.*?)<location>(.*?)<\/location>(.*?)<info>(.*?)<\/info>(.*?)<image>(.*?)<\/image>#is',$song[$i],$name))
	$xml .= '<track>'.
'<annotation>'.trim(htmlspecialchars($name[3])).' - '.trim(htmlspecialchars($name[1])).'</annotation>'.
'<title>'.trim(htmlspecialchars($name[3])).'</title>'.'<creator>'.trim(htmlspecialchars($name[1])).'</creator>'.'
<location>'.trim(htmlspecialchars($name[5])).'</location>'.'
</track>';
if ($_GET['type']=='pig') { $xml1.='<song path="'.trim(htmlspecialchars($name[5])).'" title="'.trim(htmlspecialchars($name[3])).' - '.trim(htmlspecialchars($name[1])).'" />'.''; }
}    
      
         $xml .='<track>
<title> Insertion Tool Music And Flash - wWw.y1n9.com </title>
<creator>Avira Nguyen</creator>
<annotation>Avira Nguyen - Insertion Tool Music And Flash - wWw.y1n9.com</annotation>
<location>http://nct.y1n9.com/Sound/Play.mp3</location>
<info>http://nct.y1n9.com/Sound/Play.mp3</info>


					<image> </image>
				

				</track>
			</trackList>
		</playlist> ';

    if ($_GET['type']=='pig') { $xml1.='</player>'; 
    echo $xml1; }
	else { echo $xml;}}
if ( strstr($string,"zippyshare.com/v"))
	{
	$link=explode('/',$string);
	$url='http://'.$link[2].'/downloadMusic?key='.$link[4];	
	$xml = '<?xml version="1.0" encoding="utf-8"?>
    <playlist version="1">
<trackList>
<track>
<annotation></annotation>
<title></title>
<creator></creator>
<location>'.$url.'&type=flv</location>
</track>
</trackList>
</playlist>';
echo $xml;
}
}
?> 


