/** Messages fading **/
  $( ".fading-alert" ).fadeOut( 4000, function() {
	  $( ".fading-alert" ).addClass('hidden');
  });
  

//##############
//Les input text
//##############

$(".inputValDefaut").bind({
    blur: function() {  //perd le focus du input
        if ($(this).val() === "")
        {
            $(this).val($(this).attr("title"));
            $(this).removeClass("inputValDefautValeur");
        }
    },
    focus: function() { //prends le focus du input
        if ($(this).val() === $(this).attr("title"))
        {
            $(this).val("");
            $(this).addClass("inputValDefautValeur");
        }
    }
});

//Traitement sans action de l'utilisateur
$(".inputValDefaut").each(function() {
    //gris
    if ($(this).val() === "")
        $(this).val($(this).attr("title"));
    //noir
    if ($(this).val() !== $(this).attr("title"))
        $(this).addClass("inputValDefautValeur");
    else
        $(this).removeClass("inputValDefautValeur");
        
});


//##################################################################
//###########   Mise en forme de la saisie   #######################
//##################################################################
//Seulement à ajouter le nom des champs dans les 3 tableaux ci dessous et la valeur par default de chacun

// 1 MAJUSCULE
var tabMajuscule = {
    nom_etu: "Taper votre nom", //connexion.php (admin et etudiant)
    nom: "Taper votre nom"                  //mon_compte.php
};
$.each(tabMajuscule, function(key, value)
{
    $("#" + key).blur(function() {
        if ($("#" + key).val() !== value)
        {
            $(this).val($(this).val().toUpperCase());
        }
    });
});
// 2 Première majuscule
var tabPremMajus = {
    prenom_etu: "Taper votre prénom", //connexion.php (admin et etudiant)
    prenom: "Taper votre prénom"            //mon_compte.php
};
$.each(tabPremMajus, function(key, value)
{
    $("#" + key).blur(function() {
        if ($("#" + key).val() !== value)
        {
            $(this).val($(this).val().charAt(0).toUpperCase() + $(this).val().slice(1));
        }
    });
});
// 3 minuscule
var tabMinuscule = {
    mail_etu: "Taper votre adresse email", //connexion.php (admin et etudiant)
    mail: "Taper votre adresse email"        //mon_compte.php
};
$.each(tabMinuscule, function(key, value)
{
    $("#" + key).blur(function() {
        if ($("#" + key).val() !== value)
        {
            $(this).val($(this).val().toLowerCase());
        }
    });
});

//4 sans espace
var tabSansEspace = {
    pseudo_etu: "Taper votre pseudo", //connexion.php (admin et etudiant)
    pseudo: "Taper votre pseudo"            //mon_compte.php
};
$.each(tabSansEspace, function(key, value)
{
    $('#' + key).bind('input', function() {
        $(this).val(function(_, v) {
            return v.replace(/\s+/g, '');
        });
    });
});

/*########
 div d'affichage des messages (connexion / echec)
 ########*/
$(document).ready(function() {
    if ($(".ok").text() !== "")
    {
        $(".ok").show(function() {
            $(this).delay(2000).fadeOut();
        });
    }
    if ($(".erreur").text() !== "")
    {
        $(".erreur").show(function() {
            $(this).delay(2000).fadeOut();
        });
    }
});

