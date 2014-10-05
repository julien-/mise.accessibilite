function drawPieChart(urlJSON, options, divID) 
{
    var json = $.ajax({
            url: urlJSON,
            dataType: 'json',
            async: false
    }).responseText;

    var data = new google.visualization.DataTable(json);
    var chart = new google.visualization.PieChart(document.getElementById(divID));
    chart.draw(data, options);
}

function setPieChartOptions(urlJSON, options, divID)
{
    google.load('visualization', '1', {'packages':['corechart']});
    google.setOnLoadCallback(function() { drawPieChart(urlJSON, options, divID); });
}
