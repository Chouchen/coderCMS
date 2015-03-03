<? 
session_start();
include '../class/XMLSQL.php';
$i = $_GET['i'];
$m = $_GET['m'];
$DB = new XMLSQL('../db/database.xml');
if(!$DB->isLoaded())
	echo '<span class="error">erreur de chargement de la base.</span>';
else{
	$DB->delete()->from($m)->where($i);
	try{
		if($DB->query())
			header('Location: ../admin');
		else
			echo '<span class="error">suppression impossible.</span>';
	}catch(Exception $e){
		echo '<span class="error">suppression impossible. '.$e->getMessage().'</span>';
	}
}
