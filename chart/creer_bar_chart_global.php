<link rel="stylesheet" type="text/css" href="http://visapi-gadgets.googlecode.com/svn/trunk/barsofstuff/bos.css"/>
<script type="text/javascript" src="http://visapi-gadgets.googlecode.com/svn/trunk/barsofstuff/bos.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="../js/jquery-1.11.0.js"></script>
<?php

    $daoAvancement = new DAOAvancement($db);
    $progression = $daoAvancement->getByCours($_SESSION['cours']->getId());
    $progressionEtudiant = $daoAvancement->getByCoursEtudiant($_SESSION['cours']->getId(), $_SESSION['currentUser']->getId());
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'La promo', 'Moi'],
          ['Avancement', <?php echo $progression?>, <?php echo $progressionEtudiant; ?>],
        ]);

        var options = {
          hAxis: {title: "Avancement en %" , maxValue: 100,  minValue: 0},
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, options);
      }
    </script>
<div id="barchart_material" style="width: 500px; height: 200px;"></div>