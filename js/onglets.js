
Onglet_afficher = 1;
function Affiche(Nom)
{
    document.getElementById('affiche-contenu-'+Onglet_afficher).className = 'inactif onglet';
    document.getElementById('contenu_'+Onglet_afficher).style.display = 'none';
    document.getElementById('affiche-contenu-'+Nom).className = 'affiche-contenu-1 onglet';
    
    document.getElementById('contenu_'+Nom).style.display = 'block';
    Onglet_afficher = Nom;
}

var Onglet_afficher_doc = -1;
function AfficheDocuments(Nom)
{
    if (Onglet_afficher_doc != -1)
    {
        document.getElementById('affiche-contenu-'+Onglet_afficher_doc).className = 'inactif onglet_without_borders';
        document.getElementById('contenu_'+Onglet_afficher_doc).style.display = 'none';
    }
    document.getElementById('affiche-contenu-'+Nom).className = 'affiche-contenu-1 onglet_without_borders';
    
    document.getElementById('contenu_'+Nom).style.display = 'block';
    Onglet_afficher_doc = Nom;
}