<!DOCTYPE html>
<html>
<head>
<title>Navigateur non supporté</title>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <style type="text/css">
        ul { list-style: none; padding: 0; margin: 0;} .well { margin-top: 40px;}
    </style>
</head>
<body>
    <div class="content">
        <div class="col-md-8 col-md-offset-2">
            <div class="well text-center">
            {!! HTML::image('images/icons/baloons.png', null, ["width" => 100, "height" => 100]) !!}

                <h1>Désolé</h1>
                <h4>Malheureusement, votre navigateur est trop ancien et ne permet pas d'utiliser ce site !</h4>
                <hr/>
                <p>Ce navigateur ne répond plus aux standards du Web actuels.</p>
                <p>Nous vous invitons à utiliser un autre navigateur (gratuit) plus récent tel que :</p>
                <ul>
                    <li><a href="https://www.google.fr/chrome/browser/desktop/">+ Google Chrome</a></li>
                    <li><a href="https://www.mozilla.org/fr/firefox/new/">+ Firefox</a></li>
                    <li><a href="http://windows.microsoft.com/fr-fr/internet-explorer/download-ie">+ Internet explorer (version > 9)</a></li>
                    <li><a href="http://support.apple.com/kb/DL1531?viewlocale=fr_FR">+ Safari</a></li>
                </ul>
                <hr/>
                <p>Merci de votre compréhension</p>
            </div>
        </div>
    </div>
</body>
</html>
