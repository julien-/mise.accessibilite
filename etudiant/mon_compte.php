<?php
if (isset($_GET['pseudo']))
    echo "<p style=\"text-align:center; color:red; font-weight: bold;\">Ce login (" . $_GET["pseudo"] . ") est déjà utilisé ! <br/></p>";
        
if (isset($_GET['mail']))
    echo "<p style=\"text-align:center; color:red; font-weight: bold;\">Cette adresse email (" . $_GET["mail"] . ") est déjà utilisée ! <br/></p>";

if (isset($_GET['mailinv']))
    echo "<p style=\"text-align:center; color:red; font-weight: bold;\">Adresse email invalide ! <br/></p>";

if (isset($_GET['logininv']))
    echo "<p style=\"text-align:center; color:red; font-weight: bold;\">Le login ne peut pas contenir d'espaces ! <br/></p>";
?>

<div id="divmodif1">
    <h1 class="titre_police_us">MODIFICATION DU PROFIL</h1>
    <h3>Tous les champs sont requis</h3>
    <form method="post" id="form_compt" name="form_compt" action="rq_compte.php">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom"size="26" value="<?php echo($_SESSION["nom"]); ?>"><br/>

        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" id="prenom" size="26" value="<?php echo($_SESSION["prenom"]); ?>"><br/>

        <label for="mail">Mail:</label>
        <input type="text" name="mail" id="mail" size="26" value="<?php echo($_SESSION["mail"]); ?>"><br/>

        <label for="pseudo">Pseudonyme:</label>
        <input type="text" name="pseudo" id="pseudo" size="26" value="<?php echo($_SESSION["pseudo"]); ?>"><br/>
        <p>
            <input type="submit" name="soumis1" value="Modifier"/> 
        </p>
    </form>
</div>

<div id="divmodif2">
    <h1 class="titre_police_us">MODIFICATION DU MOT DE PASSE</h1>
    <form method="post" id="form_pass" name="form_pass" action="rq_compte.php">
        <label for="pass1">Nouveau mot de passe :</label>
        <input type="password" id="pass1" name="pass1" size="26" value=""><br/>

        <label for="pass2">Retapez le nouveau mot de passe :</label>
        <input type="password" id="pass2" name="pass2" size="26" value=""><br/>
        <p>
            <input type="submit" name="soumis2" id="soumis2" value="Modifier"/> 
        </p>
    </form>
</div>




