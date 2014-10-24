function showPassword() {
    
    var key_attr = $('#mdp').attr('type');
    
    if(key_attr != 'text') {
        
        $('.checkbox').addClass('show');
        $('#mdp').attr('type', 'text');
        
    } else {
        
        $('.checkbox').removeClass('show');
        $('#mdp').attr('type', 'password');
        
    }
    
}

$(document).ready(function() {

//Controle après submit :

//Controle avant submit :

    if ($("#msg_erreur_connex").text() != '')
    {
        //Affiche une erreur(se cache toute seule grace à cummun.js)
        $("#form_connex").append("<div class='erreur'>" + $("#msg_erreur_connex").html() + "</div>");
        //efface le contenu
        $("#msg_erreur_connex").text("");
       
        
    }
    
    if ($("#msg_erreur_inscri").text() != '')
    {
        //Affiche une erreur(se cache toute seule grace à cummun.js)
        $("#form_connex").append("<div class='erreur'>" + $("#msg_erreur_inscri").html() + "</div>");
        //efface le contenu
        $("#msg_erreur_inscri").text("");
        
    }



//###################################
//CONNEXION ETUDIANT et ADMIN
//###################################
    $("#form_connex").submit(function() {
        //## 1 ## Tous les champs non vides
        if (($("#pseudo").val() === "") | ($("#password").val() === "")) {
            //Affiche une erreur
            $("#form_connex").append('<div class="erreur">Tous les champs doivent être complétés</div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //On ne soumet pas le formulaire
            return false;
        }

        //## 2 ##
        return true;
    });


    //###################################
    //INSCRIPTION ETUDIANT et ADMIN
    //###################################
    $("#form_inscri").submit(function() {
        //## 1 ##
        if (($("#nom_etu").val() === "") | ($("#prenom_etu").val() === "") | ($("#mail_etu").val() === "") | ($("#pseudo_etu").val() === "") | ($("#pass_etu").val() === "")) {
            //Affiche une erreur
            $("#form_inscri").append('<div class="erreur">Tous les champs sont obligatoires</div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //On ne soumet pas le formulaire
            return false;
        }

        //## 2 ## Format de mail saisie conforme ou pas
        var envoiFormulaire = true;
        var champMail = ["mail_etu"];

        $.each(champMail, function() {
            $element = $("#" + this);
            if ($element.val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/) === null) {
                //Affiche une erreur
                $("#form_connex").append('<div class="erreur">Adresse mail non conforme</div>');
                //cache l'erreur
                $('.erreur').delay(3000).fadeOut();
                //On ne soumet pas le formulaire
                envoiFormulaire = false;
            }
        });
        if (!envoiFormulaire)
            return false;

        //## 3 ## Verification si le mot de passe et la confirmation du mot de passe sont identiques
        if ($("#pass_etu").val() === "" || $("#pass_etu").val() !== $("#conf_pass_etu").val())
        {
            //Affiche une erreur
            $("#form_inscri").append('<div class="erreur">Le mot de passe et sa confirmation sont pas correctes</div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //efface les champs "mot de passe" et "confirmation mot de passe"
            $("#pass_etu").val("");
            $("#conf_pass_etu").val("");
            //On ne soumet pas le formulaire
            return false;
        }

        //## 4 ##
        return true;
    });





});