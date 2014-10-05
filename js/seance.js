function TAB_selon_COURS() {
    //id_cours, utile pour l'ajout d'une seance afin de transmettre l'id choisi dans la liste déroulante à PHP
    $("#id_cours_sel2").val($("#liste_cours option:selected").val());    //récupère dans le formulaire pour l'ajout de seances,  l'id_cours (pour un $_POST)
    $("#id_cours_sel").val($("#liste_cours option:selected").val());    //récupère dans le formulaire pour l'ajout de seances,  l'id_cours (pour un $_POST)
    $('#soumisadd').attr('title', "Nouvelle séance du cours de " + $("#liste_cours option:selected").text()); //Modifie le titre du bouton d'ajout de seances selon le choix de la liste déroulante

    var nb_seance_visible = $(".trSEANCE_" + $("#liste_cours").val()).length;
    if (nb_seance_visible > 0)
    {
        //on affiche le tableau
        $("#seance").show();
        $("#tab_seance").show();
        $("#msg_seance").text("");  //Aucun message à afficher

        $("#tab_seance tr:not(.titre)").hide(); //cache tous les tr du tableau sauf les titres
        $(".trSEANCE_" + $("#liste_cours").val()).show(); //montre les bons tr (ayant le meme id que la liste déroulante)


    }
    else
    {
        //affiche seulement le formulaire
        $("#seance").show();
        $("#tab_seance").hide();
        $("#msg_seance").text("Veuillez créer une séance au cours séléctionné.");

    }

    //Choix des couleurs
    $(".form_choix_couleur").hide();
    $("#form_couleur_cours_" + $("#id_cours_sel").val()).show();
}

$(document).ready(function()
{
    var nb_cours = $("#liste_cours option").length;

    if (nb_cours > 0)
    {

        TAB_selon_COURS();
        //changement de la liste déroulante des cours
        $("#liste_cours").change(function() {
            TAB_selon_COURS();
            //SELECTION PAR DEFAUT (1er de la liste déroulante)
            //Liste déroulante pas encore séléctionné mais il faut quand meme afficher les bons résultats)
            //permet de garder le meme element dans la liste déroulante après une requete
            //(créé une variable SESSION pour garder après les requetes
            $.post("../admin/seance.php", {"id_cours_sel": $("#liste_cours option:selected").val()});
        });
    }
    else
    {
        $("div #seance").html("Merci de créer un cours avant de pouvoir en gérer ses séances");
    }

    $(".color").change(function() {
        $("#form_couleur_cours_" + $("#id_cours_sel").val()).submit();
    });


    $('.img_sup_seance').click(function() {
        return confirm("Voulez-vous supprimer cette séance ?");
    });

}
);