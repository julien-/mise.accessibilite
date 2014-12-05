var tour = new Tour({
  steps: [
  {
    element: "#tableau-cours",
    title: "Vos cours",
    content: "Vous pouvez retrouver ici tous les cours que vous avez créé",
    placement: "top",
  },
  {
    element: "#addCours",
    title: "Ajouter un cours",
    content: "Cliquez ici pour ajouter un cours",
  }  
]
});
// Initialize the tour
tour.init();
 // Added this

$("#help").click(function(){
	tour.restart();
	});

		