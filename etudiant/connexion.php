<!-- Page d'inscription -->
<?php
include_once('../sql/connexion_mysql.php');
include_once('../fonctions.php');
$erreur = '';
include_once('rq_compte.php');

if (!isset($_GET['f']))
{
    if (isset($_POST['submit_oublie']))
    {
        $sql = "SELECT * FROM etudiant WHERE mail_etu ='" . $_POST['mail_oublie'] . "'";
        $reqOublie = mysql_query($sql) or die (mysql_eror());
        if (mysql_num_rows($reqOublie) > 0)
        {
            echo "<p>Vous allez recevoir un email contenant votre mot de passe à l'adresse suivante: " . $_POST['mail_oublie'] . "</p>";
            $oublie = mysql_fetch_assoc($reqOublie);
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $_POST['mail_oublie'])) // On filtre les serveurs qui rencontrent des bogues.
            {
                    $passage_ligne = "\r\n";
            }
            else
            {
                    $passage_ligne = "\n";
            }
            $newMDP = genererMDP(8);
            $message = "Bonjour " . $oublie['prenom_etu'] . $passage_ligne . $passage_ligne;
            $message .= "Voici vos identifiants, ne les oubliez pas cette fois !" . $passage_ligne;
            $message .= "Le mot de passe a été généré aléatoirement. Vous pouvez le changer dans la rubrique 'Mon Compte' du site." . $passage_ligne;
            $message .= "Login: " . $oublie['pseudo_etu'] . $passage_ligne;
            $message .= "Mot de passe: " . $newMDP;
            if (mailFree($_POST['mail_oublie'], "Mot de passe oublié" , $message)==false) 
            {
                echo "<p>L'envoi du message n'a pas été réalisé en raison des limitations des serveurs de Free, merci de réessayer un peu plus tard.</p>";
            }
            else
            {
                $sql = "UPDATE etudiant SET pass_etu = '" . md5($newMDP) ."' WHERE id_etu = " . $oublie['id_etu'];
                mysql_query($sql) or die (mysql_eror());
            }
        }
        else
        {
            echo "<p>L'adresse " . $_POST['mail_oublie'] . " est inconnue.</p>";
        }
        
        }
        
    if (isset($_GET['pseudo']))
        echo "<p style=\"text-align:center; color:red; font-weight: bold;\">Ce login (" . $_GET["pseudo"] . ") est déjà utilisé ! <br/></p>";
        
    if (isset($_GET['mail']))
        echo "<p style=\"text-align:center; color:red; font-weight: bold;\">Cette adresse email (" . $_GET["mail"] . ") est déjà utilisée ! <br/></p>";

    if (isset($_GET['mailinv']))
        echo "<p style=\"text-align:center; color:red; font-weight: bold;\">Adresse email invalide ! <br/></p>";

    if (isset($_GET['logininv']))
        echo "<p style=\"text-align:center; color:red; font-weight: bold;\">Le login ne peut pas contenir d'espaces ! <br/></p>";

    ?>
    <!-- CONNEXION --> 
    <div id="divconnexion">
        <h1 class="titre_fond_rouge">CONNEXION</h1>
        
        <form method="post" id="form_connex" name="form_connex" action="rq_connexion.php<?php if (isset($_GET['section'])) echo substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'], "?")); ?>">
            
            <table class="formulaire">
                <tbody>
                    <tr>
                        <td colspan="2" align="center">
                            <span class="note">Saisissez vos identifiants</span>
                            <br/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="libelle_champ" for="pseudo">Pseudo ou email:</label>
                         </td>
                         <td>
                            <input name="pseudo" type="text" id="pseudo" title="Taper votre pseudo" class="inputValDefaut">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="libelle_champ" for="password">Mot de Passe :</label>
                         </td>
                         <td>
                            <input type="password" name="password" id="password" title="Taper votre mot de passe">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2">
                            <p style="text-align:center; font-size: 0.8em;"><a href="index.php?f=true" >Mot de passe oublié ?</a></p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2">
                            <input class="button_1" type="submit" name="submit" value="Se connecter">
                        </td>
                    </tr>
            </table>
            <div id="msg_erreur_connex" name="msg_erreur_connex"></div>
        </form>
    </div>




    <!-- INSCRIPTION -->
    <div id="divinscription">
        <h1 class="titre_fond_rouge">INSCRIPTION</h1>
        <form method="post" id="form_inscri" name="form_inscri" action="index.php">
            <table class="formulaire">
                <tbody>
                    <tr>
                        <td colspan="2" align="center">
                            <span class="note">Tous les champs sont requis</span>
                            <br/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="libelle_champ" for="nom_etu">Nom:</label></td>
                        <td><input type="text" name="nom_etu" id="nom_etu"size="26" value="<?php if (isset($_POST['nom_etu'])) echo $_POST['nom_etu'];?>" title="Taper votre nom" <?php if (!isset($_POST['nom_etu'])) echo "class=\"inputValDefaut\""; ?>></td>
                    </tr>
                    <tr>
                        <td><label class="libelle_champ" for="prenom_etu">Prénom:</label></td>
                        <td><input type="text" name="prenom_etu" id="prenom_etu" size="26" title="Taper votre prénom" value="<?php if (isset($_POST['prenom_etu'])) echo $_POST['prenom_etu'];?>" <?php if (!isset($_POST['prenom_etu'])) echo "class=\"inputValDefaut\""; ?>></td>
                    </tr>
                    <tr>
                        <td><label class="libelle_champ" for="mail_etu">Mail:</label></td>
                        <td><input type="text" name="mail_etu" id="mail_etu" size="26" title="Taper votre adresse email" value="<?php if (isset($_POST['mail_etu'])) echo $_POST['mail_etu'];?>" <?php if (!isset($_POST['mail_etu'])) echo "class=\"inputValDefaut\""; ?>></td>
                    </tr>
                     <tr>
                        <td><label class="libelle_champ" for="pseudo_etu">Pseudonyme:</label></td>
                        <td><input type="text" name="pseudo_etu" id="pseudo_etu" size="26" title="Taper votre pseudo" value="<?php if (isset($_POST['pseudo_etu'])) echo $_POST['pseudo_etu'];?>" <?php if (!isset($_POST['pseudo_etu'])) echo "class=\"inputValDefaut\""; ?>></td>
                    </tr>
                     <tr>
                        <td><label class="libelle_champ" for="pass_etu">Mot de passe:</label></td>
                        <td><input type="password" name="pass_etu" id="pass_etu" size="26" value=""></td>
                     </tr>
                     <tr>
                        <td><label class="libelle_champ" for="conf_pass_etu">Confirmation mot de passe:</label></td>
                        <td><input type="password" name="conf_pass_etu" id="conf_pass_etu" size="26" value=""></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input class="button_1" type="submit" id="addcompte" name="addcompte" value="S'inscrire" align="center" class="bouton">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div id="msg_erreur_inscri"><?php
                echo $erreur;
            ?></div>
        </form>
    </div>

<?php
}
else
{
?>
    
    <form method="post" class="form_oublie" name="form_oublie" action="index.php?">
        <table class="formulaire" >
            <tr>
                <td colspan="2" align="center">
                    <span class="note">Veuillez saisir votre adresse email pour recevoir votre mot de passe.</span>
                </td>
            </tr>
            <tr>
                <td><label class="libelle_champ" for="mail_oublie">Votre adresse email:</label></td>
                <td><input name="mail_oublie" id="pass_etu" size="26" value=""></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <br/>
                    <input class="button_1" style="width:auto;" type="submit" name="submit_oublie" value="Recevoir mon mot de passe"/>
                </td>
            </tr>
        </table>
    </form>
<?php
}



