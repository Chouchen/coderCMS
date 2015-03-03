<? 
session_start();
include '../class/XMLSQL.php';
$w	= $_REQUEST['w'];

switch($w){
	case 'tool':
		if(!isset($_POST['submit'])):
		?>
		<fieldset>
		<legend>Ajouter un outil ou un lien intéressant</legend>
		<form action="add.php" method="post">
			<input type="text" name="link" placeholder="Lien" />
			<input type="text" name="text" placeholder="Nom" />
			<input type="hidden" name="w" value="<?=$w?>" />
			<input type="submit" name="submit" value="Enregistrer" />
		</form>
		</fieldset>
		<?
		else:
		$DB = new XMLSQL('../db/database.xml');
		if(!$DB->isLoaded())
			echo '<span class="error">erreur de chargement de la base.</span>';
		else{
			$DB->insert(array('link'=>$_POST['link'], 'text'=>$_POST['text']))->into('tools');
			try{
				if($DB->query())
					header('Location: ../admin');
				else
					echo '<span class="error">sauvegarde impossible.</span>';
			}catch(Exception $e){
				echo '<span class="error">sauvegarde impossible. '.$e->getMessage().'</span>';
			}
		}
		endif;
		break;
	case 'project':
		if(!isset($_POST['submit'])):
		?>
		<fieldset>
		<legend>Ajouter un nouveau projet</legend>
		<form action="add.php" method="post">
			<input type="text" name="link" placeholder="Lien" />
			<input type="text" name="title" placeholder="Titre" />
			<textarea name="text" placeholder="Blabla" />
			<input type="hidden" name="w" value="<?=$w?>" />
			<input type="submit" name="submit" value="Enregistrer" />
		</form>
		</fieldset>
		<?
		else:
		$DB = new XMLSQL('../db/database.xml');
		if(!$DB->isLoaded())
			echo '<span class="error">erreur de chargement de la base.</span>';
		else{
			$DB->insert(array('link'=>$_POST['link'], 'text'=>nl2br($_POST['text']), 'title'=>$_POST['title']))->into('projects');
			try{
				if($DB->query())
					header('Location: ../admin');
				else
					echo '<span class="error">sauvegarde impossible.</span>';
			}catch(Exception $e){
				echo '<span class="error">sauvegarde impossible. '.$e->getMessage().'</span>';
			}
		}
		endif;
		break;
	case 'snippet':
		if(!isset($_POST['submit'])):
		?>
		<fieldset>
		<legend>Ajouter un nouveau snippet</legend>
		<form action="add.php" method="post">
			<input type="text" name="link" placeholder="Lien" />
			<input type="text" name="title" placeholder="Titre" />
			<textarea name="text" placeholder="Blabla" />
			<input type="hidden" name="w" value="<?=$w?>" />
			<input type="submit" name="submit" value="Enregistrer" />
		</form>
		</fieldset>
		<?
		else:
		$DB = new XMLSQL('../db/database.xml');
		if(!$DB->isLoaded())
			echo '<span class="error">erreur de chargement de la base.</span>';
		else{
			$DB->insert(array('link'=>$_POST['link'], 'text'=>nl2br($_POST['text']), 'title'=>$_POST['title']))->into('snippets');
			try{
				if($DB->query())
					header('Location: ../admin');
				else
					echo '<span class="error">sauvegarde impossible.</span>';
			}catch(Exception $e){
				echo '<span class="error">sauvegarde impossible. '.$e->getMessage().'</span>';
			}
		}
		endif;
		break;
	default:
		$_SESSION['error'] = 'You can\'t add this.';
		break;	
}


