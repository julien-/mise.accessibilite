<script type="text/javascript" src="../../js/googleChartToolsLineChart.js"></script>
<script type="text/javascript">
        var optionsLineChart = {
        		height: 300,
        		backgroundColor: { fill:'transparent' },
        		vAxis: {minValue: 0, maxValue: 100},
        		lineWidth: 4,
        		series: {
        	            0: { color: 'blue' },
        	            1: { color: 'red' }
        	    },
        };
        setLineChartOptions('../../chart/get_json_seance.php', optionsLineChart, 'lineChart');
        //setLineChartOptions('../../chart/get_json_visits.php?etudiant=<?php echo $_SESSION['currentUser']->getId();?>&cours=<?php echo $_SESSION['cours']->getId();?>', optionsLineChart, 'lineChart');
</script>
<div id="lineChart"></div>