function drawBarChart(urlJSON, options, divID)  {
    var json = $.ajax({
            url: urlJSON,
            dataType: 'json',
            async: false
    }).responseText;
    var data = new google.visualization.DataTable(json);

    new google.visualization.BarChart(document.getElementById(divID)).draw(data, options);
}

function setBarChartOptions(urlJSON, options, divID)
{
    google.load('visualization', '1', {'packages':['corechart']});
    google.setOnLoadCallback(function() { drawBarChart(urlJSON, options, divID); });
}