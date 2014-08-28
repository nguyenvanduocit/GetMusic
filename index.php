<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//senvietlaptrinhhotro.appspot.com/laptrinh/demo/global/styles/theme.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
            </button>
            <a class="navbar-brand" href="http://laptrinh.senviet.org">Trang chủ</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Demo</a></li>
                <li><a href="https://github.com/nguyenvanduocit/GetMusic">Tải mã nguồn</a></li>
                <li><a href="http://laptrinh.senviet.org/lap-trinh-web/get-link-bai-hat-album-video-bang-php/">Quay lại trang hướng dẫn</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="jumbotron">
    <div class="container">
        <h1>Song Stealing Generator</h1>
        <div class="row">
            <div class="col-md-4" id="element1">
                <h2>Zing MP3</h2>
                <object type="application/x-shockwave-flash" data="xspf_player.swf?playlist_url=playlistGenerator1.xspf&autoplay=1&autoload=1&color=99CCFF&player_mode=small"" height="170" width="200" >
                    <param name="movie" value="xspf_player.swf?playlist_url=playlistGenerator1.xspf&autoplay=1&autoload=1&color=99CCFF&player_mode=small"" />
                    <param name="allownetworking" value="internal" />
                    <param name="allowScriptAccess" value="never" />
                    <param name="enableJSURL" value="false" />
                    <param name="enableHREF" value="false" />
                    <param name="saveEmbedTags" value="true" />
                    <param name="quality" value="high" />
                    <param name="wmode" value="transparent" />
                </object>
            </div>
            <div class="col-md-4" id="element2">
                <h2>Sound Cloud</h2>
                <object type="application/x-shockwave-flash" data="xspf_player.swf?playlist_url=playlistGenerator2.xspf&autoplay=0&autoload=1&color=99CCFF&player_mode=small"" height="170" width="200" >
                    <param name="movie" value="xspf_player.swf?playlist_url=playlistGenerator2.xspf&autoplay=0&autoload=1&color=99CCFF&player_mode=small"" />
                    <param name="allownetworking" value="internal" />
                    <param name="allowScriptAccess" value="never" />
                    <param name="enableJSURL" value="false" />
                    <param name="enableHREF" value="false" />
                    <param name="saveEmbedTags" value="true" />
                    <param name="quality" value="high" />
                    <param name="wmode" value="transparent" />
                </object>
            </div>
            <div class="col-md-4" id="element3">
                <h2>Nhạc số</h2>
                <object type="application/x-shockwave-flash" data="xspf_player.swf?playlist_url=playlistGenerator3.xspf&autoplay=0&autoload=1&color=99CCFF&player_mode=small"" height="170" width="200" >
                    <param name="movie" value="xspf_player.swf?playlist_url=playlistGenerator3.xspf&autoplay=0&autoload=1&color=99CCFF&player_mode=small"" />
                    <param name="allownetworking" value="internal" />
                    <param name="allowScriptAccess" value="never" />
                    <param name="enableJSURL" value="false" />
                    <param name="enableHREF" value="false" />
                    <param name="saveEmbedTags" value="true" />
                    <param name="quality" value="high" />
                    <param name="wmode" value="transparent" />
                </object>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <footer>
        <p>© Sen Viet 2014</p>
    </footer>
</div>
</body>
</html>
