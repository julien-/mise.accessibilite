var tour = new Tour({
  steps: [
  {
	placement: 'bottom',
    element: "#gestion",
    title: "Gérez votre cours",
    content: "Construisez votre cours en ajoutant chapitres, exercices et fichiers",
  },
  {
	placement: 'bottom',
    element: "#seance",
    title: "Gérez votre emploi du temps",
    content: "Ajoutez, supprimez ou modifiez la date des séances relatives à ce cours",
  },
  {
	placement: 'bottom',
    element: "#etudiants",
    title: "Suivez vos étudiants",
    content: "Suivez la progression de vos étudiants dans ce cours en accédant à différentes statistiques",
  },
  {
	placement: 'bottom',
    element: "#etudiants",
    title: "Suivez la promotion",
    content: "Suivez la progression de votre promotion dans ce cours",
  }
]
});

tour.init();

$("#help").click(function(){
	tour.restart();
});

		