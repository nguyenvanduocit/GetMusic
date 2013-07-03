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

		switch ($urlInfo['host']) {
			case 'mp3.zing.vn':
					$ZingMp3 = new ZingMp3();
					$trackList = $ZingMp3->GetTrack($_GET["url"]);
				break;
			case 'soundcloud.com':
					$Soundcloud = new SoundcloudAPI();
					$trackList = $Soundcloud->GetTrack($_GET["url"]);
				break;
			case 'www.nhaccuatui.com':
					$NhacCuaTui = new NhacCuaTui();
					$trackList = $NhacCuaTui->GetTrack($_GET["url"]);
				break;

			case (preg_match('/.*zippyshare.com.*/', $urlInfo['host']) ? true : false) :
					$ZippyShare = new ZippyShare();
					$trackList = $ZippyShare->GetTrack($_GET["url"]);
				break;
		}
		$trackCount = count($trackList);
		for ($i=0; $i < count($trackList); $i++) { 
			$PlaylistMaker->AddTrack($trackList[$i]);
		}
		echo $PlaylistMaker->MakePlaylist();
	}
?>