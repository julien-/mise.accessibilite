<table class="tableau">
            <thead>
                <tr>
                    <th>
                        Auteur
                    </th>
                    <th>
                        Messages
                    </th>
                    <?php
                    if ($_SESSION['currentUser']->getAdmin())
                    {
                    ?>
                        <th>
                            Supprimer
                        </th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>
	<?php

        
	// on va scanner tous les tuples un par un
	while ($data = mysql_fetch_array($req)) {

	// on décompose la date
	sscanf($data['date_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

	// on affiche les résultats
	echo '<tr>';
	echo '<td class="autre_colonne" style="vertical-align: top;">';

	// on affiche le nom de l'auteur de sujet ainsi que la date de la réponse
	echo htmlentities(trim($data['prenom_etu'] . ' ' . $data['nom_etu']));
        
	echo '<br />';
	echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;
        
        if ($data['id_etu'] != $_SESSION['currentUser']->getId())
        {
            echo '<br />';
            echo '<a href="index.php?section=envoyer_messagerie&etudiant=' . $data['id_etu'] . '"><img width="30" style="vertical-align:-65%;" src="../images/mail.png" alt="Mails" title="Message priv&eacute;"/>Message priv&eacute;</a>';
        }
        echo '<br />';
        // on prépare notre requête
	$sql = 'SELECT id_reponse FROM forum_reponses WHERE forum_reponses.auteur = ' . $data['id_etu'];

	// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
	$reqNbMessages = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
        echo 'Messages: ' . mysql_num_rows($reqNbMessages);
	echo '</td><td class="prem_colonne">';
	// on affiche le message
	echo formatURL(nl2br(htmlentities(trim($data['message']))));
	echo '</td>';
        if ($_SESSION['currentUser']->getAdmin())
        {
            ?>
            <td class="autre_colonne" style="vertical-align: top;">
                <a href="../../forum/controleur/delete.php?type=post&id=<?php echo $data['id_reponse']; ?>"><img src="../../images/admin/flat_supp.png" alt="Supprimer" title="Supprimer" /></a>
            </td>
            <?php
        }
            echo "</tr>";
	}
        
	// on libère l'espace mémoire alloué pour cette reqête
	mysql_free_result ($req);
	// on ferme la connection à la base de données.
	mysql_close ();
	?>

	<!-- on ferme notre table html -->
	</table>


        