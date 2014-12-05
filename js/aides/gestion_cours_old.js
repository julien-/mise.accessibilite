var tour = new Tour({
  steps: [
  {
	placement: 'left',
    element: "#icon-cours",
    title: "Actions sur le cours",
    content: "Cliquez ici pour ajouter un thème au cours, modifier le titre ou supprimer le cours",
    	backdrop:true
  }
]
});

tour.init();

$("#help").click(function(){
	tour.restart();
});

		