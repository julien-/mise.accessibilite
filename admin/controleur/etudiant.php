<?php
$idEtudiant = exists('e', 'etudiant', 'id_etu');

if ($idEtudiant != false)
{
    $daoEtudiant = new DAOEtudiant($db);
    $daoInscription = new DAOInscription($db);
    $daoAvancement = new DAOAvancement($db);
    
    $listeInscription = $daoInscription->getAllByEtudiantProf($idEtudiant, $_SESSION['currentUser']->getId());
    $etudiant = $daoEtudiant->getByID($idEtudiant);
    ?>
        <h1 class="titre_page_school"><?php echo $etudiant->getPrenom() . ' ' . $etudiant->getNom(); ?></h1>
        <h2 class="titre_scolaire">Informations sur l'&eacute;tudiant</h2>
        <label class='libelle_champ' for="mail">Adresse mail</label><a href="mailto:<?php echo $etudiant->getMail(); ?>" id="mail"><?php echo $etudiant->getMail(); ?></a>
        <br/>
        <label class='libelle_champ' for="nbcours">Nombre de cours suivis</label><span id="nbcours"><?php echo $daoInscription->countByEtudiantProf($idEtudiant, $_SESSION['currentUser']->getId()); ?></span>
        <h2 class="titre_scolaire">Cours suivis</h2>
        <table class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th>
                        Cours
                    </th>
                    <th>
                        Progression
                    </th>
                    <th>
                        D&eacute;tails pour ce cours
                    </th>
                </tr>
            </thead>
            <tbody>
    <?php
        
        foreach($listeInscription as $inscription)
        {
        	$progression = $daoAvancement->getByCoursEtudiant($inscription->getCours()->getId(), $idEtudiant);
            ?>
                <tr>
                    <td class='autre_colonne vert-align'>
                        <a href='index.php?section=progression_globale&c=<?php echo $inscription->getCours()->getId(); ?>'><?php echo $inscription->getCours()->getId() ?></a>
                    </td>
                    <td class="autre_colonne vert-align">
                        <span style="color: #339; font-size: 18px; font-weight: bold; font-family: 'please_write_me_a_songmedium';"><?php echo (int) number_format($progression, 2); ?>%</span>
                        <div style="margin: auto; border: 1px solid black; width: 300px; height: 25px;">
                            <div style="height: 100%; background-color: <?php echo Outils::colorChart($progression); ?>; width: <?php echo $progression; ?>%;">&nbsp;</div>
                        </div>
                    </td>
                    <td class="autre_colonne vert-align">
                        <a href='index.php?section=progression_etudiant&e=<?php echo $inscription->getEtudiant()->getId(); ?>&c=<?php echo $inscription->getCours()->getId(); ?>'><img title="D&eacute;tails" alt="D&eacute;tails" src="../images/loupe.png" /></a>
                    </td>
                </tr>
            <?php
        }
        ?>
            </tbody>
        </table>
        <?php
}
?>

