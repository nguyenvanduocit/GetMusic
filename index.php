<?php
	
	header('Content-Type: text/xml; charset=utf-8');
	header('Cache-Control: max-age=604800');
	header('Content-Transfer-Encoding: binary');

	require_once 'Soundcloud.class.php';
	require_once 'Zingmp3.class.php';
	require_once 'NhacCuaTui.class.php';
	require_once 'ZippyShare.php';

	require_once 'PlaylistMaker.class.php';

	if(isset($_GET["url"]))
	{

		$PlaylistMaker = new PlaylistMaker();
		$trackList  = array();
		$urlInfo = parse_url($_GET["url"]);
		$trackCount = 0;
        $link = $_GET["url"];
        $trackGetter = null;
		switch ($urlInfo['host']) {
			case 'mp3.zing.vn':
                    $trackGetter = new ZingMp3($link);
				break;
			case 'soundcloud.com':
                    $trackGetter = new SoundcloudAPI($link);
				break;
			case 'www.nhaccuatui.com':
                    $trackGetter = new NhacCuaTui($link);
				break;

			case (preg_match('/.*zippyshare.com.*/', $urlInfo['host']) ? true : false) :
                    $trackGetter = new ZippyShare($link);
				break;
		}
        $trackList = $trackGetter->GetTrack();
		$trackCount = count($trackList);
		for ($i=0; $i < count($trackList); $i++) { 
			$PlaylistMaker->AddTrack($trackList[$i]);
		}
		echo $PlaylistMaker->MakePlaylist();
	}