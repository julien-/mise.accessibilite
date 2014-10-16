function drawColumnChart(urlJSON, options, divID)  {
    var json = $.ajax({
            url: urlJSON,
            dataType: 'json',
            async: false
    }).responseText;
    var data = new google.visualization.DataTable(json);
    new google.visualization.ColumnChart(document.getElementById(divID)).draw(data, options);
}

function setColumnChartOptions(urlJSON, options, divID)
{
    google.load('visualization', '1', {'packages':['corechart']});
    google.setOnLoadCallback(function() { drawColumnChart(urlJSON, options, divID); });
}