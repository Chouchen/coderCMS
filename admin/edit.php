<? 
session_start();
include '../class/XMLSQL.php';
$i = $_REQUEST['i'];
$m = $_REQUEST['m'];
$DB = new XMLSQL('../db/database.xml');
if(!$DB->isLoaded())
	echo '<span class="error">erreur de chargement de la base.</span>';
else{
	switch($m){
	case 'tools':
		if(!isset($_POST['submit'])):
		$DB->select()->from($m)->where($i);
		$values = $DB->query();
		?>
		<fieldset>
		<legend>Ajouter un outil ou un lien intéressant</legend>
		<form action="edit.php" method="post">
			<input type="text" name="link" value="<?=$values[0]["childs"]["link"]?>" />
			<input type="text" name="text" value="<?=$values[0]["childs"]["text"]?>" />
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="i" value="<?=$i?>" />
			<input type="submit" name="submit" value="Enregistrer" />
		</form>
		</fieldset>
		<?
		else:
			$DB->update($m)->set(array('link'=>$_POST['link'], 'text'=>$_POST['text']))->where($i);
			try{
				if($DB->query())
					header('Location: ../admin');
				else
					echo '<span class="error">sauvegarde impossible.</span>';
			}catch(Exception $e){
				echo '<span class="error">sauvegarde impossible. '.$e->getMessage().'</span>';
			}
		
		endif;
		break;
	case 'projects':
		if(!isset($_POST['submit'])):
		$DB->select()->from($m)->where($i);
		$values = $DB->query();
		?>
		<fieldset>
		<legend>Ajouter un nouveau projet</legend>
		<form action="edit.php" method="post">
			<input type="text" name="link" value="<?=$values[0]["childs"]["link"]?>" />
			<input type="text" name="title" value="<?=$values[0]["childs"]["title"]?>" />
			<textarea name="text"><?=str_replace(array("\r\n", "\r", "\n", "<br/>", chr(13), "&lt;br /&gt;", "<br />" ), "\n", $values[0]["childs"]["text"])?></textarea>
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="i" value="<?=$i?>" />
			<input type="submit" name="submit" value="Enregistrer" />
		</form>
		</fieldset>
		<?
		else:
		$DB->update($m)->set(array('link'=>$_POST['link'], 'text'=>nl2br($_POST['text']), 'title'=>$_POST['title']))->where($i);
			try{
				if($DB->query())
					header('Location: ../admin');
				else
					echo '<span class="error">sauvegarde impossible.</span>';
			}catch(Exception $e){
				echo '<span class="error">sauvegarde impossible. '.$e->getMessage().'</span>';
			}
		endif;
		break;
	case 'snippets':
		if(!isset($_POST['submit'])):
		$DB->select()->from($m)->where($i);
		$values = $DB->query();
		?>
		<fieldset>
		<legend>Ajouter un nouveau snippet</legend>
		<form action="edit.php" method="post">
			<input type="text" name="link" value="<?=$values[0]["childs"]["link"]?>" />
			<input type="text" name="title" value="<?=$values[0]["childs"]["title"]?>" />
			<textarea name="text"><?=str_replace(array("\r\n", "\r", "\n", "<br/>", chr(13), "&lt;br /&gt;", "<br />" ), "\n", $values[0]["childs"]["text"])?></textarea>
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="i" value="<?=$i?>" />
			<input type="submit" name="submit" value="Enregistrer" />
		</form>
		</fieldset>
		<?
		else:
		$DB->update($m)->set(array('link'=>$_POST['link'], 'text'=>nl2br($_POST['text']), 'title'=>$_POST['title']))->where($i);
			try{
				if($DB->query())
					header('Location: ../admin');
				else
					echo '<span class="error">sauvegarde impossible.</span>';
			}catch(Exception $e){
				echo '<span class="error">sauvegarde impossible. '.$e->getMessage().'</span>';
			}
		endif;
		break;
	default:
		$_SESSION['error'] = 'You can\'t add this.';
		break;	
}
}