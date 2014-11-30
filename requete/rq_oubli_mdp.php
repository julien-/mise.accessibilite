<?php 
include_once('../lib/autoload.inc.php');
session_start();

$db = DBFactory::getMysqlConnexionStandard();

$erreur = false;

if (isset($_GET["oubli_mdp"]))
{	
	if (isset($_POST['pseudo_oubli']) && !empty($_POST['pseudo_oubli']))
		$pseudo = Outils::securite_bdd_string($_POST['pseudo_oubli']);
	else
		$erreur = true;
	
	if (isset($_POST['email_oubli'])  && !empty($_POST['email_oubli']))
		$mail = Outils::securite_bdd_string($_POST['email_oubli']);
	else
		$erreur = true;
	
	if($erreur == false)//Si le login et le mail ne sont pas invalides ou vides
	{	
		$daoEtudiant = new DAOEtudiant($db);
		
		if ($daoEtudiant->existsByPseudoAndMail($pseudo, $mail))
		{
			$daoOubliPassword = new DAOOubliPassword($db);
			
			//Recuperation de l'etudiant
			$etudiant = $daoEtudiant->getByPseudo($pseudo);
			//Clé de verification
			$cle = md5(uniqid(rand(), true));
			//Date limite modification
			$date_limite = date("Y-m-d", mktime (date("m" ) ,date("d" )+1,date("Y" )));
			$oubli = new OubliPassword(array('etudiant' => $etudiant, 'cle' => $cle, 'date' => $date_limite));
			$daoOubliPassword->save($oubli);
			
			// Le message
			$message = "Bonjour ".$etudiant->getPrenomNom().",\r\n\nVoici le lien pour modifier votre Mot de passe : projetir.free.fr/index.php?cle=".$cle."\r\nVous avez jusqu'à demain 23h59 pour modifier votre Mot de passe\r\nUne fois ce délai dépassé vous devrez refaire une demande de modification du Mot de passe\r\n\nCordialement";
			
			// Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
			$message = wordwrap($message, 70, "\r\n");
			
			$objet = "MyStudyCompanion - Oubli du mot de passe";
			
			$headers = 	'From: webmaster@example.com' . "\r\n" .
						'Reply-To: webmaster@example.com' . "\r\n";
			
			// Envoi du mail
			mail($mail, $objet, $message, $headers);
			$_SESSION['mailEnvoye'] = 'true';
		}	
		else
			$_SESSION['utilisateurInconnu'] = 'true';
	}
}

header('Location: ' . $_SESSION['referrer']);
