<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Use the .htaccess and remove these lines to avoid edge case issues.
More info: h5bp.com/b/378 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?= $STRINGTABLE['site.title'] ?></title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width,initial-scale=1">

<!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

<!-- CSS: implied media=all -->
<link rel="stylesheet" href="/css/fluid_grid.css">

<!-- CSS: Styles for jquery-UI -->
<link type="text/css" href="/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<!-- CSS concatenated and minified via ant build script-->
<link rel="stylesheet" href="/css/style.css">
<!-- end CSS-->

<link rel="stylesheet" href="/js/uploadify/uploadify.css" />

<!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

<!-- All JavaScript at the bottom, except for Modernizr / Respond.
Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
<script src="/js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>

<noscript>Bitte aktivieren Sie Javascript in Ihrem Browser</noscript>

<h1><a class="dontprint" href="javascript:window.print()">Liste jetzt drucken</a></h1>

<ul class="sublist" style="max-height: none;">
	<?= $list_content ?>
</ul>


<!-- JavaScript at the bottom for fast page loading -->

<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/js/libs/jquery-1.7.2.min.js"><\/script>')</script>

<script type="text/javascript" src="/js/libs/jquery-ui-1.8.16.custom.min.js"></script>

<!-- scripts concatenated and minified via ant build script-->
<script defer src="/js/plugins.js"></script>
<script defer src="/js/script.js"></script>
<script defer>
	window.print();
</script>
<!-- end scripts-->


<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7 ]>
<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->

</body>
</html>
