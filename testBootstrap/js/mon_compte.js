$(document).ready(function() {


    $("#form_compt").submit(function() {
        //## 1 ##
        if (($("#nom").val() === "") | ($("#prenom").val() === "")| ($("#mail").val() === "")| ($("#pseudo").val() === "")) {
            //Affiche une erreur
            $("#form_pass").append('<div class="erreur">Tous les champs doivent être complétés</div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() { $('.erreur').remove();}, 4000);
            //On ne soumet pas le formulaire
            return false;
        }
        
        //## 2 ##
        return true;
    });



    $("#form_pass").submit(function() {
        //## 1 ##
        if (($("#pass1").val() === "") | ($("#pass2").val() === "")) {
            //Affiche une erreur
            $("#form_pass").append('<div class="erreur">Les 2 champs doivent être non-vides</div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() { $('.erreur').remove();}, 4000);
            //On ne soumet pas le formulaire
            return false;
        }

        //## 2 ##
        if ($("#pass1").val() !== $("#pass2").val()) {
            //Affiche une erreur
            $("#form_pass").append('<div class="erreur">Les saisies ne sont pas identiques</div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() { $('.erreur').remove();}, 4000);
            //On ne soumet pas le formulaire
            return false;
        }

        //## 3 ##
        return true;
    });
});