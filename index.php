<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
        <title></title>
        <script type="text/javascript" src="js/imageLoader.js"></script>
        <script type="text/javascript" src="js/jquery_1.5-jquery_ui.min.js"></script>
        <script type="text/javascript" src="js/pirobox/pirobox_extended.js"></script>
        <link href="css/pirobox.css" rel="stylesheet" type="text/css" />
        <link href="css/index.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="mapDIV" class="content map" style="display: block;"></div>
        <div>
            <ul id="imageDIV" class="pirobox_gall_box content"></ul>
            <div><a style="width: 120px; height: 90px; display: block;" onclick="javascript:display('mapDIV', 'content');return false;">Zpět</a></div>
        </div>
        <script>getContent("P2", mapCallFunction, mapParserFunction);</script>
    </body>
</html>
