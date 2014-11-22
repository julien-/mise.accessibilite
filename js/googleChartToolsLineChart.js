function drawLineChart(urlJSON, options, divID)  {
    var json = $.ajax({
            url: urlJSON,
            dataType: 'json',
            async: false
    }).responseText;
    var data = new google.visualization.DataTable(json);

    new google.visualization.LineChart(document.getElementById(divID)).draw(data, options);
}

function setLineChartOptions(urlJSON, options, divID)
{
    google.load('visualization', '1', {'packages':['corechart']});
    google.setOnLoadCallback(function() { drawLineChart(urlJSON, options, divID); });
}