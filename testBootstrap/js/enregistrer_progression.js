$(document).ready(function() {
    
    $("#etudiants").change(function() {
                    var number = $('#etudiants option:selected').val();
                    var nom_etu = $('#etudiants option:selected').text();
                    
                    var input = document.createElement('input');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('name', 'Etudiant[]');
                    input.setAttribute('value', number);
                    
                    $(chosen_student).append('<font>|&nbsp;&nbsp;'+nom_etu+'&nbsp;&nbsp;|&nbsp');
                    $(input_hidden).prepend(input);
                });
                
     $("#note").change(function() {
                    alert("coucou");
                });
                
    $("button").click(function() {
        //$(this).parents('font').remove();
        alert("coucou");
    });
                
    //changement de la liste déroulante des themes
    $("#liste_seances").change(function() {
        if ($(this).val() === "") {
            // Toutes les séances
            location.href = "index.php?section=enregistrer_progression";
        }
        else {
            // Redirection vers la séance séléctionnée
            location.href = "index.php?section=enregistrer_progression&seance=" + $("#liste_seances option:selected").val();
        }
    });

    //ID des CHECKBOX: NUMERO d'exercice dans le thème
    //NAME des CHECKBOX : ID de l'exerice
    //CLIC sur un input checkbox FAIT
    $(".fait").click(function() {
        //###
        //#1#
        //###
        var idcompris = 'input[name="compris' + $(this).val() + '"]';
        var idassimile = 'input[name="assimile' + $(this).val() + '"]';
        //Si on décoche et que les 2 autres sont cochés
        if (!$(this).is(':checked') && ($(idcompris).is(':checked')) || $(idassimile).is(':checked')) {
            //Affiche une erreur
            $("form_progres").append('<div class="erreur">L\'exercice doit au moins être <u>fait</u> pour l\'avoir <u>compris</u> et <u>assimilé</u></div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() {
                $('.erreur').remove();
            }, 4000);
            return false;
        }

        //Verif si l'exercice PRECEDENT est fait
        var id = $(this).attr('id');    //exemple: fait_7_1
        var sep1 = id.indexOf("_");     //position separateur 1
        var sep2 = id.lastIndexOf("_"); //position separateur 2
        var theme = id.substring(sep1 + 1, sep2);   //Sous chaine de id (commence à 0), [debut, fin]
        var exo = id.substring(sep2 + 1, id.length);
        if (exo > 1) {
            var atester = "#fait_" + theme + "_" + (parseInt(exo)-1).toString();
            if (!$(atester).is(':checked') && ($(this).is(':checked'))) {
                //Affiche une erreur
                $("#form_progres").append('<div class="erreur">L\'exercice précédent doit être <u>fait</u></div>');
                //cache l'erreur
                $('.erreur').delay(3000).fadeOut();
                //Supprime l'erreur
                setTimeout(function() {
                    $('.erreur').remove();
                }, 4000);
                return false;
            }

            //Verif si l'exercice SUIVANT est fait
            var atester = "#fait_" + theme + "_" + (parseInt(exo)+1).toString();
            if ($(atester).is(':checked') && (!$(this).is(':checked'))) {
                //Affiche une erreur
                $("#form_progres").append('<div class="erreur">L\'exercice précédent doit être <u>fait</u></div>');
                //cache l'erreur
                $('.erreur').delay(3000).fadeOut();
                //Supprime l'erreur
                setTimeout(function() {
                    $('.erreur').remove();
                }, 4000);
                return false;
            }
        }
    });

    //CLIC sur un input checkbox COMPRIS (idem pour assimilé)
    $(".compris").click(function() {
        //###
        //#2#
        //###
        var idfait = "input[name=fait" + $(this).val() + "]";

        //Si l'exerice n'est pas au moins fait
        if (!$(idfait).is(':checked')) {
            //Affiche une erreur
            $("#form_progres").append('<div class="erreur">L\'exercice doit au moins être <u>fait</u> pour l\'avoir <u>compris</u></div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() {
                $('.erreur').remove();
            }, 4000);
            return false;
        }
        //###
        //#4#
        //###
        var idassimile = "input[name=assimile" + $(this).val() + "]";
        //Si on décoche et que les 2 autres sont cochés
        if (!$(this).is(':checked') && $(idassimile).is(':checked')) {
            //Affiche une erreur
            $("#form_progres").append('<div class="erreur">L\'exercice doit au moins être <u>compris</u> pour être <u>assimilé</u></div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() {
                $('.erreur').remove();
            }, 4000);
            return false;
        }
    });

    //CLIC sur un input checkbox ASSIMILé (idem pour compris)
    $(".assimile").click(function() {
        //###
        //#5#
        //###
        var idfait = "input[name=fait" + $(this).val() + "]";
        //Si l'exerice n'est pas au moins fait
        if (!$(idfait).is(':checked')) {
            //Affiche une erreur
            $("#form_progres").append('<div class="erreur">L\'exercice doit au moins être <u>fait</u> pour l\'avoir <u>assimilé</u></div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() {
                $('.erreur').remove();
            }, 4000);
            return false;
        }
        //###
        //#6#
        //###
        var idcompris = "input[name=compris" + $(this).val() + "]";
        //Si l'exerice n'est pas au moins fait
        if (!$(idcompris).is(':checked')) {
            //Affiche une erreur
            $("#form_progres").append('<div class="erreur">L\'exercice doit au moins être <u>compris</u> pour l\'avoir <u>assimilé</u></div>');
            //cache l'erreur
            $('.erreur').delay(3000).fadeOut();
            //Supprime l'erreur
            setTimeout(function() {
                $('.erreur').remove();
            }, 4000);
            return false;
        }
    });


});


