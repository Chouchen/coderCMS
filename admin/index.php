<?
session_start();
function isConnect(){
	if(isset($_SESSION['login']) && isset($_SESSION['mdp']))
		return true;
	return false;
}
include '../class/XMLSQL.php';
if(isset($_POST['login']) && isset($_POST['password'])){
	$DB = new XMLSQL('/home/user/database.xml'); // somewhere outside docroot
	$DB->select()->from('identification')->where('1');
	foreach($DB->query() as $ident){
		if($ident["childs"]["login"] == $_POST['login'] && $ident["childs"]["mdp"] == sha1($_POST['password'])){
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['mdp'] = sha1($_POST['password']);
			unset($_SESSION['error']);
		}else{
			$_SESSION['error'] = 'Identification erronée';
		}
	}
}
?>

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
  <link rel="stylesheet" href="../css/style.css?v=1">

  <!-- For the less-enabled mobile browsers like Opera Mini -->
  <!-- <link rel="stylesheet" media="handheld" href="css/handheld.css?v=1"> -->

  <!-- CSS : blueprint Framework -->
  <link rel="stylesheet" href="../css/screen.css" type="text/css" media="screen, projection">
  <link rel="stylesheet" href="../css/print.css" type="text/css" media="print">
  <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

  <!-- Import fancy-type plugin for the sample page. -->
  <link rel="stylesheet" href="../css/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
  
  <!-- Import silk sprites plugin -->
  <link rel="stylesheet" href="../css/plugins/sprites/sprite.css">
  
  <!-- Import buttons plugin // add nice button instead of input button -->
  <link rel="stylesheet" href="../css/plugins/buttons/screen.css">
  
  <!-- Import link-icons plugin // add icons depending of type of link / file -->
  <link rel="stylesheet" href="../css/plugins/link-icons/screen.css">
  
  <link rel="stylesheet" href="../css/override.css">
  
  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="../js/modernizr-1.6.min.js"></script>

</head>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->

<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	<div class="container">
	
		<header>
			<img src="images/logo.png" />
			<hr/>
			<? if(isConnect())
				echo '<a href="disconnect.php" class="ss_sprite ss_disconnect last">Se déconnecter</a>';
				?>
			<!-- <hr class="space" /> -->
			<h2 class="alt">Snippets et Projets de Clément Desmidt <small>: Administration</small></h2>
			<? 
				if(isset($_GET['q']))
					$q 	= $_GET['q'];	
				$DB = new XMLSQL('../db/database.xml');
				if(!$DB->isLoaded())
					echo 'erreur de chargement de la base.';
			?>
		</header>
	
		<div id="container">
		
		<div class="span-5">
			<? if(isConnect()):?>
			<h3>Outils et liens</h3>
			<ul class="nolist">
			<?$DB->select()->from('tools');
			foreach($DB->query() as $tool){
				echo '<li class="ss_sprite ss_bullet_blue"><a href="'.$tool["childs"]["link"].'">' . $tool["childs"]["text"] . '</a> <a href="edit.php?i='.$tool["attributes"]["id"].'&m=tools" class="ss_sprite ss_page_edit fancybox"></a> <a href="delete.php?i='.$tool["attributes"]["id"].'&m=tools" class="ss_sprite ss_cross"></a></li>';
			}
			echo '</ul>';
			endif;?>
			&nbsp;
		</div>
		<div class="span-12">
			<?if(!isConnect()){?>
			<fieldset>
			<legend>Identification</legend>
			<form action="" method="post">
				<input type="text" name="login" placeholder="Identifiant" />
				<input type="password" name="password" placeholder="Mot de passe" />
				<input type="submit" name="submit" value="Go!" />			
			</form>
			</fieldset>
			<?if(isset($_SESSION['error']))
				echo '<span class="error">'.$_SESSION['error'].'</span>';
				
			}else{
			?>			
			<h3>Projets</h3>
			<?
				$DB->select()->from('projects');
				$i = 1;
				foreach($DB->query() as $project){
						echo '<div class="span-5';
						if($i%2 == 0) echo ' last';
						else echo ' colborder';
						echo '">
								<h4><a href="' . $project["childs"]["link"] . '">' . $project["childs"]["title"] . '</a> <a href="edit.php?i='.$project["attributes"]["id"].'&m=projects" class="ss_sprite ss_page_edit fancybox"></a> <a href="delete.php?i='.$project["attributes"]["id"].'&m=projects" class="ss_sprite ss_cross"></a></h4>
								</div>';	
						if($i%2 == 0) echo '<hr/>';
						$i++;
					
				}
			
			?>
			<hr class="space"/>	
			<h3>Snippets</h3>
			<?
				$DB->select()->from('snippets');
				$i = 1;
				foreach($DB->query() as $snippet){
						echo '<div class="span-5';
						if($i%2 == 0) echo ' last';
						else echo ' colborder';
						echo '">
								<h4><a href="' . $snippet["childs"]["link"] . '">' . $snippet["childs"]["title"] . '</a> <a href="edit.php?i='.$snippet["attributes"]["id"].'&m=snippets" class="ss_sprite ss_page_edit fancybox"></a> <a href="delete.php?i='.$snippet["attributes"]["id"].'&m=snippets" class="ss_sprite ss_cross"></a></h4>
								</div>';	
						if($i%2 == 0) echo '<hr/>';
						$i++;
					
				}
			}
			?>			
		</div>
		<div class="span-5 last">
			<? if(isConnect()):?>
			<h3>Ajouter</h3>
			<ul class="nolist">
				<li><a href="add.php?w=tool" class="ss_sprite ss_add fancybox">Outil ou liens</a></li>
				<li><a href="add.php?w=project" class="ss_sprite ss_add fancybox">Projet</a></li>
				<li><a href="add.php?w=snippet" class="ss_sprite ss_add fancybox">Snippets</a></li>			
			</ul>
			<? endif; ?>
			&nbsp;
		</div>
		
		</div>
		
  
		<footer>
			<hr class="space" />
			<hr/>
			<span>©2010 Shikiryu - <a href="/code">Accueil</a> - <a href="http://labs.shikiryu.com/">Labs</a> - <a href="http://chouchen.tumblr.com/">Blog</a> - <a href="http://cv.shikiryu.com/">CV</a> - <a href="">Admin</a></span>
		</footer>
	</div> <!--! end of #container -->

  <!-- Javascript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script>!window.jQuery && document.write('<script src="../js/jquery-1.4.2.min.js"><\/script>')</script>
	<!-- FANCYBOX -->
	 <script src="../js/fancybox/jquery.fancybox-1.3.2.pack.js"></script>
	  <script src="../js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	   <script src="../js/fancybox/jquery.easing-1.3.pack.js"></script>
	   <link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.2.css">

  <script src="../js/plugins.js?v=1"></script>
  <script src="../js/script.js?v=1"></script>

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