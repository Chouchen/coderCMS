<!doctype html>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">

  <!-- www.phpied.com/conditional-comments-block-downloads/ -->
  <!--[if IE]><![endif]-->

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Snippets et Projets :: Shikiryu :: v1</title>
  <meta name="description" content="Projets et snippets de Shikiryu - Clément Desmidt">
  <meta name="author" content="Clément Desmidt - Shikiryu">

  <!--  Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">


  <!-- CSS : implied media="all" -->
  <link rel="stylesheet" href="css/style.css?v=1">

  <!-- For the less-enabled mobile browsers like Opera Mini -->
  <!-- <link rel="stylesheet" media="handheld" href="css/handheld.css?v=1"> -->

  <!-- CSS : blueprint Framework -->
  <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen, projection">
  <link rel="stylesheet" href="css/print.css" type="text/css" media="print">
  <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

  <!-- Import fancy-type plugin for the sample page. -->
  <link rel="stylesheet" href="css/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
  
  <!-- Import silk sprites plugin -->
  <link rel="stylesheet" href="css/plugins/sprites/sprite.css">
  
  <!-- Import buttons plugin // add nice button instead of input button -->
  <link rel="stylesheet" href="css/plugins/buttons/screen.css">
  
  <!-- Import link-icons plugin // add icons depending of type of link / file -->
  <link rel="stylesheet" href="css/plugins/link-icons/screen.css">
  
  <link rel="stylesheet" href="css/override.css"> 
  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="js/modernizr-1.6.min.js"></script>

</head>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->

<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div class="container">
	
		<header>
			<form action="" method="get">
				<input type="search" placeholder="Rechercher..." name="q" />
				<input type="submit" value="Go!" />			
			</form>
			<hr/>
			<!-- <hr class="space" /> -->
			<h2 class="alt">Projets de Clément Desmidt <small class="small">- pour les tentatives + ou - réussies, il y a le <a href="http://labs.shikiryu.com/">lab</a></small></h2>
			<? include 'class/XMLSQL.php';
				if(isset($_GET['q']))
					$q 	= $_GET['q'];	
				$DB = new XMLSQL('db/database.xml');
				if(!$DB->isLoaded())
					echo 'erreur de chargement de la base.';
			?>
		</header>
	
		<div id="container">
		
		<div class="span-5 colborder">
			<h3>Outils et liens</h3>
			<ul>
			<?
				$DB->select()->from('tools');
				foreach($DB->query() as $tool){
					if(isset($q)){
						foreach($tool["childs"] as $childs){
							if(preg_match("/".$q."/i", $childs))
								echo '<li><a href="'.$tool["childs"]["link"].'">' . $tool["childs"]["text"] . '</a></li>';
						}
					}else
					echo '<li><a href="'.$tool["childs"]["link"].'">' . $tool["childs"]["text"] . '</a></li>';
				}
				?>
			</ul>
		</div>
		<div class="span-18 last projects">
			<h3>Projets</h3>
			<?
				$DB->select()->from('projects');
				$i = 1;
				foreach($DB->query() as $project){
					if(isset($q)){
						foreach($project["childs"] as $childs){
							if(preg_match("/".$q."/i", $childs)){
								echo '<div class="span-8';
								if($i%2 == 0) echo ' last prepend-1';
									/*echo'">
									<h4><a href="' . $project["childs"]["link"] . '">' . $project["childs"]["title"] . '</a></h4>
									<p>' . $project["childs"]["text"] . '</p>
									</div>';*/
									echo'">
									<h4 class="projectLink" id="'.$project["attributes"]["id"].'">' . $project["childs"]["title"] . '</h4>
									</div>';									
								if($i%2 == 0) echo '<hr class="space"/>';
								$i++;
							}
						}
					}else{
						echo '<div class="span-8';
						if($i%2 == 0) echo ' last prepend-1';
						/*echo'">
								<h4><a href="' . $project["childs"]["link"] . '">' . $project["childs"]["title"] . '</a></h4>
								<p>' . $project["childs"]["text"] . '</p>
								</div>';	*/
								echo'">
								<h4 class="projectLink" id="'.$project["attributes"]["id"].'">' . $project["childs"]["title"] . '</h4>
								</div>';
						if($i%2 == 0) echo '<hr class="space"/>';
						$i++;
					}
				}
			?>
			<hr class="space"/>
			<!-- <h3>Snippets</h3>
			<?
				$DB->select()->from('snippets');
				$i = 1;
				foreach($DB->query() as $snippet){
					if(isset($q)){
						foreach($snippet["childs"] as $childs){
							if(preg_match("/".$q."/i", $childs)){
								echo '<div class="span-8';
								if($i%2 == 0) echo ' last prepend-1';
									echo'">
									<h4><a href="' . $snippet["childs"]["link"] . '">' . $snippet["childs"]["title"] . '</a></h4>
									<code>' . $snippet["childs"]["text"] . '</code>
									</div>';	
								if($i%2 == 0) echo '<hr class="space"/>';
								$i++;
							}
						}
					}else{
						echo '<div class="span-8';
						if($i%2 == 0) echo ' last prepend-1';
						echo'">
								<h4><a href="' . $snippet["childs"]["link"] . '">' . $snippet["childs"]["title"] . '</a></h4>
								<xmp>' . $snippet["childs"]["text"] . '</xmp>
								</div>';	
						if($i%2 == 0) echo '<hr class="space"/>';
						$i++;
					}
				}
			?> -->
		</div>
		<div class="project span-18 last">
			<h3></h3>
		</div>
		</div>
		
  
		<footer>
			<hr class="space" />
			<hr/>
			<span>©2010 Shikiryu - <a href="/code">Accueil</a> - <a href="http://labs.shikiryu.com/">Labs</a> - <a href="http://chouchen.tumblr.com/">Blog</a> - <a href="http://cv.shikiryu.com/">CV</a> - <a href="http://shikiryu.com/contact/">Contact</a> - <a href="admin/">Admin</a></span>
		</footer>
	</div> <!--! end of #container -->

  <!-- Javascript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script>!window.jQuery && document.write('<script src="js/jquery-1.4.2.min.js"><\/script>')</script>


  <script src="js/plugins.js?v=1"></script>
  <script src="js/script.js?v=1"></script>

  <!--[if lt IE 7 ]>
    <script src="js/dd_belatedpng.js?v=1"></script>
  <![endif]-->

  <!-- asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet 
       change the UA-XXXXX-X to be your site's ID -->
  <!-- <script>
   var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
   (function(d, t) {
    var g = d.createElement(t),
        s = d.getElementsByTagName(t)[0];
    g.async = true;
    g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g, s);
   })(document, 'script');
  </script> -->
  
</body>
</html>