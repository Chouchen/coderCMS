<? 
include 'class/XMLSQL.php';
if(isset($_GET['q']))
	$q 	= $_GET['q'];	
$DB = new XMLSQL('db/database.xml');
if(!$DB->isLoaded())
	echo 'erreur de chargement de la base.';
$DB->select()->from('projects')->where($q);
$request = $DB->query();
$request = $request[0];
echo json_encode($request);