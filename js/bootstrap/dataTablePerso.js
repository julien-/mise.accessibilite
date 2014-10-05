$("#example tbody tr").click(function() {
    if ($(this).hasClass('selectedRow')) {
        $(this).removeClass('selectedRow');
    }
    else {
        $(this).addClass('selectedRow');
    }
});

$(document).ready(function() {
    var tab = new Array;
    var table = $('#example').DataTable();
    $('#button').click(function() {
        alert(table.rows('.selectedRow').data().length + ' row(s) selected');
        $(".selectedRow").each(function() {
            var customerId = $(this).find(".cell").html();
            tab.push(customerId);
            alert(tab.length);
        });
    });
});
        