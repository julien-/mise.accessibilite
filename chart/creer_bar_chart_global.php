<link rel="stylesheet" type="text/css" href="http://visapi-gadgets.googlecode.com/svn/trunk/barsofstuff/bos.css"/>
<script type="text/javascript" src="http://visapi-gadgets.googlecode.com/svn/trunk/barsofstuff/bos.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="../js/jquery-1.11.0.js"></script>
<?php
    $sql = 'SELECT sum(compris+assimile+fait) as progression, count(*)*100 as total '
            . 'FROM avancement a, theme t, exercice e, cours c '
            . 'WHERE id_etu != 17 '
            . 'AND e.id_exo = a.id_exo '
            . 'AND e.id_theme = t.id_theme '
            . 'AND t.id_cours = c.id_cours '
            . 'AND c.id_cours = ' . $id_cours;
    $reqMax = mysql_query($sql) or die (mysql_error());
    $max = mysql_fetch_array($reqMax);
    $progression = $max['progression'];
    $total = $max['total'];
    if ($max['total'] == 0)
        $pourcentage = 0;
    else
        $pourcentage = number_format(($progression / $total) * 100,2); 
?>
<div id="chartdiv" style="width: 100%;"></div>
<script type="text/javascript">
  google.load("visualization", "1");
  google.setOnLoadCallback(drawChart);
  var chart;
  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Label');
    data.addColumn('number', 'Value');
    data.addRows(1);
    data.setCell(0, 0, '<?php echo $pourcentage; ?> %');
    data.setCell(0, 1, <?php echo $progression; ?>, '');

    var chartDiv = document.getElementById('chartdiv');
    var options = {max: <?php echo $total; ?>, min: 0, width: 1000, type: 'Chocolate', canSelect:false};
    chart = new BarsOfStuff(chartDiv);
    chart.draw(data, options);
  }
</script>